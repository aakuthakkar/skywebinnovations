<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Response;

class RobotsController extends Controller
{
    public function index(): Response
    {
        $baseUrl = rtrim(config('app.url'), '/');
        $content = "User-agent: *\n";
        $content .= "Allow: /\n\n";
        $content .= "# Block admin and API\n";
        $content .= "Disallow: /admin/\n";
        $content .= "Disallow: /api/\n\n";
        $content .= "# Block auth pages\n";
        $content .= "Disallow: /login\n";
        $content .= "Disallow: /register\n";
        $content .= "Disallow: /password\n";
        $content .= "Disallow: /verify-email\n\n";
        $content .= "# Sitemaps\n";
        $content .= "Sitemap: {$baseUrl}/sitemap.xml\n";

        return response($content, 200)->header('Content-Type', 'text/plain');
    }
}
