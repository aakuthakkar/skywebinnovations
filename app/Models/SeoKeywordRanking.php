<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeoKeywordRanking extends Model
{
    protected $fillable = [
        'seo_keyword_id', 'position', 'search_engine', 'url', 'search_volume_snapshot', 'checked_at',
    ];

    protected function casts(): array
    {
        return [
            'position' => 'integer',
            'checked_at' => 'date',
        ];
    }

    public function keyword(): BelongsTo
    {
        return $this->belongsTo(SeoKeyword::class);
    }
}
