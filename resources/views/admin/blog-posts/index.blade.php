@extends('admin.layouts.app')

@section('title', 'Blog Posts')

@section('content')
<div class="page-header">
    <h1>Blog Posts</h1>
    <a href="{{ route('admin.blog-posts.create') }}" class="btn btn-primary">+ New Post</a>
</div>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Published</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
            <tr>
                <td>
                    <strong>{{ $post->title }}</strong>
                    <br><span style="font-family:'JetBrains Mono',monospace;font-size:12px;color:oklch(0.65 0.02 272);">/{{ $post->slug }}</span>
                </td>
                <td>{{ $post->category ?? '—' }}</td>
                <td>
                    @if($post->is_published)
                        <span class="badge badge-new">Published</span>
                    @else
                        <span class="badge badge-closed">Draft</span>
                    @endif
                </td>
                <td>{{ $post->published_at ? $post->published_at->format('M d, Y') : '—' }}</td>
                <td class="actions">
                    <a href="{{ route('admin.blog-posts.edit', $post) }}" class="btn btn-xs btn-edit">Edit</a>
                    <form method="POST" action="{{ route('admin.blog-posts.destroy', $post) }}" style="display:inline;" onsubmit="return confirm('Delete this blog post? This action cannot be undone.');">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-xs btn-delete" style="border:none;cursor:pointer;">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center;color:oklch(0.65 0.02 272);">No blog posts yet. Create your first post.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $posts->links() }}
@endsection
