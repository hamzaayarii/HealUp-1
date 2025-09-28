<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'objectif',
        'duration',
        'reward',
        'start_date',
        'end_date',
        'is_active'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'participations')
            ->withPivot('joined_at', 'current_progress', 'completed', 'completed_at', 'points_earned')
            ->withTimestamps();
    }

    public function participations()
    {
        return $this->hasMany(Participation::class);
    }
}
