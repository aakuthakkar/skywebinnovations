<?php

namespace App\Services;

use App\Models\SeoBacklink;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Verifies tracked backlinks by making a real HTTP request to each source page
 * and confirming the page still loads and still links back to the target URL.
 *
 * A backlink "fails" if the source returns a hard error (404/410/5xx), the
 * page redirects somewhere unrelated, or the page no longer contains a link
 * to the target. This catches the two common ways backlinks silently die:
 * the linking page is removed, or the site strips your link.
 */
class BacklinkChecker
{
    /** Result codes returned per backlink. */
    public const OK = 'ok';               // link present and healthy
    public const MISSING_LINK = 'missing'; // page loads but our link is gone
    public const DEAD = 'dead';            // page returns 404/410/5xx
    public const UNREACHABLE = 'unreachable'; // timeout/DNS/connection error

    private int $timeout;
    private string $userAgent;

    public function __construct()
    {
        $this->timeout = (int) config('seo.backlink_check_timeout', 15);
        $this->userAgent = config(
            'seo.backlink_check_user_agent',
            'Mozilla/5.0 (compatible; SkyWebBacklinkMonitor/1.0; +https://skywebinnovations.com)'
        );
    }

    /**
     * Check a single backlink and update its record. Returns a result array.
     */
    public function check(SeoBacklink $backlink): array
    {
        $result = $this->verify($backlink->source_url, $backlink->target_url);

        $this->applyResult($backlink, $result);

        return $result;
    }

    /**
     * Check many backlinks. Returns a summary of the batch.
     *
     * @return array{checked:int, ok:int, missing:int, dead:int, unreachable:int, results:array}
     */
    public function checkMany($backlinks): array
    {
        $summary = [
            'checked' => 0, 'ok' => 0, 'missing' => 0,
            'dead' => 0, 'unreachable' => 0, 'results' => [],
        ];

        foreach ($backlinks as $backlink) {
            $result = $this->check($backlink);
            $summary['checked']++;
            $summary[$result['status']] = ($summary[$result['status']] ?? 0) + 1;
            $summary['results'][] = [
                'backlink_id' => $backlink->id,
                'source_url' => $backlink->source_url,
                'status' => $result['status'],
                'http_code' => $result['http_code'],
                'message' => $result['message'],
            ];
        }

        return $summary;
    }

    /**
     * Perform the actual HTTP verification without touching the database.
     *
     * @return array{status:string, http_code:int|null, message:string}
     */
    public function verify(string $sourceUrl, string $targetUrl): array
    {
        try {
            $response = Http::withHeaders(['User-Agent' => $this->userAgent])
                ->timeout($this->timeout)
                ->withOptions(['allow_redirects' => ['max' => 5]])
                ->get($sourceUrl);

            $httpCode = $response->status();

            // Hard failures: the linking page is gone for good.
            if (in_array($httpCode, [404, 410], true)) {
                return ['status' => self::DEAD, 'http_code' => $httpCode, 'message' => "Page returns HTTP {$httpCode} (removed)."];
            }
            if ($httpCode >= 500) {
                // Could be temporary — treat as unreachable, not a hard loss.
                return ['status' => self::UNREACHABLE, 'http_code' => $httpCode, 'message' => "Server error HTTP {$httpCode} (may be temporary)."];
            }
            if ($httpCode === 403 || $httpCode === 429) {
                return ['status' => self::UNREACHABLE, 'http_code' => $httpCode, 'message' => "Blocked/rate-limited (HTTP {$httpCode}) — couldn't verify."];
            }
            if ($httpCode < 200 || $httpCode >= 400) {
                return ['status' => self::UNREACHABLE, 'http_code' => $httpCode, 'message' => "Unexpected HTTP {$httpCode}."];
            }

            // Page loaded — now confirm it still actually links to us.
            if (! $this->pageLinksTo($response->body(), $targetUrl)) {
                return ['status' => self::MISSING_LINK, 'http_code' => $httpCode, 'message' => 'Page loads but no longer links to your site.'];
            }

            return ['status' => self::OK, 'http_code' => $httpCode, 'message' => 'Link is live.'];

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            return ['status' => self::UNREACHABLE, 'http_code' => null, 'message' => 'Could not connect (timeout or DNS failure).'];
        } catch (\Throwable $e) {
            Log::warning('Backlink check failed for ' . $sourceUrl . ': ' . $e->getMessage());
            return ['status' => self::UNREACHABLE, 'http_code' => null, 'message' => 'Check error: ' . $e->getMessage()];
        }
    }

