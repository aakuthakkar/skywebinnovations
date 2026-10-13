<section aria-label="Introduction" style="position:relative; min-height:100vh; display:flex; flex-direction:column; justify-content:center; padding:clamp(120px,14vw,160px) clamp(20px,4vw,48px) 40px; background:radial-gradient(60% 55% at 76% 46%, oklch(0.62 0.19 273 / 0.2), transparent 70%), radial-gradient(oklch(0.4 0.03 272 / 0.35) 1px, transparent 1px); background-size:auto, 28px 28px;">
  <div style="max-width:1320px; width:100%; margin:0 auto; display:grid; grid-template-columns:repeat(auto-fit, minmax(min(100%, 520px), 1fr)); gap:clamp(40px,5vw,72px); align-items:center;">
    <div style="animation:swi-rise .9s ease both;">
      <p style="margin:0 0 28px; display:inline-flex; align-items:center; gap:10px; padding:7px 14px 7px 10px; border-radius:999px; border:1px solid oklch(0.32 0.03 272); font-family:'JetBrains Mono'; font-size:12px; letter-spacing:0.06em; text-transform:uppercase; color:oklch(0.8 0.015 272);"><span style="width:8px; height:8px; border-radius:50%; background:oklch(0.72 0.17 150); box-shadow:0 0 0 4px oklch(0.72 0.17 150 / 0.2);"></span>{{ $settings['site_tagline'] ?? 'Website &amp; product engineering' }}</p>
      <h1 style="margin:0; max-width:620px; font-family:'Bricolage Grotesque'; font-weight:500; font-size:clamp(40px,4.9vw,74px); line-height:1.04; letter-spacing:-0.035em; text-wrap:balance;">We build <span style="font-family:'Instrument Serif'; font-style:italic; font-weight:400; font-size:1.08em; letter-spacing:-0.01em; color:oklch(0.8 0.11 273);">websites</span> and digital products.</h1>
      <p style="margin:26px 0 0; max-width:500px; font-size:clamp(16px,1.2vw,18px); line-height:1.7; color:oklch(0.76 0.015 272); text-wrap:pretty;">{{ $settings['site_name'] ?? 'Sky Web Innovations' }} designs and engineers fast websites, custom web applications and SaaS products for ambitious businesses, from first wireframe to production and beyond.</p>
      <div style="margin-top:36px; display:flex; flex-wrap:wrap; gap:12px;">
        <a href="#contact" style="padding:15px 24px; border-radius:999px; background:oklch(0.96 0.005 272); color:oklch(0.16 0.02 272); font-weight:500; font-size:15px; display:flex; gap:12px; align-items:center; white-space:nowrap; transition:transform .2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform=''">Get a project estimate <span style="font-family:'JetBrains Mono';">→</span></a>
        <a href="#work" style="padding:15px 24px; border-radius:999px; border:1px solid oklch(0.36 0.03 272); font-weight:500; font-size:15px; white-space:nowrap;" onmouseover="this.style.borderColor='oklch(0.8 0.015 272)';this.style.color='oklch(0.96 0.005 272)'" onmouseout="this.style.borderColor='oklch(0.36 0.03 272)';this.style.color='oklch(0.8 0.015 272)'">See our work</a>
      </div>
    </div>

    <div id="hero-stage" aria-hidden="true" style="position:relative; width:min(100%, 580px); aspect-ratio:1/1; justify-self:center;">
      <div style="position:absolute; inset:0; border-radius:50%; border:1px solid oklch(0.4 0.04 272 / 0.7); animation:swi-spin 60s linear infinite;">
        <div style="position:absolute; inset:0; transform:rotate(20deg);"><div style="position:absolute; top:0; left:50%; transform:translate(-50%,-50%);"><div style="transform:rotate(-20deg);"><div style="animation:swi-spin-r 60s linear infinite; padding:9px 14px; border-radius:999px; background:oklch(0.2 0.03 272); border:1px solid oklch(0.36 0.04 272); font-family:'JetBrains Mono'; font-size:12px; white-space:nowrap;">Websites</div></div></div></div>
        <div style="position:absolute; inset:0; transform:rotate(200deg);"><div style="position:absolute; top:0; left:50%; transform:translate(-50%,-50%);"><div style="transform:rotate(-200deg);"><div style="animation:swi-spin-r 60s linear infinite; padding:9px 14px; border-radius:999px; background:oklch(0.2 0.03 272); border:1px solid oklch(0.36 0.04 272); font-family:'JetBrains Mono'; font-size:12px; white-space:nowrap;">SaaS platforms</div></div></div></div>
      </div>
      <div style="position:absolute; inset:15%; border-radius:50%; border:1px dashed oklch(0.45 0.06 273 / 0.7); animation:swi-spin-r 44s linear infinite;">
        <div style="position:absolute; inset:0; transform:rotate(110deg);"><div style="position:absolute; top:0; left:50%; transform:translate(-50%,-50%);"><div style="transform:rotate(-110deg);"><div style="animation:swi-spin 44s linear infinite; padding:9px 14px; border-radius:999px; background:var(--acc, oklch(0.62 0.19 273)); color:#fff; font-family:'JetBrains Mono'; font-size:12px; white-space:nowrap;">Web apps</div></div></div></div>
        <div style="position:absolute; inset:0; transform:rotate(290deg);"><div style="position:absolute; top:0; left:50%; transform:translate(-50%,-50%);"><div style="transform:rotate(-290deg);"><div style="animation:swi-spin-r 44s linear infinite; padding:9px 14px; border-radius:999px; background:oklch(0.2 0.03 272); border:1px solid oklch(0.36 0.04 272); font-family:'JetBrains Mono'; font-size:12px; white-space:nowrap;">UI/UX</div></div></div></div>
      </div>
      <div style="position:absolute; inset:30%; border-radius:50%; border:1px solid oklch(0.45 0.06 273 / 0.6); animation:swi-spin 30s linear infinite;">
        <div style="position:absolute; inset:0; transform:rotate(60deg);"><div style="position:absolute; top:0; left:50%; transform:translate(-50%,-50%);"><div style="transform:rotate(-60deg);"><div style="animation:swi-spin-r 30s linear infinite; padding:7px 12px; border-radius:999px; background:oklch(0.2 0.03 272); border:1px solid oklch(0.36 0.04 272); font-family:'JetBrains Mono'; font-size:11px; white-space:nowrap;">APIs</div></div></div></div>
        <div style="position:absolute; inset:0; transform:rotate(240deg);"><div style="position:absolute; top:0; left:50%; transform:translate(-50%,-50%);"><div style="transform:rotate(-240deg);"><div style="animation:swi-spin-r 30s linear infinite; padding:7px 12px; border-radius:999px; background:oklch(0.2 0.03 272); border:1px solid oklch(0.36 0.04 272); font-family:'JetBrains Mono'; font-size:11px; white-space:nowrap;">Cloud</div></div></div></div>
      </div>
      <div id="hero-orb" style="position:absolute; inset:38%; border-radius:50%; background:radial-gradient(circle at 35% 30%, oklch(0.72 0.17 273), oklch(0.45 0.2 273) 60%, oklch(0.3 0.15 273)); box-shadow:0 0 80px 10px oklch(0.62 0.19 273 / 0.45); animation:swi-pulse 4s ease-in-out infinite;"></div>
      <div style="position:absolute; inset:38%; display:flex; flex-direction:column; align-items:center; justify-content:center; text-align:center; color:#fff;">
        <span style="font-family:'JetBrains Mono'; font-size:10px; letter-spacing:0.08em; text-transform:uppercase; opacity:0.85;">your product</span>
        <span id="hero-stage-text" style="font-family:'Bricolage Grotesque'; font-weight:600; font-size:clamp(16px,1.8vw,22px); letter-spacing:-0.02em; margin-top:4px;">Wireframe</span>
        <span id="hero-stage-dots" style="display:flex; gap:4px; margin-top:8px;">
          <span style="width:14px; height:3px; border-radius:2px; background:#fff;"></span>
          <span style="width:14px; height:3px; border-radius:2px; background:oklch(1 0 0 / 0.3);"></span>
          <span style="width:14px; height:3px; border-radius:2px; background:oklch(1 0 0 / 0.3);"></span>
          <span style="width:14px; height:3px; border-radius:2px; background:oklch(1 0 0 / 0.3);"></span>
        </span>
      </div>
    </div>
  </div>
</section>
