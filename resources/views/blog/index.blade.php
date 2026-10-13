@extends('layouts.app')

@section('body')
<header>
  @include('partials.header')
</header>

<main id="top">
  <section style="padding:clamp(100px,12vw,140px) clamp(20px,4vw,48px) clamp(60px,8vw,100px);">
    <div style="max-width:1320px; margin:0 auto;">
      <p style="margin:0 0 20px; font-family:'JetBrains Mono'; font-size:12px; letter-spacing:0.08em; text-transform:uppercase; color:oklch(0.72 0.02 272);">Blog</p>
      <h1 style="margin:0; font-family:'Bricolage Grotesque'; font-weight:500; font-size:clamp(36px,5vw,72px); line-height:1.04; letter-spacing:-0.035em;">Latest Posts</h1>
    </div>
  </section>

  <section style="max-width:1320px; margin:0 auto; padding:0 clamp(20px,4vw,48px) clamp(80px,10vw,120px);">
    @if($posts->count() > 0)
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(min(100%, 380px), 1fr)); gap:24px;">
      @foreach($posts as $post)
      <article style="border-radius:24px; overflow:hidden; border:1px solid oklch(0.28 0.025 272); display:flex; flex-direction:column; transition:transform .3s;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform=''">
        <a href="{{ route('blog.show', $post->slug) }}" style="display:block; aspect-ratio:16/10; background:linear-gradient(160deg, oklch(0.45 0.15 273 / 0.35), transparent 70%), oklch(0.18 0.025 272); border-bottom:1px solid oklch(0.28 0.025 272); position:relative;">
          @if($post->featured_image)
          <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" loading="lazy" width="800" height="500" style="width:100%;height:100%;object-fit:cover;display:block;">
          @else
          <div style="display:flex;align-items:center;justify-content:center;height:100%;font-family:'JetBrains Mono';font-size:13px;color:oklch(0.65 0.02 272);">{{ $post->category ?? 'Blog Post' }}</div>
          @endif
        </a>
        <div style="padding:clamp(20px,3vw,32px); display:flex; flex-direction:column; gap:14px; flex:1;">
          <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
            @if($post->category)
            <span style="padding:4px 10px;border-radius:999px;background:oklch(0.62 0.19 273 / 0.15);font-family:'JetBrains Mono';font-size:11px;color:oklch(0.78 0.12 273);">{{ $post->category }}</span>
            @endif
            <span style="font-family:'JetBrains Mono';font-size:11px;color:oklch(0.65 0.02 272);">{{ $post->published_at?->format('M d, Y') }}</span>
          </div>
          <h2 style="margin:0; font-family:'Bricolage Grotesque'; font-size:clamp(20px,2vw,26px); font-weight:600; letter-spacing:-0.02em; line-height:1.2;">
            <a href="{{ route('blog.show', $post->slug) }}" style="color:oklch(0.96 0.005 272);text-decoration:none;transition:color .2s;" onmouseover="this.style.color='oklch(0.78 0.12 273)'" onmouseout="this.style.color='oklch(0.96 0.005 272)'">{{ $post->title }}</a>
          </h2>
          <p style="margin:0; font-size:15px; line-height:1.6; color:oklch(0.78 0.015 272); display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden;">{{ $post->excerpt }}</p>
          <a href="{{ route('blog.show', $post->slug) }}" style="margin-top:auto; display:inline-flex; align-items:center; gap:8px; font-family:'JetBrains Mono'; font-size:13px; color:oklch(0.62 0.19 273); text-decoration:none;" onmouseover="this.style.gap='14px'" onmouseout="this.style.gap='8px'">Read more <span>→</span></a>
        </div>
      </article>
      @endforeach
    </div>

    <div style="margin-top:48px;">
      {{ $posts->links() }}
    </div>
    @else
    <div style="text-align:center;padding:80px 20px;color:oklch(0.65 0.02 272);">
      <p style="font-size:18px;margin-bottom:8px;">No blog posts yet.</p>
      <p style="font-size:14px;">Check back soon for new content.</p>
    </div>
    @endif
  </section>

  @include('sections.contact')
</main>

@include('partials.footer')

@endsection
