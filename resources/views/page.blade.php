@extends('layouts.app')

@section('body')
<header>
  @include('partials.header')
</header>

<main id="top">

  <section style="position:relative; padding:clamp(100px,12vw,140px) clamp(20px,4vw,48px) 40px;">
    <div style="max-width:900px; margin:0 auto; text-align:center;">
      <p style="margin:0 0 20px; font-family:'JetBrains Mono'; font-size:12px; letter-spacing:0.08em; text-transform:uppercase; color:oklch(0.72 0.02 272);">Page</p>
      <h1 style="margin:0; font-family:'Bricolage Grotesque'; font-weight:500; font-size:clamp(36px,5vw,72px); line-height:1.04; letter-spacing:-0.035em;">{{ $page->title }}</h1>
    </div>
  </section>

  <section aria-label="Page content" style="max-width:800px; margin:0 auto; padding:0 clamp(20px,4vw,48px) clamp(80px,10vw,120px);">
    <div style="font-size:clamp(16px,1.2vw,18px); line-height:1.75; color:oklch(0.82 0.015 272);">
      {!! $page->content !!}
    </div>
  </section>

  @include('sections.contact')

</main>

@include('partials.footer')

@endsection
