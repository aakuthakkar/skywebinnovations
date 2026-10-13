<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyUsItem;
use Illuminate\Http\Request;

class WhyUsItemController extends Controller
{
    public function index()
    {
        $items = WhyUsItem::ordered()->paginate(20);
        return view('admin.why-us.index', compact('items'));
    }

    public function create()
    {
        return view('admin.why-us.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'number' => 'required|string|max:10',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['order'] = $validated['order'] ?? 0;
        WhyUsItem::create($validated);

        return redirect()->route('admin.why-us.index')->with('success', 'Item created successfully.');
    }

    public function edit(WhyUsItem $whyUsItem)
    {
        return view('admin.why-us.edit', ['item' => $whyUsItem]);
    }

    public function update(Request $request, WhyUsItem $whyUsItem)
    {
        $validated = $request->validate([
            'number' => 'required|string|max:10',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['order'] = $validated['order'] ?? 0;
        $whyUsItem->update($validated);

        return redirect()->route('admin.why-us.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(WhyUsItem $whyUsItem)
    {
        $whyUsItem->delete();
        return redirect()->route('admin.why-us.index')->with('success', 'Item deleted successfully.');
    }
}
