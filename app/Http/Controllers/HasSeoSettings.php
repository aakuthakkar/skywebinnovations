<?php

namespace App\Http\Controllers;

use App\Models\Setting;

trait HasSeoSettings
{
    protected function seoSettings(array $overrides = []): array
    {
        $defaults = [
            'site_name' => Setting::get('site_name', 'Sky Web Innovations'),
            'site_tagline' => Setting::get('site_tagline', 'Website & product engineering'),
            'meta_title' => Setting::get('meta_title', 'Sky Web Innovations | Website, SaaS & Custom Software Development Company'),
            'meta_description' => Setting::get('meta_description', 'Sky Web Innovations designs and builds websites, custom web applications and SaaS products for businesses in the US, Canada, Australia, New Zealand and the UK.'),
            'meta_keywords' => Setting::get('meta_keywords', 'web development, custom software, SaaS, Laravel, React, web applications, website design, digital products, web agency'),
            'meta_author' => Setting::get('meta_author', 'Aakash Thakkar'),
            'meta_image' => Setting::get('meta_image', '/assets/og-image.jpg'),
            'contact_email' => Setting::get('contact_email', 'info@skywebinnovations.com'),
            'contact_phone' => Setting::get('contact_phone', '+91 79909 03773'),
            'contact_phone_raw' => Setting::get('contact_phone_raw', '+917990903773'),
            'whatsapp_url' => Setting::get('whatsapp_url', 'https://wa.me/917990903773'),
            'linkedin_url' => Setting::get('linkedin_url', 'https://www.linkedin.com/in/aakash-thakkar-a8b9a988/'),
            'founder_name' => Setting::get('founder_name', 'Aakash Thakkar'),
            'founder_title' => Setting::get('founder_title', 'Founder & Technology Lead'),
            'founder_quote' => Setting::get('founder_quote', '"Every project starts with a conversation about the business. Then we build the technology that serves it."'),
            'founder_linkedin' => Setting::get('linkedin_url', 'https://www.linkedin.com/in/aakash-thakkar-a8b9a988/'),
            'ga_measurement_id' => Setting::get('ga_measurement_id'),
            'google_site_verification' => Setting::get('google_site_verification'),
            'bing_site_verification' => Setting::get('bing_site_verification'),
            'twitter_handle' => Setting::get('twitter_handle'),
        ];

        return array_merge($defaults, $overrides);
    }
}
