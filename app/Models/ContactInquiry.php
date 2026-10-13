<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInquiry extends Model
{
    protected $fillable = ['name', 'email', 'project_type', 'message', 'status', 'ip_address'];

    protected function casts(): array
    {
        return [];
    }

    public function scopeNew($query)
    {
        return $query->where('status', 'new')->latest();
    }
}
