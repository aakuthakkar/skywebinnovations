@extends('admin.layouts.app')
@section('title', 'Why Us')
@section('content')
<div class="page-header">
  <h1>Why Us Items</h1>
  <a href="{{ route('admin.why-us.create') }}" class="btn btn-primary">+ Add Item</a>
</div>
<div class="card">
  <table>
    <thead><tr><th>#</th><th>Title</th><th>Order</th><th>Actions</th></tr></thead>
    <tbody>
      @foreach($items as $item)
      <tr>
        <td><strong>{{ $item->number }}</strong></td>
        <td>{{ $item->title }}</td>
        <td>{{ $item->order }}</td>
        <td>
          <div class="actions">
            <a href="{{ route('admin.why-us.edit', $item) }}" class="btn btn-xs btn-edit">Edit</a>
            <form method="POST" action="{{ route('admin.why-us.destroy', $item) }}" onsubmit="return confirm('Delete?')" style="display:inline;">
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
