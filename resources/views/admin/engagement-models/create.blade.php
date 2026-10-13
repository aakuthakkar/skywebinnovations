@extends('admin.layouts.app')
@section('title', 'Add Engagement Model')
@section('content')
<div class="page-header"><h1>Add Engagement Model</h1></div>
<div class="card" style="max-width:640px;">
  <form method="POST" action="{{ route('admin.engagement-models.store') }}">
    @csrf
    <div class="form-group"><label>Slug</label><input name="slug" value="{{ old('slug') }}" required placeholder="e.g. fixed-price"></div>
    <div class="form-group"><label>Name</label><input name="name" value="{{ old('name') }}" required></div>
    <div class="form-group"><label>Description</label><textarea name="description">{{ old('description') }}</textarea></div>
    <div class="form-group"><label>Best For</label><input name="best_for" value="{{ old('best_for') }}"></div>
    <div class="form-group"><label>Features <span style="font-size:12px; color:oklch(0.65 0.02 272);">(one per line)</span></label><textarea name="features">{{ old('features') }}</textarea></div>
    <div class="form-group"><label>Link Text</label><input name="link_text" value="{{ old('link_text') }}"></div>
    <div class="form-group">
      <label style="display:flex; align-items:center; gap:10px; cursor:pointer; margin-bottom:8px;">
        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} style="width:auto;"> Featured
      </label>
      <label style="display:flex; align-items:center; gap:10px; cursor:pointer;">
        <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }} style="width:auto;"> Published
      </label>
    </div>
    <div class="form-group"><label>Order</label><input name="order" type="number" value="{{ old('order', 0) }}"></div>
    <button type="submit" class="btn btn-primary">Save Model</button>
    <a href="{{ route('admin.engagement-models.index') }}" class="btn" style="margin-left:8px;">Cancel</a>
  </form>
</div>
@endsection
