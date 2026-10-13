<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Sky Web Innovations') — {{ config('app.name', 'Sky Web Innovations') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

        <!-- SEO / Meta -->
        <meta name="robots" content="noindex, nofollow">
        <meta name="theme-color" content="#14152a">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#14152a]">
            <div class="w-full sm:max-w-md px-6 py-4">
                <a href="/" class="flex justify-center mb-6">
                    <svg viewBox="0 0 220 44" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-12 w-auto">
                        <g transform="translate(4, 4)">
                            <circle cx="18" cy="18" r="4" fill="oklch(0.62 0.19 273)" opacity="0.95"/>
                            <circle cx="4" cy="8" r="2.5" fill="oklch(0.62 0.19 273)" opacity="0.7"/>
                            <circle cx="32" cy="8" r="2.5" fill="oklch(0.62 0.19 273)" opacity="0.7"/>
                            <circle cx="4" cy="28" r="2.5" fill="oklch(0.62 0.19 273)" opacity="0.7"/>
                            <circle cx="32" cy="28" r="2.5" fill="oklch(0.62 0.19 273)" opacity="0.7"/>
                            <line x1="7" y1="10" x2="14" y2="15" stroke="oklch(0.62 0.19 273)" stroke-width="1.2" opacity="0.5"/>
                            <line x1="29" y1="10" x2="22" y2="15" stroke="oklch(0.62 0.19 273)" stroke-width="1.2" opacity="0.5"/>
                            <line x1="7" y1="26" x2="14" y2="21" stroke="oklch(0.62 0.19 273)" stroke-width="1.2" opacity="0.5"/>
                            <line x1="29" y1="26" x2="22" y2="21" stroke="oklch(0.62 0.19 273)" stroke-width="1.2" opacity="0.5"/>
                            <line x1="14" y1="15" x2="22" y2="21" stroke="oklch(0.62 0.19 273)" stroke-width="1" opacity="0.35"/>
                            <line x1="14" y1="15" x2="14" y2="21" stroke="oklch(0.62 0.19 273)" stroke-width="1" opacity="0.35"/>
                            <line x1="22" y1="15" x2="22" y2="21" stroke="oklch(0.62 0.19 273)" stroke-width="1" opacity="0.35"/>
                        </g>
                        <text x="46" y="26" font-family="'Geist', sans-serif" font-size="17" font-weight="700" letter-spacing="-0.02em" fill="#e4e4ec">Sky Web</text>
                        <text x="46" y="39" font-family="'Geist', sans-serif" font-size="10" font-weight="500" letter-spacing="0.18em" fill="#666">INNOVATIONS</text>
                    </svg>
                </a>

                <div class="w-full sm:max-w-md mt-0 px-6 py-5 bg-white/[0.03] border border-white/10 shadow-xl overflow-hidden sm:rounded-2xl backdrop-blur-sm">
                    {{ $slot }}
                </div>

                <p class="text-center mt-6 text-xs text-gray-500">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Sky Web Innovations') }}. All rights reserved.
                </p>
            </div>
        </div>
    </body>
</html>
