<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EngagementModel;
use Illuminate\Http\Request;

class EngagementModelController extends Controller
{
    public function index()
    {
        $models = EngagementModel::ordered()->paginate(20);
        return view('admin.engagement-models.index', compact('models'));
    }

    public function create()
    {
        return view('admin.engagement-models.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'slug' => 'required|string|max:100|unique:engagement_models,slug',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'best_for' => 'nullable|string',
            'features' => 'nullable|array',
            'link_text' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['order'] = $validated['order'] ?? 0;
        $validated['is_featured'] = $validated['is_featured'] ?? false;
        $validated['is_published'] = $validated['is_published'] ?? true;
        EngagementModel::create($validated);

        return redirect()->route('admin.engagement-models.index')->with('success', 'Engagement model created successfully.');
    }

    public function edit(EngagementModel $engagementModel)
    {
        return view('admin.engagement-models.edit', ['model' => $engagementModel]);
    }

    public function update(Request $request, EngagementModel $engagementModel)
    {
        $validated = $request->validate([
            'slug' => 'required|string|max:100|unique:engagement_models,slug,' . $engagementModel->id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'best_for' => 'nullable|string',
            'features' => 'nullable|array',
            'link_text' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['order'] = $validated['order'] ?? 0;
        $validated['is_featured'] = $validated['is_featured'] ?? false;
        $validated['is_published'] = $validated['is_published'] ?? true;
        $engagementModel->update($validated);

        return redirect()->route('admin.engagement-models.index')->with('success', 'Engagement model updated successfully.');
    }

    public function destroy(EngagementModel $engagementModel)
    {
        $engagementModel->delete();
        return redirect()->route('admin.engagement-models.index')->with('success', 'Engagement model deleted successfully.');
    }
}
