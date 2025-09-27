<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habit extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'frequency',
        'target_value',
        'unit',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_habits')
            ->withPivot('current_streak', 'longest_streak', 'started_at', 'is_active')
            ->withTimestamps();
    }

    public function userHabits()
    {
        return $this->hasMany(UserHabit::class);
    }
}
