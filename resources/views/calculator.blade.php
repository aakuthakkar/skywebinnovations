@extends('layouts.app')

@php
  $ink = 'oklch(0.96 0.005 272)';
  $muted = 'oklch(0.72 0.02 272)';
  $line = 'oklch(0.3 0.025 272)';
  $accent = 'oklch(0.8 0.11 273)';
  $card = 'oklch(0.18 0.025 272 / 0.9)';
@endphp

@push('meta')
  {{-- FAQ structured data so the calculator page can win rich results --}}
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
      {"@type":"Question","name":"How much does a website cost?","acceptedAnswer":{"@type":"Answer","text":"A simple business website typically costs between $1,500 and $5,000. A custom website with advanced features ranges from $5,000 to $15,000, and complex web applications or SaaS platforms start around $15,000 and up. This calculator gives you an instant estimate based on your specific requirements."}},
      {"@type":"Question","name":"How long does it take to build a website?","acceptedAnswer":{"@type":"Answer","text":"A basic website takes 2 to 4 weeks. A custom website with multiple pages and integrations takes 4 to 8 weeks. Web applications and SaaS products usually take 8 to 16 weeks depending on complexity."}},
      {"@type":"Question","name":"Is this estimate binding?","acceptedAnswer":{"@type":"Answer","text":"No. The calculator provides a ballpark range to help you plan and budget. A final quote depends on a detailed discussion of your requirements, design preferences, and integrations. Contact us for a precise, no-obligation estimate."}},
      {"@type":"Question","name":"What factors affect the cost of a website?","acceptedAnswer":{"@type":"Answer","text":"Key factors include the type of project, number of pages or screens, design complexity, custom functionality, third-party integrations, content creation, SEO requirements, and ongoing maintenance."}}
    ]
  }
  </script>
@endpush

@section('body')
<header>
  @include('partials.header')
</header>

