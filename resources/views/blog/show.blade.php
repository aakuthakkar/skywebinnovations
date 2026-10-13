@extends('layouts.app')

@section('body')
@php
    $articleSchema = [
        '@type' => 'BlogPosting',
        '@id' => ($url ?? config('app.url')) . '/blog/' . $post->slug . '#article',
        'headline' => $post->title,
        'description' => $post->excerpt,
        'url' => route('blog.show', $post->slug),
        'datePublished' => $post->published_at?->toIso8601String() ?? '',
        'dateModified' => $post->updated_at?->toIso8601String() ?? ($post->published_at?->toIso8601String() ?? ''),
        'author' => [
            '@type' => 'Person',
            'name' => $post->author_id ? ($settings['founder_name'] ?? 'Aakash Thakkar') : ($settings['founder_name'] ?? 'Aakash Thakkar'),
            'url' => ($settings['linkedin_url'] ?? 'https://www.linkedin.com/in/aakash-thakkar-a8b9a988/')
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => $settings['site_name'] ?? 'Sky Web Innovations',
            'logo' => [
                '@type' => 'ImageObject',
                'url' => (config('app.url') ?? 'https://skywebinnovations.com') . '/assets/logo.jpeg',
                'width' => 220,
                'height' => 44
            ]
        ],
        'image' => $post->featured_image ?? ($settings['meta_image'] ?? '/assets/og-image.jpg'),
        'inLanguage' => 'en-US',
    ];
    if ($post->category) {
        $articleSchema['articleSection'] = [$post->category];
    }
    if (!empty($post->tags)) {
        $articleSchema['keywords'] = implode(', ', is_array($post->tags) ? $post->tags : json_decode($post->tags, true) ?? []);
    }
@endphp
<script type="application/ld+json">
{!! json_encode($articleSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>

<header>
  @include('partials.header')
</header>

<main id="top">
  <article style="padding:clamp(100px,12vw,140px) clamp(20px,4vw,48px) clamp(40px,6vw,80px);">
    <div style="max-width:800px; margin:0 auto;">
      <div style="margin-bottom:32px;">
        @if($post->category)
        <span style="padding:5px 12px;border-radius:999px;background:oklch(0.62 0.19 273 / 0.15);font-family:'JetBrains Mono';font-size:12px;color:oklch(0.78 0.12 273);">{{ $post->category }}</span>
        @endif
        <p style="margin:16px 0 0;font-family:'JetBrains Mono';font-size:12px;color:oklch(0.65 0.02 272);">{{ $post->published_at?->format('F d, Y') }}</p>
      </div>

      <h1 style="margin:0 0 40px; font-family:'Bricolage Grotesque'; font-weight:500; font-size:clamp(32px,4.5vw,64px); line-height:1.04; letter-spacing:-0.035em;">{{ $post->title }}</h1>

      @if($post->featured_image)
      <div style="margin-bottom:48px;border-radius:24px;overflow:hidden;border:1px solid oklch(0.28 0.025 272);">
        <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" style="width:100%;display:block;" loading="lazy" width="1200" height="630">
      </div>
      @endif

      <div style="font-size:clamp(16px,1.2vw,18px); line-height:1.8; color:oklch(0.82 0.015 272);" class="blog-content">
        {!! $post->content !!}
      </div>

      @if($post->tags && count($post->tags) > 0)
      <div style="margin-top:48px; padding-top:32px; border-top:1px solid oklch(0.28 0.025 272); display:flex; flex-wrap:wrap; gap:8px;">
        @foreach($post->tags as $tag)
        <span style="padding:5px 12px;border-radius:999px;background:oklch(0.22 0.025 272);font-family:'JetBrains Mono';font-size:12px;color:oklch(0.85 0.01 272);">{{ $tag }}</span>
        @endforeach
      </div>
      @endif
    </div>
  </article>

  @if($recentPosts->count() > 0)
  <section style="background:oklch(0.17 0.025 272);border-block:1px solid oklch(0.26 0.025 272);padding:clamp(80px,10vw,120px) clamp(20px,4vw,48px);">
    <div style="max-width:1320px; margin:0 auto;">
      <h2 style="margin:0 0 32px;font-family:'Bricolage Grotesque';font-weight:600;font-size:clamp(28px,3.2vw,44px);letter-spacing:-0.025em;">More posts</h2>
      <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(min(100%, 340px), 1fr)); gap:24px;">
        @foreach($recentPosts as $recent)
        <a href="{{ route('blog.show', $recent->slug) }}" style="text-decoration:none;color:inherit;">
          <article style="border-radius:16px; padding:clamp(20px,3vw,32px); background:oklch(0.14 0.02 272); border:1px solid oklch(0.28 0.025 272); display:flex; flex-direction:column; gap:14px; transition:transform .3s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform=''">
            <span style="font-family:'JetBrains Mono';font-size:11px;color:oklch(0.65 0.02 272);">{{ $recent->published_at?->format('M d, Y') }}</span>
            <h3 style="margin:0; font-family:'Bricolage Grotesque'; font-size:clamp(18px,2vw,22px); font-weight:600; letter-spacing:-0.02em; color:oklch(0.96 0.005 272);">{{ $recent->title }}</h3>
            <p style="margin:0; font-size:14px; line-height:1.6; color:oklch(0.78 0.015 272); display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">{{ $recent->excerpt }}</p>
          </article>
        </a>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  @include('sections.contact')
</main>

@include('partials.footer')

@endsection
