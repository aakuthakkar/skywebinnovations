<?php

namespace App\Http\Controllers\Admin;

use App\Models\SeoKeyword;
use App\Models\SeoBacklink;
use App\Models\SeoRedirect;
use App\Models\SeoAudit;
use App\Models\Page;
use App\Models\BlogPost;
use App\Models\Setting;
use Illuminate\Http\Request;

class SeoDashboardController
{
    public function index()
    {
        $keywords = SeoKeyword::active()->count();
        $topKeywords = SeoKeyword::active()
            ->whereNotNull('current_position')
            ->orderBy('current_position')
            ->limit(10)
            ->get();

        $backlinks = SeoBacklink::active()->count();
        $totalDomains = SeoBacklink::active()->distinct('source_domain')->count();

        $activeRedirects = SeoRedirect::active()->count();
        $totalRedirectHits = SeoRedirect::sum('hit_count');

        $recentAudits = SeoAudit::latest()->limit(5)->get();

        $pagesNeedingMeta = Page::where('is_published', true)
            ->where(function ($q) {
                $q->whereNull('meta_title')->orWhereNull('meta_description');
            })
            ->count();

        $blogPostsNeedingMeta = BlogPost::where('is_published', true)
            ->where(function ($q) {
                $q->whereNull('meta_title')->orWhereNull('meta_description');
            })
            ->count();

        return view('admin.seo.index', compact(
            'keywords', 'topKeywords', 'backlinks', 'totalDomains',
            'activeRedirects', 'totalRedirectHits', 'recentAudits',
            'pagesNeedingMeta', 'blogPostsNeedingMeta'
        ));
    }
}
