<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_habit_id',
        'date',
        'value',
        'completed',
        'notes'
    ];

    protected $casts = [
        'date' => 'date',
        'completed' => 'boolean',
        'value' => 'decimal:2',
    ];

    // Relationships
    public function userHabit()
    {
        return $this->belongsTo(UserHabit::class);
    }
}
