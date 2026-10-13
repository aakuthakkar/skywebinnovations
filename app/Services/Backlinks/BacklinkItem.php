<?php

namespace App\Services\Backlinks;

/**
 * A single normalized backlink record, independent of which provider
 * (external API or your own tracked links) it came from.
 */
final readonly class BacklinkItem
{
    /**
     * @param  string  $sourceUrl     the page that links out
     * @param  string|null  $sourceTitle  title of the linking page
     * @param  string|null  $anchorText   clickable text of the link
     * @param  string  $targetUrl     the page being linked to
     * @param  string  $linkType      dofollow|nofollow|sponsored|ugc
     * @param  int|null  $domainAuthority  0-100
     * @param  int|null  $pageAuthority    0-100
     * @param  string|null  $indexedAt   when the link was first seen (ISO date)
     */
    public function __construct(
        public string $sourceUrl,
        public string $targetUrl,
        public ?string $sourceTitle = null,
        public ?string $anchorText = null,
        public string $linkType = 'dofollow',
        public ?int $domainAuthority = null,
        public ?int $pageAuthority = null,
        public ?string $indexedAt = null,
    ) {}

    /**
     * The registrable host of the linking page (e.g. "blog.example.com").
     */
    public function sourceDomain(): string
    {
        return (string) (parse_url($this->sourceUrl, PHP_URL_HOST) ?: $this->sourceUrl);
    }
}
