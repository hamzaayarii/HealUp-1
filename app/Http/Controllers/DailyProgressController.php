<?php

namespace App\Http\Controllers;

use App\Models\UserHabit;
use App\Models\DailyProgress;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DailyProgressController extends Controller
{
    /**
     * Display today's progress dashboard
     */
    public function index()
    {
        $user = Auth::user();
        $today = today();

        // Get user's active habits with today's progress
        $habitsWithProgress = $user->userHabits()
            ->with([
                'habit.category',
                'dailyProgress' => function ($query) use ($today) {
                    $query->whereDate('date', $today);
                }
            ])
            ->where('is_active', true)
            ->orderBy('created_at')
            ->get();

        // Calculate today's stats
        $todayStats = [
            'total_habits' => $habitsWithProgress->count(),
            'completed' => $habitsWithProgress->filter(function ($userHabit) {
                return $userHabit->dailyProgress->where('completed', true)->count() > 0;
            })->count(),
            'pending' => $habitsWithProgress->filter(function ($userHabit) {
                return $userHabit->dailyProgress->where('completed', true)->count() === 0;
            })->count(),
        ];

        $todayStats['completion_rate'] = $todayStats['total_habits'] > 0
            ? round(($todayStats['completed'] / $todayStats['total_habits']) * 100)
            : 0;

        return view('health.progress.index', compact('habitsWithProgress', 'todayStats'));
    }

    /**
     * Log progress for a specific habit
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_habit_id' => 'required|exists:user_habits,id',
            'date' => 'required|date',
            'value' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:500',
        ]);

        $userHabit = UserHabit::findOrFail($validated['user_habit_id']);

        // Ensure user can only log progress for their own habits
        if ($userHabit->user_id !== Auth::id()) {
            abort(403);
        }

        $date = Carbon::parse($validated['date'])->toDateString();

        // Check if progress already exists for this date
        $existingProgress = DailyProgress::where('user_habit_id', $userHabit->id)
            ->where('date', $date)
            ->first();

        $completed = $validated['value'] >= $userHabit->target_value;

        if ($existingProgress) {
            $existingProgress->update([
                'value' => $validated['value'],
                'completed' => $completed,
                'notes' => $validated['notes'],
            ]);
            $message = 'Progress updated successfully!';
        } else {
            DailyProgress::create([
                'user_habit_id' => $userHabit->id,
                'date' => $date,
                'value' => $validated['value'],
                'completed' => $completed,
                'notes' => $validated['notes'],
            ]);
            $message = 'Progress logged successfully!';
        }

        // Update streak if completed today
        if ($completed && $date === today()->toDateString()) {
            $this->updateStreak($userHabit);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'completed' => $completed,
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Get progress for a specific habit and date range
     */
    public function show(UserHabit $userHabit, Request $request)
    {
        // Ensure user can only view their own habits
        if ($userHabit->user_id !== Auth::id()) {
            abort(403);
        }

        $startDate = $request->get('start_date', now()->subDays(30)->toDateString());
        $endDate = $request->get('end_date', now()->toDateString());

        $progress = $userHabit->dailyProgress()
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date', 'asc')
            ->get();

        if ($request->expectsJson()) {
            return response()->json([
                'habit' => $userHabit->load('habit.category'),
                'progress' => $progress,
                'stats' => $this->calculateProgressStats($progress, $userHabit),
            ]);
        }

        return view('health.progress.show', compact('userHabit', 'progress'));
    }

    /**
     * Update progress entry
     */
    public function update(Request $request, DailyProgress $dailyProgress)
    {
        // Ensure user can only update their own progress
        $userHabit = $dailyProgress->userHabit;
        if ($userHabit->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'value' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:500',
        ]);

        $completed = $validated['value'] >= $userHabit->target_value;

        $dailyProgress->update([
            'value' => $validated['value'],
            'completed' => $completed,
            'notes' => $validated['notes'],
        ]);

        // Update streak if this is today's progress
        if (Carbon::parse($dailyProgress->date)->isToday() && $completed) {
            $this->updateStreak($userHabit);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Progress updated successfully!',
                'completed' => $completed,
            ]);
        }

        return redirect()->back()->with('success', 'Progress updated successfully!');
    }

    /**
     * Delete progress entry
     */
    public function destroy(DailyProgress $dailyProgress)
    {
        // Ensure user can only delete their own progress
        $userHabit = $dailyProgress->userHabit;
        if ($userHabit->user_id !== Auth::id()) {
            abort(403);
        }

        $dailyProgress->delete();

        return redirect()->back()->with('success', 'Progress entry deleted successfully!');
    }

    /**
     * Get weekly progress summary
     */
    public function weekly(Request $request)
    {
        $user = Auth::user();
        $weekStart = $request->get('week_start', now()->startOfWeek()->toDateString());
        $weekEnd = Carbon::parse($weekStart)->endOfWeek()->toDateString();

        $userHabits = $user->userHabits()
            ->with([
                'habit.category',
                'dailyProgress' => function ($query) use ($weekStart, $weekEnd) {
                    $query->whereBetween('date', [$weekStart, $weekEnd])
                        ->orderBy('date', 'asc');
                }
            ])
            ->where('is_active', true)
            ->get();

        $weeklyStats = [];
        foreach ($userHabits as $userHabit) {
            $progress = $userHabit->dailyProgress;
            $weeklyStats[] = [
                'habit' => $userHabit->habit,
                'completed_days' => $progress->where('completed', true)->count(),
                'total_days' => $progress->count(),
                'completion_rate' => $progress->count() > 0
                    ? round(($progress->where('completed', true)->count() / 7) * 100)
                    : 0,
                'average_value' => $progress->where('completed', true)->avg('value') ?? 0,
                'progress_data' => $progress,
            ];
        }

        if ($request->expectsJson()) {
            return response()->json([
                'week_start' => $weekStart,
                'week_end' => $weekEnd,
                'habits' => $weeklyStats,
            ]);
        }

        return view('health.progress.weekly', compact('weeklyStats', 'weekStart', 'weekEnd'));
    }

    /**
     * Quick log progress (AJAX endpoint)
     */
    public function quickLog(Request $request)
    {
        $validated = $request->validate([
            'user_habit_id' => 'required|exists:user_habits,id',
            'completed' => 'required|boolean',
            'value' => 'nullable|numeric|min:0',
        ]);

        $userHabit = UserHabit::findOrFail($validated['user_habit_id']);

        // Ensure user can only log progress for their own habits
        if ($userHabit->user_id !== Auth::id()) {
            abort(403);
        }

        $today = today()->toDateString();
        $value = $validated['value'] ?? ($validated['completed'] ? $userHabit->target_value : 0);

        $progress = DailyProgress::updateOrCreate([
            'user_habit_id' => $userHabit->id,
            'date' => $today,
        ], [
            'value' => $value,
            'completed' => $validated['completed'],
        ]);

        // Update streak if completed
        if ($validated['completed']) {
            $this->updateStreak($userHabit);
        }

        return response()->json([
            'success' => true,
            'message' => $validated['completed'] ? 'Great job! Keep it up!' : 'Progress logged',
            'progress' => $progress,
        ]);
    }

    /**
     * Update user habit streaks
     */
    private function updateStreak(UserHabit $userHabit)
    {
        $recentProgress = $userHabit->dailyProgress()
            ->orderBy('date', 'desc')
            ->limit(30)
            ->get();

        $currentStreak = 0;
        $today = today();

        // Calculate current streak
        foreach ($recentProgress->sortByDesc('date') as $progress) {
            if ($progress->completed && Carbon::parse($progress->date)->lte($today)) {
                $currentStreak++;
                $today = $today->subDay();
            } else {
                break;
            }
        }

        // Update streaks
        $userHabit->current_streak = $currentStreak;
        if ($currentStreak > $userHabit->longest_streak) {
            $userHabit->longest_streak = $currentStreak;
        }
        $userHabit->save();
    }

    /**
     * Calculate progress statistics
     */
    private function calculateProgressStats($progress, UserHabit $userHabit)
    {
        $completed = $progress->where('completed', true);
        $total = $progress->count();

        return [
            'completion_rate' => $total > 0 ? round(($completed->count() / $total) * 100) : 0,
            'average_value' => $completed->avg('value') ?? 0,
            'best_day' => $completed->sortByDesc('value')->first(),
            'total_completed' => $completed->count(),
            'streak_data' => $this->calculateStreakData($progress),
        ];
    }

    /**
     * Calculate streak data for visualization
     */
    private function calculateStreakData($progress)
    {
        $streaks = [];
        $currentStreak = 0;
        $streakStart = null;

        foreach ($progress->sortBy('date') as $day) {
            if ($day->completed) {
                if ($currentStreak === 0) {
                    $streakStart = $day->date;
                }
                $currentStreak++;
            } else {
                if ($currentStreak > 0) {
                    $streaks[] = [
                        'start' => $streakStart,
                        'end' => $progress->where('date', '<', $day->date)->sortByDesc('date')->first()->date,
                        'length' => $currentStreak,
                    ];
                    $currentStreak = 0;
                }
            }
        }

        // Add final streak if still ongoing
        if ($currentStreak > 0) {
            $streaks[] = [
                'start' => $streakStart,
                'end' => $progress->sortByDesc('date')->first()->date,
                'length' => $currentStreak,
            ];
        }

        return $streaks;
    }
}
