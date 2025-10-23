<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'challenge_id',
        'joined_at',
        'current_progress',
        'completed',
        'completed_at',
        'points_earned',
        'checkin_count',
        'checkin_history',
        'last_checkin'
    ];

    protected $casts = [
        'joined_at' => 'datetime',
        'checkin_history' => 'array',
        'completed' => 'boolean',
        'completed_at' => 'datetime',
        'last_checkin' => 'datetime',
        'current_progress' => 'float',
        'points_earned' => 'integer',
        'checkin_count' => 'integer'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    public function getCalendarEvents()
    {
        $events = [];
        $startDate = $this->joined_at;
        $history = $this->checkin_history ?? [];
        
        for ($day = 1; $day <= $this->challenge->duration; $day++) {
            $eventDate = $startDate->copy()->addDays($day - 1);
            $dateStr = $eventDate->format('Y-m-d');
            $isChecked = in_array($dateStr, $history);
            
            $events[] = [
                'id' => 'checkin_' . $this->id . '_' . $day,
                'title' => 'Jour ' . $day,
                'start' => $dateStr,
                'allDay' => true,
                'color' => $isChecked ? '#10b981' : '#f59e0b',
                'textColor' => '#ffffff',
                'extendedProps' => [
                    'type' => 'checkin',
                    'challenge_id' => $this->challenge->id,
                    'participation_id' => $this->id,
                    'day' => $day,
                    'checked' => $isChecked,
                    'progress' => $this->current_progress
                ]
            ];
        }
        
        return $events;
    }

    public function isDateChecked($date)
    {
        $history = $this->checkin_history ?? [];
        $dateStr = $date->format('Y-m-d');
        return in_array($dateStr, $history);
    }

    public function checkIn($date = null)
    {
        $today = $date ? \Carbon\Carbon::parse($date)->format('Y-m-d') : now()->format('Y-m-d');
        $history = $this->checkin_history ?? [];
        
        if (!in_array($today, $history)) {
            // Ajouter la date à l'historique
            $history[] = $today;
            sort($history);
            
            // Mettre à jour les propriétés
            $this->checkin_history = $history;
            $this->checkin_count = count($history);
            $this->last_checkin = now();
            
            // Calculer la progression
            $progress = min(100, ($this->checkin_count / $this->challenge->duration) * 100);
            $this->current_progress = $progress;
            
            // Vérifier si le défi est complété
            if ($progress >= 100) {
                $this->completed = true;
                $this->completed_at = now();
                $this->points_earned = $this->challenge->reward;
            }
            
            // Sauvegarder les changements
            $this->save();
            return true;
        }
        
        return false;
    }
}