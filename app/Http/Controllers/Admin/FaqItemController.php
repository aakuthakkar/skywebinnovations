<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqItem;
use Illuminate\Http\Request;

class FaqItemController extends Controller
{
    public function index()
    {
        $items = FaqItem::ordered()->paginate(20);
        return view('admin.faq.index', compact('items'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'is_published' => 'boolean',
        ]);

        $validated['order'] = $validated['order'] ?? 0;
        $validated['is_published'] = $validated['is_published'] ?? true;
        FaqItem::create($validated);

        return redirect()->route('admin.faq.index')->with('success', 'FAQ item created successfully.');
    }

    public function edit(FaqItem $faqItem)
    {
        return view('admin.faq.edit', compact('faqItem'));
    }

    public function update(Request $request, FaqItem $faqItem)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'is_published' => 'boolean',
        ]);

        $validated['order'] = $validated['order'] ?? 0;
        $validated['is_published'] = $validated['is_published'] ?? true;
        $faqItem->update($validated);

        return redirect()->route('admin.faq.index')->with('success', 'FAQ item updated successfully.');
    }

    public function destroy(FaqItem $faqItem)
    {
        $faqItem->delete();
        return redirect()->route('admin.faq.index')->with('success', 'FAQ item deleted successfully.');
    }
}
