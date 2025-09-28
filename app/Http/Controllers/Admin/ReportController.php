<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Habit;
use App\Models\Challenge;
use App\Models\Post;
use App\Models\DailyProgress;
use App\Models\UserHabit;
use App\Models\Participation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        // Overview stats
        $stats = [
            'total_users' => User::count(),
            'active_users' => User::whereHas('userHabits.dailyProgress', function ($q) {
                $q->where('date', '>=', Carbon::now()->subDays(7));
            })->count(),
            'total_habits' => Habit::count(),
            'total_challenges' => Challenge::count(),
            'active_challenges' => Challenge::where('is_active', true)->count(),
        ];

        // User growth data (last 30 days)
        $userGrowth = User::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Most popular habits
        $popularHabits = Habit::withCount('userHabits')
            ->orderBy('user_habits_count', 'desc')
            ->limit(10)
            ->get();

        // Challenge participation stats
        $challengeStats = Challenge::withCount('participations')
            ->orderBy('participations_count', 'desc')
            ->limit(10)
            ->get();

        return view('admin.reports.index', compact(
            'stats',
            'userGrowth',
            'popularHabits',
            'challengeStats'
        ));
    }

    public function users(Request $request)
    {
        $period = $request->get('period', '30');
        $startDate = Carbon::now()->subDays($period);

        // User registrations over time
        $registrations = User::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->where('created_at', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // User role distribution
        $roleDistribution = User::select('role', DB::raw('COUNT(*) as count'))
            ->groupBy('role')
            ->get();

        // Most active users
        $activeUsers = User::withCount(['habits', 'challenges', 'posts'])
            ->orderBy('habits_count', 'desc')
            ->limit(20)
            ->get();

        return view('admin.reports.users', compact(
            'registrations',
            'roleDistribution',
            'activeUsers',
            'period'
        ));
    }

    public function habits(Request $request)
    {
        $period = $request->get('period', '30');
        $startDate = Carbon::now()->subDays($period);

        // Habit completion rates
        $habitStats = Habit::with('category')
            ->withCount('userHabits')
            ->get()
            ->map(function ($habit) use ($startDate) {
                $totalProgress = DailyProgress::whereHas('userHabit', function ($q) use ($habit) {
                    $q->where('habit_id', $habit->id);
                })
                    ->where('date', '>=', $startDate)
                    ->count();

                $completedProgress = DailyProgress::whereHas('userHabit', function ($q) use ($habit) {
                    $q->where('habit_id', $habit->id);
                })
                    ->where('date', '>=', $startDate)
                    ->where('completed', true)
                    ->count();

                $habit->completion_rate = $totalProgress > 0 ? ($completedProgress / $totalProgress) * 100 : 0;
                $habit->total_attempts = $totalProgress;
                $habit->completed_attempts = $completedProgress;

                return $habit;
            })
            ->sortByDesc('completion_rate');

        return view('admin.reports.habits', compact('habitStats', 'period'));
    }

    public function challenges(Request $request)
    {
        $period = $request->get('period', '30');
        $startDate = Carbon::now()->subDays($period);

        // Challenge participation stats
        $challengeStats = Challenge::with('category')
            ->withCount('participations')
            ->get()
            ->map(function ($challenge) use ($startDate) {
                $completedParticipations = $challenge->participations()
                    ->where('completed', true)
                    ->where('created_at', '>=', $startDate)
                    ->count();

                $totalParticipations = $challenge->participations()
                    ->where('created_at', '>=', $startDate)
                    ->count();

                $challenge->completion_rate = $totalParticipations > 0 ?
                    ($completedParticipations / $totalParticipations) * 100 : 0;
                $challenge->period_participations = $totalParticipations;
                $challenge->period_completions = $completedParticipations;

                return $challenge;
            })
            ->sortByDesc('participations_count');

        return view('admin.reports.challenges', compact('challengeStats', 'period'));
    }

    public function export(Request $request)
    {
        $type = $request->get('type', 'users');
        $format = $request->get('format', 'csv');

        // This would implement export functionality
        // For now, return a placeholder response
        return response()->json([
            'message' => 'Export functionality will be implemented',
            'type' => $type,
            'format' => $format
        ]);
    }
}
