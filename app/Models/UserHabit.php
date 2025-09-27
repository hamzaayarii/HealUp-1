<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHabit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'habit_id',
        'current_streak',
        'longest_streak',
        'started_at',
        'is_active'
    ];

    protected $casts = [
        'started_at' => 'date',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function habit()
    {
        return $this->belongsTo(Habit::class);
    }

    public function dailyProgress()
    {
        return $this->hasMany(DailyProgress::class);
    }
}
