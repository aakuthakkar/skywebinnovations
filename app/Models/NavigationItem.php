<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavigationItem extends Model
{
    protected $fillable = [
        'label', 'url', 'location', 'parent_id', 'order', 'is_active', 'target_blank',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'target_blank' => 'boolean',
            'order' => 'integer',
            'parent_id' => 'integer',
        ];
    }

    public function scopeHeader($query)
    {
        return $query->where('location', 'header')->where('is_active', true)->ordered();
    }

    public function scopeFooter($query)
    {
        return $query->where('location', 'footer')->where('is_active', true)->ordered();
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('id');
    }
}
