<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <title>@yield('title', 'Dashboard') — Admin</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,500;12..96,600;12..96,700&family=Geist:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
  @vite('resources/css/app.css')
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Geist', system-ui, sans-serif; background: oklch(0.14 0.02 272); color: oklch(0.96 0.005 272); }
    .admin-sidebar { position: fixed; top: 0; left: 0; bottom: 0; width: 260px; background: oklch(0.12 0.02 272); border-right: 1px solid oklch(0.24 0.025 272); padding: 24px 0; z-index: 50; }
    .admin-sidebar .brand { padding: 0 24px 24px; font-family: 'Bricolage Grotesque', sans-serif; font-size: 20px; font-weight: 600; border-bottom: 1px solid oklch(0.24 0.025 272); margin-bottom: 16px; }
    .admin-sidebar nav a { display: flex; align-items: center; gap: 10px; padding: 10px 24px; color: oklch(0.8 0.015 272); text-decoration: none; font-size: 14px; transition: all .15s; }
    .admin-sidebar nav a:hover, .admin-sidebar nav a.active { background: oklch(0.18 0.025 272); color: oklch(0.96 0.005 272); }
    .admin-sidebar nav a .icon { font-family: 'JetBrains Mono', monospace; font-size: 12px; opacity: .7; width: 20px; text-align: center; }
    .admin-content { margin-left: 260px; min-height: 100vh; }
    .admin-topbar { position: sticky; top: 0; background: oklch(0.14 0.02 272 / 0.9); backdrop-filter: blur(12px); border-bottom: 1px solid oklch(0.24 0.025 272); padding: 16px 32px; display: flex; justify-content: space-between; align-items: center; z-index: 40; }
    .admin-topbar .user { display: flex; align-items: center; gap: 12px; font-size: 14px; }
    .btn { display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border-radius: 8px; font-size: 14px; text-decoration: none; border: none; cursor: pointer; }
    .btn-primary { background: oklch(0.62 0.19 273); color: #fff; }
    .btn-sm { padding: 6px 12px; font-size: 13px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 12px 16px; text-align: left; border-bottom: 1px solid oklch(0.24 0.025 272); }
    th { font-family: 'JetBrains Mono', monospace; font-size: 11px; text-transform: uppercase; color: oklch(0.65 0.02 272); letter-spacing: 0.06em; }
    .card { background: oklch(0.18 0.025 272); border: 1px solid oklch(0.28 0.025 272); border-radius: 12px; padding: 24px; }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; margin-bottom: 6px; font-size: 14px; font-weight: 500; }
    .form-group input, .form-group textarea, .form-group select { width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid oklch(0.28 0.025 272); background: oklch(0.14 0.02 272); color: oklch(0.96 0.005 272); font-size: 14px; outline: none; }
    .form-group input:focus, .form-group textarea:focus, .form-group select:focus { border-color: oklch(0.62 0.19 273); }
    .form-group textarea { min-height: 120px; resize: vertical; }
    .badge { display: inline-block; padding: 4px 10px; border-radius: 999px; font-size: 12px; }
    .badge-new { background: oklch(0.72 0.17 150); color: oklch(0.16 0.02 272); }
    .badge-read { background: oklch(0.62 0.19 273); color: #fff; }
    .badge-replied { background: oklch(0.72 0.17 150); color: oklch(0.16 0.02 272); }
    .badge-closed { background: oklch(0.65 0.02 272); color: #fff; }
    .actions { display: flex; gap: 8px; }
    .btn-xs { padding: 4px 10px; font-size: 12px; border-radius: 6px; text-decoration: none; }
    .btn-edit { background: oklch(0.62 0.19 273); color: #fff; }
    .btn-delete { background: oklch(0.55 0.19 25); color: #fff; }
    .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
    .page-header h1 { font-family: 'Bricolage Grotesque', sans-serif; font-size: 28px; font-weight: 600; }
    .alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; background: oklch(0.72 0.17 150 / 0.15); border: 1px solid oklch(0.72 0.17 150); color: oklch(0.72 0.17 150); }
    @media (max-width: 768px) {
      .admin-sidebar { display: none; }
      .admin-content { margin-left: 0; }
    }
  </style>
  @yield('styles')
</head>
<body>
  <aside class="admin-sidebar">
    <div class="brand">Sky Web</div>
    <nav>
      <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><span class="icon">◉</span> {{ $menuLabels['dashboard'] ?? 'Dashboard' }}</a>
      <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}"><span class="icon">⊞</span> {{ $menuLabels['services'] ?? 'Services' }}</a>
      <a href="{{ route('admin.projects.index') }}" class="{{ request()->routeIs('admin.projects.*') ? 'active' : '' }}"><span class="icon">◇</span> {{ $menuLabels['projects'] ?? 'Projects' }}</a>
      <a href="{{ route('admin.why-us.index') }}" class="{{ request()->routeIs('admin.why-us.*') ? 'active' : '' }}"><span class="icon">✦</span> {{ $menuLabels['why_us'] ?? 'Why Us' }}</a>
      <a href="{{ route('admin.process-steps.index') }}" class="{{ request()->routeIs('admin.process-steps.*') ? 'active' : '' }}"><span class="icon">→</span> {{ $menuLabels['process'] ?? 'Process' }}</a>
      <a href="{{ route('admin.engagement-models.index') }}" class="{{ request()->routeIs('admin.engagement-models.*') ? 'active' : '' }}"><span class="icon">◎</span> {{ $menuLabels['engagement'] ?? 'Engagement' }}</a>
      <a href="{{ route('admin.tech-stack.index') }}" class="{{ request()->routeIs('admin.tech-stack.*') ? 'active' : '' }}"><span class="icon">⌘</span> {{ $menuLabels['tech_stack'] ?? 'Tech Stack' }}</a>
      <a href="{{ route('admin.contact-inquiries.index') }}" class="{{ request()->routeIs('admin.contact-inquiries.*') ? 'active' : '' }}"><span class="icon">✉</span> {{ $menuLabels['inquiries'] ?? 'Inquiries' }} <span style="margin-left:auto; font-size:11px; opacity:.7;">{{ \App\Models\ContactInquiry::where('status','new')->count() }}</span></a>
      <a href="{{ route('admin.pages.index') }}" class="{{ request()->routeIs('admin.pages.*') ? 'active' : '' }}"><span class="icon">▤</span> Pages</a>
      <a href="{{ route('admin.blog-posts.index') }}" class="{{ request()->routeIs('admin.blog-posts.*') ? 'active' : '' }}"><span class="icon">◧</span> Blog Posts</a>
      <a href="{{ route('admin.navigation.index') }}" class="{{ request()->routeIs('admin.navigation.*') ? 'active' : '' }}"><span class="icon">☰</span> Navigation</a>
      <a href="{{ route('admin.footer-links.index') }}" class="{{ request()->routeIs('admin.footer-links.*') ? 'active' : '' }}"><span class="icon">▥</span> Footer Links</a>
      <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}"><span class="icon">⚙</span> Settings</a>
      <div style="border-top:1px solid oklch(0.24 0.025 272); margin: 16px 0;"></div>
      <a href="{{ url('/') }}" target="_blank"><span class="icon">↗</span> View Site</a>
      <form method="POST" action="{{ route('logout') }}" style="display:contents;">
        @csrf
        <button type="submit" style="background:none; border:none; color:oklch(0.8 0.015 272); cursor:pointer; font-size:14px; font-family:inherit; display:flex; align-items:center; gap:10px; padding:10px 24px; width:100%; text-align:left;"><span class="icon">←</span> Logout</button>
      </form>
    </nav>
  </aside>

  <main class="admin-content">
    <div class="admin-topbar">
      <h2 style="font-family:'Bricolage Grotesque',sans-serif; font-size:18px; font-weight:600;">@yield('title', 'Admin')</h2>
      <div class="user">
        <span>{{ Auth::user()->name }}</span>
      </div>
    </div>
    <div style="padding:24px 32px;">
      @if(session('success'))
        <div class="alert">{{ session('success') }}</div>
      @endif
      @if($errors->any())
        <div class="alert">{{ $errors->first() }}</div>
      @endif
      @yield('content')
    </div>
  </main>
</body>
</html>
