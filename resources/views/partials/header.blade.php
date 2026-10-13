<header style="position:fixed; top:14px; left:0; right:0; z-index:60; padding:0 clamp(12px,3vw,32px);">
  <nav aria-label="Primary" style="max-width:1180px; margin:0 auto; display:flex; align-items:center; justify-content:space-between; gap:20px; padding:8px 8px 8px 20px; border-radius:999px; background:oklch(0.19 0.025 272 / 0.72); backdrop-filter:blur(16px) saturate(1.4); -webkit-backdrop-filter:blur(16px) saturate(1.4); border:1px solid oklch(0.32 0.03 272 / 0.8);">
    <a href="#top" aria-label="{{ $settings['site_name'] ?? 'Sky Web Innovations' }} home" style="display:flex; align-items:center;"><img src="{{ asset('assets/logo.jpeg') }}" alt="{{ $settings['site_name'] ?? 'Sky Web Innovations' }}" width="150" height="36" style="display:block; height:34px; width:auto; filter:invert(1) hue-rotate(180deg) brightness(1.15); mix-blend-mode:screen;"></a>
    @unless(request()->is('admin*'))
    <div id="nav-links" style="display:flex; gap:26px; font-size:14px; color:oklch(0.8 0.015 272);">
      @php
        $headerNav = \App\Models\NavigationItem::header()->get();
      @endphp
      @foreach($headerNav as $item)
        @if($item->url === '#founder' && isset($showFounder) && $showFounder)
          <a href="{{ $item->url }}" @if($item->target_blank)target="_blank"@endif>{{ $item->label }}</a>
        @elseif($item->url === '#why' && isset($showWhyUs) && $showWhyUs)
          <a href="{{ $item->url }}" @if($item->target_blank)target="_blank"@endif>{{ $item->label }}</a>
        @elseif($item->url === '#services' && isset($showServices) && $showServices)
          <a href="{{ $item->url }}" @if($item->target_blank)target="_blank"@endif>{{ $item->label }}</a>
        @elseif($item->url === '#work' && isset($showWork) && $showWork)
          <a href="{{ $item->url }}" @if($item->target_blank)target="_blank"@endif>{{ $item->label }}</a>
        @elseif($item->url === '#engage' && isset($showEngage) && $showEngage)
          <a href="{{ $item->url }}" @if($item->target_blank)target="_blank"@endif>{{ $item->label }}</a>
        @elseif(str_starts_with($item->url, '#'))
          <a href="{{ $item->url }}" @if($item->target_blank)target="_blank"@endif>{{ $item->label }}</a>
        @else
          <a href="{{ $item->url }}" @if($item->target_blank)target="_blank"@endif>{{ $item->label }}</a>
        @endif
      @endforeach
    </div>
    <a href="#contact" style="display:flex; align-items:center; gap:10px; padding:11px 18px; border-radius:999px; background:var(--acc, oklch(0.62 0.19 273)); color:#fff; font-size:14px; font-weight:500; white-space:nowrap;">Start a project <span style="font-family:'JetBrains Mono';">→</span></a>
    <button id="nav-toggle" style="display:none; background:none; border:none; color:#fff; font-size:24px; cursor:pointer;">☰</button>
    @endunless
  </nav>
</header>
