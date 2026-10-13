@extends('admin.seo.layout')

@section('title', 'Keyword Tracking')

@section('content')
<div class="page-header">
  <h1>Keyword Tracking</h1>
  <a href="{{ route('admin.seo.keywords.create') }}" class="btn btn-primary">+ Add Keyword</a>
</div>

{{-- Mini Stats --}}
<div class="stats-grid" style="margin-bottom: 20px;">
  <div class="stat-card">
    <div class="label">Trending Up</div>
    <div class="value" style="color:oklch(0.72 0.17 150);">{{ $trendingUp }}</div>
  </div>
  <div class="stat-card">
    <div class="label">Trending Down</div>
    <div class="value" style="color:oklch(0.72 0.14 25);">{{ $trendingDown }}</div>
  </div>
  <div class="stat-card">
    <div class="label">In Top 10</div>
    <div class="value" style="color:oklch(0.78 0.12 273);">{{ $inTop10 }}</div>
  </div>
  <div class="stat-card">
    <div class="label">Total Keywords</div>
    <div class="value">{{ $keywords->total() }}</div>
  </div>
</div>

{{-- Filters --}}
<div class="filters">
  <form method="GET" style="display:flex; gap:10px; flex-wrap:wrap; flex:1;">
    <input type="text" name="search" placeholder="Search keywords..." value="{{ request('search') }}">
    <select name="intent">
      <option value="">All Intents</option>
      <option value="informational" {{ request('intent') === 'informational' ? 'selected' : '' }}>Informational</option>
      <option value="navigational" {{ request('intent') === 'navigational' ? 'selected' : '' }}>Navigational</option>
      <option value="transactional" {{ request('intent') === 'transactional' ? 'selected' : '' }}>Transactional</option>
      <option value="commercial" {{ request('intent') === 'commercial' ? 'selected' : '' }}>Commercial</option>
    </select>
    <select name="status">
      <option value="">All Status</option>
      <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
      <option value="paused" {{ request('status') === 'paused' ? 'selected' : '' }}>Paused</option>
    </select>
    <button type="submit" class="btn btn-sm btn-ghost">Filter</button>
    @if(request()->hasAny(['search', 'intent', 'status']))
      <a href="{{ route('admin.seo.keywords.index') }}" class="btn btn-sm btn-ghost">Clear</a>
    @endif
  </form>
</div>

<div class="card">
  <table>
    <thead>
      <tr>
        <th>Keyword</th>
        <th>Intent</th>
        <th>Search Volume</th>
        <th>Difficulty</th>
        <th>CPC</th>
        <th>Position</th>
        <th>Target</th>
        <th>Trend</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($keywords as $keyword)
      <tr>
        <td>
          <strong>{{ $keyword->keyword }}</strong>
          @if($keyword->target_url)
            <br><a href="{{ $keyword->target_url }}" target="_blank" style="font-size:11px; color:oklch(0.62 0.015 272);">{{ Str::limit($keyword->target_url, 40) }}</a>
          @endif
        </td>
        <td style="text-transform:capitalize;">{{ $keyword->search_intent }}</td>
        <td>{{ $keyword->search_volume ? number_format($keyword->search_volume) : '—' }}</td>
        <td>{{ $keyword->difficulty !== null ? $keyword->difficulty . '/100' : '—' }}</td>
        <td>{{ $keyword->cpc ? '$' . number_format($keyword->cpc, 2) : '—' }}</td>
        <td>
          @if($keyword->current_position)
            <strong>#{{ $keyword->current_position }}</strong>
          @else
            <span style="color:oklch(0.62 0.015 272);">Not ranked</span>
          @endif
        </td>
        <td>#{{ $keyword->target_position ?? '—' }}</td>
        <td>
          @if($keyword->trend === 'up')
            <span class="badge badge-up">&#8593; Up</span>
          @elseif($keyword->trend === 'down')
            <span class="badge badge-down">&#8595; Down</span>
          @else
            <span class="badge badge-stable">&#8596;</span>
          @endif
        </td>
        <td>
          @if($keyword->is_active)
            <span class="badge badge-new">Active</span>
          @else
            <span class="badge badge-closed">Paused</span>
          @endif
        </td>
        <td>
          <div class="actions">
            <a href="{{ route('admin.seo.keywords.edit', $keyword) }}" class="btn btn-xs btn-edit">Edit</a>
            <form method="POST" action="{{ route('admin.seo.keywords.destroy', $keyword) }}" onsubmit="return confirm('Remove this keyword?')" style="display:inline;">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-xs btn-delete">Delete</button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr><td colspan="10">
        <div class="empty-state">
          <p>No keywords tracked yet.</p>
          <a href="{{ route('admin.seo.keywords.create') }}" class="btn btn-primary" style="margin-top:12px;">+ Add Your First Keyword</a>
        </div>
      </td></tr>
      @endforelse
    </tbody>
  </table>
  <div style="margin-top:16px;">{{ $keywords->links() }}</div>
</div>
@endsection
