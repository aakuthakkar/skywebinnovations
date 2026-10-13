<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login — {{ config('app.name', 'Sky Web Innovations') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

        <!-- SEO / Meta -->
        <meta name="robots" content="noindex, nofollow">
        <meta name="theme-color" content="#14152a">

        <!-- Styles -->
        <style>
            *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
            body {
                font-family: 'Geist', system-ui, -apple-system, sans-serif;
                background: #14152a;
                color: #e4e4ec;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                -webkit-font-smoothing: antialiased;
            }
            .login-wrapper {
                width: 100%;
                max-width: 420px;
                padding: 24px;
            }
            .login-card {
                background: oklch(0.20 0.025 272);
                border: 1px solid oklch(0.30 0.03 272);
                border-radius: 16px;
                padding: 40px 36px;
                box-shadow: 0 24px 64px rgba(0, 0, 0, 0.35);
            }
            .login-logo {
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 8px;
            }
            .login-logo svg {
                width: 44px;
                height: 44px;
                color: oklch(0.72 0.18 273);
            }
            .login-brand {
                text-align: center;
                margin-bottom: 32px;
            }
            .login-brand h1 {
                font-family: 'JetBrains Mono', monospace;
                font-size: 13px;
                font-weight: 500;
                letter-spacing: 0.15em;
                text-transform: uppercase;
                color: oklch(0.62 0.02 272);
            }
            .login-brand p {
                font-size: 13px;
                color: oklch(0.62 0.015 272);
                margin-top: 4px;
            }
            .login-card .form-group { margin-bottom: 18px; }
            .login-card label {
                display: block;
                margin-bottom: 6px;
                font-size: 13px;
                font-weight: 500;
                color: oklch(0.80 0.015 272);
            }
            .login-card input[type="email"],
            .login-card input[type="password"] {
                width: 100%;
                padding: 11px 14px;
                border-radius: 10px;
                border: 1px solid oklch(0.30 0.025 272);
                background: oklch(0.16 0.02 272);
                color: oklch(0.96 0.005 272);
                font-size: 14px;
                font-family: 'Geist', system-ui, sans-serif;
                outline: none;
                transition: border-color 0.2s;
            }
            .login-card input:focus {
                border-color: oklch(0.62 0.19 273);
                box-shadow: 0 0 0 3px oklch(0.62 0.19 273 / 0.12);
            }
            .login-card input::placeholder { color: oklch(0.55 0.015 272); }
            .login-remember {
                display: flex;
                align-items: center;
                gap: 8px;
                margin-bottom: 20px;
            }
            .login-remember input[type="checkbox"] {
                width: 16px;
                height: 16px;
                accent-color: oklch(0.62 0.19 273);
                cursor: pointer;
            }
            .login-remember label {
                font-size: 13px;
                color: oklch(0.72 0.015 272);
                cursor: pointer;
            }
            .login-actions {
                display: flex;
                flex-direction: column;
                gap: 12px;
                align-items: stretch;
            }
            .login-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                width: 100%;
                padding: 12px 20px;
                border-radius: 10px;
                border: none;
                background: oklch(0.62 0.19 273);
                color: #fff;
                font-size: 14px;
                font-weight: 600;
                font-family: 'Geist', system-ui, sans-serif;
                cursor: pointer;
                transition: background 0.2s, transform 0.15s;
            }
            .login-btn:hover {
                background: oklch(0.57 0.19 273);
                transform: translateY(-1px);
            }
            .login-btn:active { transform: translateY(0); }
            .login-forgot {
                text-align: center;
                font-size: 13px;
            }
            .login-forgot a {
                color: oklch(0.62 0.19 273);
                text-decoration: none;
            }
            .login-forgot a:hover { text-decoration: underline; }
            .login-footer {
                text-align: center;
                margin-top: 24px;
                font-size: 12px;
                color: oklch(0.55 0.015 272);
            }
            .login-footer a {
                color: oklch(0.62 0.19 273);
                text-decoration: none;
            }
            .login-footer a:hover { text-decoration: underline; }
            .bg-orb {
                position: fixed;
                border-radius: 50%;
                filter: blur(120px);
                pointer-events: none;
                z-index: 0;
            }
            .bg-orb-1 {
                width: 500px; height: 500px;
                background: oklch(0.45 0.18 273 / 0.15);
                top: -150px; left: -100px;
            }
            .bg-orb-2 {
                width: 400px; height: 400px;
                background: oklch(0.45 0.12 200 / 0.10);
                bottom: -100px; right: -80px;
            }
        </style>
    </head>
    <body>
        <div class="bg-orb bg-orb-1"></div>
        <div class="bg-orb bg-orb-2"></div>

        <div class="login-wrapper" style="position:relative; z-index:1;">
            <!-- Logo -->
            <div class="login-logo">
                <svg viewBox="0 0 220 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g transform="translate(4, 4)">
                        <circle cx="18" cy="18" r="4" fill="oklch(0.72 0.18 273)" opacity="0.95"/>
                        <circle cx="4" cy="8" r="2.5" fill="oklch(0.72 0.18 273)" opacity="0.7"/>
                        <circle cx="32" cy="8" r="2.5" fill="oklch(0.72 0.18 273)" opacity="0.7"/>
                        <circle cx="4" cy="28" r="2.5" fill="oklch(0.72 0.18 273)" opacity="0.7"/>
                        <circle cx="32" cy="28" r="2.5" fill="oklch(0.72 0.18 273)" opacity="0.7"/>
                        <line x1="7" y1="10" x2="14" y2="15" stroke="oklch(0.72 0.18 273)" stroke-width="1.2" opacity="0.5"/>
                        <line x1="29" y1="10" x2="22" y2="15" stroke="oklch(0.72 0.18 273)" stroke-width="1.2" opacity="0.5"/>
                        <line x1="7" y1="26" x2="14" y2="21" stroke="oklch(0.72 0.18 273)" stroke-width="1.2" opacity="0.5"/>
                        <line x1="29" y1="26" x2="22" y2="21" stroke="oklch(0.72 0.18 273)" stroke-width="1.2" opacity="0.5"/>
                        <line x1="14" y1="15" x2="22" y2="21" stroke="oklch(0.72 0.18 273)" stroke-width="1" opacity="0.35"/>
                        <line x1="14" y1="15" x2="14" y2="21" stroke="oklch(0.72 0.18 273)" stroke-width="1" opacity="0.35"/>
                        <line x1="22" y1="15" x2="22" y2="21" stroke="oklch(0.72 0.18 273)" stroke-width="1" opacity="0.35"/>
                    </g>
                    <text x="46" y="26" font-family="'Geist', system-ui, sans-serif" font-size="17" font-weight="700" letter-spacing="-0.02em" fill="oklch(0.90 0.005 272)">Sky Web</text>
                    <text x="46" y="39" font-family="'Geist', system-ui, sans-serif" font-size="10" font-weight="500" letter-spacing="0.18em" fill="oklch(0.55 0.02 272)">INNOVATIONS</text>
                </svg>
            </div>

            <!-- Brand -->
            <div class="login-brand">
                <h1>Admin Panel</h1>
                <p>Sign in to manage your website</p>
            </div>

            <!-- Card -->
            <div class="login-card">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">{{ __('Email') }}</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="you@example.com">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember -->
                    <div class="login-remember">
                        <input id="remember_me" type="checkbox" name="remember">
                        <label for="remember_me">{{ __('Remember me') }}</label>
                    </div>

                    <!-- Actions -->
                    <div class="login-actions">
                        <button type="submit" class="login-btn">
                            Sign in
                        </button>

                        @if (Route::has('password.request'))
                            <div class="login-forgot">
                                <a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                            </div>
                        @endif
                    </div>
                </form>
            </div>

            <div class="login-footer">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'Sky Web Innovations') }}. All rights reserved.</p>
            </div>
        </div>
    </body>
</html>
