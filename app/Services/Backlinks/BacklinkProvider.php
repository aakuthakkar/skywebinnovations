<?php

namespace App\Services\Backlinks;

/**
 * Contract for anything that can return a backlink report for a domain.
 *
 * Two implementations ship by default:
 *  - ApiBacklinkProvider:   external API (SE Ranking free tier / paid key)
 *  - LocalBacklinkProvider: the backlinks you track in your own database
 */
interface BacklinkProvider
{
    /**
     * Whether this provider can serve the given domain. The local provider,
     * for example, only serves the site's own domain.
     */
    public function supports(string $domain): bool;

    /**
     * Fetch a page of backlinks for the domain.
     */
    public function fetch(string $domain, int $page = 1, int $perPage = 50): BacklinkReport;
}
