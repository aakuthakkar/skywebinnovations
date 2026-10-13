@extends('layouts.app')

@php
  $ink = 'oklch(0.96 0.005 272)';
  $muted = 'oklch(0.72 0.02 272)';
  $line = 'oklch(0.3 0.025 272)';
  $accent = 'oklch(0.8 0.11 273)';
  $card = 'oklch(0.18 0.025 272 / 0.9)';
  $report = $report ?? null;
@endphp

@push('meta')
  <title>Backlinks for {{ $report?->domain ?? 'domain' }} | Free Backlink Checker</title>
  <meta name="description" content="Backlink report for {{ $report?->domain ?? 'this domain' }} — see the referring pages, anchor text, and referring domains linking in.">
  <meta name="robots" content="noindex, follow">
@endpush

@section('body')
<header>
  @include('partials.header')
</header>

<main id="top" style="padding-top:clamp(40px,6vw,72px);">

  <section style="padding:0 clamp(20px,4vw,48px) clamp(80px,10vw,120px);">
    <div style="max-width:1180px; margin:0 auto;">

      {{-- Search bar (so users can run another lookup) --}}
      <form method="GET" action="{{ route('backlink-checker.report') }}"
            style="display:flex; gap:10px; flex-wrap:wrap; margin-bottom:32px;">
        <input type="text" name="domain" value="{{ $report?->domain }}" placeholder="example.com" aria-label="Domain to check"
               style="flex:1 1 260px; min-width:0; padding:14px 16px; border-radius:12px; border:1px solid {{ $line }}; background:oklch(0.14 0.02 272); color:{{ $ink }}; font-size:15px; font-family:'JetBrains Mono';">
        <button type="submit" class="btn btn-primary" style="padding:14px 24px; font-size:14px; border-radius:12px;">Check</button>
      </form>

      @if(!$report || $report->isEmpty())
        {{-- Empty / notice state --}}
        <div style="padding:clamp(32px,5vw,64px); border-radius:20px; border:1px solid {{ $line }}; background:{{ $card }}; text-align:center;">
          <h1 style="font-family:'Bricolage Grotesque'; font-weight:600; font-size:clamp(22px,3vw,30px); margin:0 0 12px;">
            No backlinks found for <span style="font-family:'JetBrains Mono'; color:{{ $accent }};">{{ $report?->domain ?? 'that domain' }}</span>
          </h1>
          <p style="color:{{ $muted }}; max-width:560px; margin:0 auto; line-height:1.6;">
            {{ $report?->notice ?? 'This domain has no trackable backlinks, or none were found in our data source.' }}
          </p>
          <a href="{{ route('backlink-checker.index') }}" class="btn btn-ghost" style="margin-top:24px; padding:14px 26px; border-radius:12px;">Check another domain</a>
        </div>
      @else
        {{-- ===== REPORT ===== --}}
        <div style="display:flex; align-items:flex-end; justify-content:space-between; gap:16px; flex-wrap:wrap; margin-bottom:24px;">
          <div>
            <p style="margin:0 0 6px; font-family:'JetBrains Mono'; font-size:12px; letter-spacing:0.08em; text-transform:uppercase; color:{{ $accent }};">Backlink report</p>
            <h1 style="font-family:'Bricolage Grotesque'; font-weight:600; font-size:clamp(26px,4vw,44px); letter-spacing:-0.03em; margin:0; word-break:break-all;">
              {{ $report->domain }}
            </h1>
          </div>
          @if($report->authorityScore !== null)
            <div style="text-align:center; padding:16px 24px; border-radius:16px; border:1px solid {{ $line }}; background:{{ $card }};">
              <div style="font-family:'Bricolage Grotesque'; font-weight:700; font-size:40px; line-height:1; color:oklch(0.72 0.17 150);">{{ $report->authorityScore }}</div>
              <div style="font-family:'JetBrains Mono'; font-size:10px; letter-spacing:0.06em; text-transform:uppercase; color:{{ $muted }}; margin-top:6px;">Authority</div>
            </div>
          @endif
        </div>

        {{-- Stats --}}
        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:12px; margin-bottom:28px;">
          <div style="padding:20px 22px; border-radius:16px; border:1px solid {{ $line }}; background:{{ $card }};">
            <div style="font-family:'Bricolage Grotesque'; font-weight:700; font-size:32px; line-height:1;">{{ number_format($report->totalBacklinks) }}</div>
            <div style="color:{{ $muted }}; font-size:13px; margin-top:8px;">Backlinks</div>
          </div>
          <div style="padding:20px 22px; border-radius:16px; border:1px solid {{ $line }}; background:{{ $card }};">
            <div style="font-family:'Bricolage Grotesque'; font-weight:700; font-size:32px; line-height:1;">{{ number_format($report->referringDomains) }}</div>
            <div style="color:{{ $muted }}; font-size:13px; margin-top:8px;">Referring domains</div>
          </div>
        </div>

        {{-- Honesty notices --}}
        @if($report->notice)
          <div style="padding:14px 18px; border-radius:12px; border:1px solid oklch(0.75 0.15 60 / 0.4); background:oklch(0.75 0.15 60 / 0.1); color:{{ $ink }}; font-size:14px; line-height:1.6; margin-bottom:20px;">
            {{ $report->notice }}
          </div>
        @endif
        @if($report->isSample)
          <p style="color:{{ $muted }}; font-size:13px; line-height:1.6; margin:0 0 16px;">
            Showing a sample of results. Connect a full backlink data plan for complete coverage.
          </p>
        @endif

        {{-- Table --}}
        <div style="border-radius:16px; border:1px solid {{ $line }}; background:{{ $card }}; overflow:hidden;">
          <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; font-size:14px; min-width:820px;">
              <thead>
                <tr style="text-align:left; color:{{ $muted }}; font-family:'JetBrains Mono'; font-size:11px; letter-spacing:0.06em; text-transform:uppercase;">
                  <th style="padding:16px 18px; border-bottom:1px solid {{ $line }};">Source page / Title</th>
                  <th style="padding:16px 18px; border-bottom:1px solid {{ $line }};">Anchor text</th>
                  <th style="padding:16px 18px; border-bottom:1px solid {{ $line }};">Target URL</th>
                  <th style="padding:16px 18px; border-bottom:1px solid {{ $line }};">Type</th>
                  <th style="padding:16px 18px; border-bottom:1px solid {{ $line }}; text-align:center;">DA</th>
                  <th style="padding:16px 18px; border-bottom:1px solid {{ $line }}; text-align:right;">Indexed</th>
                </tr>
              </thead>
              <tbody>
                @forelse($report->items as $item)
                  <tr style="border-bottom:1px solid oklch(0.3 0.025 272 / 0.5);">
                    <td style="padding:14px 18px; max-width:320px;">
                      <a href="{{ $item->sourceUrl }}" target="_blank" rel="noopener" style="color:{{ $accent }}; text-decoration:none; word-break:break-all;">{{ \Illuminate\Support\Str::limit($item->sourceUrl, 55) }}</a>
                      @if($item->sourceTitle)
                        <div style="color:{{ $muted }}; font-size:13px; margin-top:4px;">{{ \Illuminate\Support\Str::limit($item->sourceTitle, 60) }}</div>
                      @endif
                    </td>
                    <td style="padding:14px 18px; max-width:200px;">{{ \Illuminate\Support\Str::limit($item->anchorText ?? '—', 40) }}</td>
                    <td style="padding:14px 18px; max-width:200px;">
                      <span style="color:{{ $muted }}; word-break:break-all;">{{ \Illuminate\Support\Str::limit($item->targetUrl, 40) }}</span>
                    </td>
                    <td style="padding:14px 18px;">
                      <span style="font-family:'JetBrains Mono'; font-size:11px; text-transform:capitalize; padding:3px 9px; border-radius:999px; border:1px solid {{ $line }}; color:{{ $item->linkType === 'dofollow' ? 'oklch(0.72 0.17 150)' : $muted }};">{{ $item->linkType }}</span>
                    </td>
                    <td style="padding:14px 18px; text-align:center; font-family:'JetBrains Mono';">{{ $item->domainAuthority ?? '—' }}</td>
                    <td style="padding:14px 18px; text-align:right; color:{{ $muted }}; font-size:13px; white-space:nowrap;">
                      {{ $item->indexedAt ? \Illuminate\Support\Carbon::parse($item->indexedAt)->format('M j, Y') : '—' }}
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" style="padding:40px; text-align:center; color:{{ $muted }};">No individual backlink rows returned.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

        {{-- Pagination --}}
        @if($report->hasMore || $report->page > 1)
          <div style="display:flex; justify-content:space-between; align-items:center; margin-top:24px; gap:12px;">
            @if($report->page > 1)
              <a href="{{ route('backlink-checker.report', ['domain' => $report->domain, 'page' => $report->page - 1]) }}" class="btn btn-ghost" style="padding:12px 22px; border-radius:12px;">&larr; Previous</a>
            @else
              <span></span>
            @endif
            <span style="color:{{ $muted }}; font-family:'JetBrains Mono'; font-size:13px;">Page {{ $report->page }}</span>
            @if($report->hasMore)
              <a href="{{ route('backlink-checker.report', ['domain' => $report->domain, 'page' => $report->page + 1]) }}" class="btn btn-ghost" style="padding:12px 22px; border-radius:12px;">Next &rarr;</a>
            @else
              <span></span>
            @endif
          </div>
        @endif

        {{-- Source attribution (honesty) --}}
        <p style="color:{{ $muted }}; font-size:12px; margin-top:28px; line-height:1.6;">
          @if($report->source === 'local')
            Data source: links tracked in this site's own backlink monitor.
          @elseif($report->source === 'api')
            Data provided by SE Ranking. Backlink data reflects recent crawls and may lag live changes.
          @endif
        </p>
      @endif

    </div>
  </section>

</main>

@include('partials.footer')
@endsection
