@props([
    'title' => null,
    'description' => null,
    'image' => null,
    'author' => null,
    'keywords' => null,
    'type' => 'website',
    'canonical' => null,
    'services' => [],
    'faqItems' => [],
])

<?php
    $settings = $settings ?? [];
    $title = $title ?: ($settings['meta_title'] ?? 'Sky Web Innovations | Website, SaaS & Custom Software Development Company');
    $description = $description ?: ($settings['meta_description'] ?? 'Sky Web Innovations designs and builds websites, custom web applications and SaaS products for businesses in the US, Canada, Australia, New Zealand and the UK.');
    $image = $image ?: ($settings['meta_image'] ?? '/assets/og-image.jpg');
    $imageFull = preg_match('#^https?://#', $image) ? $image : (config('app.url') . $image);
    $author = $author ?: ($settings['founder_name'] ?? 'Aakash Thakkar');
    $keywords = $keywords ?: ($settings['meta_keywords'] ?? 'web development, custom software, SaaS, Laravel, React, web applications, website design, digital products, web agency');
    $canonical = $canonical ?: url()->current();
    $url = config('app.url');
    $siteName = $settings['site_name'] ?? 'Sky Web Innovations';
    $locale = app()->getLocale() ?: 'en_US';
?>

<!-- Primary Meta Tags -->
<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">
<meta name="author" content="{{ $author }}">
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<link rel="canonical" href="{{ $canonical }}">

<!-- Favicon -->
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
<meta name="theme-color" content="#14152a">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{ $type }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="{{ $locale }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $imageFull }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="{{ $siteName }} - Web Development & Digital Products">
@if($type === 'article')
<meta property="article:published_time" content="{{ $settings['published_at'] ?? '' }}">
<meta property="article:modified_time" content="{{ $settings['modified_at'] ?? '' }}">
<meta property="article:author" content="{{ $author }}">
<meta property="article:publisher" content="{{ $url }}">
@endif

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $imageFull }}">
<meta name="twitter:image:alt" content="{{ $siteName }} - Web Development & Digital Products">
<meta name="twitter:creator" content="{{ $settings['twitter_handle'] ?? '@skywebinnovations' }}">

<!-- Hreflang — international targeting (single English site serving multiple markets) -->
<link rel="alternate" hreflang="x-default" href="{{ $url }}/">
<link rel="alternate" hreflang="en-us" href="{{ $url }}/">
<link rel="alternate" hreflang="en-gb" href="{{ $url }}/">
<link rel="alternate" hreflang="en-ca" href="{{ $url }}/">
<link rel="alternate" hreflang="en-au" href="{{ $url }}/">
<link rel="alternate" hreflang="en-nz" href="{{ $url }}/">
<link rel="alternate" hreflang="en" href="{{ $url }}/">

<!-- Preconnect for performance -->
<link rel="preconnect" href="https://www.googletagmanager.com">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

