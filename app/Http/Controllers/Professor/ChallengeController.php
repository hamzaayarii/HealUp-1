<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Challenge;
use App\Services\ChallengeRecommender;
use Illuminate\Support\Facades\Auth;
use App\Models\UserRecommendation;


class ChallengeController extends Controller
{
    public function index(Request $request)
    {

        $query = Challenge::where('status', 'approved')
                         ->withCount('participations');
        

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%");
            });
        }
        
        $challenges = $query->latest()->paginate(12);

        $recommended = collect();

        // If the current user is authenticated and is a student, prefer model recommendations stored in DB
        if (Auth::check() && Auth::user()->isStudent()) {
            $userId = Auth::id();
            $modelRecs = UserRecommendation::where('user_id', $userId)
                ->orderByDesc('score')
                ->limit(6)
                ->pluck('challenge_id')
                ->all();

            if (!empty($modelRecs)) {
                $recommended = Challenge::whereIn('id', $modelRecs)
                    ->where('status', 'approved')
                    ->get()
                    ->sortByDesc(function($c) use ($modelRecs) {
                        return array_search($c->id, $modelRecs);
                    });
            } else {
                // Fallback to heuristic recommender
                $recommender = new ChallengeRecommender();
                $recommended = $recommender->recommendFor(Auth::user(), 6);
            }
        }

        return view('professor.challenges.index', compact('challenges', 'recommended'));
    }
}
