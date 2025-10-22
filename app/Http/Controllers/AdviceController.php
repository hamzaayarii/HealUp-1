<?php

namespace App\Http\Controllers;

use App\Models\Advice;
use App\Models\ChatSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\UserHabit;
use App\Models\Repas;
use App\Models\Habit;

class AdviceController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Manual advices
        $advices = Advice::where('user_id', $user->id)->latest()->get();

        // Chat sessions
        $chatSessions = ChatSession::where('user_id', $user->id)
            ->with('advice')
            ->latest()
            ->get();

        // Get user habits
        $userHabits = UserHabit::with('habit')->where('user_id', $user->id)->get();

        // Get today's repas
        $today = now()->toDateString();
        $repas = Repas::where('user_id', $user->id)
                    ->whereDate('date_consommation', $today)
                    ->get();

        // Compute aggregated features for AI
        $features = [
            'age' => $user->age,
            'poids' => $user->poids,
            'taille' => $user->taille,
            'current_streak' => $userHabits->sum('current_streak'),
            'total_calories' => $repas->sum('calories_total'),
            'total_proteines' => $repas->sum('proteines_total'),
            'total_glucides' => $repas->sum('glucides_total'),
            'total_lipides' => $repas->sum('lipides_total'),
        ];

        // Generate AI advices
        $response = Http::post('http://127.0.0.1:5000/predict_advice', $features);

        // AI returns an array of advices [{title, content}, ...]
        $aiAdvices = $response->json() ?? [];

        // Pass everything to view
        return view('advices.advices', compact('advices', 'chatSessions', 'aiAdvices'));
    }

    public function show($id)
    {
        $advice = Advice::findOrFail($id);

        if ($advice->user_id === Auth::id() && !$advice->is_read) {
            $advice->update(['is_read' => true]);
        }

        return view('advices.advice-show', compact('advice'));
    }
}
