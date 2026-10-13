<?php

namespace App\Services\Backlinks;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Backlink data from the SE Ranking Data API.
 *
 * Works with a paid API key, and degrades gracefully (returns an empty
 * report with an honest notice) when no key is configured — so the public
 * tool never breaks, it just explains that live data isn't connected yet.
 *
 * API docs: https://seranking.com/api/data/backlinks/
 *   GET /v1/backlinks/summary  → { backlinks, refdomains, ... }
 *   GET /v1/backlinks/all      → [ { url_from, url_to, title, anchor,
 *                                   nofollow, inlink_rank,
 *                                   domain_inlink_rank, first_seen, ... } ]
 */
class ApiBacklinkProvider implements BacklinkProvider
{
    private const BASE = 'https://api.seranking.com/v1/backlinks';

    public function __construct(
        private readonly ?string $apiKey = null,
        private readonly int $timeout = 20,
    ) {}

    public static function fromConfig(): self
    {
        return new self(
            apiKey: config('services.seranking.api_key'),
            timeout: (int) config('services.seranking.timeout', 20),
        );
    }

    public function hasKey(): bool
    {
        return ! empty($this->apiKey);
    }

    public function supports(string $domain): bool
    {
        // The API can serve any domain; we just need a key to actually call it.
        return $this->hasKey();
    }

    public function fetch(string $domain, int $page = 1, int $perPage = 50): BacklinkReport
    {
        if (! $this->hasKey()) {
            return BacklinkReport::empty($domain);
        }

        $perPage = max(1, min(100, $perPage));

        // Summary (totals) and the listing are separate calls. If either fails
        // we still return whatever we have, with a notice rather than a crash.
        $summary = $this->fetchSummary($domain);
        $listing = $this->fetchListing($domain, $page, $perPage);

        if ($listing === null && $summary === null) {
            Log::warning('SE Ranking backlinks: both summary and listing failed', ['domain' => $domain]);
            return BacklinkReport::empty(
                $domain,
                'Live backlink data is temporarily unavailable. Please try again in a moment.'
            );
        }

        $items = collect($listing ?? [])->map(fn (array $row) => $this->toItem($row));

        return new BacklinkReport(
            domain: $domain,
            authorityScore: null, // the API's DA lives on a separate authority endpoint
            totalBacklinks: (int) ($summary['backlinks'] ?? $items->count()),
            referringDomains: (int) ($summary['refdomains'] ?? $items->pluck('sourceDomain')->unique()->count()),
            items: $items,
            source: 'api',
            isSample: true, // free/limited API plans return a capped result set
            hasMore: $items->count() >= $perPage,
            page: $page,
        );
    }

    /**
     * @return array{backlinks?:int, refdomains?:int}|null
     */
    private function fetchSummary(string $domain): ?array
    {
        try {
            $response = Http::timeout($this->timeout)
                ->withToken($this->apiKey)
                ->get(self::BASE . '/summary', [
                    'apikey' => $this->apiKey,
                    'target' => $domain,
                    'mode' => 'domain',
                    'output' => 'json',
                ]);

            if (! $response->successful()) {
                Log::info('SE Ranking summary non-2xx', ['status' => $response->status(), 'domain' => $domain]);
                return null;
            }

            return $response->json() ?? [];
        } catch (\Throwable $e) {
            Log::warning('SE Ranking summary error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * @return array<int,array>|null
     */
    private function fetchListing(string $domain, int $page, int $perPage): ?array
    {
        try {
            $offset = ($page - 1) * $perPage;

            $response = Http::timeout($this->timeout)
                ->withToken($this->apiKey)
                ->get(self::BASE . '/all', [
                    'apikey' => $this->apiKey,
                    'target' => $domain,
                    'mode' => 'domain',
                    'limit' => $perPage,
                    'next' => $offset > 0 ? (string) $offset : null,
                    'order_by' => 'domain_inlink_rank',
                    'output' => 'json',
                ]);

            if (! $response->successful()) {
                Log::info('SE Ranking listing non-2xx', ['status' => $response->status(), 'domain' => $domain]);
                return null;
            }

            $data = $response->json();
            return is_array($data) ? $data : [];
        } catch (\Throwable $e) {
            Log::warning('SE Ranking listing error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Map one API row to our normalized BacklinkItem.
     *
     * @param  array<string,mixed>  $row
     */
    private function toItem(array $row): BacklinkItem
    {
        return new BacklinkItem(
            sourceUrl: (string) ($row['url_from'] ?? ''),
            targetUrl: (string) ($row['url_to'] ?? ''),
            sourceTitle: isset($row['title']) ? (string) $row['title'] : null,
            anchorText: isset($row['anchor']) ? (string) $row['anchor'] : null,
            linkType: ! empty($row['nofollow']) ? 'nofollow' : 'dofollow',
            domainAuthority: isset($row['domain_inlink_rank']) ? (int) $row['domain_inlink_rank'] : null,
            pageAuthority: isset($row['inlink_rank']) ? (int) $row['inlink_rank'] : null,
            indexedAt: isset($row['first_seen']) ? (string) $row['first_seen'] : null,
        );
    }
}
