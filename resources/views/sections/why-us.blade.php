<section id="why" aria-labelledby="why-h" style="max-width:1320px; margin:0 auto; padding:clamp(100px,12vw,160px) clamp(20px,4vw,48px);">
  <div data-reveal style="display:flex; flex-wrap:wrap; justify-content:space-between; align-items:flex-end; gap:24px; margin-bottom:56px;">
    <div>
      <p style="margin:0 0 20px; font-family:'JetBrains Mono'; font-size:12px; letter-spacing:0.08em; text-transform:uppercase; color:oklch(0.72 0.02 272);">03 — Why choose us</p>
      <h2 id="why-h" style="margin:0; font-family:'Bricolage Grotesque'; font-weight:600; font-size:clamp(40px,5.4vw,84px); line-height:0.96; letter-spacing:-0.045em; text-wrap:balance;">Why Choose <span style="font-family:'Instrument Serif'; font-style:italic; font-weight:400; color:oklch(0.8 0.11 273);">Us</span></h2>
    </div>
  </div>
  <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(min(100%, 320px), 1fr)); gap:1px; background:oklch(0.28 0.025 272); border:1px solid oklch(0.28 0.025 272); border-radius:24px; overflow:hidden;">
    @foreach($whyUsItems as $item)
    <article style="padding:clamp(28px,3vw,40px); background:oklch(0.14 0.02 272); display:flex; flex-direction:column; gap:16px; min-height:240px;" onmouseover="this.style.background='oklch(0.18 0.025 272)'" onmouseout="this.style.background='oklch(0.14 0.02 272)'">
      <span style="font-family:'JetBrains Mono'; font-size:12px; color:oklch(0.78 0.12 273);">{{ $item->number }}</span>
      <h3 style="margin:0; font-family:'Bricolage Grotesque'; font-size:clamp(22px,2vw,27px); font-weight:600; letter-spacing:-0.025em; line-height:1.15;">{{ $item->title }}</h3>
      <p style="margin:0; font-size:15px; line-height:1.65; color:oklch(0.76 0.015 272); text-wrap:pretty;">{{ $item->description }}</p>
    </article>
    @endforeach
  </div>
</section>
