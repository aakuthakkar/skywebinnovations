@extends('admin.layouts.app')
@section('title', 'Projects')
@section('content')
<div class="page-header">
  <h1>Projects</h1>
  <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">+ Add Project</a>
</div>
<div class="card">
  <table>
    <thead><tr><th>Title</th><th>Category</th><th>Tags</th><th>Published</th><th>Actions</th></tr></thead>
    <tbody>
      @foreach($projects as $project)
      <tr>
        <td><strong>{{ $project->title }}</strong></td>
        <td>{{ $project->category }}</td>
        <td style="font-size:12px; color:oklch(0.65 0.02 272);">{{ Str::limit(implode(', ', $project->tags ?? []), 50) }}</td>
        <td>
          @if($project->is_published)
            <span class="badge badge-new">Yes</span>
          @else
            <span class="badge badge-closed">No</span>
          @endif
        </td>
        <td>
          <div class="actions">
            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-xs btn-edit">Edit</a>
            <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" onsubmit="return confirm('Delete?')" style="display:inline;">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-xs btn-delete">Delete</button>
            </form>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div style="margin-top:16px;">{{ $projects->links() }}</div>
</div>
@endsection
