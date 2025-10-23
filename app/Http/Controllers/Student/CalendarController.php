<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Participation;
use App\Models\Challenge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index()
    {
        return view('student.calendar.index');
    }

    public function getEvents(Request $request)
{
    $user = Auth::user();
    $events = [];
    
    $participations = Participation::with('challenge')
        ->where('user_id', $user->id)
        ->whereHas('challenge', function($query) {
            $query->where('status', 'approved');
        })
        ->get();
    
    foreach ($participations as $participation) {
        if (!$participation->challenge) {
            continue;
        }
        
        // Événement principal du défi
        $events[] = [
            'id' => 'challenge_' . $participation->id,
            'title' => '🎯 ' . $participation->challenge->title,
            'start' => $participation->joined_at->format('Y-m-d'),
            'end' => $participation->joined_at->copy()
                ->addDays($participation->challenge->duration)
                ->format('Y-m-d'),
            'allDay' => true,
            'color' => '#3b82f6',
            'textColor' => '#ffffff',
            'display' => 'background',
            'extendedProps' => [
                'type' => 'challenge',
                'challenge_id' => $participation->challenge->id,
                'participation_id' => $participation->id,
                'progress' => $participation->current_progress
            ]
        ];
        
        // Ajouter les jours de check-in
        $checkinEvents = $participation->getCalendarEvents();
        $events = array_merge($events, $checkinEvents);
    }
    
    return response()->json($events);
}
    public function checkin(Request $request)
{
    try {
        $request->validate([
            'participation_id' => 'required|exists:participations,id',
            'date' => 'required|date'
        ]);
        
        $user = Auth::user();
        $participation = Participation::with('challenge')
            ->where('user_id', $user->id)
            ->where('id', $request->participation_id)
            ->firstOrFail();

        // Vérifier si le défi est toujours actif
        if ($participation->challenge->end_date < now()) {
            return response()->json([
                'success' => false,
                'message' => 'Ce défi est terminé!'
            ], 400);
        }

        // Vérifier si la date est dans la période du défi
        $checkinDate = \Carbon\Carbon::parse($request->date);
        $startDate = $participation->joined_at;
        $endDate = $participation->joined_at->copy()->addDays($participation->challenge->duration);
        
        if ($checkinDate < $startDate || $checkinDate > $endDate) {
            return response()->json([
                'success' => false,
                'message' => 'Date invalide pour ce défi!'
            ], 400);
        }

        // Utiliser la méthode checkIn du modèle
        if ($participation->checkIn($request->date)) {
            // Recharger le modèle pour avoir les données fraîches
            $participation->refresh();
            
            $response = [
                'success' => true,
                'message' => 'Check-in enregistré avec succès!',
                'progress' => $participation->current_progress,
                'checkin_count' => $participation->checkin_count,
                'completed' => $participation->completed
            ];

            // Vérifier si le défi vient d'être complété
            if ($participation->completed) {
                $response['challenge_completed'] = true;
                $response['challenge_title'] = $participation->challenge->title;
                $response['completion_message'] = "Félicitations! Vous avez complété le défi '{$participation->challenge->title}'! 🎉";
                
                // Vérifier les badges
                $newBadges = \App\Services\BadgeService::checkForNewBadges($user);
                if (!empty($newBadges)) {
                    $response['new_badges'] = $newBadges;
                }
            }

            return response()->json($response);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Check-in déjà effectué pour cette date!'
            ], 400);
        }

    } catch (\Exception $e) {
        \Log::error('Check-in error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Erreur lors du check-in: ' . $e->getMessage()
        ], 500);
    }
}
    public function getStats()
    {
        $user = Auth::user();
        
        $participations = Participation::with('challenge')
            ->where('user_id', $user->id)
            ->get();
        
        $totalCheckins = $participations->sum('checkin_count');
        $currentChallenges = $participations->where('completed', false)->count();
        $currentStreak = $this->calculateCurrentStreak($user);
        $totalPoints = $participations->sum('points_earned');
        
        return response()->json([
            'total_checkins' => $totalCheckins,
            'current_challenges' => $currentChallenges,
            'current_streak' => $currentStreak,
            'total_points' => $totalPoints
        ]);
    }
    
    private function calculateCurrentStreak($user)
    {
        $participations = Participation::where('user_id', $user->id)
            ->where('completed', false)
            ->get();
            
        $maxStreak = 0;
        $today = now()->format('Y-m-d');
        
        foreach ($participations as $participation) {
            $history = $participation->checkin_history ?? [];
            if (empty($history)) continue;
            
            sort($history);
            $currentStreak = 0;
            $checkDate = $today;
            
            // Vérifier les check-ins consécutifs en partant d'aujourd'hui
            for ($i = 0; $i < 30; $i++) {
                if (in_array($checkDate, $history)) {
                    $currentStreak++;
                    $checkDate = \Carbon\Carbon::parse($checkDate)->subDay()->format('Y-m-d');
                } else {
                    break;
                }
            }
            
            $maxStreak = max($maxStreak, $currentStreak);
        }
        
        return $maxStreak;
    }

    public function syncAllProgress()
    {
        $user = Auth::user();
        
        $participations = Participation::with('challenge')
            ->where('user_id', $user->id)
            ->where('completed', false)
            ->get();

        $updatedCount = 0;
        
        foreach ($participations as $participation) {
            $history = $participation->checkin_history ?? [];
            $progress = min(100, (count($history) / $participation->challenge->duration) * 100);
            $isCompleted = $progress >= 100;
            
            if ($participation->current_progress != $progress) {
                $participation->update([
                    'current_progress' => $progress,
                    'completed' => $isCompleted,
                    'completed_at' => $isCompleted ? now() : null,
                    'points_earned' => $isCompleted ? $participation->challenge->reward : 0
                ]);
                
                $updatedCount++;
                
                if ($isCompleted) {
                    \App\Services\BadgeService::checkForNewBadges($user);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => $updatedCount . ' défis synchronisés',
            'updated_count' => $updatedCount
        ]);
    }
}