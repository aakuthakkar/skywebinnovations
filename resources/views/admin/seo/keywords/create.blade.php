@extends('admin.seo.layout')

@section('title', 'Add Keyword')

@section('content')
<div class="page-header">
  <h1>Add Keyword</h1>
  <a href="{{ route('admin.seo.keywords.index') }}" class="btn btn-ghost">&larr; Back</a>
</div>

<div class="card" style="max-width:720px;">
  <form method="POST" action="{{ route('admin.seo.keywords.store') }}">
    @csrf
    <div class="form-group">
      <label>Keyword *</label>
      <input type="text" name="keyword" value="{{ old('keyword') }}" required placeholder="e.g. best web development company" autofocus>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
      <div class="form-group">
        <label>Target URL</label>
        <input type="url" name="target_url" value="{{ old('target_url') }}" placeholder="https://skywebinnovations.com/services">
      </div>
      <div class="form-group">
        <label>Search Intent</label>
        <select name="search_intent">
          <option value="informational" {{ old('search_intent') === 'informational' ? 'selected' : '' }}>Informational</option>
          <option value="navigational" {{ old('search_intent') === 'navigational' ? 'selected' : '' }}>Navigational</option>
          <option value="transactional" {{ old('search_intent') === 'transactional' ? 'selected' : '' }}>Transactional</option>
          <option value="commercial" {{ old('search_intent') === 'commercial' ? 'selected' : '' }}>Commercial</option>
        </select>
      </div>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px;">
      <div class="form-group">
        <label>Search Volume</label>
        <input type="number" name="search_volume" value="{{ old('search_volume') }}" placeholder="e.g. 1200" min="0">
      </div>
      <div class="form-group">
        <label>Difficulty (0-100)</label>
        <input type="number" name="difficulty" value="{{ old('difficulty') }}" placeholder="e.g. 45" min="0" max="100">
      </div>
      <div class="form-group">
        <label>CPC ($)</label>
        <input type="number" step="0.01" name="cpc" value="{{ old('cpc') }}" placeholder="e.g. 2.50" min="0">
      </div>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
      <div class="form-group">
        <label>Target Position</label>
        <input type="number" name="target_position" value="{{ old('target_position') }}" placeholder="e.g. 1" min="1">
      </div>
      <div class="form-group">
        <label>Current Position (if known)</label>
        <input type="number" name="current_position" value="{{ old('current_position') }}" placeholder="e.g. 25" min="1">
      </div>
    </div>
    <div class="form-group">
      <label>Check Frequency</label>
      <select name="tracking_frequency">
        <option value="daily">Daily</option>
        <option value="weekly" selected>Weekly</option>
        <option value="monthly">Monthly</option>
      </select>
    </div>
    <div class="form-group">
      <label>Notes</label>
      <textarea name="notes" placeholder="Any additional notes...">{{ old('notes') }}</textarea>
    </div>
    <div style="display:flex; gap:10px;">
      <button type="submit" class="btn btn-primary">Save Keyword</button>
      <a href="{{ route('admin.seo.keywords.index') }}" class="btn btn-ghost">Cancel</a>
    </div>
  </form>
</div>
@endsection
