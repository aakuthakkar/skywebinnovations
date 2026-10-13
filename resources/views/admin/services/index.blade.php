@extends('admin.layouts.app')
@section('title', 'Services')
@section('content')
<div class="page-header">
  <h1>Services</h1>
  <a href="{{ route('admin.services.create') }}" class="btn btn-primary">+ Add Service</a>
</div>
<div class="card">
  <table>
    <thead><tr><th>Order</th><th>Name</th><th>Slug</th><th>Description</th><th>Actions</th></tr></thead>
    <tbody>
      @foreach($services as $service)
      <tr>
        <td>{{ $service->order }}</td>
        <td><strong>{{ $service->name }}</strong></td>
        <td style="font-family:'JetBrains Mono',monospace; font-size:12px; color:oklch(0.65 0.02 272);">{{ $service->slug }}</td>
        <td>{{ Str::limit($service->description, 60) }}</td>
        <td><div class="actions"><a href="{{ route('admin.services.edit', $service) }}" class="btn btn-xs btn-edit">Edit</a><form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Delete?')" style="display:inline;">@csrf @method('DELETE')<button type="submit" class="btn btn-xs btn-delete">Delete</button></form></div></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div style="margin-top:16px;">{{ $services->links() }}</div>
</div>
@endsection
