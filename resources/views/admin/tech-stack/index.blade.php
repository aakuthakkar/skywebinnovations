@extends('admin.layouts.app')
@section('title', 'Tech Stack')
@section('content')
<div class="page-header">
  <h1>Tech Stack</h1>
  <a href="{{ route('admin.tech-stack.create') }}" class="btn btn-primary">+ Add Item</a>
</div>
<div class="card">
  <table>
    <thead><tr><th>Name</th><th>Published</th><th>Order</th><th>Actions</th></tr></thead>
    <tbody>
      @foreach($items as $item)
      <tr>
        <td><strong>{{ $item->name }}</strong></td>
        <td>@if($item->is_published)<span class="badge badge-new">Yes</span>@else <span class="badge badge-closed">No</span> @endif</td>
        <td>{{ $item->order }}</td>
        <td>
          <div class="actions">
            <a href="{{ route('admin.tech-stack.edit', $item) }}" class="btn btn-xs btn-edit">Edit</a>
            <form method="POST" action="{{ route('admin.tech-stack.destroy', $item) }}" onsubmit="return confirm('Delete?')" style="display:inline;">
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