@php
    $servicesArray = $services instanceof \Illuminate\Support\Collection ? $services : collect($services ?? []);
    $faqArray = $faqItems instanceof \Illuminate\Support\Collection ? $faqItems : collect($faqItems ?? []);
    $orgUrl = $url;
    $orgName = $siteName;
    $orgEmail = $settings['contact_email'] ?? 'info@skywebinnovations.com';
    $orgPhone = $settings['contact_phone'] ?? '+91-8469015463';
    $founderName = $settings['founder_name'] ?? 'Aakash Thakkar';
    $founderLinkedin = $settings['linkedin_url'] ?? 'https://www.linkedin.com/in/aakash-thakkar-a8b9a988/';
    $logoUrl = $url . '/assets/logo.jpeg';
    $servicesForSchema = collect($servicesArray)->map(fn($s) => ['@type' => 'Service', 'name' => is_object($s) ? $s->name : $s])->take(7);
    $faqForSchema = collect($faqArray)->take(6)->map(fn($f) => [
        '@type' => 'Question',
        'name' => is_object($f) ? $f->question : $f['question'],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => is_object($f) ? $f->answer : $f['answer']]
    ]);

    // Determine breadcrumb items based on current route
    $breadcrumbItems = [['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $orgUrl . '/']];
    if (request()->routeIs('blog.show') && isset($post)) {
        $breadcrumbItems[] = ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => $orgUrl . '/blog'];
        $breadcrumbItems[] = ['@type' => 'ListItem', 'position' => 3, 'name' => $post->title, 'item' => $canonical];
    } elseif (request()->routeIs('blog.index')) {
        $breadcrumbItems[] = ['@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => $canonical];
    } elseif (request()->routeIs('page.show') && isset($page)) {
        $breadcrumbItems[] = ['@type' => 'ListItem', 'position' => 2, 'name' => $page->title, 'item' => $canonical];
    }
@endphp

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@graph": [
        {
            "@type": "WebSite",
            "@id": "{{ $orgUrl }}/#website",
            "url": "{{ $orgUrl }}/",
            "name": "{{ $orgName }}",
            "description": "{{ $description }}",
            "inLanguage": "en-US",
            "publisher": {"@id": "{{ $orgUrl }}/#org"},
            "potentialAction": {
                "@type": "SearchAction",
                "target": {"@type" : "EntryPoint", "urlTemplate" : "{{ $orgUrl }}/?s={search_term_string}"},
                "query-input": "required name=search_term_string"
            }
        },
        {
            "@type": "Organization",
            "@id": "{{ $orgUrl }}/#org",
            "name": "{{ $orgName }}",
            "url": "{{ $orgUrl }}/",
            "logo": {
                "@type": "ImageObject",
                "url": "{{ $logoUrl }}",
                "width": 220,
                "height": 44
            },
            "email": "{{ $orgEmail }}",
            "telephone": "{{ $orgPhone }}",
            "description": "Website, custom web application, SaaS and digital product development company.",
            "foundingDate": "{{ $settings['founding_date'] ?? '2024' }}",
            "founder": {"@id": "{{ $orgUrl }}/#founder"},
            "sameAs": [
                "{{ $founderLinkedin }}"
            ],
            "areaServed": [
                {"@type": "Country", "name": "United States"},
                {"@type": "Country", "name": "United Kingdom"},
                {"@type": "Country", "name": "Canada"},
                {"@type": "Country", "name": "Australia"},
                {"@type": "Country", "name": "New Zealand"}
            ],
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Vedant Lifestyle, C 27, Kalali Rd, near Chanakya Nagri, opposite CM Patel Farm, Atladara",
                "addressLocality": "Vadodara",
                "addressRegion": "Gujarat",
                "postalCode": "390012",
                "addressCountry": "IN"
            },
            "contactPoint": {
                "@type": "ContactPoint",
                "email": "{{ $orgEmail }}",
                "telephone": "{{ $orgPhone }}",
                "contactType": "sales",
                "availableLanguage": ["English", "Hindi", "Gujarati"]
            }@if($servicesForSchema->count() > 0),
            "hasOfferCatalog": {!! json_encode([
                '@type' => 'OfferCatalog',
                'name' => 'Services',
                'itemListElement' => $servicesForSchema->toArray()
            ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
            @endif
        },
        {
            "@type": "ProfessionalService",
            "@id": "{{ $orgUrl }}/#professionalservice",
            "name": "{{ $orgName }}",
            "image": "{{ $imageFull }}",
            "url": "{{ $orgUrl }}/",
            "telephone": "{{ $orgPhone }}",
            "email": "{{ $orgEmail }}",
            "priceRange": "$$",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Vedant Lifestyle, C 27, Kalali Rd, near Chanakya Nagri, opposite CM Patel Farm, Atladara",
                "addressLocality": "Vadodara",
                "addressRegion": "Gujarat",
                "postalCode": "390012",
                "addressCountry": "IN"
            },
            "geo": {"@type": "GeoCoordinates", "latitude": 22.3072, "longitude": 73.1812},
            "openingHoursSpecification": [{
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
                "opens": "09:00",
                "closes": "18:00"
            }],
            "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue": "5.0",
                "reviewCount": "2",
                "bestRating": "5",
                "worstRating": "1"
            }
        },
        {
            "@type": "Person",
            "@id": "{{ $orgUrl }}/#founder",
            "name": "{{ $founderName }}",
            "jobTitle": "{{ $settings['founder_title'] ?? 'Founder & Technology Lead' }}",
            "worksFor": {"@id": "{{ $orgUrl }}/#org"},
            "sameAs": ["{{ $founderLinkedin }}"]
        }
        @if($faqForSchema->count() > 0),
        {
            "@type": "FAQPage",
            "mainEntity": {!! json_encode($faqForSchema->toArray(), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
        }
        @endif
        @if(count($breadcrumbItems) > 1 || request()->routeIs('page.show')),
        {
            "@type": "BreadcrumbList",
            "itemListElement": {!! json_encode($breadcrumbItems, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
        }
        @endif
    ]
}
</script>

<!-- Google Analytics -->
@if($settings['ga_measurement_id'] ?? false)
<script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings['ga_measurement_id'] }}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '{{ $settings['ga_measurement_id'] }}');
</script>
@endif

<!-- Google Site Verification -->
@if($settings['google_site_verification'] ?? false)
<meta name="google-site-verification" content="{{ $settings['google_site_verification'] }}">
@endif

<!-- Bing Site Verification -->
@if($settings['bing_site_verification'] ?? false)
<meta name="msvalidate.01" content="{{ $settings['bing_site_verification'] }}">
@endif
