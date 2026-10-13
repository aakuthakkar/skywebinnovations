<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Page;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller as BaseController;

class SitemapController extends BaseController
{
    public function index(): Response
    {
        try {
            // Cache the generated sitemap for 1 hour so we don't hammer the
            // database on every request (and so a brief DB blip never breaks it).
            $xml = Cache::remember('sitemap.xml', 3600, function () {
                return $this->build();
            });
        } catch (\Throwable $e) {
            // If the database is down, serve the last good cached copy.
            // Only if there is no cached copy do we fall back to a minimal
            // (but still valid) sitemap — we never return a 500 to crawlers.
            Log::error('Sitemap generation failed: ' . $e->getMessage());
            $xml = Cache::get('sitemap.xml') ?? $this->buildFallback();
        }

        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=utf-8')
            ->header('Cache-Control', 'public, max-age=3600');
    }

    private function build(): string
    {
        $baseUrl = rtrim(config('app.url'), '/');
        $now = now()->toIso8601String();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Homepage
        $xml .= $this->url($baseUrl . '/', $now, 'weekly', '1.0');

        // Main anchor sections (low priority since they're on the homepage)
        $sections = [
            ['#about', 'monthly', '0.5'],
            ['#why', 'monthly', '0.5'],
            ['#services', 'monthly', '0.5'],
            ['#work', 'weekly', '0.5'],
            ['#engage', 'monthly', '0.5'],
            ['#faq', 'monthly', '0.4'],
            ['#contact', 'monthly', '0.5'],
        ];

        foreach ($sections as [$hash, $freq, $priority]) {
            $xml .= $this->url($baseUrl . '/' . $hash, $now, $freq, $priority);
        }

        // Published CMS pages
        foreach (Page::published()->get() as $page) {
            $xml .= $this->url($baseUrl . '/' . $page->slug, $page->updated_at?->toIso8601String() ?? $now, 'weekly', '0.8');
        }

        // Blog listing page
        $xml .= $this->url($baseUrl . '/blog', $now, 'weekly', '0.7');

        // Free tool — high value landing page (link magnet)
        $xml .= $this->url($baseUrl . '/website-cost-calculator', $now, 'monthly', '0.9');
        $xml .= $this->url($baseUrl . '/backlink-checker', $now, 'monthly', '0.9');

        // Published blog posts
        foreach (BlogPost::published()->orderByDesc('published_at')->get() as $post) {
            $lastmod = $post->updated_at?->toIso8601String() ?? ($post->published_at?->toIso8601String() ?? $now);
            $xml .= $this->url($baseUrl . '/blog/' . $post->slug, $lastmod, 'monthly', '0.6');
        }

        $xml .= '</urlset>' . "\n";

        return $xml;
    }

    /**
     * Minimal but valid sitemap used only when the database is unreachable
     * and no cached copy exists. Keeps crawlers happy instead of erroring.
     */
    private function buildFallback(): string
    {
        $baseUrl = rtrim(config('app.url'), '/');
        $now = now()->toIso8601String();

        return '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
            '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n" .
            $this->url($baseUrl . '/', $now, 'weekly', '1.0') .
            $this->url($baseUrl . '/website-cost-calculator', $now, 'monthly', '0.9') .
            $this->url($baseUrl . '/backlink-checker', $now, 'monthly', '0.9') .
            $this->url($baseUrl . '/blog', $now, 'weekly', '0.7') .
            '</urlset>' . "\n";
    }

    private function url(string $loc, string $lastmod, string $changefreq, string $priority): string
    {
        return '  <url>' . "\n" .
            '    <loc>' . $loc . '</loc>' . "\n" .
            '    <lastmod>' . $lastmod . '</lastmod>' . "\n" .
            '    <changefreq>' . $changefreq . '</changefreq>' . "\n" .
            '    <priority>' . $priority . '</priority>' . "\n" .
            '  </url>' . "\n";
    }
}
