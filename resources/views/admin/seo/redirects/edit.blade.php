@extends('admin.seo.layout')

@section('title', 'Edit Redirect')

@section('content')
<div class="page-header">
  <h1>Edit Redirect</h1>
  <a href="{{ route('admin.seo.redirects.index') }}" class="btn btn-ghost">&larr; Back</a>
</div>

<div class="card" style="max-width:720px;">
  <form method="POST" action="{{ route('admin.seo.redirects.update', $redirect) }}">
    @csrf @method('PUT')
    <div class="form-group">
      <label>Source Path *</label>
      <input type="text" name="source_path" value="{{ old('source_path', $redirect->source_path) }}" required>
    </div>
    <div class="form-group">
      <label>Target Path *</label>
      <input type="text" name="target_path" value="{{ old('target_path', $redirect->target_path) }}" required>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
      <div class="form-group">
        <label>Redirect Type</label>
        <select name="type">
          @foreach(['301', '302', '307'] as $type)
          <option value="{{ $type }}" {{ old('type', $redirect->type) === $type ? 'selected' : '' }}>{{ $type }} — {{ $type === '301' ? 'Permanent' : ($type === '302' ? 'Temporary' : 'Temporary (preserves method)') }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label>Source Host</label>
        <input type="url" name="source_host" value="{{ old('source_host', $redirect->source_host) }}">
      </div>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
      <div class="form-group">
        <label>Hit Count</label>
        <input type="text" value="{{ number_format($redirect->hit_count) }}" disabled style="opacity:0.6;">
      </div>
      <div class="form-group">
        <label>Active</label>
        <select name="is_active">
          <option value="1" {{ old('is_active', $redirect->is_active) ? 'selected' : '' }}>Yes</option>
          <option value="0" {{ !old('is_active', $redirect->is_active) ? 'selected' : '' }}>No</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label>Notes</label>
      <textarea name="notes">{{ old('notes', $redirect->notes) }}</textarea>
    </div>
    <div style="display:flex; gap:10px;">
      <button type="submit" class="btn btn-primary">Update Redirect</button>
      <a href="{{ route('admin.seo.redirects.index') }}" class="btn btn-ghost">Cancel</a>
    </div>
  </form>
</div>
@endsection
