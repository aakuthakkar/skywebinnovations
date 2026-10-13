@extends('admin.layouts.app')
@section('title', 'Process Steps')
@section('content')
<div class="page-header">
  <h1>Process Steps</h1>
  <a href="{{ route('admin.process-steps.create') }}" class="btn btn-primary">+ Add Step</a>
</div>
<div class="card">
  <table>
    <thead><tr><th>#</th><th>Title</th><th>Order</th><th>Actions</th></tr></thead>
    <tbody>
      @foreach($steps as $step)
      <tr>
        <td><strong>{{ $step->number }}</strong></td>
        <td>{{ $step->title }}</td>
        <td>{{ $step->order }}</td>
        <td>
          <div class="actions">
            <a href="{{ route('admin.process-steps.edit', $step) }}" class="btn btn-xs btn-edit">Edit</a>
            <form method="POST" action="{{ route('admin.process-steps.destroy', $step) }}" onsubmit="return confirm('Delete?')" style="display:inline;">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-xs btn-delete">Delete</button>
            </form>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div style="margin-top:16px;">{{ $steps->links() }}</div>
</div>
@endsection
