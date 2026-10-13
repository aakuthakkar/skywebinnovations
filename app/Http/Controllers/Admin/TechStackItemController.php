<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TechStackItem;
use Illuminate\Http\Request;

class TechStackItemController extends Controller
{
    public function index()
    {
        $items = TechStackItem::ordered()->paginate(20);
        return view('admin.tech-stack.index', compact('items'));
    }

    public function create()
    {
        return view('admin.tech-stack.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'order' => 'nullable|integer|min:0',
            'is_published' => 'boolean',
        ]);

        $validated['order'] = $validated['order'] ?? 0;
        $validated['is_published'] = $validated['is_published'] ?? true;
        TechStackItem::create($validated);

        return redirect()->route('admin.tech-stack.index')->with('success', 'Tech stack item created successfully.');
    }

    public function edit(TechStackItem $techStackItem)
    {
        return view('admin.tech-stack.edit', ['item' => $techStackItem]);
    }

    public function update(Request $request, TechStackItem $techStackItem)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'order' => 'nullable|integer|min:0',
            'is_published' => 'boolean',
        ]);

        $validated['order'] = $validated['order'] ?? 0;
        $validated['is_published'] = $validated['is_published'] ?? true;
        $techStackItem->update($validated);

        return redirect()->route('admin.tech-stack.index')->with('success', 'Tech stack item updated successfully.');
    }

    public function destroy(TechStackItem $techStackItem)
    {
        $techStackItem->delete();
        return redirect()->route('admin.tech-stack.index')->with('success', 'Tech stack item deleted successfully.');
    }
}
