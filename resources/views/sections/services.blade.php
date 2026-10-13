<section id="services" aria-labelledby="svc-h" style="max-width:1320px; margin:0 auto; padding:0 clamp(20px,4vw,48px) clamp(100px,12vw,160px);">
  <div data-reveal style="margin-bottom:48px;">
    <p style="margin:0 0 20px; font-family:'JetBrains Mono'; font-size:12px; letter-spacing:0.08em; text-transform:uppercase; color:oklch(0.72 0.02 272);">04 — What we offer</p>
    <h2 id="svc-h" style="margin:0; font-family:'Bricolage Grotesque'; font-weight:600; font-size:clamp(40px,5.4vw,84px); line-height:0.96; letter-spacing:-0.045em; text-wrap:balance;">What We <span style="font-family:'Instrument Serif'; font-style:italic; font-weight:400; color:oklch(0.8 0.11 273);">Offer</span></h2>
  </div>
  <div style="border-top:1px solid oklch(0.28 0.025 272);">
    @foreach($services as $service)
    <article style="display:grid; grid-template-columns:repeat(auto-fit, minmax(min(100%, 340px), 1fr)); gap:12px 48px; align-items:baseline; padding:clamp(24px,2.6vw,34px) clamp(8px,1.5vw,20px); border-bottom:1px solid oklch(0.28 0.025 272);" onmouseover="this.style.background='oklch(0.18 0.025 272)'" onmouseout="this.style.background='transparent'">
      <div style="display:flex; align-items:baseline; gap:clamp(16px,3vw,40px);">
        <span style="font-family:'JetBrains Mono'; font-size:13px; color:oklch(0.65 0.02 272);">{{ str_pad($loop->index + 1, 2, '0', STR_PAD_LEFT) }}</span>
        <h3 style="margin:0; font-family:'Bricolage Grotesque'; font-size:clamp(24px,2.8vw,40px); font-weight:500; letter-spacing:-0.035em; line-height:1.08;">{{ $service->name }}</h3>
      </div>
      <p style="margin:0; font-size:16px; line-height:1.65; color:oklch(0.78 0.015 272); text-wrap:pretty;">{{ $service->description }}</p>
    </article>
    @endforeach
  </div>
</section>
