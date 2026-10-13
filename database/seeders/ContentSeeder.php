<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\Service;
use App\Models\Project;
use App\Models\WhyUsItem;
use App\Models\ProcessStep;
use App\Models\EngagementModel;
use App\Models\FaqItem;
use App\Models\TechStackItem;
use App\Models\Page;
use App\Models\BlogPost;
use App\Models\NavigationItem;
use App\Models\FooterLink;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        // Clear all data tables in dependency order (idempotent)
        NavigationItem::query()->delete();
        FooterLink::query()->delete();
        BlogPost::query()->delete();
        Page::query()->delete();
        TechStackItem::query()->delete();
        FaqItem::query()->delete();
        ProcessStep::query()->delete();
        EngagementModel::query()->delete();
        Project::query()->delete();
        Service::query()->delete();
        WhyUsItem::query()->delete();
        Setting::query()->delete();

        // ─── Settings ───
        $settings = [
            ['key' => 'site_name', 'value' => 'Sky Web Innovations', 'type' => 'text'],
            ['key' => 'site_tagline', 'value' => 'Website & product engineering', 'type' => 'text'],
            ['key' => 'meta_title', 'value' => 'Sky Web Innovations | Website, SaaS & Custom Software Development Company', 'type' => 'text'],
            ['key' => 'meta_description', 'value' => 'Sky Web Innovations designs and builds websites, custom web applications and SaaS products for businesses in the US, Canada, Australia, New Zealand and the UK.', 'type' => 'textarea'],
            ['key' => 'meta_image', 'value' => '/assets/og-image.jpg', 'type' => 'text'],
            ['key' => 'contact_email', 'value' => 'info@skywebinnovations.com', 'type' => 'text'],
            ['key' => 'contact_phone', 'value' => '+91 79909 03773', 'type' => 'text'],
            ['key' => 'contact_phone_raw', 'value' => '+917990903773', 'type' => 'text'],
            ['key' => 'whatsapp_url', 'value' => 'https://wa.me/917990903773', 'type' => 'text'],
            ['key' => 'linkedin_url', 'value' => 'https://www.linkedin.com/in/aakash-thakkar-a8b9a988/', 'type' => 'text'],
            ['key' => 'founder_name', 'value' => 'Aakash Thakkar', 'type' => 'text'],
            ['key' => 'founder_title', 'value' => 'Founder & Technology Lead', 'type' => 'text'],
            ['key' => 'founder_quote', 'value' => '"Every project starts with a conversation about the business. Then we build the technology that serves it."', 'type' => 'textarea'],
            ['key' => 'meta_keywords', 'value' => 'web development, custom software, SaaS, Laravel, React, web applications, website design, digital products, web agency', 'type' => 'textarea'],
            ['key' => 'meta_author', 'value' => 'Aakash Thakkar', 'type' => 'text'],
            ['key' => 'ga_measurement_id', 'value' => '', 'type' => 'text'],
            ['key' => 'google_site_verification', 'value' => '', 'type' => 'text'],
            ['key' => 'bing_site_verification', 'value' => '', 'type' => 'text'],
            ['key' => 'twitter_handle', 'value' => '@skywebinnovations', 'type' => 'text'],
        ];
        foreach ($settings as $s) {
            Setting::create($s);
        }

        // ─── Services ───
        $services = [
            ['Web Development', 'Business websites, corporate websites, landing pages, and custom web experiences designed around your goals.', 'web-development'],
            ['WordPress & WooCommerce', 'Custom WordPress websites, WooCommerce stores, redesigns, performance optimization, and ongoing maintenance.', 'wordpress-woocommerce'],
            ['Web Applications', 'Custom web applications built around your business processes, users, and operational requirements.', 'web-applications'],
            ['SaaS & MVP Development', 'From an initial idea to a working MVP, we help businesses and startups plan, build, and launch digital products.', 'saas-mvp-development'],
            ['Laravel & Backend Development', 'Custom Laravel applications, backend systems, admin panels, databases, and business logic.', 'laravel-backend-development'],
            ['API & Third-Party Integrations', 'Connect your website or application with APIs, payment gateways, CRMs, business tools, and other third-party platforms.', 'api-integrations'],
            ['Maintenance & Technical Support', 'Ongoing website maintenance, performance improvements, security updates, technical SEO, troubleshooting, and feature enhancements.', 'maintenance-support'],
        ];
        foreach ($services as $i => [$name, $desc, $slug]) {
            Service::create(['name' => $name, 'description' => $desc, 'slug' => $slug, 'order' => $i + 1]);
        }

        // ─── Projects ───
        $projects = [
            ['Fleet operations platform', 'Multi-tenant SaaS for logistics companies: live tracking, dispatch and automated invoicing.', 'SaaS', json_encode(['Laravel', 'Vue.js', 'AWS']), 1],
            ['Manufacturing group website', 'Multilingual corporate website with product catalogue, dealer locator and CMS.', 'Website', json_encode(['Next.js', 'Headless CMS']), 2],
            ['Clinic booking portal', 'Patient booking, doctor schedules and payments in one portal for a healthcare network.', 'Web App', json_encode(['React', 'Node.js', 'Stripe']), 3],
            ['D2C commerce storefront', 'Custom Shopify storefront with subscriptions and a fast, conversion-focused checkout.', 'E-commerce', json_encode(['Shopify', 'Liquid']), 4],
        ];
        foreach ($projects as [$title, $desc, $cat, $tags, $order]) {
            Project::create([
                'title' => $title,
                'description' => $desc,
                'category' => $cat,
                'tags' => $tags,
                'shot_label' => $title,
                'tint' => 'oklch(0.45 0.14 250 / 0.5)',
                'is_published' => true,
                'order' => $order,
            ]);
        }

        // ─── Why Us Items ───
        $whyUs = [
            ['Business-First Approach', 'We start by understanding your business, goals, users, and challenges before deciding how to build the solution.'],
            ['Direct Communication', 'You communicate directly with the people working on your project, keeping decisions and communication simple.'],
            ['Clear Scope & Pricing', 'We define the project scope, deliverables, timeline, and pricing clearly before development begins.'],
            ['Right Technology', 'We choose technology based on your actual requirements, budget, performance needs, and future goals.'],
            ['Quality & Performance', 'We focus on clean development, performance, security, scalability, and maintainability.'],
            ['Long-Term Partnership', 'Our relationship does not end after launch. We continue supporting, maintaining, and improving your website or product.'],
        ];
        foreach ($whyUs as $i => [$title, $desc]) {
            WhyUsItem::create(['number' => sprintf('%02d', $i + 1), 'title' => $title, 'description' => $desc, 'order' => $i + 1]);
        }

        // ─── Process Steps ───
        $processes = [
            ['Discovery', 'We understand your business, goals, requirements, and challenges.'],
            ['Scope & Proposal', 'We define the project scope, deliverables, timeline, technology, and cost.'],
            ['Design & Development', 'We design and build the solution with regular communication and progress updates.'],
            ['Testing & Launch', 'We test everything, make final improvements, and prepare the project for launch.'],
            ['Ongoing Support', 'After launch, we remain available for maintenance, improvements, and future development.'],
        ];
        foreach ($processes as $i => [$title, $desc]) {
            ProcessStep::create(['number' => sprintf('%02d', $i + 1), 'title' => $title, 'description' => $desc, 'order' => $i + 1]);
        }

        // ─── Engagement Models ───
        EngagementModel::create([
            'slug' => 'fixed',
            'name' => 'Fixed-price project',
            'description' => 'Best for websites and well-defined builds.',
            'best_for' => 'Best for websites and well-defined builds.',
            'features' => json_encode(['Agreed scope, timeline and quote', 'Milestone-based payments', 'Post-launch support included']),
            'link_text' => 'Discuss this model',
            'is_featured' => false,
            'is_published' => true,
            'order' => 1,
        ]);
        EngagementModel::create([
            'slug' => 'team',
            'name' => 'Dedicated team',
            'description' => 'Best for SaaS and long-term product development.',
            'best_for' => 'Best for SaaS and long-term product development.',
            'features' => json_encode(['Designers and engineers focused on your product', 'Two-week sprints with live demos', 'Scale the team up or down monthly']),
            'link_text' => 'Discuss this model',
            'is_featured' => true,
            'is_published' => true,
            'order' => 2,
        ]);
        EngagementModel::create([
            'slug' => 'retainer',
            'name' => 'Monthly retainer',
            'description' => 'Best for ongoing improvements and maintenance.',
            'best_for' => 'Best for ongoing improvements and maintenance.',
            'features' => json_encode(['Reserved hours every month', 'Priority fixes and updates', 'Performance and security monitoring']),
            'link_text' => 'Discuss this model',
            'is_featured' => false,
            'is_published' => true,
            'order' => 3,
        ]);

        // ─── FAQ Items ───
        $faqs = [
            ['Do you work with clients in the US, Canada, Australia and New Zealand?', 'Yes. Most of our clients are based in the United States, Canada, Australia, New Zealand and the UK. We work remotely with clear processes, written documentation and scheduled calls in your business hours.'],
            ['How do you handle time zone differences?', 'We agree on a daily overlap window at the start of the project, run sprint demos in your working hours, and share written progress updates so nothing waits on a meeting.'],
            ['Who owns the code and intellectual property?', 'You do. All source code, designs and assets are transferred to you, and we sign an NDA before any project details are shared.'],
            ['How much does a website or digital product cost?', 'It depends on scope. After a free discovery call we send a fixed quote in USD with a timeline and milestones, so you know the cost before work begins.'],
            ['Which technologies do you use?', 'Laravel, PHP, Node.js, React, Next.js, Vue.js, Flutter, WordPress and Shopify, deployed on AWS or your preferred cloud. We recommend the stack that fits your product and team.'],
            ['Do you provide support after launch?', 'Yes. Every project includes post-launch support, and many clients continue with a monthly retainer for maintenance, monitoring and new features.'],
        ];
        foreach ($faqs as $i => [$q, $a]) {
            FaqItem::create(['question' => $q, 'answer' => $a, 'is_published' => true, 'order' => $i + 1]);
        }

        // ─── Tech Stack Items ───
        $stackItems = ['Laravel', 'PHP', 'React', 'Next.js', 'Vue.js', 'Node.js', 'Flutter', 'WordPress', 'Shopify', 'MySQL', 'AWS', 'Docker'];
        foreach ($stackItems as $i => $name) {
            TechStackItem::create(['name' => $name, 'order' => $i + 1, 'is_published' => true]);
        }

        // ─── Navigation Items ───
        $navItems = [
            ['About', '#founder', 1],
            ['Why Us', '#why', 2],
            ['Services', '#services', 3],
            ['Work', '#work', 4],
            ['Process', '#engage', 5],
        ];
        foreach ($navItems as [$label, $url, $order]) {
            NavigationItem::create(['label' => $label, 'url' => $url, 'location' => 'header', 'order' => $order, 'is_active' => true, 'target_blank' => false]);
        }

        // ─── Footer Links ───
        $footerItems = [
            ['About Us', '#founder', 'site', 1],
            ['Services', '#services', 'site', 2],
            ['Process', '#engage', 'site', 3],
            ['Work', '#work', 'site', 4],
            ['Blog', '/blog', 'site', 5],
            ['Privacy Policy', '/privacy-policy', 'legal', 1],
            ['Terms of Service', '/terms-of-service', 'legal', 2],
        ];
        foreach ($footerItems as [$label, $url, $column, $order]) {
            FooterLink::create(['label' => $label, 'url' => $url, 'column_name' => $column, 'order' => $order, 'is_active' => true]);
        }

        // ─── Pages ───
        Page::create([
            'title' => 'About Us',
            'slug' => 'about',
            'excerpt' => 'Learn about Sky Web Innovations — a web development and digital product company helping businesses build reliable, scalable digital solutions.',
            'content' => '<p>Sky Web Innovations is a web development and digital product company helping businesses, startups, and agencies build reliable, scalable digital solutions.</p>',
            'page_template' => 'default',
            'is_published' => true,
            'meta_title' => 'About Sky Web Innovations | Web Development Company',
            'meta_description' => 'Sky Web Innovations is a web development and digital product company helping businesses build reliable, scalable digital solutions.',
            'order' => 1,
        ]);
        Page::create([
            'title' => 'Privacy Policy',
            'slug' => 'privacy-policy',
            'excerpt' => 'Our privacy policy outlines how we collect, use, and protect your personal information.',
            'content' => '<p>This Privacy Policy describes how Sky Web Innovations collects, uses, and protects your personal information.</p>',
            'page_template' => 'default',
            'is_published' => true,
            'meta_title' => 'Privacy Policy | Sky Web Innovations',
            'meta_description' => 'Learn how Sky Web Innovations collects, uses, and protects your personal information.',
            'order' => 2,
        ]);
        Page::create([
            'title' => 'Terms of Service',
            'slug' => 'terms-of-service',
            'excerpt' => 'The terms and conditions for using Sky Web Innovations services.',
            'content' => '<p>By using the Sky Web Innovations website and services, you agree to the following terms and conditions.</p>',
            'page_template' => 'default',
            'is_published' => true,
            'meta_title' => 'Terms of Service | Sky Web Innovations',
            'meta_description' => 'Terms and conditions for using Sky Web Innovations services.',
            'order' => 3,
        ]);

        // ─── Blog Posts ───
        BlogPost::create([
            'title' => 'How to Choose the Right Technology Stack for Your Web Project',
            'slug' => 'how-to-choose-right-technology-stack',
            'excerpt' => 'Choosing the right technology stack is one of the most important decisions in web development. Here is a practical guide.',
            'content' => '<p>Choosing the right technology stack is one of the most important decisions you will make for your web project.</p>',
            'category' => 'Technology',
            'tags' => json_encode(['Web Development', 'Technology']),
            'is_published' => true,
            'published_at' => now()->subDays(7),
            'meta_title' => 'How to Choose the Right Tech Stack',
            'meta_description' => 'A practical guide to choosing the right technology stack for your web project.',
            'order' => 1,
        ]);
        BlogPost::create([
            'title' => 'Why Laravel Remains the Best PHP Framework in 2026',
            'slug' => 'why-laravel-best-php-framework-2026',
            'excerpt' => 'Laravel continues to dominate the PHP ecosystem. Here is why it remains the top choice.',
            'content' => '<p>Laravel has been the most popular PHP framework for several years running, and for good reason.</p>',
            'category' => 'Laravel',
            'tags' => json_encode(['Laravel', 'PHP']),
            'is_published' => true,
            'published_at' => now()->subDays(14),
            'meta_title' => 'Why Laravel Remains the Best PHP Framework',
            'meta_description' => 'Laravel continues to dominate the PHP ecosystem.',
            'order' => 2,
        ]);
    }
}
