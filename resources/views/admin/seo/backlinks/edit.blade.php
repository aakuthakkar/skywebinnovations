@extends('admin.seo.layout')

@section('title', 'Edit Backlink')

@section('content')
<div class="page-header">
  <h1>Edit Backlink</h1>
  <a href="{{ route('admin.seo.backlinks.index') }}" class="btn btn-ghost">&larr; Back</a>
</div>

<div class="card" style="max-width:720px;">
  <form method="POST" action="{{ route('admin.seo.backlinks.update', $backlink) }}">
    @csrf @method('PUT')
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
      <div class="form-group">
        <label>Source URL *</label>
        <input type="url" name="source_url" value="{{ old('source_url', $backlink->source_url) }}" required>
      </div>
      <div class="form-group">
        <label>Target URL *</label>
        <input type="url" name="target_url" value="{{ old('target_url', $backlink->target_url) }}" required>
      </div>
    </div>
    <div class="form-group">
      <label>Anchor Text</label>
      <input type="text" name="anchor_text" value="{{ old('anchor_text', $backlink->anchor_text) }}">
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px;">
      <div class="form-group">
        <label>Link Type</label>
        <select name="link_type">
          @foreach(['dofollow', 'nofollow', 'sponsored', 'ugc'] as $type)
          <option value="{{ $type }}" {{ old('link_type', $backlink->link_type) === $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label>Domain Authority (0-100)</label>
        <input type="number" name="domain_authority" value="{{ old('domain_authority', $backlink->domain_authority) }}" min="0" max="100">
      </div>
      <div class="form-group">
        <label>Page Authority (0-100)</label>
        <input type="number" name="page_authority" value="{{ old('page_authority', $backlink->page_authority) }}" min="0" max="100">
      </div>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
      <div class="form-group">
        <label>First Seen</label>
        <input type="text" value="{{ $backlink->first_seen_at->format('M j, Y') }}" disabled style="opacity:0.6;">
      </div>
      <div class="form-group">
        <label>Last Seen</label>
        <input type="text" value="{{ $backlink->last_seen_at->format('M j, Y') }}" disabled style="opacity:0.6;">
      </div>
    </div>
    <div class="form-group">
      <label>Notes</label>
      <textarea name="notes">{{ old('notes', $backlink->notes) }}</textarea>
    </div>
    <div style="display:flex; gap:10px;">
      <button type="submit" class="btn btn-primary">Update Backlink</button>
      <a href="{{ route('admin.seo.backlinks.index') }}" class="btn btn-ghost">Cancel</a>
    </div>
  </form>
</div>
@endsection
