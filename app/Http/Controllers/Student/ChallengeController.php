<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Services\RecommendationService;
use App\Models\Challenge;
use App\Models\Participation;
use App\Services\BadgeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChallengeController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Recherche et filtres existants
        $query = Challenge::where('status', 'approved')
            ->where('end_date', '>=', now())
            ->whereDoesntHave('participations', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->with(['creator', 'participations'])
            ->withCount(['participations as current_participants_count']);

        // Filtres existants...
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('duration') && $request->duration != '') {
            $query->where('duration', '<=', $request->duration);
        }

        if ($request->has('reward') && $request->reward != '') {
            $query->where('reward', '>=', $request->reward);
        }

        $availableChallenges = $query->orderBy('end_date', 'asc')->paginate(9);

        // Challenges en cours avec progression
        $currentChallenges = Participation::with(['challenge' => function($query) {
                $query->where('end_date', '>=', now());
            }])
            ->where('user_id', $user->id)
            ->where('completed', false)
            ->get()
            ->filter(function($participation) {
                return $participation->challenge !== null;
            });

        // Statistiques pour le header
        $challengeStats = [
            'available' => $availableChallenges->total(),
            'in_progress' => $currentChallenges->count(),
            'completed' => Participation::where('user_id', $user->id)
                ->where('completed', true)
                ->count(),
        ];

        // NOUVEAU: Récupérer les recommandations IA
        $recommendedChallenges = RecommendationService::getRecommendedChallenges($user, 6);
        $recommendationExplanation = RecommendationService::getRecommendationExplanation($user);

        return view('student.challenges.index', compact(
            'availableChallenges', 
            'currentChallenges', 
            'challengeStats',
            'recommendedChallenges', // NOUVEAU
            'recommendationExplanation' // NOUVEAU
        ));
    
    }

    public function join(Challenge $challenge)
    {
        $user = Auth::user();

        // Vérifier si le challenge est encore actif
        if ($challenge->end_date < now()) {
            return redirect()->back()->with('error', 'Ce challenge est terminé!');
        }

        // Vérifier si l'étudiant participe déjà
        $existingParticipation = Participation::where('user_id', $user->id)
            ->where('challenge_id', $challenge->id)
            ->first();

        if ($existingParticipation) {
            return redirect()->back()->with('error', 'Vous participez déjà à ce défi!');
        }

        DB::transaction(function () use ($user, $challenge) {
            $participation = Participation::create([
                'user_id' => $user->id,
                'challenge_id' => $challenge->id,
                'joined_at' => now(),
                'current_progress' => 0,
                'completed' => false,
                'points_earned' => 0,
                'checkin_count' => 0,
                'checkin_history' => []
            ]);

            // Vérifier les badges après la création
            BadgeService::checkForNewBadges($user);
        });

        return redirect()->back()->with('success', 'Vous avez rejoint le défi avec succès!');
    }

    

    public function leave(Challenge $challenge)
    {
        $participation = Participation::where('user_id', Auth::id())
            ->where('challenge_id', $challenge->id)
            ->firstOrFail();

        $participation->delete();

        return redirect()->back()->with('success', 'Vous avez quitté le défi.');
    }
}