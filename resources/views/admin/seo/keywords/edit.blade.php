@extends('admin.seo.layout')

@section('title', 'Edit Keyword')

@section('content')
<div class="page-header">
  <h1>Edit Keyword</h1>
  <a href="{{ route('admin.seo.keywords.index') }}" class="btn btn-ghost">&larr; Back</a>
</div>

<div class="card" style="max-width:720px;">
  <form method="POST" action="{{ route('admin.seo.keywords.update', $keyword) }}">
    @csrf @method('PUT')
    <div class="form-group">
      <label>Keyword *</label>
      <input type="text" name="keyword" value="{{ old('keyword', $keyword->keyword) }}" required>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
      <div class="form-group">
        <label>Target URL</label>
        <input type="url" name="target_url" value="{{ old('target_url', $keyword->target_url) }}">
      </div>
      <div class="form-group">
        <label>Search Intent</label>
        <select name="search_intent">
          @foreach(['informational', 'navigational', 'transactional', 'commercial'] as $intent)
          <option value="{{ $intent }}" {{ old('search_intent', $keyword->search_intent) === $intent ? 'selected' : '' }}>{{ ucfirst($intent) }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px;">
      <div class="form-group">
        <label>Search Volume</label>
        <input type="number" name="search_volume" value="{{ old('search_volume', $keyword->search_volume) }}" min="0">
      </div>
      <div class="form-group">
        <label>Difficulty (0-100)</label>
        <input type="number" name="difficulty" value="{{ old('difficulty', $keyword->difficulty) }}" min="0" max="100">
      </div>
      <div class="form-group">
        <label>CPC ($)</label>
        <input type="number" step="0.01" name="cpc" value="{{ old('cpc', $keyword->cpc) }}" min="0">
      </div>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
      <div class="form-group">
        <label>Current Position</label>
        <input type="number" name="current_position" value="{{ old('current_position', $keyword->current_position) }}" min="1" placeholder="e.g. 25">
      </div>
      <div class="form-group">
        <label>Target Position</label>
        <input type="number" name="target_position" value="{{ old('target_position', $keyword->target_position) }}" min="1">
      </div>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
      <div class="form-group">
        <label>Tracking Frequency</label>
        <select name="tracking_frequency">
          @foreach(['daily', 'weekly', 'monthly'] as $freq)
          <option value="{{ $freq }}" {{ old('tracking_frequency', $keyword->tracking_frequency) === $freq ? 'selected' : '' }}>{{ ucfirst($freq) }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label>Last Checked</label>
        <input type="text" value="{{ $keyword->last_checked_at?->format('M j, Y') ?? 'Never' }}" disabled style="opacity:0.6;">
      </div>
    </div>
    <div class="form-group">
      <label>Notes</label>
      <textarea name="notes">{{ old('notes', $keyword->notes) }}</textarea>
    </div>
    <div style="display:flex; gap:10px;">
      <button type="submit" class="btn btn-primary">Update Keyword</button>
      <a href="{{ route('admin.seo.keywords.index') }}" class="btn btn-ghost">Cancel</a>
    </div>
  </form>
</div>
@endsection