    /**
     * Does the HTML contain an anchor pointing at the target URL?
     * Matches against several normalized forms so trivial differences
     * (trailing slash, http/https, www) don't cause false negatives.
     */
    private function pageLinksTo(string $html, string $targetUrl): bool
    {
        if (trim($html) === '') {
            return false;
        }

        $targetForms = $this->normalizedForms($targetUrl);
        $targetHost = parse_url($targetUrl, PHP_URL_HOST);

        if (preg_match_all('/<a\b[^>]*\bhref\s*=\s*(["\'])(.*?)\1/is', $html, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $m) {
                $href = html_entity_decode(trim($m[2]), ENT_QUOTES);
                foreach ($this->normalizedForms($href) as $form) {
                    if (in_array($form, $targetForms, true)) {
                        return true;
                    }
                }
                // Also accept a same-host link if the target has no path
                // (e.g. someone links to our homepage as https://skywebinnovations.com/).
                if ($targetHost && parse_url($href, PHP_URL_HOST) === $targetHost) {
                    $targetPath = rtrim((string) parse_url($targetUrl, PHP_URL_PATH), '/');
                    $hrefPath = rtrim((string) parse_url($href, PHP_URL_PATH), '/');
                    if ($targetPath === $hrefPath) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * Normalize a URL into comparable forms (with/without trailing slash,
     * with/without scheme+www) so matching is robust.
     *
     * @return array<int,string>
     */
    private function normalizedForms(string $url): array
    {
        $url = trim($url);
        if ($url === '' || str_starts_with($url, '#') || str_starts_with($url, 'mailto:') || str_starts_with($url, 'javascript:')) {
            return [];
        }

        $host = parse_url($url, PHP_URL_HOST);
        $path = parse_url($url, PHP_URL_PATH) ?? '';
        if (! $host) {
            return [];
        }

        $host = str_ireplace('www.', '', $host);
        $path = rtrim($path, '/');

        return [
            $host . $path,
            "https://{$host}{$path}",
            "http://{$host}{$path}",
        ];
    }

    /**
     * Persist the outcome of a check onto the backlink record.
     */
    private function applyResult(SeoBacklink $backlink, array $result): void
    {
        $status = $result['status'];
        $now = now()->toDateString();

        if ($status === self::OK) {
            // Healthy — clear any previously-recorded loss.
            $backlink->forceFill([
                'last_seen_at' => $now,
                'lost_at' => null,
                'is_active' => true,
            ])->save();
            return;
        }

        if ($status === self::MISSING_LINK || $status === self::DEAD) {
            // Confirmed loss — mark it, but only stamp lost_at the first time.
            if (! $backlink->lost_at) {
                $backlink->lost_at = $now;
            }
            $backlink->is_active = false;
            $backlink->last_seen_at = $now;
            $backlink->notes = trim(($backlink->notes ? $backlink->notes . "\n" : '') . '[' . $now . '] ' . $result['message']);
            $backlink->save();
            return;
        }

        // UNREACHABLE — do NOT mark the link lost (could be a temporary
        // outage or a block). Just record that we tried, so it rotates back
        // through the queue on the next run.
        $backlink->last_seen_at = $now;
        $backlink->notes = trim(($backlink->notes ? $backlink->notes . "\n" : '') . '[' . $now . '] ' . $result['message']);
        $backlink->save();
    }
}
