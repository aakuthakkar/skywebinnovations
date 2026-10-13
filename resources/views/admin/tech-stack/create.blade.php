@extends('admin.layouts.app')
@section('title', 'Add Tech Stack Item')
@section('content')
<div class="page-header"><h1>Add Tech Stack Item</h1></div>
<div class="card" style="max-width:640px;">
  <form method="POST" action="{{ route('admin.tech-stack.store') }}">
    @csrf
    <div class="form-group"><label>Name</label><input name="name" value="{{ old('name') }}" required></div>
    <div class="form-group"><label>Order</label><input name="order" type="number" value="{{ old('order', 0) }}"></div>
    <div class="form-group">
      <label style="display:flex; align-items:center; gap:10px; cursor:pointer;">
        <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }} style="width:auto;"> Published
      </label>
    </div>
    <button type="submit" class="btn btn-primary">Save Item</button>
    <a href="{{ route('admin.tech-stack.index') }}" class="btn" style="margin-left:8px;">Cancel</a>
  </form>
</div>
@endsection
