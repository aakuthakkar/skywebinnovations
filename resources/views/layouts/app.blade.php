<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="google-site-verification" content="Ztt5g2V-1OmuaGg-rGgwOlXQze_XpLRCk_dEk83oLMg">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,500;12..96,600;12..96,700&family=Instrument+Serif:ital@0,1&family=Geist:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <x-meta-tags
        :settings="$settings ?? []"
        :title="$metaTitle ?? null"
        :description="$metaDescription ?? null"
        :image="$metaImage ?? null"
        :author="$metaAuthor ?? null"
        :keywords="$metaKeywords ?? null"
        :canonical="$canonical ?? null"
        :services="$services ?? []"
        :faqItems="$faqItems ?? []"
    />
    @stack('meta')
</head>
<body>
    @yield('body')
    @vite('resources/js/app.js')
</body>
</html>
