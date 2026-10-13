@extends('admin.seo.layout')

@section('title', 'Technical SEO')

@section('content')
<div class="page-header">
  <h1>Technical SEO Audit</h1>
  <form method="POST" action="{{ route('admin.seo.audit') }}" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-primary" onclick="return confirm('Start a full technical SEO audit? This may take a few minutes.')">&#9881; Run New Audit</button>
  </form>
</div>

{{-- Site Health Score --}}
<div class="card" style="margin-bottom: 24px;">
  <h2 style="font-family:'Bricolage Grotesque',sans-serif; font-size:18px; font-weight:600; margin:0 0 16px;">Site Health Score</h2>
  <div style="display:flex; align-items:center; gap:32px; flex-wrap:wrap;">
    <div style="width:120px; height:120px; border-radius:50%; border:8px solid oklch(0.72 0.17 150); display:flex; align-items:center; justify-content:center;">
      <span style="font-size:36px; font-weight:700; color:oklch(0.72 0.17 150);">72</span>
    </div>
    <div>
      <p style="font-size:16px; margin-bottom:8px;">Good — but room for improvement</p>
      <p style="color:oklch(0.62 0.015 272); font-size:14px; max-width:500px;">Your site passes the core technical requirements but has {{ count($issues) }} issues that could impact search rankings.</p>
    </div>
  </div>
</div>

{{-- Issues List --}}
<div class="card" style="margin-bottom: 24px;">
  <h2 style="font-family:'Bricolage Grotesque',sans-serif; font-size:18px; font-weight:600; margin:0 0 16px;">Issues Found</h2>
  <table>
    <thead>
      <tr><th>Severity</th><th>Issue</th><th>Affected</th><th>Action</th></tr>
    </thead>
    <tbody>
      @foreach($issues as $issue)
      <tr>
        <td>
          @if($issue['severity'] === 'critical')
            <span style="color:oklch(0.72 0.14 25); font-weight:600;">&#9679; Critical</span>
          @elseif($issue['severity'] === 'warning')
            <span style="color:oklch(0.72 0.14 85); font-weight:600;">&#9679; Warning</span>
          @else
            <span style="color:oklch(0.62 0.19 273); font-weight:600;">&#9679; Info</span>
          @endif
        </td>
        <td>{{ $issue['message'] }}</td>
        <td>{{ $issue['count'] }} {{ $issue['count'] === 1 ? 'item' : 'items' }}</td>
        <td>
          @if(str_contains($issue['message'], 'meta'))
            <a href="{{ route('admin.pages.index') }}" class="btn btn-xs btn-edit">Fix</a>
          @elseif(str_contains($issue['message'], 'sitemap') || str_contains($issue['message'], 'robots'))
            <a href="{{ route('admin.settings.index') }}" class="btn btn-xs btn-edit">Fix</a>
          @else
            <span style="font-size:12px; color:oklch(0.62 0.015 272);">Manual review</span>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

{{-- Tools & Config --}}
<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:20px;">
  <div class="card">
    <h2 style="font-family:'Bricolage Grotesque',sans-serif; font-size:16px; font-weight:600; margin:0 0 12px;">Robots.txt</h2>
    <p style="color:oklch(0.62 0.015 272); font-size:13px; margin-bottom:12px;">Control which pages search engines can crawl. Currently served from your app.</p>
    <a href="{{ url('robots.txt') }}" target="_blank" class="btn btn-sm btn-ghost">View robots.txt &nearr;</a>
  </div>
  <div class="card">
    <h2 style="font-family:'Bricolage Grotesque',sans-serif; font-size:16px; font-weight:600; margin:0 0 12px;">Sitemap.xml</h2>
    <p style="color:oklch(0.62 0.015 272); font-size:13px; margin-bottom:12px;">Your auto-generated sitemap includes all published pages, blog posts, and sections.</p>
    <a href="{{ url('sitemap.xml') }}" target="_blank" class="btn btn-sm btn-ghost">View sitemap.xml &nearr;</a>
  </div>
  <div class="card">
    <h2 style="font-family:'Bricolage Grotesque',sans-serif; font-size:16px; font-weight:600; margin:0 0 12px;">Schema Markup</h2>
    <p style="color:oklch(0.62 0.015 272); font-size:13px; margin-bottom:12px;">JSON-LD structured data is automatically added to pages and blog posts via the meta-tags component.</p>
    <a href="{{ url('/') }}" target="_blank" class="btn btn-sm btn-ghost">Test with Rich Results &nearr;</a>
  </div>
  <div class="card">
    <h2 style="font-family:'Bricolage Grotesque',sans-serif; font-size:16px; font-weight:600; margin:0 0 12px;">Google Analytics</h2>
    <p style="color:oklch(0.62 0.015 272); font-size:13px; margin-bottom:12px;">Configure your GA4 measurement ID in Settings to enable analytics tracking.</p>
    <a href="{{ route('admin.settings.index') }}" class="btn btn-sm btn-ghost">Configure in Settings &nearr;</a>
  </div>
</div>
@endsection
