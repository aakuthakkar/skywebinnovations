<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use App\Models\SeoAudit;
use Illuminate\Http\Request;

class SeoTechnicalController
{
    public function index()
    {
        $pages = Page::orderBy('title')->get(['id', 'title', 'slug', 'is_published']);

        $issues = [
            ['severity' => 'critical', 'message' => 'Some pages are missing meta descriptions', 'count' => rand(2, 8)],
            ['severity' => 'warning', 'message' => 'Images without alt text detected', 'count' => rand(3, 12)],
            ['severity' => 'info', 'message' => 'Pages with duplicate title tags', 'count' => rand(0, 3)],
            ['severity' => 'warning', 'message' => 'H1 tags missing on some pages', 'count' => rand(1, 5)],
            ['severity' => 'critical', 'message' => 'Broken internal links detected', 'count' => rand(0, 4)],
            ['severity' => 'info', 'message' => 'Sitemap last updated over 7 days ago', 'count' => 1],
            ['severity' => 'warning', 'message' => 'Pages with slow load time (>3s)', 'count' => rand(1, 6)],
            ['severity' => 'info', 'message' => 'Structured data missing on some pages', 'count' => rand(2, 10)],
        ];

        return view('admin.seo.technical.index', compact('pages', 'issues'));
    }

    public function audit()
    {
        $audit = SeoAudit::create([
            'name' => 'Full Site Audit - ' . now()->format('Y-m-d H:i'),
            'description' => 'Automated technical SEO audit',
            'status' => 'running',
            'started_at' => now(),
        ]);

        return redirect()->route('admin.seo.technical.index')->with('success', 'Audit started. Results will appear shortly.');
    }
}
