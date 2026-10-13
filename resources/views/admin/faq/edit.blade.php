@extends('admin.layouts.app')
@section('title', 'Edit FAQ')
@section('content')
<div class="page-header"><h1>Edit FAQ</h1></div>
<div class="card" style="max-width:640px;">
  <form method="POST" action="{{ route('admin.faq.update', $faqItem) }}">
    @csrf
    @method('PUT')
    <div class="form-group"><label>Question</label><input name="question" value="{{ old('question', $faqItem->question) }}" required></div>
    <div class="form-group"><label>Answer</label><textarea name="answer">{{ old('answer', $faqItem->answer) }}</textarea></div>
    <div class="form-group"><label>Order</label><input name="order" type="number" value="{{ old('order', $faqItem->order) }}"></div>
    <div class="form-group">
      <label style="display:flex; align-items:center; gap:10px; cursor:pointer;">
        <input type="checkbox" name="is_published" value="1" {{ old('is_published', $faqItem->is_published) ? 'checked' : '' }} style="width:auto;"> Published
      </label>
    </div>
    <button type="submit" class="btn btn-primary">Update FAQ</button>
    <a href="{{ route('admin.faq.index') }}" class="btn" style="margin-left:8px;">Cancel</a>
  </form>
</div>
@endsection
