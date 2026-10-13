<section id="work" aria-labelledby="work-h" style="padding:clamp(100px,12vw,160px) 0;">
  <div data-reveal style="max-width:1320px; margin:0 auto 48px; padding:0 clamp(20px,4vw,48px); display:flex; flex-wrap:wrap; justify-content:space-between; align-items:flex-end; gap:24px;">
    <div>
      <p style="margin:0 0 20px; font-family:'JetBrains Mono'; font-size:12px; letter-spacing:0.08em; text-transform:uppercase; color:oklch(0.72 0.02 272);">05 — Selected work</p>
      <h2 id="work-h" style="margin:0; font-family:'Bricolage Grotesque'; font-weight:600; font-size:clamp(40px,6vw,92px); line-height:0.95; letter-spacing:-0.045em;">Products in <span style="font-family:'Instrument Serif'; font-style:italic; font-weight:400; color:oklch(0.8 0.11 273);">orbit</span></h2>
    </div>
    <div style="display:flex; gap:10px;">
      <button onclick="scrollWork(-1)" aria-label="Previous project" style="width:52px; height:52px; border-radius:50%; border:1px solid oklch(0.36 0.03 272); background:transparent; color:oklch(0.96 0.005 272); cursor:pointer; font-size:18px;">←</button>
      <button onclick="scrollWork(1)" aria-label="Next project" style="width:52px; height:52px; border-radius:50%; border:1px solid oklch(0.36 0.03 272); background:transparent; color:oklch(0.96 0.005 272); cursor:pointer; font-size:18px;">→</button>
    </div>
  </div>
  <div id="work-carousel" style="display:flex; gap:clamp(16px,2vw,28px); overflow-x:auto; scroll-snap-type:x mandatory; scrollbar-width:none; padding:0 max(clamp(20px,4vw,48px), calc((100vw - 1320px) / 2 + 48px)); scroll-padding:0 max(clamp(20px,4vw,48px), calc((100vw - 1320px) / 2 + 48px));">
    @foreach($projects as $project)
    <article style="flex:none; width:min(82vw, 680px); scroll-snap-align:start; display:flex; flex-direction:column; gap:22px;">
      <a href="#contact" aria-label="{{ $project->title }}" style="position:relative; display:block; aspect-ratio:4/3; border-radius:24px; overflow:hidden; border:1px solid oklch(0.3 0.03 272); background:linear-gradient(160deg, {{ $project->tint ?? 'oklch(0.45 0.15 273 / 0.55)' }}, transparent 70%), repeating-linear-gradient(135deg, oklch(0.2 0.025 272) 0 12px, oklch(0.17 0.022 272) 12px 24px); transition:transform .5s;" onmouseover="this.style.transform='scale(0.985)'" onmouseout="this.style.transform=''">
        <span style="position:absolute; left:22px; top:22px; display:flex; gap:8px;"><span style="padding:6px 11px; border-radius:999px; background:oklch(0.96 0.005 272); color:oklch(0.16 0.02 272); font-family:'JetBrains Mono'; font-size:11px;">{{ $project->category }}</span><span style="padding:6px 11px; border-radius:999px; border:1px solid oklch(0.45 0.03 272); font-family:'JetBrains Mono'; font-size:11px; color:oklch(0.9 0.01 272);">{{ str_pad($loop->index + 1, 2, '0', STR_PAD_LEFT) }} / 0{{ $projects->count() }}</span></span>
        <span style="position:absolute; inset:0; display:grid; place-items:center; font-family:'JetBrains Mono'; font-size:12px; color:oklch(0.7 0.02 272);"><span>[ {{ $project->shot_label ?? 'product screenshot' }} ]</span></span>
        <span style="position:absolute; right:22px; bottom:22px; width:54px; height:54px; border-radius:50%; background:var(--acc, oklch(0.62 0.19 273)); color:#fff; display:grid; place-items:center; font-size:20px;">↗</span>
      </a>
      <div style="display:flex; justify-content:space-between; gap:20px; flex-wrap:wrap;">
        <div style="min-width:0; flex:1 1 300px;">
          <h3 style="margin:0 0 8px; font-family:'Bricolage Grotesque'; font-size:clamp(24px,2.4vw,32px); font-weight:600; letter-spacing:-0.03em;">{{ $project->title }}</h3>
          <p style="margin:0; font-size:15px; line-height:1.55; color:oklch(0.76 0.015 272); text-wrap:pretty;">{{ $project->description }}</p>
        </div>
        <div style="display:flex; flex-wrap:wrap; gap:6px; align-content:flex-start; max-width:240px;">
          @foreach(($project->tags ?? []) as $tag)
            <span style="padding:5px 10px; border-radius:6px; background:oklch(0.22 0.025 272); font-family:'JetBrains Mono'; font-size:11px; color:oklch(0.85 0.01 272);">{{ $tag }}</span>
          @endforeach
        </div>
      </div>
    </article>
    @endforeach
  </div>
</section>
