<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SeoKeyword extends Model
{
    protected $fillable = [
        'keyword', 'target_url', 'search_intent', 'search_volume', 'difficulty', 'cpc',
        'current_position', 'target_position', 'previous_position',
        'first_tracked_at', 'last_checked_at', 'tracking_frequency', 'notes', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'current_position' => 'integer',
            'target_position' => 'integer',
            'previous_position' => 'integer',
            'search_volume' => 'integer',
            'difficulty' => 'integer',
            'cpc' => 'decimal:2',
            'first_tracked_at' => 'date',
            'last_checked_at' => 'date',
        ];
    }

    public function rankings(): HasMany
    {
        return $this->hasMany(SeoKeywordRanking::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getTrendAttribute(): string
    {
        if ($this->current_position && $this->previous_position) {
            if ($this->current_position < $this->previous_position) return 'up';
            if ($this->current_position > $this->previous_position) return 'down';
        }
        return 'stable';
    }
}
