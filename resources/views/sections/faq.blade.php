<section id="faq" aria-labelledby="faq-h" style="max-width:1320px; margin:0 auto; padding:clamp(100px,12vw,160px) clamp(20px,4vw,48px);">
  <div data-reveal style="margin-bottom:56px;">
    <p style="margin:0 0 20px; font-family:'JetBrains Mono'; font-size:12px; letter-spacing:0.08em; text-transform:uppercase; color:oklch(0.72 0.02 272);">07 — Questions</p>
    <h2 id="faq-h" style="margin:0; font-family:'Bricolage Grotesque'; font-weight:600; font-size:clamp(40px,5.4vw,84px); line-height:0.96; letter-spacing:-0.045em; text-wrap:balance;">Frequently asked <span style="font-family:'Instrument Serif'; font-style:italic; font-weight:400; color:oklch(0.8 0.11 273);">questions</span></h2>
  </div>
  <div style="border-top:1px solid oklch(0.28 0.025 272);">
    @foreach($faqItems as $item)
    <article style="padding:clamp(20px,2.4vw,32px) 0; border-bottom:1px solid oklch(0.28 0.025 272);">
      <button onclick="toggleFaq(this)" style="cursor:pointer; display:flex; justify-content:space-between; align-items:center; gap:16px; width:100%; background:none; border:none; color:oklch(0.96 0.005 272); font-family:'Bricolage Grotesque'; font-size:clamp(20px,2vw,26px); font-weight:500; letter-spacing:-0.02em; text-align:left; padding:0;">
        <span>{{ $item->question }}</span>
        <span class="faq-icon" style="font-family:'JetBrains Mono'; font-size:18px; color:oklch(0.78 0.12 273); flex-shrink:0; transition:transform .3s;">+</span>
      </button>
      <div class="faq-answer" style="max-height:0; overflow:hidden; transition:max-height .4s ease, padding .4s ease;">
        <p style="margin:16px 0 0; font-size:16px; line-height:1.65; color:oklch(0.78 0.015 272); text-wrap:pretty;">{{ $item->answer }}</p>
      </div>
    </article>
    @endforeach
  </div>
</section>
