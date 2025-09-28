<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use App\Models\Category;
use App\Models\UserHabit;
use App\Models\DailyProgress;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class HabitController extends Controller
{
    /**
     * Display a listing of user's habits
     */
    public function index()
    {
        $user = Auth::user();

        // Get user's active habits with today's progress
        $userHabits = $user->userHabits()
            ->with([
                'habit.category',
                'dailyProgress' => function ($query) {
                    $query->whereDate('date', today());
                }
            ])
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        // Get available categories for creating new habits
        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        // Calculate completion stats for today
        $todayStats = [
            'total_habits' => $userHabits->count(),
            'completed_today' => $userHabits->filter(function ($userHabit) {
                return $userHabit->dailyProgress->where('completed', true)->count() > 0;
            })->count(),
            'completion_rate' => $userHabits->count() > 0
                ? round(($userHabits->filter(function ($userHabit) {
                    return $userHabit->dailyProgress->where('completed', true)->count() > 0;
                })->count() / $userHabits->count()) * 100)
                : 0
        ];

        return view('health.habits.index', compact('userHabits', 'categories', 'todayStats'));
    }

    /**
     * Show the form for creating a new habit
     */
    public function create()
    {
        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('health.habits.create', compact('categories'));
    }

    /**
     * Store a newly created habit
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'category_id' => 'required|exists:categories,id',
            'frequency' => 'required|in:daily,weekly,monthly',
            'target_value' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
        ]);

        // Create or find the habit
        $habit = Habit::firstOrCreate([
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
        ], [
            'description' => $validated['description'],
            'frequency' => $validated['frequency'],
            'target_value' => $validated['target_value'],
            'unit' => $validated['unit'],
            'is_active' => true,
        ]);

        // Create user-habit relationship
        UserHabit::create([
            'user_id' => Auth::id(),
            'habit_id' => $habit->id,
            'target_value' => $validated['target_value'],
            'started_at' => now(),
            'is_active' => true,
        ]);

        return redirect()->route('habits.index')
            ->with('success', 'Habit created successfully! Start tracking your progress today.');
    }

    /**
     * Display the specified habit
     */
    public function show(UserHabit $userHabit)
    {
        // Ensure user can only view their own habits
        if ($userHabit->user_id !== Auth::id()) {
            abort(403);
        }

        $userHabit->load([
            'habit.category',
            'dailyProgress' => function ($query) {
                $query->orderBy('date', 'desc')->limit(30);
            }
        ]);

        // Calculate streak and statistics
        $stats = $this->calculateHabitStats($userHabit);

        return view('health.habits.show', compact('userHabit', 'stats'));
    }

    /**
     * Show the form for editing the specified habit
     */
    public function edit(UserHabit $userHabit)
    {
        // Ensure user can only edit their own habits
        if ($userHabit->user_id !== Auth::id()) {
            abort(403);
        }

        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        $userHabit->load('habit.category');

        return view('health.habits.edit', compact('userHabit', 'categories'));
    }

    /**
     * Update the specified habit
     */
    public function update(Request $request, UserHabit $userHabit)
    {
        // Ensure user can only update their own habits
        if ($userHabit->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'target_value' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        $userHabit->update($validated);

        return redirect()->route('habits.show', $userHabit)
            ->with('success', 'Habit updated successfully!');
    }

    /**
     * Remove the specified habit
     */
    public function destroy(UserHabit $userHabit)
    {
        // Ensure user can only delete their own habits
        if ($userHabit->user_id !== Auth::id()) {
            abort(403);
        }

        $userHabit->update(['is_active' => false]);

        return redirect()->route('habits.index')
            ->with('success', 'Habit deactivated successfully!');
    }

    /**
     * Get available habits for adding to user
     */
    public function available()
    {
        $user = Auth::user();
        $userHabitIds = $user->userHabits()->pluck('habit_id');

        $availableHabits = Habit::with('category')
            ->whereNotIn('id', $userHabitIds)
            ->where('is_active', true)
            ->orderBy('name')
            ->get()
            ->groupBy('category.name');

        return view('health.habits.available', compact('availableHabits'));
    }

    /**
     * Add an existing habit to user
     */
    public function addExisting(Request $request)
    {
        $validated = $request->validate([
            'habit_id' => 'required|exists:habits,id',
            'target_value' => 'required|numeric|min:0',
        ]);

        // Check if user already has this habit
        $existing = UserHabit::where('user_id', Auth::id())
            ->where('habit_id', $validated['habit_id'])
            ->first();

        if ($existing) {
            if (!$existing->is_active) {
                $existing->update([
                    'is_active' => true,
                    'target_value' => $validated['target_value'],
                    'started_at' => now(),
                ]);
                return redirect()->route('habits.index')
                    ->with('success', 'Habit reactivated successfully!');
            }
            return redirect()->route('habits.index')
                ->with('error', 'You already have this habit!');
        }

        UserHabit::create([
            'user_id' => Auth::id(),
            'habit_id' => $validated['habit_id'],
            'target_value' => $validated['target_value'],
            'started_at' => now(),
            'is_active' => true,
        ]);

        return redirect()->route('habits.index')
            ->with('success', 'Habit added successfully!');
    }

    /**
     * Calculate habit statistics
     */
    private function calculateHabitStats(UserHabit $userHabit)
    {
        $progress = $userHabit->dailyProgress()
            ->orderBy('date', 'desc')
            ->limit(30)
            ->get();

        $completedDays = $progress->where('completed', true)->count();
        $totalDays = $progress->count();
        $completionRate = $totalDays > 0 ? round(($completedDays / $totalDays) * 100) : 0;

        // Calculate current streak
        $currentStreak = 0;
        $sortedProgress = $progress->sortByDesc('date');
        foreach ($sortedProgress as $day) {
            if ($day->completed) {
                $currentStreak++;
            } else {
                break;
            }
        }

        // Average value
        $avgValue = $progress->where('completed', true)->avg('value') ?? 0;

        return [
            'completion_rate' => $completionRate,
            'current_streak' => $currentStreak,
            'longest_streak' => $userHabit->longest_streak ?? 0,
            'total_completed' => $completedDays,
            'average_value' => round($avgValue, 2),
            'recent_progress' => $progress->take(7),
        ];
    }
}
