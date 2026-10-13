<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavigationItem;
use Illuminate\Http\Request;

class NavigationItemController extends Controller
{
    public function index()
    {
        $items = NavigationItem::ordered()->get()->groupBy('location');
        return view('admin.navigation.index', compact('items'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:100',
            'url' => 'required|string|max:255',
            'location' => 'required|in:header,footer',
            'parent_id' => 'nullable|integer|min:0',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'target_blank' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['target_blank'] = $request->has('target_blank');
        $validated['parent_id'] = $validated['parent_id'] ?: null;
        $validated['order'] = $validated['order'] ?? 0;

        NavigationItem::create($validated);

        return redirect()->route('admin.navigation.index')->with('success', 'Navigation item created successfully.');
    }

    public function update(Request $request, NavigationItem $navigationItem)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:100',
            'url' => 'required|string|max:255',
            'location' => 'required|in:header,footer',
            'parent_id' => 'nullable|integer|min:0',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'target_blank' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['target_blank'] = $request->has('target_blank');
        $validated['parent_id'] = $validated['parent_id'] ?: null;
        $validated['order'] = $validated['order'] ?? 0;

        $navigationItem->update($validated);

        return redirect()->route('admin.navigation.index')->with('success', 'Navigation item updated successfully.');
    }

    public function destroy(NavigationItem $navigationItem)
    {
        $navigationItem->delete();
        return redirect()->route('admin.navigation.index')->with('success', 'Navigation item deleted successfully.');
    }
}
