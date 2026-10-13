<?php

namespace App\Http\Controllers;

use App\Models\EngagementModel;
use App\Models\FaqItem;
use App\Models\ProcessStep;
use App\Models\Project;
use App\Models\Service;
use App\Models\TechStackItem;
use App\Models\WhyUsItem;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    use HasSeoSettings;

    public function index(): View
    {
        $services = Service::ordered()->get();
        $projects = Project::published()->get();
        $whyUsItems = WhyUsItem::ordered()->get();
        $processSteps = ProcessStep::ordered()->get();
        $engagementModels = EngagementModel::published()->get();
        $faqItems = FaqItem::published()->get();
        $techStackItems = TechStackItem::published()->get();

        $settings = $this->seoSettings();

        $projects = Project::published()->get();
        if ($projects->isEmpty()) {
            $samples = [
                ['title' => 'Nexus SaaS Platform', 'description' => 'A full-stack SaaS dashboard with real-time analytics, team collaboration, and automated billing workflows.', 'category' => 'SaaS Platform', 'tags' => ['Laravel', 'Vue.js', 'PostgreSQL'], 'shot_label' => 'dashboard preview', 'tint' => 'oklch(0.55 0.18 265 / 0.5)', 'order' => 0, 'is_published' => true],
                ['title' => 'Aether E-Commerce', 'description' => 'Headless Shopify storefront with blazing-fast page loads, dynamic product filtering, and seamless checkout.', 'category' => 'E-Commerce', 'tags' => ['Next.js', 'Shopify API', 'Stripe'], 'shot_label' => 'storefront', 'tint' => 'oklch(0.5 0.15 150 / 0.5)', 'order' => 1, 'is_published' => true],
                ['title' => 'Pulse Health App', 'description' => 'Cross-platform health tracking app with wearable integration, habit streaks, and AI-powered wellness insights.', 'category' => 'Mobile App', 'tags' => ['React Native', 'Firebase', 'TensorFlow'], 'shot_label' => 'app screens', 'tint' => 'oklch(0.55 0.16 30 / 0.5)', 'order' => 2, 'is_published' => true],
                ['title' => 'Vertex CRM', 'description' => 'Custom CRM with pipeline automation, email sequencing, and predictive lead scoring for sales teams.', 'category' => 'Web Application', 'tags' => ['Laravel', 'Livewire', 'Tailwind'], 'shot_label' => 'crm interface', 'tint' => 'oklch(0.5 0.14 180 / 0.5)', 'order' => 3, 'is_published' => true],
            ];
            $projects = collect($samples)->map(fn($p) => new Project($p));
        }

        return view('home', compact(
            'services', 'projects', 'whyUsItems', 'processSteps',
            'engagementModels', 'faqItems', 'techStackItems', 'settings'
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
