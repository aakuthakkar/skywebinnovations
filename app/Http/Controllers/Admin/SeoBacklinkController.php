<?php

namespace App\Http\Controllers\Admin;

use App\Models\SeoBacklink;
use App\Services\BacklinkChecker;
use Illuminate\Http\Request;

class SeoBacklinkController
{
    public function index(Request $request)
    {
        $query = SeoBacklink::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('source_domain', 'like', "%{$request->search}%")
                  ->orWhere('target_url', 'like', "%{$request->search}%")
                  ->orWhere('anchor_text', 'like', "%{$request->search}%");
            });
        }
        if ($request->filled('type')) {
            $query->where('link_type', $request->type);
        }
        if ($request->filled('status')) {
            if ($request->status === 'lost') {
                $query->whereNotNull('lost_at');
            } else {
                $query->where('is_active', $request->status === 'active');
            }
        }

        $backlinks = $query->orderByDesc('last_seen_at')->paginate(20);

        $totalBacklinks = SeoBacklink::where('is_active', true)->count();
        $totalDomains = SeoBacklink::where('is_active', true)->distinct('source_domain')->count('source_domain');
        $dofollowCount = SeoBacklink::where('is_active', true)->where('link_type', 'dofollow')->count();
        $lostCount = SeoBacklink::whereNotNull('lost_at')->count();

        return view('admin.seo.backlinks.index', compact(
            'backlinks', 'totalBacklinks', 'totalDomains', 'dofollowCount', 'lostCount'
        ));
    }

    public function create()
    {
        return view('admin.seo.backlinks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'source_url' => 'required|url|max:500',
            'target_url' => 'required|url|max:500',
            'anchor_text' => 'nullable|string|max:500',
            'link_type' => 'required|in:dofollow,nofollow,sponsored,ugc',
            'domain_authority' => 'nullable|integer|min:0|max:100',
            'page_authority' => 'nullable|integer|min:0|max:100',
            'notes' => 'nullable|string',
        ]);

        $validated['source_domain'] = parse_url($validated['source_url'], PHP_URL_HOST) ?: $validated['source_url'];
        $validated['first_seen_at'] = now()->toDateString();
        $validated['last_seen_at'] = now()->toDateString();

        SeoBacklink::create($validated);

        return redirect()->route('admin.seo.backlinks.index')->with('success', 'Backlink added successfully.');
    }

    public function edit(SeoBacklink $seoBacklink)
    {
        return view('admin.seo.backlinks.edit', ['backlink' => $seoBacklink]);
    }

    public function update(Request $request, SeoBacklink $seoBacklink)
    {
        $validated = $request->validate([
            'source_url' => 'required|url|max:500',
            'target_url' => 'required|url|max:500',
            'anchor_text' => 'nullable|string|max:500',
            'link_type' => 'required|in:dofollow,nofollow,sponsored,ugc',
            'domain_authority' => 'nullable|integer|min:0|max:100',
            'page_authority' => 'nullable|integer|min:0|max:100',
            'notes' => 'nullable|string',
        ]);

        $validated['source_domain'] = parse_url($validated['source_url'], PHP_URL_HOST) ?: $validated['source_url'];

        $seoBacklink->update($validated);

        return redirect()->route('admin.seo.backlinks.index')->with('success', 'Backlink updated successfully.');
    }

    public function destroy(SeoBacklink $seoBacklink)
    {
        $seoBacklink->delete();
        return redirect()->route('admin.seo.backlinks.index')->with('success', 'Backlink removed.');
    }

    /**
     * Verify every active backlink with a real HTTP request and auto-flag
     * any that have gone dead or lost their link. Returns to the index with
     * a summary of what was found.
     */
    public function healthCheck(BacklinkChecker $checker)
    {
        // Cap the batch so a large list can't time out the request. Priority
        // goes to links not checked recently, so repeated runs rotate through.
        $limit = (int) config('seo.backlink_check_batch_size', 50);
        $backlinks = SeoBacklink::query()
            ->orderByRaw('last_seen_at IS NULL DESC')
            ->orderBy('last_seen_at', 'asc')
            ->limit($limit)
            ->get();

        if ($backlinks->isEmpty()) {
            return redirect()->route('admin.seo.backlinks.index')
                ->with('success', 'No backlinks to check yet — add some first.');
        }

        $summary = $checker->checkMany($backlinks);

        $message = "Health check complete: {$summary['checked']} checked — "
            . "{$summary['ok']} live, {$summary['dead']} dead, "
            . "{$summary['missing']} missing your link, {$summary['unreachable']} couldn't be verified.";

        return redirect()->route('admin.seo.backlinks.index')->with([
            'success' => $message,
            'health_check' => $summary,
        ]);
    }

    /**
     * Re-check a single backlink (used by the per-row "Re-check" button).
     */
    public function recheck(SeoBacklink $seoBacklink, BacklinkChecker $checker)
    {
        $result = $checker->check($seoBacklink);

        $labels = [
            'ok' => 'is live',
            'dead' => 'is dead (page removed)',
            'missing' => 'no longer links to your site',
            'unreachable' => "couldn't be verified",
        ];

        return redirect()->route('admin.seo.backlinks.index')
            ->with('success', '"' . $seoBacklink->source_domain . '" ' . ($labels[$result['status']] ?? 'checked') . '.');
    }
}
