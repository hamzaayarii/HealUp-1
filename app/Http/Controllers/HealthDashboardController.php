<?php

namespace App\Http\Controllers;

use App\Models\UserHabit;
use App\Models\DailyProgress;
use App\Models\Category;
use App\Models\Challenge;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HealthDashboardController extends Controller
{
    /**
     * Display the main health dashboard
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
                    $query->where('date', $today);
                }
            ])
            ->where('is_active', true)
            ->orderBy('created_at')
            ->get();

        // Calculate today's stats
        $todayStats = $this->getTodayStats($habitsWithProgress);

        // Get weekly overview
        $weeklyOverview = $this->getWeeklyOverview($user);

        // Get recent activity
        $recentActivity = $this->getRecentActivity($user);

        // Get quick actions
        $quickActions = $this->getQuickActions($habitsWithProgress);

        // Get motivational message
        $motivationalMessage = $this->getMotivationalMessage($todayStats, $weeklyOverview);

        // Get upcoming challenges
        $upcomingChallenges = Challenge::where('is_active', true)
            ->where('end_date', '>', now())
            ->orderBy('start_date')
            ->limit(3)
            ->get();

        return view('health.dashboard.index', compact(
            'habitsWithProgress',
            'todayStats',
            'weeklyOverview',
            'recentActivity',
            'quickActions',
            'motivationalMessage',
            'upcomingChallenges'
        ));
    }

    /**
     * Get today's statistics
     */
    private function getTodayStats($habitsWithProgress)
    {
        $totalHabits = $habitsWithProgress->count();
        $completedToday = $habitsWithProgress->filter(function ($userHabit) {
            return $userHabit->dailyProgress->where('completed', true)->count() > 0;
        })->count();

        $completionRate = $totalHabits > 0 ? round(($completedToday / $totalHabits) * 100) : 0;

        return [
            'total_habits' => $totalHabits,
            'completed' => $completedToday,
            'pending' => $totalHabits - $completedToday,
            'completion_rate' => $completionRate,
            'streak_status' => $this->getStreakStatus($habitsWithProgress),
        ];
    }

    /**
     * Get weekly overview statistics
     */
    private function getWeeklyOverview($user)
    {
        $weekStart = now()->startOfWeek();
        $weekEnd = now()->endOfWeek();

        $userHabits = $user->userHabits()
            ->with([
                'dailyProgress' => function ($query) use ($weekStart, $weekEnd) {
                    $query->whereBetween('date', [$weekStart, $weekEnd]);
                }
            ])
            ->where('is_active', true)
            ->get();

        $totalPossible = $userHabits->count() * 7; // 7 days
        $totalCompleted = 0;
        $activeStreaks = 0;

        foreach ($userHabits as $userHabit) {
            $completed = $userHabit->dailyProgress->where('completed', true)->count();
            $totalCompleted += $completed;

            if ($userHabit->current_streak > 0) {
                $activeStreaks++;
            }
        }

        $weeklyCompletionRate = $totalPossible > 0 ? round(($totalCompleted / $totalPossible) * 100) : 0;

        return [
            'completion_rate' => $weeklyCompletionRate,
            'total_completed' => $totalCompleted,
            'active_streaks' => $activeStreaks,
            'best_day' => $this->getBestDayThisWeek($userHabits),
            'consistency_score' => $this->calculateWeeklyConsistency($userHabits),
        ];
    }

    /**
     * Get recent activity feed
     */
    private function getRecentActivity($user)
    {
        $recentProgress = DailyProgress::whereHas('userHabit', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->with(['userHabit.habit.category'])
            ->where('completed', true)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $activities = [];

        foreach ($recentProgress as $progress) {
            $activities[] = [
                'type' => 'completion',
                'habit_name' => $progress->userHabit->habit->name,
                'category' => $progress->userHabit->habit->category->name,
                'value' => $progress->value,
                'unit' => $progress->userHabit->habit->unit,
                'date' => $progress->date,
                'time_ago' => Carbon::parse($progress->created_at)->diffForHumans(),
                'icon' => $this->getCategoryIcon($progress->userHabit->habit->category->name),
            ];
        }

        return collect($activities);
    }

    /**
     * Get quick actions for habits
     */
    private function getQuickActions($habitsWithProgress)
    {
        $quickActions = [];

        foreach ($habitsWithProgress as $userHabit) {
            $todayProgress = $userHabit->dailyProgress->first();
            $isCompleted = $todayProgress && $todayProgress->completed;

            if (!$isCompleted) {
                $quickActions[] = [
                    'user_habit_id' => $userHabit->id,
                    'habit_name' => $userHabit->habit->name,
                    'target_value' => $userHabit->target_value,
                    'unit' => $userHabit->habit->unit,
                    'category' => $userHabit->habit->category->name,
                    'icon' => $this->getCategoryIcon($userHabit->habit->category->name),
                    'current_value' => $todayProgress ? $todayProgress->value : 0,
                ];
            }
        }

        return collect($quickActions)->take(4); // Show max 4 quick actions
    }

    /**
     * Get motivational message based on user's progress
     */
    private function getMotivationalMessage($todayStats, $weeklyOverview)
    {
        $messages = [];

        if ($todayStats['completion_rate'] == 100) {
            $messages[] = [
                'type' => 'celebration',
                'title' => '🎉 Perfect Day!',
                'message' => 'You\'ve completed all your habits today. Amazing work!',
                'color' => 'green',
            ];
        } elseif ($todayStats['completion_rate'] >= 75) {
            $messages[] = [
                'type' => 'encouragement',
                'title' => '💪 Almost There!',
                'message' => 'You\'re doing great! Just a few more habits to complete today.',
                'color' => 'blue',
            ];
        } elseif ($todayStats['completion_rate'] >= 50) {
            $messages[] = [
                'type' => 'motivation',
                'title' => '🌟 Keep Going!',
                'message' => 'You\'re halfway through your daily goals. You\'ve got this!',
                'color' => 'yellow',
            ];
        } else {
            $messages[] = [
                'type' => 'gentle_push',
                'title' => '🚀 Ready to Start?',
                'message' => 'Every journey begins with a single step. Let\'s make today count!',
                'color' => 'purple',
            ];
        }

        // Add weekly performance message
        if ($weeklyOverview['completion_rate'] >= 80) {
            $messages[] = [
                'type' => 'weekly_praise',
                'title' => '🔥 On Fire This Week!',
                'message' => "Your weekly completion rate is {$weeklyOverview['completion_rate']}%. Keep up the momentum!",
                'color' => 'orange',
            ];
        }

        return $messages;
    }

    /**
     * Get streak status for habits
     */
    private function getStreakStatus($habitsWithProgress)
    {
        $streaks = $habitsWithProgress->pluck('current_streak')->filter(function ($streak) {
            return $streak > 0;
        });

        return [
            'active_streaks' => $streaks->count(),
            'longest_current' => $streaks->max() ?? 0,
            'total_streak_days' => $streaks->sum(),
        ];
    }

    /**
     * Get the best day of the week based on completion rates
     */
    private function getBestDayThisWeek($userHabits)
    {
        $dayStats = [];
        $weekStart = now()->startOfWeek();

        for ($i = 0; $i < 7; $i++) {
            $date = $weekStart->copy()->addDays($i);
            $dayName = $date->format('l');
            $completions = 0;
            $total = 0;

            foreach ($userHabits as $userHabit) {
                $dayProgress = $userHabit->dailyProgress->where('date', $date->format('Y-m-d'))->first();
                $total++;
                if ($dayProgress && $dayProgress->completed) {
                    $completions++;
                }
            }

            $dayStats[$dayName] = [
                'date' => $date->format('Y-m-d'),
                'completions' => $completions,
                'total' => $total,
                'rate' => $total > 0 ? round(($completions / $total) * 100) : 0,
            ];
        }

        $bestDay = collect($dayStats)->sortByDesc('rate')->first();
        return $bestDay ? array_search($bestDay, $dayStats) : 'Today';
    }

    /**
     * Calculate weekly consistency score
     */
    private function calculateWeeklyConsistency($userHabits)
    {
        if ($userHabits->isEmpty())
            return 0;

        $dailyCompletions = [];
        $weekStart = now()->startOfWeek();

        for ($i = 0; $i < 7; $i++) {
            $date = $weekStart->copy()->addDays($i)->format('Y-m-d');
            $completions = 0;

            foreach ($userHabits as $userHabit) {
                $dayProgress = $userHabit->dailyProgress->where('date', $date)->first();
                if ($dayProgress && $dayProgress->completed) {
                    $completions++;
                }
            }

            $dailyCompletions[] = $completions;
        }

        // Calculate standard deviation to measure consistency
        $avg = collect($dailyCompletions)->avg();
        $variance = collect($dailyCompletions)->map(function ($completions) use ($avg) {
            return pow($completions - $avg, 2);
        })->avg();

        $stdDev = sqrt($variance);

        // Convert to consistency score (lower deviation = higher consistency)
        $maxPossibleDev = $userHabits->count();
        $consistencyScore = $maxPossibleDev > 0
            ? max(0, 100 - (($stdDev / $maxPossibleDev) * 100))
            : 0;

        return round($consistencyScore);
    }

    /**
     * Get category icon based on category name
     */
    private function getCategoryIcon($categoryName)
    {
        $icons = [
            'Fitness' => '💪',
            'Mental Health' => '🧠',
            'Nutrition' => '🥗',
            'Sleep' => '😴',
            'Productivity' => '⚡',
            'Social' => '👥',
            'Learning' => '📚',
            'Meditation' => '🧘',
            'Hydration' => '💧',
            'default' => '⭐',
        ];

        return $icons[$categoryName] ?? $icons['default'];
    }

    /**
     * Get habit statistics for API
     */
    public function getHabitStats(Request $request)
    {
        $user = Auth::user();
        $habitId = $request->get('habit_id');
        $days = $request->get('days', 30);

        $userHabit = $user->userHabits()
            ->with([
                'habit.category',
                'dailyProgress' => function ($query) use ($days) {
                    $query->where('date', '>=', now()->subDays($days))
                        ->orderBy('date', 'asc');
                }
            ])
            ->where('id', $habitId)
            ->first();

        if (!$userHabit) {
            return response()->json(['error' => 'Habit not found'], 404);
        }

        $progress = $userHabit->dailyProgress;
        $completed = $progress->where('completed', true);

        $stats = [
            'habit' => $userHabit->habit,
            'total_days' => $progress->count(),
            'completed_days' => $completed->count(),
            'completion_rate' => $progress->count() > 0
                ? round(($completed->count() / $progress->count()) * 100)
                : 0,
            'current_streak' => $userHabit->current_streak,
            'longest_streak' => $userHabit->longest_streak,
            'average_value' => $completed->avg('value') ?? 0,
            'progress_data' => $progress->map(function ($p) {
                return [
                    'date' => $p->date,
                    'value' => $p->value,
                    'completed' => $p->completed,
                    'target' => $p->userHabit->target_value,
                ];
            }),
        ];

        return response()->json($stats);
    }

    /**
     * Get dashboard data for mobile API
     */
    public function api()
    {
        $user = Auth::user();
        $today = today();

        $habitsWithProgress = $user->userHabits()
            ->with([
                'habit.category',
                'dailyProgress' => function ($query) use ($today) {
                    $query->where('date', $today);
                }
            ])
            ->where('is_active', true)
            ->get();

        $todayStats = $this->getTodayStats($habitsWithProgress);
        $weeklyOverview = $this->getWeeklyOverview($user);
        $recentActivity = $this->getRecentActivity($user);
        $quickActions = $this->getQuickActions($habitsWithProgress);

        return response()->json([
            'today_stats' => $todayStats,
            'weekly_overview' => $weeklyOverview,
            'recent_activity' => $recentActivity,
            'quick_actions' => $quickActions,
            'habits' => $habitsWithProgress->map(function ($userHabit) {
                $todayProgress = $userHabit->dailyProgress->first();
                return [
                    'id' => $userHabit->id,
                    'name' => $userHabit->habit->name,
                    'category' => $userHabit->habit->category->name,
                    'target_value' => $userHabit->target_value,
                    'unit' => $userHabit->habit->unit,
                    'current_streak' => $userHabit->current_streak,
                    'today_completed' => $todayProgress ? $todayProgress->completed : false,
                    'today_value' => $todayProgress ? $todayProgress->value : 0,
                ];
            }),
        ]);
    }
}
