<?php

namespace App\Services\Backlinks;

use Illuminate\Support\Collection;

/**
 * A normalized backlink report for a single domain, produced by any
 * BacklinkProvider. The report service and views only ever see this shape,
 * so swapping providers (or adding a paid one later) changes nothing else.
 */
final readonly class BacklinkReport
{
    /**
     * @param  Collection<int, BacklinkItem>  $items
     * @param  string  $source            which provider produced this ('api'|'local')
     * @param  bool  $isSample            true when results are an incomplete/limited sample
     * @param  bool  $hasMore             true when another page of results exists
     * @param  string|null  $notice       an honest caveat to show the user (e.g. no API key)
     */
    public function __construct(
        public string $domain,
        public ?int $authorityScore,
        public int $totalBacklinks,
        public int $referringDomains,
        public Collection $items,
        public string $source,
        public bool $isSample = false,
        public bool $hasMore = false,
        public int $page = 1,
        public ?string $notice = null,
    ) {}

    public function isEmpty(): bool
    {
        return $this->items->isEmpty();
    }

    public static function empty(string $domain, ?string $notice = null): self
    {
        return new self(
            domain: $domain,
            authorityScore: null,
            totalBacklinks: 0,
            referringDomains: 0,
            items: collect(),
            source: 'none',
            notice: $notice,
        );
    }
}
