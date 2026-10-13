@extends('admin.layouts.app')
@section('title', 'Add Project')
@section('content')
<div class="page-header"><h1>Add Project</h1></div>
<div class="card" style="max-width:640px;">
  <form method="POST" action="{{ route('admin.projects.store') }}">
    @csrf
    <div class="form-group"><label>Title</label><input name="title" value="{{ old('title') }}" required></div>
    <div class="form-group"><label>Category</label><input name="category" value="{{ old('category') }}" required></div>
    <div class="form-group"><label>Description</label><textarea name="description">{{ old('description') }}</textarea></div>
    <div class="form-group"><label>Tags <span style="font-size:12px; color:oklch(0.65 0.02 272);">(one per line)</span></label><textarea name="tags">{{ old('tags') }}</textarea></div>
    <div class="form-group"><label>Shot Label</label><input name="shot_label" value="{{ old('shot_label') }}"></div>
    <div class="form-group"><label>Tint</label><input name="tint" value="{{ old('tint') }}" placeholder="e.g. violet, blue"></div>
    <div class="form-group"><label>Order</label><input name="order" type="number" value="{{ old('order', 0) }}"></div>
    <div class="form-group">
      <label style="display:flex; align-items:center; gap:10px; cursor:pointer;">
        <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }} style="width:auto;">
        Published
      </label>
    </div>
    <button type="submit" class="btn btn-primary">Save Project</button>
    <a href="{{ route('admin.projects.index') }}" class="btn" style="margin-left:8px;">Cancel</a>
  </form>
</div>
@endsection
