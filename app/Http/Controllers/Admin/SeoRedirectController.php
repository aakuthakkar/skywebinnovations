<?php

namespace App\Http\Controllers\Admin;

use App\Models\SeoRedirect;
use Illuminate\Http\Request;

class SeoRedirectController
{
    public function index(Request $request)
    {
        $query = SeoRedirect::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('source_path', 'like', "%{$request->search}%")
                  ->orWhere('target_path', 'like', "%{$request->search}%");
            });
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $redirects = $query->orderBy('source_path')->paginate(20);

        return view('admin.seo.redirects.index', compact('redirects'));
    }

    public function create()
    {
        return view('admin.seo.redirects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'source_path' => 'required|string|max:500',
            'target_path' => 'required|string|max:500',
            'type' => 'required|in:301,302,307',
            'source_host' => 'nullable|url|max:500',
            'notes' => 'nullable|string',
        ]);

        $validated['source_path'] = '/' . ltrim($validated['source_path'], '/');

        SeoRedirect::updateOrCreate(
            ['source_path' => $validated['source_path'], 'source_host' => $validated['source_host']],
            $validated
        );

        return redirect()->route('admin.seo.redirects.index')->with('success', 'Redirect added successfully.');
    }

    public function edit(SeoRedirect $seoRedirect)
    {
        return view('admin.seo.redirects.edit', ['redirect' => $seoRedirect]);
    }

    public function update(Request $request, SeoRedirect $seoRedirect)
    {
        $validated = $request->validate([
            'source_path' => 'required|string|max:500',
            'target_path' => 'required|string|max:500',
            'type' => 'required|in:301,302,307',
            'source_host' => 'nullable|url|max:500',
            'notes' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['source_path'] = '/' . ltrim($validated['source_path'], '/');

        $seoRedirect->update($validated);

        return redirect()->route('admin.seo.redirects.index')->with('success', 'Redirect updated successfully.');
    }

    public function destroy(SeoRedirect $seoRedirect)
    {
        $seoRedirect->delete();
        return redirect()->route('admin.seo.redirects.index')->with('success', 'Redirect removed.');
    }
}
