@extends('admin.seo.layout')

@section('title', 'SEO Dashboard')

@section('content')
<div style="padding-bottom: 32px;">
  <h1 style="font-family:'Bricolage Grotesque',sans-serif; font-size:32px; font-weight:600; margin:0 0 4px;">SEO Dashboard</h1>
  <p style="color:oklch(0.62 0.015 272); font-size:14px; margin:0 0 28px;">Overview of your search engine optimization performance</p>

  {{-- Quick Actions --}}
  <div style="display:flex; gap:10px; margin-bottom:28px; flex-wrap:wrap;">
    <a href="{{ route('admin.seo.keywords.create') }}" class="btn btn-primary">+ Add Keyword</a>
    <a href="{{ route('admin.seo.backlinks.create') }}" class="btn btn-ghost">+ Add Backlink</a>
    <a href="{{ route('admin.seo.redirects.create') }}" class="btn btn-ghost">+ Add Redirect</a>
    <form method="POST" action="{{ route('admin.seo.audit') }}" style="display:inline;">
      @csrf
      <button type="submit" class="btn btn-ghost" onclick="return confirm('Start a full technical SEO audit? This may take a few minutes.')">&#9881; Run Audit</button>
    </form>
  </div>

  {{-- Stats Row --}}
  <div class="stats-grid">
    <div class="stat-card">
      <div class="label">Tracked Keywords</div>
      <div class="value">{{ $keywords }}</div>
      <div class="sub">Active tracking</div>
    </div>
    <div class="stat-card">
      <div class="label">Backlinks</div>
      <div class="value">{{ $totalDomains }}</div>
      <div class="sub">{{ $backlinks }} total links from {{ $totalDomains }} domains</div>
    </div>
    <div class="stat-card">
      <div class="label">Active Redirects</div>
      <div class="value">{{ $activeRedirects }}</div>
      <div class="sub">{{ number_format($totalRedirectHits) }} total hits</div>
    </div>
    <div class="stat-card">
      <div class="label">Missing Meta</div>
      <div class="value" style="color:oklch(0.72 0.14 25);">{{ $pagesNeedingMeta + $blogPostsNeedingMeta }}</div>
      <div class="sub">{{ $pagesNeedingMeta }} pages, {{ $blogPostsNeedingMeta }} blog posts</div>
    </div>
  </div>

  {{-- Top Keywords --}}
  <div class="card" style="margin-bottom: 24px;">
    <h2 style="font-family:'Bricolage Grotesque',sans-serif; font-size:18px; font-weight:600; margin:0 0 16px;">Top Performing Keywords</h2>
    @if($topKeywords->count() > 0)
    <table>
      <thead>
        <tr><th>Keyword</th><th>Position</th><th>Target</th><th>Trend</th><th>Intent</th></tr>
      </thead>
      <tbody>
        @foreach($topKeywords as $kw)
        <tr>
          <td style="font-weight:500;">{{ $kw->keyword }}</td>
          <td>#{{ $kw->current_position ?? '—' }}</td>
          <td>#{{ $kw->target_position ?? '—' }}</td>
          <td>
            @if($kw->trend === 'up')
              <span class="badge badge-up">&#8593; Up</span>
            @elseif($kw->trend === 'down')
              <span class="badge badge-down">&#8595; Down</span>
            @else
              <span class="badge badge-stable">&#8596; Stable</span>
            @endif
          </td>
          <td style="text-transform:capitalize;">{{ $kw->search_intent }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <a href="{{ route('admin.seo.keywords.index') }}" style="display:inline-block; margin-top:16px; color:oklch(0.78 0.12 273); text-decoration:none; font-size:14px;">View all keywords &rarr;</a>
    @else
    <div class="empty-state">
      <p>No keywords tracked yet. <a href="{{ route('admin.seo.keywords.create') }}" style="color:oklch(0.78 0.12 273);">Add your first keyword</a></p>
    </div>
    @endif
  </div>

  {{-- Recent Audits --}}
  <div class="card">
    <h2 style="font-family:'Bricolage Grotesque',sans-serif; font-size:18px; font-weight:600; margin:0 0 16px;">Recent Audits</h2>
    @if($recentAudits->count() > 0)
    <table>
      <thead>
        <tr><th>Name</th><th>Status</th><th>Score</th><th>Date</th></tr>
      </thead>
      <tbody>
        @foreach($recentAudits as $audit)
        <tr>
          <td style="font-weight:500;">{{ $audit->name }}</td>
          <td>
            @if($audit->status === 'completed')
              <span class="badge badge-new">Completed</span>
            @elseif($audit->status === 'running')
              <span class="badge badge-read">Running</span>
            @else
              <span class="badge badge-closed">Failed</span>
            @endif
          </td>
          <td>
            @if($audit->score)
              <span style="color: {{ $audit->score >= 80 ? 'oklch(0.72 0.17 150)' : ($audit->score >= 50 ? 'oklch(0.72 0.14 85)' : 'oklch(0.72 0.14 25)') }}; font-weight:600;">{{ $audit->score }}/100</span>
            @else
              <span style="color:oklch(0.62 0.015 272);">—</span>
            @endif
          </td>
          <td style="color:oklch(0.62 0.015 272);">{{ $audit->completed_at?->format('M j, Y') ?? 'In progress...' }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @else
    <div class="empty-state">
      <p>No audits yet. <button class="btn btn-ghost" style="margin-top:8px;" onclick="document.querySelector('form[action=\"{{ route('admin.seo.audit') }}\"]').submit();">Run your first audit</button></p>
    </div>
    @endif
  </div>

  {{-- Quick Meta Check --}}
  <div class="card" style="margin-top: 24px;">
    <h2 style="font-family:'Bricolage Grotesque',sans-serif; font-size:18px; font-weight:600; margin:0 0 16px;">Quick Meta Tag Audit</h2>
    <p style="color:oklch(0.62 0.015 272); font-size:14px; margin-bottom:16px;">Pages and blog posts missing important meta tags</p>
    @if($pagesNeedingMeta > 0 || $blogPostsNeedingMeta > 0)
    <table>
      <thead>
        <tr><th>Type</th><th>Count</th><th>Action</th></tr>
      </thead>
      <tbody>
        @if($pagesNeedingMeta > 0)
        <tr>
          <td>Pages missing meta title/description</td>
          <td style="color:oklch(0.72 0.14 25); font-weight:600;">{{ $pagesNeedingMeta }}</td>
          <td><a href="{{ route('admin.pages.index') }}" class="btn btn-xs btn-edit">Fix Pages</a></td>
        </tr>
        @endif
        @if($blogPostsNeedingMeta > 0)
        <tr>
          <td>Blog posts missing meta title/description</td>
          <td style="color:oklch(0.72 0.14 25); font-weight:600;">{{ $blogPostsNeedingMeta }}</td>
          <td><a href="{{ route('admin.blog-posts.index') }}" class="btn btn-xs btn-edit">Fix Posts</a></td>
        </tr>
        @endif
      </tbody>
    </table>
    @else
    <p style="color:oklch(0.62 0.015 272);">All published pages and posts have meta tags. Great job!</p>
    @endif
  </div>
</div>
@endsection
