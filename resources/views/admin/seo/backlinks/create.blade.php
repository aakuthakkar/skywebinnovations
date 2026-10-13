@extends('admin.seo.layout')

@section('title', 'Add Backlink')

@section('content')
<div class="page-header">
  <h1>Add Backlink</h1>
  <a href="{{ route('admin.seo.backlinks.index') }}" class="btn btn-ghost">&larr; Back</a>
</div>

<div class="card" style="max-width:720px;">
  <form method="POST" action="{{ route('admin.seo.backlinks.store') }}">
    @csrf
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
      <div class="form-group">
        <label>Source URL *</label>
        <input type="url" name="source_url" value="{{ old('source_url') }}" required placeholder="https://example.com/page-link">
      </div>
      <div class="form-group">
        <label>Target URL *</label>
        <input type="url" name="target_url" value="{{ old('target_url') }}" required placeholder="https://skywebinnovations.com/page">
      </div>
    </div>
    <div class="form-group">
      <label>Anchor Text</label>
      <input type="text" name="anchor_text" value="{{ old('anchor_text') }}" placeholder="e.g. best web development company">
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px;">
      <div class="form-group">
        <label>Link Type</label>
        <select name="link_type">
          <option value="dofollow">Dofollow</option>
          <option value="nofollow">Nofollow</option>
          <option value="sponsored">Sponsored</option>
          <option value="ugc">UGC</option>
        </select>
      </div>
      <div class="form-group">
        <label>Domain Authority (0-100)</label>
        <input type="number" name="domain_authority" value="{{ old('domain_authority') }}" min="0" max="100">
      </div>
      <div class="form-group">
        <label>Page Authority (0-100)</label>
        <input type="number" name="page_authority" value="{{ old('page_authority') }}" min="0" max="100">
      </div>
    </div>
    <div class="form-group">
      <label>Notes</label>
      <textarea name="notes" placeholder="How was this backlink acquired? Any context...">{{ old('notes') }}</textarea>
    </div>
    <div style="display:flex; gap:10px;">
      <button type="submit" class="btn btn-primary">Save Backlink</button>
      <a href="{{ route('admin.seo.backlinks.index') }}" class="btn btn-ghost">Cancel</a>
    </div>
  </form>
</div>
@endsection
