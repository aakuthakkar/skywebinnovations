<section id="engage" aria-labelledby="eng-h" style="background:oklch(0.17 0.025 272); border-block:1px solid oklch(0.26 0.025 272);">
  <div style="max-width:1320px; margin:0 auto; padding:clamp(100px,12vw,160px) clamp(20px,4vw,48px);">
    <div data-reveal style="display:grid; grid-template-columns:repeat(auto-fit, minmax(min(100%, 420px), 1fr)); gap:32px clamp(40px,6vw,96px); align-items:end; margin-bottom:clamp(56px,6vw,88px);">
      <div>
        <p style="margin:0 0 20px; font-family:'JetBrains Mono'; font-size:12px; letter-spacing:0.08em; text-transform:uppercase; color:oklch(0.72 0.02 272);">06 — Working With Us</p>
        <h2 id="eng-h" style="margin:0; font-family:'Bricolage Grotesque'; font-weight:600; font-size:clamp(40px,5.4vw,84px); line-height:0.96; letter-spacing:-0.045em; text-wrap:balance;">A Simple Way to Work <span style="font-family:'Instrument Serif'; font-style:italic; font-weight:400; color:oklch(0.8 0.11 273);">Together</span></h2>
      </div>
      <div style="display:grid; gap:16px; max-width:540px;">
        <p style="margin:0; font-family:'Bricolage Grotesque'; font-size:clamp(18px,1.5vw,21px); font-weight:500; line-height:1.45; letter-spacing:-0.01em; text-wrap:pretty;">We keep the process simple and transparent — with clear project pricing, straightforward agreements, and one dedicated point of contact from kickoff to launch.</p>
        <p style="margin:0; font-size:16px; line-height:1.65; color:oklch(0.76 0.015 272); text-wrap:pretty;">Whether you need a new website, a custom web application, or a complete digital product, we define the scope clearly and keep communication straightforward throughout the project.</p>
      </div>
    </div>
    <h3 style="margin:0 0 36px; font-family:'JetBrains Mono'; font-size:12px; letter-spacing:0.08em; text-transform:uppercase; color:oklch(0.72 0.02 272);">Our Process</h3>
    <ol id="process" style="list-style:none; margin:0 0 clamp(72px,8vw,112px); padding:0; display:grid; grid-template-columns:repeat(auto-fit, minmax(min(100%, 150px), 1fr)); gap:32px 0;">
      @foreach($processSteps as $step)
      <li data-reveal style="position:relative; padding:36px 16px 8px 0; border-top:1px solid oklch(0.34 0.03 272); display:flex; flex-direction:column; gap:14px;">
        <span style="position:absolute; top:-6px; left:0; width:11px; height:11px; border-radius:50%; background:var(--acc, oklch(0.62 0.19 273)); box-shadow:0 0 0 5px oklch(0.62 0.19 273 / 0.2);"></span>
        <span style="font-family:'Bricolage Grotesque'; font-size:clamp(56px,5vw,80px); font-weight:600; letter-spacing:-0.06em; line-height:0.85; color:transparent; -webkit-text-stroke:1px oklch(0.6 0.08 273);">{{ $step->number }}</span>
        <h4 style="margin:0; font-family:'Bricolage Grotesque'; font-size:22px; font-weight:600; letter-spacing:-0.02em;">{{ $step->title }}</h4>
        <p style="margin:0; font-size:15px; line-height:1.6; color:oklch(0.76 0.015 272); text-wrap:pretty;">{{ $step->description }}</p>
      </li>
      @endforeach
    </ol>
    <h3 style="margin:0 0 24px; font-family:'JetBrains Mono'; font-size:12px; letter-spacing:0.08em; text-transform:uppercase; color:oklch(0.72 0.02 272);">Engagement models</h3>
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(min(100%, 320px), 1fr)); gap:16px;">
      @foreach($engagementModels as $model)
      <article data-reveal style="border-radius:24px; padding:clamp(28px,3vw,40px); background:oklch(0.14 0.02 272); border:1px solid oklch(0.28 0.025 272); display:flex; flex-direction:column; gap:24px; min-height:460px;">
        @if($model->is_featured)
        <div style="display:flex; justify-content:space-between; align-items:center; font-family:'JetBrains Mono'; font-size:12px; color:oklch(0.45 0.02 272);"><span>model/{{ $model->slug }}</span><span style="padding:5px 10px; border-radius:999px; background:var(--acc, oklch(0.62 0.19 273)); color:#fff;">Most chosen</span></div>
        @else
        <span style="font-family:'JetBrains Mono'; font-size:12px; color:oklch(0.65 0.02 272);">model/{{ $model->slug }}</span>
        @endif
        <div>
          <h4 style="margin:0 0 12px; font-family:'Bricolage Grotesque'; font-size:clamp(26px,2.4vw,34px); font-weight:600; letter-spacing:-0.03em; line-height:1;">{{ $model->name }}</h4>
          <p style="margin:0; font-size:15px; line-height:1.55; color:oklch(0.76 0.015 272);">{{ $model->description }}</p>
        </div>
        <ul style="list-style:none; margin:0; padding:24px 0 0; border-top:1px solid {{ $model->is_featured ? 'oklch(0.86 0.01 272)' : 'oklch(0.3 0.025 272)' }}; display:grid; gap:12px;">
          @foreach($model->features as $feature)
          <li style="display:flex; gap:12px; font-size:15px;"><span style="font-family:'JetBrains Mono'; color:oklch(0.78 0.12 273);">+</span>{{ $feature }}</li>
          @endforeach
        </ul>
        <a href="#contact" style="margin-top:auto; display:flex; justify-content:space-between; padding:15px 20px; border-radius:999px; @if($model->is_featured) background:oklch(0.16 0.02 272); color:#fff; @else border:1px solid oklch(0.36 0.03 272); @endif font-size:15px; font-weight:500; white-space:nowrap;">{{ $model->link_text ?? 'Discuss this model' }} <span style="font-family:'JetBrains Mono';">→</span></a>
      </article>
      @endforeach
    </div>
  </div>
</section>
