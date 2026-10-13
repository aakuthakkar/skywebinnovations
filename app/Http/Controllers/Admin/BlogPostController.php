<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::ordered()->paginate(20);
        return view('admin.blog-posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog-posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_posts,slug',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|string',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'og_image' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['is_published'] = $request->has('is_published');
        $validated['order'] = $validated['order'] ?? 0;

        if ($request->has('tags') && is_string($validated['tags'])) {
            $validated['tags'] = array_values(array_filter(array_map('trim', explode(',', $validated['tags']))));
        }

        if ($request->has('is_published') && !empty($validated['published_at'])) {
            $validated['published_at'] = $validated['published_at'];
        } elseif ($request->has('is_published') && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        BlogPost::create($validated);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post created successfully.');
    }

    public function edit(BlogPost $blogPost)
    {
        return view('admin.blog-posts.edit', compact('blogPost'));
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_posts,slug,' . $blogPost->id,
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|string',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'og_image' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
        ]);

        $validated['is_published'] = $request->has('is_published');
        $validated['order'] = $validated['order'] ?? 0;

        if ($request->has('tags') && is_string($validated['tags'])) {
            $validated['tags'] = array_values(array_filter(array_map('trim', explode(',', $validated['tags']))));
        }

        if ($request->has('is_published') && !empty($validated['published_at'])) {
            $validated['published_at'] = $validated['published_at'];
        } elseif ($request->has('is_published') && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $blogPost->update($validated);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();
        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post deleted successfully.');
    }
}
