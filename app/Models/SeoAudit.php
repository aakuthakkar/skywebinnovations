<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoAudit extends Model
{
    protected $fillable = [
        'name', 'description', 'status', 'score', 'results', 'issues',
        'summary', 'started_at', 'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'score' => 'integer',
            'results' => 'array',
            'issues' => 'array',
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }
}
