<?php

namespace App\Http\Controllers;

use App\Models\FaqItem;
use App\Models\Page;
use App\Models\Service;
use App\Models\Setting;
use App\Models\TechStackItem;
use App\Models\WhyUsItem;
use App\Models\EngagementModel;
use App\Models\ProcessStep;
use App\Models\Project;
use Illuminate\Http\Request;

class PageController extends Controller
{
    use HasSeoSettings;

    public function show($slug)
    {
        $page = Page::where('slug', $slug)->published()->firstOrFail();

        $settings = $this->seoSettings(array_merge([
            'meta_title' => $page->meta_title ?: ($page->title . ' | Sky Web Innovations'),
            'meta_description' => $page->meta_description ?: ($page->excerpt ?: Setting::get('meta_description', '')),
            'meta_image' => $page->og_image ?: Setting::get('meta_image', '/assets/og-image.jpg'),
        ], $page->meta_keywords ? ['meta_keywords' => $page->meta_keywords] : []));

        $services = Service::ordered()->get();
        $projects = Project::published()->get();
        $whyUsItems = WhyUsItem::ordered()->get();
        $processSteps = ProcessStep::ordered()->get();
        $engagementModels = EngagementModel::published()->get();
        $faqItems = FaqItem::published()->get();
        $techStackItems = TechStackItem::published()->get();

        return view('page', compact(
            'page', 'settings', 'services', 'projects',
            'whyUsItems', 'processSteps', 'engagementModels',
            'faqItems', 'techStackItems'
        ))->with([
            'showFounder' => true,
            'showWhyUs' => true,
            'showServices' => true,
            'showWork' => true,
            'showEngage' => true,
            'showFaq' => true,
        ]);
    }
}
