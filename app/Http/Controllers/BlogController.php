<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Setting;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use HasSeoSettings;

    public function index()
    {
        $posts = BlogPost::published()->paginate(10);

        $settings = $this->seoSettings([
            'meta_title' => Setting::get('blog_meta_title', 'Blog | Sky Web Innovations'),
            'meta_description' => Setting::get('blog_meta_description', 'Articles on web development, SaaS, custom software, and digital product engineering from Sky Web Innovations.'),
        ]);

        $services = \App\Models\Service::ordered()->get();
        $faqItems = \App\Models\FaqItem::published()->get();

        return view('blog.index', compact('posts', 'settings', 'services', 'faqItems'));
    }

    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)->published()->firstOrFail();

        $settings = $this->seoSettings([
            'meta_title' => $post->meta_title ?: ($post->title . ' | Sky Web Innovations'),
            'meta_description' => $post->meta_description ?: ($post->excerpt ?: Setting::get('meta_description', '')),
            'meta_image' => $post->og_image ?: Setting::get('meta_image', '/assets/og-image.jpg'),
        ]);

        $services = \App\Models\Service::ordered()->get();
        $faqItems = \App\Models\FaqItem::published()->get();

        $recentPosts = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('blog.show', compact('post', 'settings', 'recentPosts', 'services', 'faqItems'));
    }
}
