@extends('admin.seo.layout')

@section('title', 'Backlinks')

@section('content')
<div class="page-header">
  <h1>Backlink Management</h1>
  <div style="display:flex; gap:10px;">
    <form method="POST" action="{{ route('admin.seo.backlinks.health-check') }}" onsubmit="this.querySelector('button').disabled=true; this.querySelector('button').textContent='Checking… (this can take a minute)';">
      @csrf
      <button type="submit" class="btn btn-ghost" title="Verify each backlink still loads and still links to your site">⟳ Run Health Check</button>
    </form>
    <a href="{{ route('admin.seo.backlinks.create') }}" class="btn btn-primary">+ Add Backlink</a>
  </div>
</div>

@if(session('health_check'))
  @php $hc = session('health_check'); @endphp
  <div class="card" style="margin-bottom:20px; border-left:3px solid oklch(0.72 0.17 150);">
    <h3 style="margin:0 0 12px; font-size:15px;">Health Check Results</h3>
    <div class="stats-grid">
      <div class="stat-card"><div class="label">Checked</div><div class="value">{{ $hc['checked'] }}</div></div>
      <div class="stat-card"><div class="label">Live</div><div class="value" style="color:oklch(0.72 0.17 150);">{{ $hc['ok'] }}</div></div>
      <div class="stat-card"><div class="label">Dead</div><div class="value" style="color:oklch(0.72 0.14 25);">{{ $hc['dead'] }}</div></div>
      <div class="stat-card"><div class="label">Link Removed</div><div class="value" style="color:oklch(0.75 0.15 60);">{{ $hc['missing'] }}</div></div>
      <div class="stat-card"><div class="label">Unverified</div><div class="value" style="color:oklch(0.7 0.02 272);">{{ $hc['unreachable'] }}</div></div>
    </div>
    <p style="margin:12px 0 0; font-size:13px; color:oklch(0.65 0.02 272);">
      "Unverified" means the site blocked the request or timed out — not necessarily lost. Re-check later.
      {{ $hc['checked'] >= 50 ? 'Only the 50 oldest-checked links were verified this run; run again to cover more.' : '' }}
    </p>
  </div>
@endif

<div class="stats-grid" style="margin-bottom: 20px;">
  <div class="stat-card">
    <div class="label">Total Backlinks</div>
    <div class="value">{{ $totalBacklinks }}</div>
  </div>
  <div class="stat-card">
    <div class="label">Referring Domains</div>
    <div class="value">{{ $totalDomains }}</div>
  </div>
  <div class="stat-card">
    <div class="label">Dofollow Links</div>
    <div class="value" style="color:oklch(0.72 0.17 150);">{{ $dofollowCount }}</div>
  </div>
  <div class="stat-card">
    <div class="label">Lost Backlinks</div>
    <div class="value" style="color:oklch(0.72 0.14 25);">{{ $lostCount }}</div>
  </div>
</div>

<div class="filters">
  <form method="GET" style="display:flex; gap:10px; flex-wrap:wrap; flex:1;">
    <input type="text" name="search" placeholder="Search by domain, URL, or anchor text..." value="{{ request('search') }}">
    <select name="type">
      <option value="">All Link Types</option>
      <option value="dofollow" {{ request('type') === 'dofollow' ? 'selected' : '' }}>Dofollow</option>
      <option value="nofollow" {{ request('type') === 'nofollow' ? 'selected' : '' }}>Nofollow</option>
      <option value="sponsored" {{ request('type') === 'sponsored' ? 'selected' : '' }}>Sponsored</option>
      <option value="ugc" {{ request('type') === 'ugc' ? 'selected' : '' }}>UGC</option>
    </select>
    <select name="status">
      <option value="">All Status</option>
      <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
      <option value="lost" {{ request('status') === 'lost' ? 'selected' : '' }}>Lost</option>
    </select>
    <button type="submit" class="btn btn-sm btn-ghost">Filter</button>
    @if(request()->hasAny(['search', 'type', 'status']))
      <a href="{{ route('admin.seo.backlinks.index') }}" class="btn btn-sm btn-ghost">Clear</a>
    @endif
  </form>
</div>

<div class="card">
  <table>
    <thead>
      <tr>
        <th>Source Domain</th>
        <th>Target URL</th>
        <th>Anchor Text</th>
        <th>Type</th>
        <th>DA</th>
        <th>PA</th>
        <th>Status</th>
        <th>Last Seen</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($backlinks as $backlink)
      <tr>
        <td><strong>{{ $backlink->source_domain }}</strong></td>
        <td><a href="{{ $backlink->target_url }}" target="_blank" style="color:oklch(0.78 0.12 273);">{{ Str::limit($backlink->target_url, 35) }}</a></td>
        <td>{{ $backlink->anchor_text ? Str::limit($backlink->anchor_text, 30) : '—' }}</td>
        <td>
          <span class="badge {{ $backlink->link_type === 'dofollow' ? 'badge-up' : 'badge-stable' }}" style="text-transform:capitalize;">{{ $backlink->link_type }}</span>
        </td>
        <td>{{ $backlink->domain_authority ?? '—' }}</td>
        <td>{{ $backlink->page_authority ?? '—' }}</td>
        <td>
          @if($backlink->lost_at)
            <span class="badge badge-down">Lost</span>
          @elseif($backlink->is_active)
            <span class="badge badge-new">Active</span>
          @else
            <span class="badge badge-closed">Inactive</span>
          @endif
        </td>
        <td style="font-size:13px;">{{ $backlink->last_seen_at?->format('M j, Y') ?? 'Never' }}</td>
        <td>
          <div class="actions">
            <form method="POST" action="{{ route('admin.seo.backlinks.recheck', $backlink) }}" style="display:inline;">
              @csrf
              <button type="submit" class="btn btn-xs btn-ghost" title="Re-verify this single backlink">Re-check</button>
            </form>
            <a href="{{ route('admin.seo.backlinks.edit', $backlink) }}" class="btn btn-xs btn-edit">Edit</a>
            <form method="POST" action="{{ route('admin.seo.backlinks.destroy', $backlink) }}" onsubmit="return confirm('Remove this backlink?')" style="display:inline;">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-xs btn-delete">Delete</button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr><td colspan="9">
        <div class="empty-state">
          <p>No backlinks tracked yet.</p>
          <a href="{{ route('admin.seo.backlinks.create') }}" class="btn btn-primary" style="margin-top:12px;">+ Add Your First Backlink</a>
        </div>
      </td></tr>
      @endforelse
    </tbody>
  </table>
  <div style="margin-top:16px;">{{ $backlinks->links() }}</div>
</div>
@endsection