<main id="top">

  {{-- ============ HERO + CALCULATOR ============ --}}
  <section style="position:relative; padding:clamp(90px,11vw,130px) clamp(20px,4vw,48px) clamp(60px,8vw,90px); background:radial-gradient(70% 60% at 15% 0%, oklch(0.62 0.19 273 / 0.25), transparent 70%);">
    <div style="max-width:1320px; margin:0 auto;">

      <div style="max-width:760px; margin:0 auto; text-align:center; margin-bottom:clamp(40px,5vw,64px);">
        <p style="margin:0 0 20px; font-family:'JetBrains Mono'; font-size:12px; letter-spacing:0.08em; text-transform:uppercase; color:{{ $accent }};">Free tool — no signup required</p>
        <h1 style="margin:0; font-family:'Bricolage Grotesque'; font-weight:600; font-size:clamp(38px,6vw,76px); line-height:1.02; letter-spacing:-0.04em; text-wrap:balance;">
          How much will your <span style="font-family:'Instrument Serif'; font-style:italic; font-weight:400; letter-spacing:-0.025em; color:{{ $accent }};">project</span> cost?
        </h1>
        <p style="margin:24px auto 0; max-width:560px; font-size:clamp(16px,1.4vw,19px); line-height:1.6; color:{{ $muted }};">
          Answer a few questions and get an instant, transparent budget range — before you talk to anyone.
        </p>
      </div>

      {{-- Calculator card --}}
      <div id="calculator" style="max-width:1080px; margin:0 auto; display:grid; grid-template-columns:1.4fr 1fr; gap:0; border-radius:28px; overflow:hidden; border:1px solid {{ $line }}; background:{{ $card }}; backdrop-filter:blur(12px); box-shadow:0 30px 80px -20px oklch(0.1 0.03 272 / 0.6);">

        {{-- LEFT: questions --}}
        <div style="padding:clamp(28px,3.5vw,48px);">

          {{-- Q1 Project type --}}
          <div class="calc-step" data-step="1" style="margin-bottom:36px;">
            <label style="display:block; font-family:'JetBrains Mono'; font-size:11px; letter-spacing:0.08em; text-transform:uppercase; color:{{ $accent }}; margin-bottom:14px;">01 — What are you building?</label>
            <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(140px,1fr)); gap:10px;" id="type-options">
              {{-- populated by JS for consistent markup --}}
            </div>
          </div>

          {{-- Q2 Size/scope --}}
          <div class="calc-step" data-step="2" style="margin-bottom:36px;">
            <label style="display:block; font-family:'JetBrains Mono'; font-size:11px; letter-spacing:0.08em; text-transform:uppercase; color:{{ $accent }}; margin-bottom:14px;">02 — How big is it?</label>
            <div id="size-options" style="display:grid; grid-template-columns:repeat(auto-fit,minmax(140px,1fr)); gap:10px;"></div>
          </div>

          {{-- Q3 Design --}}
          <div class="calc-step" data-step="3" style="margin-bottom:36px;">
            <label style="display:block; font-family:'JetBrains Mono'; font-size:11px; letter-spacing:0.08em; text-transform:uppercase; color:{{ $accent }}; margin-bottom:14px;">03 — Design needs</label>
            <div id="design-options" style="display:grid; grid-template-columns:repeat(auto-fit,minmax(140px,1fr)); gap:10px;"></div>
          </div>

          {{-- Q4 Features (multi-select) --}}
          <div class="calc-step" data-step="4" style="margin-bottom:36px;">
            <label style="display:block; font-family:'JetBrains Mono'; font-size:11px; letter-spacing:0.08em; text-transform:uppercase; color:{{ $accent }}; margin-bottom:14px;">04 — Which features? <span style="text-transform:none; letter-spacing:0; color:{{ $muted }};">(select all that apply)</span></label>
            <div id="feature-options" style="display:flex; flex-wrap:wrap; gap:10px;"></div>
          </div>

          {{-- Q5 Timeline --}}
          <div class="calc-step" data-step="5">
            <label style="display:block; font-family:'JetBrains Mono'; font-size:11px; letter-spacing:0.08em; text-transform:uppercase; color:{{ $accent }}; margin-bottom:14px;">05 — Timeline</label>
            <div id="timeline-options" style="display:grid; grid-template-columns:repeat(auto-fit,minmax(140px,1fr)); gap:10px;"></div>
          </div>

        </div>

        {{-- RIGHT: live estimate --}}
        <div style="padding:clamp(28px,3.5vw,48px); background:oklch(0.15 0.03 272 / 0.6); border-left:1px solid {{ $line }}; display:flex; flex-direction:column;">
          <p style="margin:0 0 6px; font-family:'JetBrains Mono'; font-size:11px; letter-spacing:0.08em; text-transform:uppercase; color:{{ $muted }};">Estimated cost</p>

          <div style="margin:8px 0 4px;">
            <span id="cost-low" style="font-family:'Bricolage Grotesque'; font-weight:600; font-size:clamp(34px,4vw,52px); letter-spacing:-0.03em; line-height:1;">$0</span>
            <span style="color:{{ $muted }}; font-size:clamp(20px,2vw,28px); margin:0 6px;">–</span>
            <span id="cost-high" style="font-family:'Bricolage Grotesque'; font-weight:600; font-size:clamp(34px,4vw,52px); letter-spacing:-0.03em; line-height:1; color:{{ $accent }};">$0</span>
          </div>
          <p style="margin:0 0 24px; font-size:13px; color:{{ $muted }};">USD · typical range for your requirements</p>

          {{-- Progress bar --}}
          <div style="margin-bottom:24px;">
            <div style="display:flex; justify-content:space-between; margin-bottom:8px; font-size:12px; color:{{ $muted }};">
              <span>Your estimate</span>
              <span id="tier-label">—</span>
            </div>
            <div style="height:8px; border-radius:999px; background:oklch(0.28 0.03 272); overflow:hidden;">
              <div id="cost-bar" style="height:100%; width:0%; border-radius:999px; background:linear-gradient(90deg, oklch(0.8 0.11 273), oklch(0.72 0.16 300)); transition:width .4s ease;"></div>
            </div>
          </div>

          {{-- Summary --}}
          <div id="summary" style="flex:1; display:flex; flex-direction:column; gap:12px; padding-top:20px; border-top:1px solid {{ $line }}; font-size:14px;">
            <p style="margin:0; color:{{ $muted }};">Select your options to see a live estimate.</p>
          </div>

          {{-- Timeline note --}}
          <div id="timeline-note" style="margin-top:20px; padding:14px 16px; border-radius:14px; background:oklch(0.62 0.19 273 / 0.12); border:1px solid oklch(0.62 0.19 273 / 0.3); font-size:13px; line-height:1.5; color:{{ $ink }}; display:none;">
            <strong style="font-family:'JetBrains Mono'; font-size:11px; letter-spacing:0.06em; text-transform:uppercase; color:{{ $accent }}; display:block; margin-bottom:4px;">Estimated timeline</strong>
            <span id="timeline-text">—</span>
          </div>

          {{-- CTA --}}
          <a href="#calculator-cta" id="calc-cta-btn" style="margin-top:24px; display:block; text-align:center; padding:16px; border-radius:14px; background:oklch(0.62 0.19 273); color:#fff; font-weight:600; font-size:15px; text-decoration:none; transition:transform .2s, opacity .2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform=''">
            Get my exact quote →
          </a>
          <p style="margin:12px 0 0; text-align:center; font-size:12px; color:{{ $muted }};">No obligation · Reply within 1 business day</p>
        </div>

      </div>

      <p style="margin:20px auto 0; max-width:720px; text-align:center; font-size:12px; color:{{ $muted }}; line-height:1.6;">
        This calculator provides a ballpark estimate for planning purposes. Your final quote depends on a detailed review of your requirements. We believe in transparent pricing — no hidden surprises.
      </p>
    </div>
  </section>

  {{-- ============ CTA + LEAD CAPTURE ============ --}}
  <section id="calculator-cta" style="padding:clamp(70px,9vw,120px) clamp(20px,4vw,48px); background:oklch(0.12 0.02 272); border-top:1px solid {{ $line }};">
    <div style="max-width:820px; margin:0 auto;">
      <div style="text-align:center; margin-bottom:48px;">
        <p style="margin:0 0 16px; font-family:'JetBrains Mono'; font-size:12px; letter-spacing:0.08em; text-transform:uppercase; color:{{ $accent }};">Lock in your number</p>
        <h2 style="margin:0; font-family:'Bricolage Grotesque'; font-weight:600; font-size:clamp(32px,5vw,60px); line-height:1.02; letter-spacing:-0.04em; text-wrap:balance;">
          Get an exact quote in <span style="font-family:'Instrument Serif'; font-style:italic; font-weight:400; letter-spacing:-0.025em; color:{{ $accent }};">one business day.</span>
        </h2>
        <p style="margin:20px auto 0; max-width:520px; font-size:17px; line-height:1.6; color:{{ $muted }};">
          Your estimate carries over automatically. Just tell us where to send the detailed breakdown.
        </p>
      </div>

      <div style="border-radius:24px; background:{{ $card }}; border:1px solid {{ $line }}; padding:clamp(24px,3vw,40px);">
        <form id="calc-quote-form" method="POST" action="{{ route('contact.submit') }}" style="display:flex; flex-direction:column; gap:20px;">
          @csrf
          {{-- carry the estimate into the inquiry --}}
          <input type="hidden" name="project_type" id="hp-project-type" value="Website">
          <input type="hidden" name="estimate_summary" id="estimate-summary" value="">
          <input type="hidden" name="estimate_low" id="estimate-low" value="">
          <input type="hidden" name="estimate_high" id="estimate-high" value="">
          {{-- honeypot --}}
          <div style="position:absolute; left:-9999px; width:1px; height:1px; overflow:hidden;" aria-hidden="true">
            <label>Leave blank<input type="text" name="website_url" value="" tabindex="-1" autocomplete="off"></label>
            <input type="hidden" name="honeypot_time" value="{{ time() }}">
          </div>

          {{-- recap of their selection --}}
          <div id="quote-recap" style="display:none; padding:16px 18px; border-radius:14px; background:oklch(0.62 0.19 273 / 0.1); border:1px solid oklch(0.62 0.19 273 / 0.28); font-size:14px; line-height:1.6;">
            <strong style="font-family:'JetBrains Mono'; font-size:11px; letter-spacing:0.06em; text-transform:uppercase; color:{{ $accent }}; display:block; margin-bottom:6px;">Your estimate</strong>
            <span id="quote-recap-text">—</span>
          </div>

          <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:14px;">
            <div>
              <label style="display:block; margin-bottom:6px; font-size:13px; color:oklch(0.75 0.015 272);">Name <span style="color:oklch(0.72 0.17 25);">*</span></label>
              <input required name="name" autocomplete="name" placeholder="Your name" style="padding:14px; border-radius:12px; border:1px solid oklch(0.34 0.03 272); background:oklch(0.14 0.02 272); font-size:15px; color:{{ $ink }}; outline:none; width:100%;">
            </div>
            <div>
              <label style="display:block; margin-bottom:6px; font-size:13px; color:oklch(0.75 0.015 272);">Email <span style="color:oklch(0.72 0.17 25);">*</span></label>
              <input required type="email" name="email" autocomplete="email" placeholder="you@company.com" style="padding:14px; border-radius:12px; border:1px solid oklch(0.34 0.03 272); background:oklch(0.14 0.02 272); font-size:15px; color:{{ $ink }}; outline:none; width:100%;">
            </div>
          </div>

          <div>
            <label style="display:block; margin-bottom:6px; font-size:13px; color:oklch(0.75 0.015 272);">Anything else we should know? <span style="color:{{ $muted }};">(optional)</span></label>
            <textarea name="message" rows="4" placeholder="Tell us about your project…" style="padding:14px; border-radius:12px; border:1px solid oklch(0.34 0.03 272); background:oklch(0.14 0.02 272); font-size:15px; color:{{ $ink }}; outline:none; width:100%; resize:vertical;"></textarea>
          </div>

          <button type="submit" style="padding:16px; border:0; border-radius:14px; background:oklch(0.62 0.19 273); color:#fff; font-weight:600; font-size:15px; cursor:pointer; transition:transform .2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform=''">
            Send my request
          </button>
        </form>
      </div>
    </div>
  </section>

  {{-- ============ FAQ ============ --}}
  <section style="padding:clamp(70px,9vw,120px) clamp(20px,4vw,48px);">
    <div style="max-width:820px; margin:0 auto;">
      <p style="margin:0 0 28px; font-family:'JetBrains Mono'; font-size:12px; letter-spacing:0.08em; text-transform:uppercase; color:{{ $accent }};">Common questions</p>
      <h2 style="margin:0 0 40px; font-family:'Bricolage Grotesque'; font-weight:600; font-size:clamp(28px,4vw,48px); line-height:1.05; letter-spacing:-0.035em;">Before you build</h2>

      <div style="display:flex; flex-direction:column; gap:0; border-top:1px solid {{ $line }};">
        @foreach([
          ['How much does a website cost?', 'A simple business website typically costs between $1,500 and $5,000. A custom website with advanced features ranges from $5,000 to $15,000. Complex web applications and SaaS platforms start around $15,000 and up. This calculator gives you an instant range based on your specific needs.'],
          ['How long does it take to build?', 'A basic website takes 2–4 weeks. A custom site with multiple pages and integrations takes 4–8 weeks. Web applications and SaaS products usually take 8–16 weeks depending on complexity.'],
          ['Is this estimate binding?', 'No — it is a ballpark range to help you plan and budget. A final quote depends on a detailed discussion of your requirements, design preferences, and integrations. We provide precise, no-obligation estimates within one business day.'],
          ['What factors affect the cost?', 'The type of project, number of pages or screens, design complexity, custom functionality, third-party integrations, content creation, SEO, and ongoing maintenance all influence the final cost.'],
        ] as $i => [$q, $a])
        <details style="border-bottom:1px solid {{ $line }}; padding:24px 0;" @if($i === 0) open @endif>
          <summary style="cursor:pointer; list-style:none; display:flex; justify-content:space-between; align-items:center; gap:16px; font-family:'Bricolage Grotesque'; font-weight:500; font-size:clamp(17px,1.8vw,21px); letter-spacing:-0.01em; color:{{ $ink }};">
            {{ $q }}
            <span style="color:{{ $accent }}; font-size:24px; flex-shrink:0; transition:transform .2s;">+</span>
          </summary>
          <p style="margin:16px 0 0; max-width:680px; font-size:16px; line-height:1.7; color:{{ $muted }};">{{ $a }}</p>
        </details>
        @endforeach
      </div>
    </div>
  </section>

