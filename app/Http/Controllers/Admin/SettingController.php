<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::orderBy('key')->get()->groupBy('type');

        // Collect menu labels for admin sidebar
        $menuLabels = [];
        $menuKeys = ['dashboard', 'services', 'projects', 'why_us', 'process', 'engagement', 'faq', 'tech_stack', 'inquiries'];
        foreach ($menuKeys as $key) {
            $menuLabels['menu_' . $key] = Setting::get('menu_' . $key, match($key) {
                'dashboard' => 'Dashboard',
                'services' => 'Services',
                'projects' => 'Projects',
                'why_us' => 'Why Us',
                'process' => 'Process',
                'engagement' => 'Engagement',
                'faq' => 'FAQ',
                'tech_stack' => 'Tech Stack',
                'inquiries' => 'Inquiries',
            });
        }

        return view('admin.settings.index', compact('settings', 'menuLabels'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'settings' => 'required|array',
            'settings.*.key' => 'required|string|max:100',
            'settings.*.value' => 'nullable|string',
            'settings.*.type' => 'required|string|in:text,textarea,boolean,json,integer',
        ]);

        foreach ($validated['settings'] as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value'], 'type' => $setting['type']]
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings saved successfully.');
    }
}
