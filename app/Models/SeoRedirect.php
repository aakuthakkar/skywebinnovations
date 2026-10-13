<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoRedirect extends Model
{
    protected $fillable = [
        'source_path', 'target_path', 'type', 'source_host', 'notes', 'is_active', 'hit_count',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'hit_count' => 'integer',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
