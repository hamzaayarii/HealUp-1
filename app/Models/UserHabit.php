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
        'target_value',
        'unit',
        'current_streak',
        'longest_streak',
        'started_at',
        'is_active'
    ];

    protected $casts = [
        'started_at' => 'date',
        'is_active' => 'boolean',
        'target_value' => 'decimal:2',
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

    /**
     * Update the current streak for this habit
     */
    public function updateStreak()
    {
        $today = now()->toDateString();
        $currentStreak = 0;
        $checkDate = now();

        // Count consecutive days from today backwards
        while (true) {
            $progress = $this->dailyProgress()
                ->where('date', $checkDate->toDateString())
                ->where('completed', true)
                ->first();

            if ($progress) {
                $currentStreak++;
                $checkDate->subDay();
            } else {
                break;
            }
        }

        // Update streaks
        $this->current_streak = $currentStreak;
        if ($currentStreak > $this->longest_streak) {
            $this->longest_streak = $currentStreak;
        }

        $this->save();

        return $this;
    }
}
