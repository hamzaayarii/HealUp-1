<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'date',
        'location',
        'description',
        'max_participants',
        'current_participants',
        'is_active',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
