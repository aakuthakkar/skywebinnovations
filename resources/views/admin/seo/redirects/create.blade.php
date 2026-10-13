@extends('admin.seo.layout')

@section('title', 'Add Redirect')

@section('content')
<div class="page-header">
  <h1>Add Redirect</h1>
  <a href="{{ route('admin.seo.redirects.index') }}" class="btn btn-ghost">&larr; Back</a>
</div>

<div class="card" style="max-width:720px;">
  <form method="POST" action="{{ route('admin.seo.redirects.store') }}">
    @csrf
    <div class="form-group">
      <label>Source Path *</label>
      <input type="text" name="source_path" value="{{ old('source_path') }}" required placeholder="/old-page-url">
      <p style="font-size:12px; color:oklch(0.62 0.015 272); margin-top:4px;">Enter the path that should redirect (e.g. /old-service or /blog/old-post)</p>
    </div>
    <div class="form-group">
      <label>Target Path *</label>
      <input type="text" name="target_path" value="{{ old('target_path') }}" required placeholder="/new-page-url">
      <p style="font-size:12px; color:oklch(0.62 0.015 272); margin-top:4px;">Enter the destination URL path or full URL</p>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
      <div class="form-group">
        <label>Redirect Type</label>
        <select name="type">
          <option value="301">301 — Permanent Redirect (recommended)</option>
          <option value="302">302 — Temporary Redirect</option>
          <option value="307">307 — Temporary (preserves method)</option>
        </select>
      </div>
      <div class="form-group">
        <label>Source Host (optional)</label>
        <input type="url" name="source_host" value="{{ old('source_host') }}" placeholder="https://old-domain.com">
        <p style="font-size:12px; color:oklch(0.62 0.015 272); margin-top:4px;">Only if redirecting from a different domain</p>
      </div>
    </div>
    <div class="form-group">
      <label>Notes</label>
      <textarea name="notes" placeholder="Why was this redirect created?">{{ old('notes') }}</textarea>
    </div>
    <div style="display:flex; gap:10px;">
      <button type="submit" class="btn btn-primary">Save Redirect</button>
      <a href="{{ route('admin.seo.redirects.index') }}" class="btn btn-ghost">Cancel</a>
    </div>
  </form>
</div>
@endsection
