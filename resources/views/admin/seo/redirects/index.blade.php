@extends('admin.seo.layout')

@section('title', 'Redirects')

@section('content')
<div class="page-header">
  <h1>URL Redirects</h1>
  <a href="{{ route('admin.seo.redirects.create') }}" class="btn btn-primary">+ Add Redirect</a>
</div>

<div class="filters">
  <form method="GET" style="display:flex; gap:10px; flex-wrap:wrap; flex:1;">
    <input type="text" name="search" placeholder="Search source or target path..." value="{{ request('search') }}">
    <select name="type">
      <option value="">All Types</option>
      <option value="301" {{ request('type') === '301' ? 'selected' : '' }}>301 Permanent</option>
      <option value="302" {{ request('type') === '302' ? 'selected' : '' }}>302 Temporary</option>
      <option value="307" {{ request('type') === '307' ? 'selected' : '' }}>307 Temporary</option>
    </select>
    <select name="status">
      <option value="">All Status</option>
      <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
      <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
    </select>
    <button type="submit" class="btn btn-sm btn-ghost">Filter</button>
    @if(request()->hasAny(['search', 'type', 'status']))
      <a href="{{ route('admin.seo.redirects.index') }}" class="btn btn-sm btn-ghost">Clear</a>
    @endif
  </form>
</div>

<div class="card">
  <table>
    <thead>
      <tr>
        <th>Source</th>
        <th>Type</th>
        <th>Target</th>
        <th>Hits</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($redirects as $redirect)
      <tr>
        <td>
          <code style="font-family:'JetBrains Mono',monospace; font-size:13px; background:oklch(0.14 0.02 272); padding:2px 8px; border-radius:4px;">{{ $redirect->source_path }}</code>
          @if($redirect->source_host)
            <br><span style="font-size:11px; color:oklch(0.62 0.015 272);">{{ $redirect->source_host }}</span>
          @endif
        </td>
        <td>
          <span class="badge" style="background: {{ $redirect->type === '301' ? 'oklch(0.72 0.17 150)' : 'oklch(0.62 0.19 273)' }}; color:#fff;">{{ $redirect->type }}</span>
        </td>
        <td>
          <code style="font-family:'JetBrains Mono',monospace; font-size:13px; color:oklch(0.78 0.12 273);">{{ $redirect->target_path }}</code>
        </td>
        <td>{{ number_format($redirect->hit_count) }}</td>
        <td>
          @if($redirect->is_active)
            <span class="badge badge-new">Active</span>
          @else
            <span class="badge badge-closed">Inactive</span>
          @endif
        </td>
        <td>
          <div class="actions">
            <a href="{{ route('admin.seo.redirects.edit', $redirect) }}" class="btn btn-xs btn-edit">Edit</a>
            <form method="POST" action="{{ route('admin.seo.redirects.destroy', $redirect) }}" onsubmit="return confirm('Remove this redirect?')" style="display:inline;">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-xs btn-delete">Delete</button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr><td colspan="6">
        <div class="empty-state">
          <p>No redirects configured yet.</p>
          <a href="{{ route('admin.seo.redirects.create') }}" class="btn btn-primary" style="margin-top:12px;">+ Add Your First Redirect</a>
        </div>
      </td></tr>
      @endforelse
    </tbody>
  </table>
  <div style="margin-top:16px;">{{ $redirects->links() }}</div>
</div>
@endsection
