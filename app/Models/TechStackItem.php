<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechStackItem extends Model
{
    protected $fillable = ['order', 'name', 'is_published'];

    protected function casts(): array
    {
        return [
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
