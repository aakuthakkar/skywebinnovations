@extends('admin.layouts.app')
@section('title', 'Add Process Step')
@section('content')
<div class="page-header"><h1>Add Process Step</h1></div>
<div class="card" style="max-width:640px;">
  <form method="POST" action="{{ route('admin.process-steps.store') }}">
    @csrf
    <div class="form-group"><label>Number</label><input name="number" type="number" value="{{ old('number', 1) }}" required></div>
    <div class="form-group"><label>Title</label><input name="title" value="{{ old('title') }}" required></div>
    <div class="form-group"><label>Description</label><textarea name="description">{{ old('description') }}</textarea></div>
    <div class="form-group"><label>Order</label><input name="order" type="number" value="{{ old('order', 0) }}"></div>
    <button type="submit" class="btn btn-primary">Save Step</button>
    <a href="{{ route('admin.process-steps.index') }}" class="btn" style="margin-left:8px;">Cancel</a>
  </form>
</div>
@endsection
