<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use App\Models\Participation;
use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

public function index()
{
    $currentParticipations = auth()->user()->challengeParticipations()
        ->with('challenge')
        ->whereHas('challenge', function ($query) {
            $query->where('end_date', '>', now());
        })
        ->get();

    $challengeStats = [
        'available' => Challenge::available()->count(),
        'in_progress' => $currentParticipations->count(),
        'completed' => auth()->user()->challengeParticipations()
            ->whereHas('challenge', function ($query) {
                $query->where('end_date', '<=', now());
            })->count()
    ];

    $recentBadges = auth()->user()->badges()
        ->latest('earned_at')
        ->take(5)
        ->get();

    return view('student.challenges.index', compact(
        'currentParticipations',
        'challengeStats',
        'recentBadges'
    ));
}

    public function progress()
    {
        $user = Auth::user();
        
        $participations = Participation::with('challenge')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('student.progress', compact('participations'));
    }
    public function dashboard()
{
    $user = Auth::user();
    
    // Challenges en cours
    $currentParticipations = Participation::with('challenge')
        ->where('user_id', $user->id)
        ->where('completed', false)
        ->whereHas('challenge', function($query) {
            $query->where('end_date', '>=', now());
        })
        ->get();

    // Badges récents
    $recentBadges = $user->badges()
        ->orderBy('user_badges.earned_at', 'desc')
        ->take(3)
        ->get();

    // Statistiques de base
    $stats = [
        'total_challenges' => Participation::where('user_id', $user->id)->count(),
        'completed_challenges' => Participation::where('user_id', $user->id)
            ->where('completed', true)
            ->count(),
        'total_points' => Participation::where('user_id', $user->id)
            ->sum('points_earned'),
        'current_challenges' => $currentParticipations->count(),
        'success_rate' => $this->calculateSuccessRate($user),
    ];

    // Statistiques pour les challenges (comme dans ChallengeController)
    $challengeStats = [
        'available' => Challenge::where('status', 'approved')
            ->where('end_date', '>=', now())
            ->whereDoesntHave('participations', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->count(),
        'in_progress' => $currentParticipations->count(),
        'completed' => $stats['completed_challenges'],
    ];

    // Challenges recommandés
    $recommendedChallenges = $this->getRecommendedChallenges($user);

    return view('student.dashboard', compact(
        'currentParticipations', 
        'stats', 
        'recentBadges',
        'recommendedChallenges',
        'challengeStats' // Ajout de cette variable
    ));
}

    public function badges()
{
    $user = Auth::user();
    
    // Utiliser le service BadgeService pour obtenir les données complètes
    $badgesData = \App\Services\BadgeService::getUserBadgesWithProgress($user);

    $stats = [
        'total_points' => $user->participations()->sum('points_earned'),
        'current_streak' => $user->getCurrentStreak(),
        'earned_badges_count' => collect($badgesData)->where('is_earned', true)->count(),
        'total_badges_count' => count($badgesData)
    ];

    return view('student.badges.index', compact('badgesData', 'stats'));
}
private function calculateSuccessRate($user)
{
    $totalChallenges = Participation::where('user_id', $user->id)->count();
    $completedChallenges = Participation::where('user_id', $user->id)
        ->where('completed', true)
        ->count();

    return $totalChallenges > 0 ? round(($completedChallenges / $totalChallenges) * 100) : 0;
}

private function getRecommendedChallenges($user)
{
    // Logique de recommandation basée sur les habitudes de l'utilisateur
    // Pour l'instant, retourner les challenges les plus populaires
    return Challenge::where('status', 'approved')
        ->where('end_date', '>=', now())
        ->whereDoesntHave('participations', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->withCount('participations')
        ->orderBy('participations_count', 'desc')
        ->take(3)
        ->get();
}
}