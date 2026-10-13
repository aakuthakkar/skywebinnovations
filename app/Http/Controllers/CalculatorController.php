<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Setting;

class CalculatorController extends Controller
{
    use HasSeoSettings;

    /**
     * Website cost estimator — a free tool that attracts organic traffic and
     * earns backlinks. Interactive estimation runs client-side; this controller
     * only supplies SEO metadata, services, and FAQ data.
     */
    public function index()
    {
        $settings = $this->seoSettings([
            'meta_title' => 'Free Website Cost Calculator | Estimate Your Project | Sky Web Innovations',
            'meta_description' => 'Estimate the cost of a website, web app, SaaS product, or e-commerce store in seconds. Answer a few questions and get an instant, no-obligation budget range.',
            'meta_keywords' => 'website cost calculator, web development cost estimator, how much does a website cost, SaaS development cost, app development estimate, project cost calculator',
            'meta_image' => '/assets/og-image.jpg',
        ]);

        $services = Service::ordered()->get();

        return view('calculator', compact('settings', 'services'));
    }
}
