<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoBacklink extends Model
{
    protected $fillable = [
        'source_url', 'source_domain', 'target_url', 'anchor_text',
        'link_type', 'domain_authority', 'page_authority',
        'first_seen_at', 'last_seen_at', 'lost_at', 'notes', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'domain_authority' => 'integer',
            'page_authority' => 'integer',
            'first_seen_at' => 'date',
            'last_seen_at' => 'date',
            'lost_at' => 'date',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
