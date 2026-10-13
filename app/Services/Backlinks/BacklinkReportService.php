<?php

namespace App\Services\Backlinks;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\RateLimiter;

/**
 * Orchestrates backlink lookups: chooses the best provider for a domain,
 * caches results so we don't burn API credits on repeat lookups, and
 * rate-limits per client so the free public tool can't be abused.
 *
 * Provider priority:
 *   - the site's own domain  → LocalBacklinkProvider (real, first-party)
 *   - any other domain       → ApiBacklinkProvider     (SE Ranking, may be sample)
 */
class BacklinkReportService
{
    /** Cache a report for this long so repeated lookups don't re-hit the API. */
    private const CACHE_TTL_MINUTES = 360; // 6 hours

    public function __construct(
        private readonly LocalBacklinkProvider $local,
        private readonly ApiBacklinkProvider $api,
    ) {}

    /**
     * @return array{ok: bool, report?: BacklinkReport, error?: string}
     */
    public function lookup(string $domain, int $page = 1, int $perPage = 50, ?string $clientKey = null): array
    {
        $domain = $this->cleanDomain($domain);

        if (! $this->isValidDomain($domain)) {
            return ['ok' => false, 'error' => 'Please enter a valid domain name, e.g. example.com'];
        }

        // Rate limit: a handful of lookups per minute per IP.
        if ($clientKey !== null) {
            $key = 'backlink-lookup:' . $clientKey;
            if (RateLimiter::tooManyAttempts($key, maxAttempts: 10)) {
                $seconds = RateLimiter::availableIn($key);
                return ['ok' => false, 'error' => "Too many lookups. Please try again in {$seconds} seconds."];
            }
            RateLimiter::hit($key, decaySeconds: 60);
        }

        $report = $this->resolve($domain, $page, $perPage);

        return ['ok' => true, 'report' => $report];
    }

    /**
     * Pick and (for the API path) cache the report.
     */
    private function resolve(string $domain, int $page, int $perPage): BacklinkReport
    {
        // First-party data: always fresh, cheap, no caching needed.
        if ($this->local->supports($domain)) {
            return $this->local->fetch($domain, $page, $perPage);
        }

        $cacheKey = "backlinks:api:{$domain}:p{$page}:n{$perPage}";

        return Cache::remember($cacheKey, now()->addMinutes(self::CACHE_TTL_MINUTES), function () use ($domain, $page, $perPage) {
            if (! $this->api->hasKey()) {
                return BacklinkReport::empty(
                    $domain,
                    'This tool shows backlinks for any domain. Live external data requires an API key, '
                    . 'which isn’t connected yet — so no results can be shown right now.'
                );
            }

            return $this->api->fetch($domain, $page, $perPage);
        });
    }

    /**
     * Normalize whatever the user typed into a bare domain.
     */
    public function cleanDomain(string $input): string
    {
        $input = trim(strtolower($input));
        $input = preg_replace('#^https?://#', '', $input) ?? $input;
        $input = explode('/', $input)[0];
        $input = explode('?', $input)[0];
        $input = trim($input, ' .');
        // Treat www.example.com and example.com the same.
        $input = preg_replace('#^www\.#', '', $input) ?? $input;
        return trim($input, ' .');
    }

    private function isValidDomain(string $domain): bool
    {
        return (bool) preg_match('/^(?!-)[a-z0-9-]+(\.[a-z0-9-]+)+$/i', $domain)
            && str_contains($domain, '.')
            && strlen($domain) <= 253;
    }
}
