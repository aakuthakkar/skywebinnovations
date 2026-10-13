<footer style="background:oklch(0.12 0.02 272); padding:clamp(56px,7vw,96px) clamp(20px,4vw,48px) 28px; border-top:1px solid oklch(0.24 0.025 272);">
  <div style="max-width:1320px; margin:0 auto;">
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(180px, 1fr)); gap:32px; padding-bottom:56px;">
      <div style="grid-column:span 2; min-width:0; display:flex; flex-direction:column; gap:20px;">
        <img src="{{ asset('assets/logo.jpeg') }}" alt="{{ $settings['site_name'] ?? 'Sky Web Innovations' }}" width="220" height="52" style="display:block; align-self:flex-start; height:48px; width:auto; filter:invert(1) hue-rotate(180deg) brightness(1.15); mix-blend-mode:screen;">
        <p style="margin:0; max-width:380px; font-size:15px; line-height:1.55; color:oklch(0.74 0.015 272);">A website and product development company building software for businesses worldwide.</p>
        <p style="margin:0; font-family:'JetBrains Mono'; font-size:12px; color:oklch(0.62 0.02 272);">US · Canada · Australia · New Zealand · UK</p>
      </div>
      @php
        $allFooterColumns = \App\Models\FooterLink::where('is_active', true)
          ->select('column_name')
          ->distinct()
          ->orderBy('column_name')
          ->pluck('column_name');
      @endphp
      @foreach($allFooterColumns as $col)
      <nav aria-label="Footer" style="display:flex; flex-direction:column; gap:10px; font-size:14px; color:oklch(0.85 0.01 272);">
        <span style="font-family:'JetBrains Mono'; font-size:11px; color:oklch(0.6 0.02 272); margin-bottom:4px; text-transform:uppercase;">{{ ucfirst($col) }}</span>
        @foreach(\App\Models\FooterLink::byColumn($col)->get() as $link)
          <a href="{{ $link->url }}">{{ $link->label }}</a>
        @endforeach
      </nav>
      @endforeach
      @if($allFooterColumns->isEmpty())
      <nav aria-label="Footer" style="display:flex; flex-direction:column; gap:10px; font-size:14px; color:oklch(0.85 0.01 272);"><span style="font-family:'JetBrains Mono'; font-size:11px; color:oklch(0.6 0.02 272); margin-bottom:4px;">SITE</span><a href="#founder">About Us</a><a href="#services">Services</a><a href="#engage">Process</a><a href="#work">Work</a></nav>
      <div style="display:flex; flex-direction:column; gap:10px; font-size:14px; color:oklch(0.85 0.01 272);"><span style="font-family:'JetBrains Mono'; font-size:11px; color:oklch(0.6 0.02 272); margin-bottom:4px;">CONTACT</span><a href="mailto:{{ $settings['contact_email'] ?? 'info@skywebinnovations.com' }}">{{ $settings['contact_email'] ?? 'info@skywebinnovations.com' }}</a><a href="tel:{{ $settings['contact_phone_raw'] ?? '+917990903773' }}">{{ $settings['contact_phone'] ?? '+91 79909 03773' }}</a><a href="{{ $settings['linkedin_url'] ?? 'https://www.linkedin.com/in/aakash-thakkar-a8b9a988/' }}" target="_blank" rel="noopener">LinkedIn ↗</a></div>
      @endif
    </div>
    <div aria-hidden="true" style="font-family:'Bricolage Grotesque'; font-weight:700; font-size:clamp(64px,16vw,240px); line-height:0.8; letter-spacing:-0.065em; text-align:center; color:transparent; -webkit-text-stroke:1px oklch(0.4 0.06 273); overflow:hidden; white-space:nowrap;">{{ $settings['site_name'] ?? 'Sky Web' }}<span style="color:var(--acc, oklch(0.62 0.19 273)); -webkit-text-stroke:0;">.</span></div>
    <div style="margin-top:32px; padding-top:20px; border-top:1px solid oklch(0.24 0.025 272); display:flex; flex-wrap:wrap; justify-content:space-between; gap:12px; font-family:'JetBrains Mono'; font-size:11px; color:oklch(0.62 0.02 272);"><span>© 2026 {{ $settings['site_name'] ?? 'Sky Web Innovations' }}. All rights reserved.</span><a href="#top">Back to top ↑</a></div>
  </div>
</footer>
