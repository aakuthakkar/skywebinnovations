<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share admin menu labels with all admin views
        View::composer('admin.*', function ($view) {
            $menuKeys = [
                'dashboard' => 'Dashboard',
                'services' => 'Services',
                'projects' => 'Projects',
                'why_us' => 'Why Us',
                'process' => 'Process',
                'engagement' => 'Engagement',
                'faq' => 'FAQ',
                'tech_stack' => 'Tech Stack',
                'inquiries' => 'Inquiries',
            ];

            // Batch-load all menu_* settings in one query
            $menuSettingKeys = array_keys(array_map(fn($k) => 'menu_' . $k, array_keys($menuKeys)));
            $storedSettings = Setting::whereIn('key', $menuSettingKeys)->get()->keyBy('key');

            $menuLabels = [];
            foreach ($menuKeys as $key => $default) {
                $settingKey = 'menu_' . $key;
                $menuLabels[$key] = $storedSettings->has($settingKey)
                    ? $storedSettings[$settingKey]->value
                    : $default;
            }

            $view->with('menuLabels', $menuLabels);
        });
    }
}
