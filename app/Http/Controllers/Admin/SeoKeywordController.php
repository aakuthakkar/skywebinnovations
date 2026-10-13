<?php

namespace App\Http\Controllers\Admin;

use App\Models\SeoKeyword;
use Illuminate\Http\Request;

class SeoKeywordController
{
    public function index(Request $request)
    {
        $query = SeoKeyword::query();

        if ($request->filled('search')) {
            $query->where('keyword', 'like', "%{$request->search}%");
        }
        if ($request->filled('intent')) {
            $query->where('search_intent', $request->intent);
        }
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $keywords = $query->orderByDesc('updated_at')->paginate(20);

        $trendingUp = SeoKeyword::active()
            ->where('current_position', '<', 'previous_position')
            ->whereNotNull('current_position')
            ->count();
        $trendingDown = SeoKeyword::active()
            ->where('current_position', '>', 'previous_position')
            ->whereNotNull('current_position')
            ->count();
        $inTop10 = SeoKeyword::active()
            ->where('current_position', '<=', 10)
            ->count();

        return view('admin.seo.keywords.index', compact('keywords', 'trendingUp', 'trendingDown', 'inTop10'));
    }

    public function create()
    {
        return view('admin.seo.keywords.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'keyword' => 'required|string|max:255',
            'target_url' => 'nullable|url|max:500',
            'search_intent' => 'required|in:informational,navigational,transactional,commercial',
            'search_volume' => 'nullable|integer|min:0',
            'difficulty' => 'nullable|integer|min:0|max:100',
            'cpc' => 'nullable|numeric|min:0',
            'target_position' => 'nullable|integer|min:1',
            'current_position' => 'nullable|integer|min:1',
            'tracking_frequency' => 'required|in:daily,weekly,monthly',
            'notes' => 'nullable|string',
        ]);

        $validated['first_tracked_at'] = now()->toDateString();
        $validated['last_checked_at'] = now()->toDateString();
        if ($request->filled('current_position')) {
            $validated['previous_position'] = $validated['current_position'];
        }

        SeoKeyword::create($validated);

        return redirect()->route('admin.seo.keywords.index')->with('success', 'Keyword added successfully.');
    }

    public function edit(SeoKeyword $keyword)
    {
        return view('admin.seo.keywords.edit', ['keyword' => $keyword]);
    }

    public function update(Request $request, SeoKeyword $keyword)
    {
        $validated = $request->validate([
            'keyword' => 'required|string|max:255',
            'target_url' => 'nullable|url|max:500',
            'search_intent' => 'required|in:informational,navigational,transactional,commercial',
            'search_volume' => 'nullable|integer|min:0',
            'difficulty' => 'nullable|integer|min:0|max:100',
            'cpc' => 'nullable|numeric|min:0',
            'current_position' => 'nullable|integer|min:1',
            'target_position' => 'nullable|integer|min:1',
            'tracking_frequency' => 'required|in:daily,weekly,monthly',
            'notes' => 'nullable|string',
        ]);

        if ($request->filled('current_position') && $keyword->current_position) {
            $validated['previous_position'] = $keyword->current_position;
        }

        $keyword->update($validated);

        return redirect()->route('admin.seo.keywords.index')->with('success', 'Keyword updated successfully.');
    }

    public function destroy(SeoKeyword $keyword)
    {
        $keyword->delete();
        return redirect()->route('admin.seo.keywords.index')->with('success', 'Keyword removed.');
    }
}
