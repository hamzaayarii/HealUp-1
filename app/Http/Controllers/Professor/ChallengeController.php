<?php

namespace App\Http\Controllers\Professor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Challenge;


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
        
        return view('professor.challenges.index', compact('challenges'));
    }
}
