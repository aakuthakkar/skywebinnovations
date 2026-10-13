<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProcessStep;
use Illuminate\Http\Request;

class ProcessStepController extends Controller
{
    public function index()
    {
        $steps = ProcessStep::ordered()->paginate(20);
        return view('admin.process-steps.index', compact('steps'));
    }

    public function create()
    {
        return view('admin.process-steps.create');
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
        ProcessStep::create($validated);

        return redirect()->route('admin.process-steps.index')->with('success', 'Step created successfully.');
    }

    public function edit(ProcessStep $processStep)
    {
        return view('admin.process-steps.edit', ['step' => $processStep]);
    }

    public function update(Request $request, ProcessStep $processStep)
    {
        $validated = $request->validate([
            'number' => 'required|string|max:10',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['order'] = $validated['order'] ?? 0;
        $processStep->update($validated);

        return redirect()->route('admin.process-steps.index')->with('success', 'Step updated successfully.');
    }

    public function destroy(ProcessStep $processStep)
    {
        $processStep->delete();
        return redirect()->route('admin.process-steps.index')->with('success', 'Step deleted successfully.');
    }
}
