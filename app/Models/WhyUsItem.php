<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyUsItem extends Model
{
    protected $fillable = ['order', 'number', 'title', 'description'];

    protected function casts(): array
    {
        return [
            'order' => 'integer',
        ];
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('id');
    }
}
