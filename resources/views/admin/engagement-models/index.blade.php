@extends('admin.layouts.app')
@section('title', 'Engagement Models')
@section('content')
<div class="page-header">
  <h1>Engagement Models</h1>
  <a href="{{ route('admin.engagement-models.create') }}" class="btn btn-primary">+ Add Model</a>
</div>
<div class="card">
  <table>
    <thead><tr><th>Slug</th><th>Name</th><th>Featured</th><th>Published</th><th>Order</th><th>Actions</th></tr></thead>
    <tbody>
      @foreach($models as $model)
      <tr>
        <td style="font-family:'JetBrains Mono',monospace; font-size:12px; color:oklch(0.65 0.02 272);">{{ $model->slug }}</td>
        <td><strong>{{ $model->name }}</strong></td>
        <td>@if($model->is_featured)<span class="badge badge-new">Yes</span>@else <span class="badge badge-closed">No</span> @endif</td>
        <td>@if($model->is_published)<span class="badge badge-new">Yes</span>@else <span class="badge badge-closed">No</span> @endif</td>
        <td>{{ $model->order }}</td>
        <td>
          <div class="actions">
            <a href="{{ route('admin.engagement-models.edit', $model) }}" class="btn btn-xs btn-edit">Edit</a>
            <form method="POST" action="{{ route('admin.engagement-models.destroy', $model) }}" onsubmit="return confirm('Delete?')" style="display:inline;">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-xs btn-delete">Delete</button>
            </form>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div style="margin-top:16px;">{{ $models->links() }}</div>
</div>
@endsection
