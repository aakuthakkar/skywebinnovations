@extends('admin.layouts.app')

@section('title', 'Create Blog Post')

@section('content')
<div class="page-header">
    <h1>Create New Blog Post</h1>
    <a href="{{ route('admin.blog-posts.index') }}" class="btn btn-primary" style="background:oklch(0.28 0.025 272);color:oklch(0.96 0.005 272);">&larr; Back</a>
</div>

<div class="card">
    <form method="POST" action="{{ route('admin.blog-posts.store') }}">
        @csrf

        <div class="form-group">
            <label>Post Title <span style="color:oklch(0.72 0.17 25);">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}" required placeholder="e.g. How to Choose the Right Tech Stack">
            @error('title')<p style="color:oklch(0.72 0.17 25);font-size:13px;margin-top:4px;">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
            <label>URL Slug <span style="color:oklch(0.72 0.17 25);">*</span></label>
            <input type="text" name="slug" value="{{ old('slug') }}" required placeholder="e.g. how-to-choose-tech-stack" oninput="this.value=this.value.toLowerCase().replace(/[^a-z0-9-]/g,'-').replace(/-+/g,'-').replace(/^-|-$/g,'')">
            @error('slug')<p style="color:oklch(0.72 0.17 25);font-size:13px;margin-top:4px;">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
            <label>Excerpt</label>
            <textarea name="excerpt" rows="3" placeholder="Short summary of the post..." maxlength="500">{{ old('excerpt') }}</textarea>
            @error('excerpt')<p style="color:oklch(0.72 0.17 25);font-size:13px;margin-top:4px;">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
            <label>Post Content <span style="color:oklch(0.72 0.17 25);">*</span></label>
            <textarea name="content" rows="16" required placeholder="Write your blog post content here (HTML is allowed)...">{{ old('content') }}</textarea>
            @error('content')<p style="color:oklch(0.72 0.17 25);font-size:13px;margin-top:4px;">{{ $message }}</p>@enderror
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">
            <div class="form-group">
                <label>Category</label>
                <input type="text" name="category" value="{{ old('category') }}" placeholder="e.g. Technology, Business, Tutorial">
                @error('category')<p style="color:oklch(0.72 0.17 25);font-size:13px;margin-top:4px;">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label>Tags (comma separated)</label>
                <input type="text" name="tags" value="{{ old('tags') }}" placeholder="Laravel, Web Development, Tutorial">
                @error('tags')<p style="color:oklch(0.72 0.17 25);font-size:13px;margin-top:4px;">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="form-group">
            <label>Featured Image URL</label>
            <input type="text" name="featured_image" value="{{ old('featured_image') }}" placeholder="/images/blog-hero.jpg">
            @error('featured_image')<p style="color:oklch(0.72 0.17 25);font-size:13px;margin-top:4px;">{{ $message }}</p>@enderror
        </div>

        <div style="border-top:1px solid oklch(0.24 0.025 272);margin:24px 0;padding-top:24px;">
            <h3 style="font-family:'JetBrains Mono',monospace;font-size:12px;text-transform:uppercase;color:oklch(0.65 0.02 272);letter-spacing:0.06em;margin-bottom:20px;">SEO Settings</h3>

            <div class="form-group">
                <label>Meta Title</label>
                <input type="text" name="meta_title" value="{{ old('meta_title') }}" placeholder="Custom SEO title">
                @error('meta_title')<p style="color:oklch(0.72 0.17 25);font-size:13px;margin-top:4px;">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label>Meta Description</label>
                <textarea name="meta_description" rows="3" placeholder="SEO meta description..." maxlength="500">{{ old('meta_description') }}</textarea>
                @error('meta_description')<p style="color:oklch(0.72 0.17 25);font-size:13px;margin-top:4px;">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label>Meta Keywords</label>
                <input type="text" name="meta_keywords" value="{{ old('meta_keywords') }}" placeholder="keyword1, keyword2, keyword3">
                @error('meta_keywords')<p style="color:oklch(0.72 0.17 25);font-size:13px;margin-top:4px;">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label>OG Image URL</label>
                <input type="text" name="og_image" value="{{ old('og_image') }}" placeholder="/images/og-image.jpg">
                @error('og_image')<p style="color:oklch(0.72 0.17 25);font-size:13px;margin-top:4px;">{{ $message }}</p>@enderror
            </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:24px;">
            <div class="form-group">
                <label>Display Order</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" min="0">
                @error('order')<p style="color:oklch(0.72 0.17 25);font-size:13px;margin-top:4px;">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label>Publication Date</label>
                <input type="date" name="published_at" value="{{ old('published_at') }}">
                @error('published_at')<p style="color:oklch(0.72 0.17 25);font-size:13px;margin-top:4px;">{{ $message }}</p>@enderror
            </div>

            <div class="form-group" style="display:flex;align-items:center;padding-top:28px;">
                <label style="display:flex;align-items:center;gap:10px;cursor:pointer;font-weight:400;">
                    <input type="checkbox" name="is_published" {{ old('is_published') ? 'checked' : '' }} style="width:auto;">
                    Publish immediately
                </label>
            </div>
        </div>

        <div style="display:flex;gap:12px;margin-top:24px;">
            <button type="submit" class="btn btn-primary">Create Post</button>
            <a href="{{ route('admin.blog-posts.index') }}" class="btn" style="background:oklch(0.28 0.025 272);color:oklch(0.96 0.005 272);">Cancel</a>
        </div>
    </form>
</div>
@endsection
