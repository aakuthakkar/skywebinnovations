<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EngagementModel extends Model
{
    protected $fillable = [
        'order', 'slug', 'name', 'description', 'best_for',
        'features', 'link_text', 'is_featured', 'is_published',
    ];

    protected function casts(): array
    {
        return [
            'features' => 'array',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'order' => 'integer',
        ];
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->ordered();
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('id');
    }
}
