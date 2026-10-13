@extends('admin.layouts.app')
@section('title', 'Add Service')
@section('content')
<div class="page-header"><h1>Add Service</h1></div>
<div class="card" style="max-width:640px;">
  <form method="POST" action="{{ route('admin.services.store') }}">
    @csrf
    <div class="form-group"><label>Name</label><input name="name" value="{{ old('name') }}" required></div>
    <div class="form-group"><label>Slug</label><input name="slug" value="{{ old('slug') }}" required placeholder="e.g. web-development"></div>
    <div class="form-group"><label>Description</label><textarea name="description">{{ old('description') }}</textarea></div>
    <div class="form-group"><label>Order</label><input name="order" type="number" value="{{ old('order', 0) }}"></div>
    <button type="submit" class="btn btn-primary">Save Service</button>
    <a href="{{ route('admin.services.index') }}" class="btn" style="margin-left:8px;">Cancel</a>
  </form>
</div>
@endsection
