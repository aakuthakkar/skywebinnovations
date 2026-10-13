@extends('admin.layouts.app')

@section('title', 'Pages')

@section('content')
<div class="page-header">
    <h1>Pages</h1>
    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">+ New Page</a>
</div>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Order</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pages as $page)
            <tr>
                <td>{{ $page->title }}</td>
                <td style="font-family:'JetBrains Mono',monospace;font-size:13px;color:oklch(0.65 0.02 272);">/{{ $page->slug }}</td>
                <td>
                    @if($page->is_published)
                        <span class="badge badge-new">Published</span>
                    @else
                        <span class="badge badge-closed">Draft</span>
                    @endif
                </td>
                <td>{{ $page->order }}</td>
                <td class="actions">
                    <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-xs btn-edit">Edit</a>
                    <form method="POST" action="{{ route('admin.pages.destroy', $page) }}" style="display:inline;" onsubmit="return confirm('Delete this page? This action cannot be undone.');">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-xs btn-delete" style="border:none;cursor:pointer;">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center;color:oklch(0.65 0.02 272);">No pages yet. Create your first page.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $pages->links() }}
@endsection
