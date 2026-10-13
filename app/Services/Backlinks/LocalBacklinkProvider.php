<?php

namespace App\Services\Backlinks;

use App\Models\SeoBacklink;
use Illuminate\Support\Collection;

/**
 * Serves backlinks from the links you track in your own database. This is
 * 100% real, first-party data — you record each backlink as you earn it and
 * the Backlink Health Checker keeps it current. Only serves the site's own
 * domain (we can't know competitors' tracked links).
 */
class LocalBacklinkProvider implements BacklinkProvider
{
    public function supports(string $domain): bool
    {
        return $this->normalize($domain) === $this->normalize((string) config('app.url'));
    }

    public function fetch(string $domain, int $page = 1, int $perPage = 50): BacklinkReport
    {
        $query = SeoBacklink::query()
            ->where(function ($q) use ($domain) {
                $q->where('target_url', 'like', '%' . $this->normalize($domain) . '%');
            });

        $totalBacklinks = (clone $query)->count();
        $referringDomains = (clone $query)->distinct('source_domain')->count('source_domain');

        $rows = $query->orderByRaw('lost_at IS NOT NULL ASC') // live first
            ->orderByDesc('domain_authority')
            ->orderByDesc('last_seen_at')
            ->offset(($page - 1) * $perPage)
            ->limit($perPage)
            ->get();

        $items = $rows->map(fn (SeoBacklink $b) => new BacklinkItem(
            sourceUrl: $b->source_url,
            targetUrl: $b->target_url,
            sourceTitle: null, // not captured at add time
            anchorText: $b->anchor_text,
            linkType: $b->link_type,
            domainAuthority: $b->domain_authority,
            pageAuthority: $b->page_authority,
            indexedAt: $b->first_seen_at?->toDateString(),
        ));

        return new BacklinkReport(
            domain: $domain,
            authorityScore: null,
            totalBacklinks: $totalBacklinks,
            referringDomains: $referringDomains,
            items: $items,
            source: 'local',
            isSample: false,
            hasMore: ($page * $perPage) < $totalBacklinks,
            page: $page,
        );
    }

    private function normalize(string $url): string
    {
        $host = parse_url($url, PHP_URL_HOST) ?: $url;
        return str_ireplace('www.', '', strtolower(trim($host, '/')));
    }

    /**
     * @return Collection<int, BacklinkItem>
     */
    public function topLinks(int $limit = 10): Collection
    {
        return SeoBacklink::query()
            ->where('is_active', true)
            ->orderByDesc('domain_authority')
            ->limit($limit)
            ->get()
            ->map(fn (SeoBacklink $b) => new BacklinkItem(
                sourceUrl: $b->source_url,
                targetUrl: $b->target_url,
                anchorText: $b->anchor_text,
                linkType: $b->link_type,
                domainAuthority: $b->domain_authority,
                pageAuthority: $b->page_authority,
                indexedAt: $b->first_seen_at?->toDateString(),
            ));
    }
}
