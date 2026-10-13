<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'featured_image',
        'category', 'tags', 'is_published', 'published_at',
        'meta_title', 'meta_description', 'meta_keywords',
        'og_image', 'author_id', 'order',
    ];

    protected function casts(): array
    {
        return [
            'tags' => 'array',
            'is_published' => 'boolean',
            'published_at' => 'datetime',
            'order' => 'integer',
        ];
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->ordered();
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('published_at', 'desc')->orderBy('order')->orderBy('id');
    }

    public function scopeBySlug($query, string $slug)
    {
        return $query->where('slug', $slug);
    }

    public function getExcerptAttribute($value)
    {
        return $value ?: ($this->attributes['content'] ? strip_tags(str($this->attributes['content'])->limit(200)) : '');
    }
}
