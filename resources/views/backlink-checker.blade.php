@extends('layouts.app')

@php
  $ink = 'oklch(0.96 0.005 272)';
  $muted = 'oklch(0.72 0.02 272)';
  $line = 'oklch(0.3 0.025 272)';
  $accent = 'oklch(0.8 0.11 273)';
  $card = 'oklch(0.18 0.025 272 / 0.9)';
@endphp

@push('meta')
  <title>Free Backlink Checker — See Who Links to Any Domain | Sky Web Innovations</title>
  <meta name="description" content="Free backlink checker. Enter any domain to see the websites linking to it, anchor text, and referring domains. No signup required.">
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
      {"@type":"Question","name":"What is a backlink checker?","acceptedAnswer":{"@type":"Answer","text":"A backlink checker shows which websites link to a domain. Enter a domain and it lists the referring pages, the anchor text they use, and the authority of each linking site."}},
      {"@type":"Question","name":"Is this backlink checker free?","acceptedAnswer":{"@type":"Answer","text":"Yes. Enter any domain and see the linking sites with anchor text and referring domain counts. No account or signup is required."}},
      {"@type":"Question","name":"Why are backlinks important for SEO?","acceptedAnswer":{"@type":"Answer","text":"Backlinks are one of Google's strongest ranking signals. Links from reputable, relevant sites tell search engines your site is trustworthy, which helps you rank higher."}},
      {"@type":"Question","name":"Can I check my competitors' backlinks?","acceptedAnswer":{"@type":"Answer","text":"Yes. Enter any domain to see who links to it. This helps you understand a competitor's link profile and find link-building opportunities for your own site."}}
    ]
  }
  </script>
@endpush

@section('body')
<header>
  @include('partials.header')
</header>

<main id="top">

  {{-- ============ HERO + SEARCH ============ --}}
  <section style="position:relative; padding:clamp(90px,11vw,130px) clamp(20px,4vw,48px) clamp(60px,8vw,90px); background:radial-gradient(70% 60% at 15% 0%, oklch(0.62 0.19 273 / 0.25), transparent 70%);">
    <div style="max-width:1320px; margin:0 auto;">

      <div style="max-width:760px; margin:0 auto; text-align:center; margin-bottom:clamp(40px,5vw,56px);">
        <p style="margin:0 0 20px; font-family:'JetBrains Mono'; font-size:12px; letter-spacing:0.08em; text-transform:uppercase; color:{{ $accent }};">Free tool — no signup required</p>
        <h1 style="margin:0; font-family:'Bricolage Grotesque'; font-weight:600; font-size:clamp(38px,6vw,72px); line-height:1.02; letter-spacing:-0.04em; text-wrap:balance;">
          Who <span style="font-family:'Instrument Serif'; font-style:italic; font-weight:400; letter-spacing:-0.025em; color:{{ $accent }};">links</span> to you?
        </h1>
        <p style="margin:24px auto 0; max-width:560px; font-size:clamp(16px,1.4vw,19px); line-height:1.6; color:{{ $muted }};">
          Enter any domain to see every website pointing to it — the referring page, the anchor text, and the authority behind each link.
        </p>
      </div>

      {{-- Search card --}}
      <div style="max-width:720px; margin:0 auto;">
        <form method="GET" action="{{ route('backlink-checker.report') }}"
              style="display:flex; gap:10px; flex-wrap:wrap; padding:10px; border-radius:18px; border:1px solid {{ $line }}; background:{{ $card }}; backdrop-filter:blur(12px); box-shadow:0 30px 80px -20px oklch(0.1 0.03 272 / 0.6);">
          <input type="text" name="domain" value="{{ old('domain', request('domain')) }}"
                 placeholder="example.com"
                 aria-label="Domain to check"
                 style="flex:1 1 260px; min-width:0; padding:16px 18px; border-radius:12px; border:1px solid {{ $line }}; background:oklch(0.14 0.02 272); color:{{ $ink }}; font-size:16px; font-family:'JetBrains Mono';">
          <button type="submit" class="btn btn-primary" style="padding:16px 28px; font-size:15px; border-radius:12px;">Check Backlinks</button>
        </form>

        @error('domain')
          <p style="margin:12px 4px 0; color:oklch(0.72 0.14 25); font-size:14px;">{{ $message }}</p>
        @enderror

        <p style="margin:14px 4px 0; font-size:13px; color:{{ $muted }}; text-align:center;">
          Try it on your own site — or a competitor's — to see where their authority comes from.
        </p>
      </div>

    </div>
  </section>

  {{-- ============ WHAT YOU'LL SEE ============ --}}
  <section style="padding:clamp(40px,6vw,72px) clamp(20px,4vw,48px);">
    <div style="max-width:1080px; margin:0 auto;">
      <h2 style="font-family:'Bricolage Grotesque'; font-weight:600; font-size:clamp(24px,3vw,34px); letter-spacing:-0.03em; margin:0 0 8px;">What you'll get</h2>
      <p style="color:{{ $muted }}; margin:0 0 36px; font-size:16px; line-height:1.6;">A complete picture of a domain's link profile.</p>

      <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:16px;">
        @foreach ([
          ['Referring pages', 'The exact URLs that link out, so you can see the context of every link.'],
          ['Anchor text', 'The words each site uses to link — a signal of how they position you.'],
          ['Referring domains', 'How many unique sites link in, the metric that actually moves rankings.'],
          ['Domain authority', 'The strength of each linking site, so you can spot your best links.'],
        ] as [$title, $desc])
          <div style="padding:24px; border-radius:16px; border:1px solid {{ $line }}; background:{{ $card }};">
            <h3 style="font-family:'Bricolage Grotesque'; font-weight:600; font-size:18px; margin:0 0 8px;">{{ $title }}</h3>
            <p style="color:{{ $muted }}; font-size:14px; line-height:1.6; margin:0;">{{ $desc }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- ============ CTA ============ --}}
  <section style="padding:clamp(40px,6vw,80px) clamp(20px,4vw,48px) clamp(80px,10vw,120px);">
    <div style="max-width:1080px; margin:0 auto; padding:clamp(32px,4vw,56px); border-radius:24px; border:1px solid {{ $line }}; background:radial-gradient(80% 120% at 100% 0%, oklch(0.62 0.19 273 / 0.18), transparent 60%), {{ $card }}; text-align:center;">
      <h2 style="font-family:'Bricolage Grotesque'; font-weight:600; font-size:clamp(24px,3vw,36px); letter-spacing:-0.03em; margin:0 0 12px;">Need more links pointing your way?</h2>
      <p style="color:{{ $muted }}; max-width:520px; margin:0 auto 28px; font-size:16px; line-height:1.6;">
        We build the kind of websites and content that earn high-quality backlinks — and rank. Let's talk about your project.
      </p>
      <a href="{{ url('/#contact') }}" class="btn btn-primary" style="padding:16px 32px; font-size:15px; border-radius:12px;">Start a project</a>
    </div>
  </section>

</main>

@include('partials.footer')
@endsection
