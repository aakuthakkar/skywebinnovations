@extends('admin.layouts.app')
@section('title', 'Edit Why Us Item')
@section('content')
<div class="page-header"><h1>Edit Why Us Item</h1></div>
<div class="card" style="max-width:640px;">
  <form method="POST" action="{{ route('admin.why-us.update', $item) }}">
    @csrf
    @method('PUT')
    <div class="form-group"><label>Number</label><input name="number" type="number" value="{{ old('number', $item->number) }}" required></div>
    <div class="form-group"><label>Title</label><input name="title" value="{{ old('title', $item->title) }}" required></div>
    <div class="form-group"><label>Description</label><textarea name="description">{{ old('description', $item->description) }}</textarea></div>
    <div class="form-group"><label>Order</label><input name="order" type="number" value="{{ old('order', $item->order) }}"></div>
    <button type="submit" class="btn btn-primary">Update Item</button>
    <a href="{{ route('admin.why-us.index') }}" class="btn" style="margin-left:8px;">Cancel</a>
  </form>
</div>
@endsection
