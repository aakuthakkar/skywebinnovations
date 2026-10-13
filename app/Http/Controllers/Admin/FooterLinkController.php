<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterLink;
use Illuminate\Http\Request;

class FooterLinkController extends Controller
{
    public function index()
    {
        $links = FooterLink::ordered()->get()->groupBy('column_name');
        return view('admin.footer-links.index', compact('links'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:100',
            'url' => 'required|string|max:255',
            'column_name' => 'required|string|max:50',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        FooterLink::create($validated);

        return redirect()->route('admin.footer-links.index')->with('success', 'Footer link created successfully.');
    }

    public function update(Request $request, FooterLink $footerLink)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:100',
            'url' => 'required|string|max:255',
            'column_name' => 'required|string|max:50',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $footerLink->update($validated);

        return redirect()->route('admin.footer-links.index')->with('success', 'Footer link updated successfully.');
    }

    public function destroy(FooterLink $footerLink)
    {
        $footerLink->delete();
        return redirect()->route('admin.footer-links.index')->with('success', 'Footer link deleted successfully.');
    }
}