</main>

@include('partials.footer')

@endsection

@push('scripts')
<script>
(function () {
  // ---- Pricing model (USD) ----
  var BASE = {
    'website':  { label: 'Website',          low: 1800,  high: 4500  },
    'webapp':   { label: 'Web application',  low: 6000,  high: 16000 },
    'saas':     { label: 'SaaS / MVP',       low: 9000,  high: 25000 },
    'ecommerce':{ label: 'E-commerce store', low: 3500,  high: 12000 },
    'mobile':   { label: 'Mobile app',       low: 7000,  high: 20000 },
    'design':   { label: 'UI/UX design',     low: 2000,  high: 7000  }
  };
  var SIZE = {   // multiplier
    'small':  { label: 'Small / simple',    mult: 1.0 },
    'medium': { label: 'Medium',            mult: 1.5 },
    'large':  { label: 'Large / complex',   mult: 2.3 }
  };
  var DESIGN = {
    'template':  { label: 'Template-based',        mult: 1.0 },
    'custom':    { label: 'Custom design',         mult: 1.3 },
    'premium':   { label: 'Premium / brand-led',   mult: 1.6 }
  };
  var FEATURES = {   // flat additions
    'auth':      { label: 'User accounts / login',  low: 900,  high: 2200 },
    'payments':  { label: 'Payments / billing',     low: 1200, high: 3000 },
    'admin':     { label: 'Admin dashboard',        low: 1500, high: 4000 },
    'api':       { label: 'Third-party / API',      low: 900,  high: 2500 },
    'cms':       { label: 'Content management',     low: 800,  high: 1800 },
    'search':    { label: 'Search & filters',       low: 600,  high: 1600 },
    'chat':      { label: 'Chat / messaging',       low: 1000, high: 2600 },
    'analytics': { label: 'Analytics & reports',    low: 700,  high: 1800 },
    'i18n':      { label: 'Multi-language',         low: 800,  high: 2000 },
    'seo':       { label: 'Advanced SEO package',   low: 700,  high: 1800 }
  };
  var TIMELINE = {
    'flexible':  { label: 'Flexible (3+ months)',  mult: 1.0,  note: '3+ months — best value, lowest cost' },
    'standard':  { label: 'Standard (4–8 weeks)',  mult: 1.1,  note: '4–8 weeks' },
    'fast':      { label: 'Fast (2–4 weeks)',      mult: 1.3,  note: '2–4 weeks — priority scheduling' },
    'rush':      { label: 'Rush (ASAP)',           mult: 1.6,  note: 'ASAP — expedited, premium rate' }
  };

  var state = { type: null, size: null, design: null, timeline: null, features: {} };

  // ---- Build option buttons ----
  function chip(group, key, obj, multi) {
    var btn = document.createElement('button');
    btn.type = 'button';
    btn.dataset.group = group;
    btn.dataset.key = key;
    btn.textContent = obj.label;
    var base = 'cursor:pointer; padding:11px 14px; border-radius:12px; border:1px solid ' + (typeof INK_LINE !== 'undefined' ? INK_LINE : 'oklch(0.34 0.03 272)') + '; background:transparent; color:' + (typeof INK_TEXT !== 'undefined' ? INK_TEXT : 'oklch(0.96 0.005 272)') + '; font-size:14px; text-align:left; transition:all .18s; font-family:inherit;';
    btn.setAttribute('style', base);
    btn.addEventListener('click', function () {
      if (multi) {
        if (state.features[key]) { delete state.features[key]; btn.setAttribute('style', base); }
        else { state.features[key] = true; btn.setAttribute('style', base + 'border-color:oklch(0.8 0.11 273); background:oklch(0.62 0.19 273 / 0.18); color:oklch(0.9 0.05 273);'); }
      } else {
        state[group] = (state[group] === key) ? null : key;
        // reset siblings in this group
        var sibs = btn.parentElement.querySelectorAll('button');
        sibs.forEach(function (s) { s.setAttribute('style', base); });
        if (state[group] === key) {
          btn.setAttribute('style', base + 'border-color:oklch(0.8 0.11 273); background:oklch(0.62 0.19 273 / 0.18); color:oklch(0.9 0.05 273);');
        }
      }
      render();
    });
    return btn;
  }

  function build(containerId, map, multi) {
    var c = document.getElementById(containerId);
    if (!c) return;
    Object.keys(map).forEach(function (k) { c.appendChild(chip(containerId.replace('-options',''), k, map[k], multi)); });
  }

  build('type-options', BASE);
  build('size-options', SIZE);
  build('design-options', DESIGN);
  build('timeline-options', TIMELINE);
  build('feature-options', FEATURES, true);

  // ---- Formatting ----
  function money(n) {
    return '$' + Math.round(n / 100) * 100;
  }

  // ---- Render live estimate ----
  function render() {
    var hasType = !!state.type;
    var low = 0, high = 0;
    var summaryParts = [];

    if (hasType) {
      var b = BASE[state.type];
      var sizeMult = state.size ? SIZE[state.size].mult : 1.0;
      var designMult = state.design ? DESIGN[state.design].mult : 1.0;
      var timeMult = state.timeline ? TIMELINE[state.timeline].mult : 1.0;

      var baseLow = b.low * sizeMult * designMult;
      var baseHigh = b.high * sizeMult * designMult;

      var featLow = 0, featHigh = 0;
      Object.keys(state.features).forEach(function (k) {
        featLow += FEATURES[k].low; featHigh += FEATURES[k].high;
      });

      low = (baseLow + featLow) * timeMult;
      high = (baseHigh + featHigh) * timeMult;

      summaryParts.push(b.label);
      if (state.size) summaryParts.push(SIZE[state.size].label.toLowerCase());
      if (state.design) summaryParts.push(DESIGN[state.design].label.toLowerCase());
      var featLabels = Object.keys(state.features).map(function (k) { return FEATURES[k].label; });
      if (featLabels.length) summaryParts.push('+' + featLabels.length + ' feature' + (featLabels.length > 1 ? 's' : ''));
    }

    // numbers
    document.getElementById('cost-low').textContent = money(low);
    document.getElementById('cost-high').textContent = money(high);

    // bar + tier (scale $0..$60000)
    var pct = hasType ? Math.min(100, (high / 60000) * 100) : 0;
    document.getElementById('cost-bar').style.width = pct + '%';
    var tier = '—';
    if (hasType) {
      if (high < 5000) tier = 'Starter';
      else if (high < 15000) tier = 'Growth';
      else if (high < 30000) tier = 'Advanced';
      else tier = 'Enterprise';
    }
    document.getElementById('tier-label').textContent = tier;

    // summary list
    var s = document.getElementById('summary');
    if (!hasType) {
      s.innerHTML = '<p style="margin:0; color:oklch(0.72 0.02 272);">Select your options to see a live estimate.</p>';
    } else {
      var rows = [
        ['Project', BASE[state.type].label],
        ['Scope', state.size ? SIZE[state.size].label : '—'],
        ['Design', state.design ? DESIGN[state.design].label : '—'],
        ['Timeline', state.timeline ? TIMELINE[state.timeline].label : '—']
      ];
      var featLabels = Object.keys(state.features).map(function (k) { return FEATURES[k].label; });
      var html = rows.map(function (r) {
        return '<div style="display:flex; justify-content:space-between; gap:12px;"><span style="color:oklch(0.72 0.02 272);">' + r[0] + '</span><span style="text-align:right;">' + r[1] + '</span></div>';
      }).join('');
      if (featLabels.length) {
        html += '<div style="margin-top:4px;"><div style="color:oklch(0.72 0.02 272); margin-bottom:6px;">Features</div><div style="display:flex; flex-wrap:wrap; gap:6px;">' +
          featLabels.map(function (f) { return '<span style="padding:4px 10px; border-radius:999px; background:oklch(0.62 0.19 273 / 0.16); border:1px solid oklch(0.62 0.19 273 / 0.3); font-size:12px;">' + f + '</span>'; }).join('') +
          '</div></div>';
      }
      s.innerHTML = html;
    }

    // timeline note
    var tn = document.getElementById('timeline-note');
    var tt = document.getElementById('timeline-text');
    if (state.timeline) {
      tn.style.display = 'block';
      tt.textContent = TIMELINE[state.timeline].note;
    } else {
      tn.style.display = 'none';
    }

    // carry into the quote form
    document.getElementById('hp-project-type').value = hasType ? BASE[state.type].label : 'Website';
    document.getElementById('estimate-summary').value = summaryParts.join(', ');
    document.getElementById('estimate-low').value = hasType ? money(low) : '';
    document.getElementById('estimate-high').value = hasType ? money(high) : '';

    var recap = document.getElementById('quote-recap');
    var recapText = document.getElementById('quote-recap-text');
    if (hasType) {
      recap.style.display = 'block';
      recapText.textContent = BASE[state.type].label + ' — estimated ' + money(low) + ' to ' + money(high) + (summaryParts.length > 1 ? ' (' + summaryParts.slice(1).join(', ') + ')' : '') + '.';
    } else {
      recap.style.display = 'none';
    }
  }

  render();
})();
</script>
@endpush
