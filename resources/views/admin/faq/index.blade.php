@extends('admin.layouts.app')
@section('title', 'FAQ')
@section('content')
<div class="page-header">
  <h1>FAQ Items</h1>
  <a href="{{ route('admin.faq.create') }}" class="btn btn-primary">+ Add FAQ</a>
</div>
<div class="card">
  <table>
    <thead><tr><th>Question</th><th>Published</th><th>Order</th><th>Actions</th></tr></thead>
    <tbody>
      @foreach($items as $faq)
      <tr>
        <td>{{ $faq->question }}</td>
        <td>@if($faq->is_published)<span class="badge badge-new">Yes</span>@else <span class="badge badge-closed">No</span> @endif</td>
        <td>{{ $faq->order }}</td>
        <td>
          <div class="actions">
            <a href="{{ route('admin.faq.edit', $faq) }}" class="btn btn-xs btn-edit">Edit</a>
            <form method="POST" action="{{ route('admin.faq.destroy', $faq) }}" onsubmit="return confirm('Delete?')" style="display:inline;">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-xs btn-delete">Delete</button>
            </form>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div style="margin-top:16px;">{{ $items->links() }}</div>
</div>
@endsection
