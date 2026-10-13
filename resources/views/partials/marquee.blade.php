<div aria-label="Technology stack" style="overflow:hidden; padding:30px 0; border-bottom:1px solid oklch(0.26 0.025 272);">
  <div style="display:flex; width:max-content; animation:swi-marq 45s linear infinite;">
    @foreach(array_merge($techStackItems->pluck('name')->toArray(), $techStackItems->pluck('name')->toArray()) as $name)
      <span style="display:flex; align-items:center; gap:36px; padding-right:36px; font-family:'Bricolage Grotesque'; font-size:clamp(24px,3vw,40px); font-weight:500; letter-spacing:-0.03em; white-space:nowrap; color:oklch(0.82 0.015 272);">{{ $name }}<span style="width:8px; height:8px; border-radius:50%; background:var(--acc, oklch(0.62 0.19 273));"></span></span>
    @endforeach
  </div>
</div>
