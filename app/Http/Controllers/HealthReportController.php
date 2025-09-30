<?php

namespace App\Http\Controllers;

use App\Models\UserHabit;
use App\Models\DailyProgress;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HealthReportController extends Controller
{
    /**
     * Display health reports dashboard
     */
    public function index()
    {
        $user = Auth::user();

        // Get user's active habits
        $userHabits = $user->userHabits()
            ->with('habit.category')
            ->where('is_active', true)
            ->get();

        // Check if user has enough data for reports
        $totalProgressEntries = DailyProgress::whereIn('user_habit_id', $userHabits->pluck('id'))
            ->count();

        $hasEnoughData = $totalProgressEntries >= 7; // At least a week of data

        // Get overview stats
        $overviewStats = $this->getOverviewStats($userHabits);

        // Get recent achievements
        $achievements = $this->getRecentAchievements($userHabits);

        return view('health.reports.index', compact(
            'userHabits',
            'hasEnoughData',
            'overviewStats',
            'achievements'
        ));
    }

    /**
     * Generate weekly report
     */
    public function weekly(Request $request)
    {
        $user = Auth::user();
        $weekStart = $request->get('week_start', now()->startOfWeek()->format('Y-m-d'));
        $weekEnd = Carbon::parse($weekStart)->endOfWeek()->format('Y-m-d');

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

        $weeklyData = $this->generateWeeklyReportData($userHabits, $weekStart, $weekEnd);

        if ($request->expectsJson()) {
            return response()->json($weeklyData);
        }

        return view('health.reports.weekly', compact('weeklyData', 'weekStart', 'weekEnd'));
    }

    /**
     * Generate monthly report
     */
    public function monthly(Request $request)
    {
        $user = Auth::user();
        $month = $request->get('month', now()->format('Y-m'));
        $monthStart = Carbon::parse($month . '-01')->startOfMonth()->format('Y-m-d');
        $monthEnd = Carbon::parse($monthStart)->endOfMonth()->format('Y-m-d');

        $userHabits = $user->userHabits()
            ->with([
                'habit.category',
                'dailyProgress' => function ($query) use ($monthStart, $monthEnd) {
                    $query->whereBetween('date', [$monthStart, $monthEnd])
                        ->orderBy('date', 'asc');
                }
            ])
            ->where('is_active', true)
            ->get();

        $monthlyData = $this->generateMonthlyReportData($userHabits, $monthStart, $monthEnd);

        if ($request->expectsJson()) {
            return response()->json($monthlyData);
        }

        return view('health.reports.monthly', compact('monthlyData', 'monthStart', 'monthEnd'));
    }

    /**
     * Get category-wise performance
     */
    public function categoryPerformance(Request $request)
    {
        $user = Auth::user();
        $period = $request->get('period', 'month'); // week, month, quarter

        $startDate = match ($period) {
            'week' => now()->startOfWeek(),
            'quarter' => now()->startOfQuarter(),
            default => now()->startOfMonth(),
        };

        $endDate = match ($period) {
            'week' => now()->endOfWeek(),
            'quarter' => now()->endOfQuarter(),
            default => now()->endOfMonth(),
        };

        $categoryData = $this->getCategoryPerformanceData($user, $startDate, $endDate);

        if ($request->expectsJson()) {
            return response()->json([
                'period' => $period,
                'start_date' => $startDate->format('Y-m-d'),
                'end_date' => $endDate->format('Y-m-d'),
                'categories' => $categoryData,
            ]);
        }

        return view('health.reports.category-performance', compact('categoryData', 'period'));
    }

    /**
     * Get habit comparison data
     */
    public function habitComparison(Request $request)
    {
        $user = Auth::user();
        $days = $request->get('days', 30);
        $startDate = now()->subDays($days)->format('Y-m-d');
        $endDate = now()->format('Y-m-d');

        $userHabits = $user->userHabits()
            ->with([
                'habit.category',
                'dailyProgress' => function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('date', [$startDate, $endDate]);
                }
            ])
            ->where('is_active', true)
            ->get();

        $comparisonData = $this->generateHabitComparisonData($userHabits, $days);

        if ($request->expectsJson()) {
            return response()->json($comparisonData);
        }

        return view('health.reports.habit-comparison', compact('comparisonData', 'days'));
    }

    /**
     * Export report as PDF
     */
    public function exportPdf(Request $request)
    {
        $type = $request->get('type', 'monthly');
        $date = $request->get('date', now()->format('Y-m'));

        // Generate report data based on type
        $reportData = match ($type) {
            'weekly' => $this->generateWeeklyReportData(
                Auth::user()->userHabits()->with('habit.category')->where('is_active', true)->get(),
                Carbon::parse($date)->startOfWeek()->format('Y-m-d'),
                Carbon::parse($date)->endOfWeek()->format('Y-m-d')
            ),
            default => $this->generateMonthlyReportData(
                Auth::user()->userHabits()->with('habit.category')->where('is_active', true)->get(),
                Carbon::parse($date . '-01')->startOfMonth()->format('Y-m-d'),
                Carbon::parse($date . '-01')->endOfMonth()->format('Y-m-d')
            ),
        };

        // Here you would use a PDF library like DomPDF or wkhtmltopdf
        // For now, return JSON data
        return response()->json([
            'type' => $type,
            'date' => $date,
            'data' => $reportData,
            'message' => 'PDF export functionality can be implemented with DomPDF',
        ]);
    }

    /**
     * Get overview statistics
     */
    private function getOverviewStats($userHabits)
    {
        $totalHabits = $userHabits->count();
        $activeStreaks = $userHabits->where('current_streak', '>', 0)->count();

        $totalProgress = DailyProgress::whereIn('user_habit_id', $userHabits->pluck('id'))
            ->whereBetween('date', [now()->subDays(30), now()])
            ->count();

        $completedProgress = DailyProgress::whereIn('user_habit_id', $userHabits->pluck('id'))
            ->whereBetween('date', [now()->subDays(30), now()])
            ->where('completed', true)
            ->count();

        $overallCompletionRate = $totalProgress > 0 ? round(($completedProgress / $totalProgress) * 100) : 0;

        return [
            'total_habits' => $totalHabits,
            'active_streaks' => $activeStreaks,
            'completion_rate' => $overallCompletionRate,
            'longest_streak' => $userHabits->max('longest_streak') ?? 0,
            'total_completed' => $completedProgress,
        ];
    }

    /**
     * Get recent achievements
     */
    private function getRecentAchievements($userHabits)
    {
        $achievements = [];

        foreach ($userHabits as $userHabit) {
            // Check for streak milestones
            if ($userHabit->current_streak >= 7 && $userHabit->current_streak % 7 == 0) {
                $achievements[] = [
                    'type' => 'streak',
                    'title' => "{$userHabit->current_streak} Day Streak!",
                    'description' => "You've maintained {$userHabit->habit->name} for {$userHabit->current_streak} consecutive days",
                    'habit' => $userHabit->habit->name,
                    'date' => now(),
                    'icon' => '🔥',
                ];
            }

            // Check for completion milestones
            $completedCount = $userHabit->dailyProgress()
                ->where('completed', true)
                ->count();

            if ($completedCount > 0 && $completedCount % 10 == 0) {
                $achievements[] = [
                    'type' => 'milestone',
                    'title' => "{$completedCount} Completions!",
                    'description' => "You've completed {$userHabit->habit->name} {$completedCount} times",
                    'habit' => $userHabit->habit->name,
                    'date' => now(),
                    'icon' => '⭐',
                ];
            }
        }

        return collect($achievements)->sortByDesc('date')->take(5);
    }

    /**
     * Generate weekly report data
     */
    private function generateWeeklyReportData($userHabits, $weekStart, $weekEnd)
    {
        $days = [];
        $current = Carbon::parse($weekStart);

        while ($current <= Carbon::parse($weekEnd)) {
            $days[] = $current->format('Y-m-d');
            $current->addDay();
        }

        $habitData = [];
        $dailyCompletions = array_fill_keys($days, 0);
        $dailyTotals = array_fill_keys($days, 0);

        foreach ($userHabits as $userHabit) {
            $progress = $userHabit->dailyProgress->keyBy('date');

            $weekProgress = [];
            foreach ($days as $day) {
                $dayProgress = $progress->get($day);
                $weekProgress[$day] = [
                    'completed' => $dayProgress ? $dayProgress->completed : false,
                    'value' => $dayProgress ? $dayProgress->value : 0,
                ];

                $dailyTotals[$day]++;
                if ($dayProgress && $dayProgress->completed) {
                    $dailyCompletions[$day]++;
                }
            }

            $completed = collect($weekProgress)->where('completed', true)->count();

            $habitData[] = [
                'habit' => $userHabit->habit,
                'target_value' => $userHabit->target_value,
                'progress' => $weekProgress,
                'completed_days' => $completed,
                'completion_rate' => round(($completed / 7) * 100),
                'average_value' => collect($weekProgress)->where('completed', true)->avg('value') ?? 0,
            ];
        }

        // Calculate daily completion rates
        $dailyRates = [];
        foreach ($days as $day) {
            $dailyRates[$day] = $dailyTotals[$day] > 0
                ? round(($dailyCompletions[$day] / $dailyTotals[$day]) * 100)
                : 0;
        }

        return [
            'period' => 'Weekly',
            'start_date' => $weekStart,
            'end_date' => $weekEnd,
            'days' => $days,
            'habits' => $habitData,
            'daily_completion_rates' => $dailyRates,
            'overall_completion_rate' => round(array_sum($dailyCompletions) / max(array_sum($dailyTotals), 1) * 100),
            'total_habits' => count($habitData),
            'active_days' => count(array_filter($dailyCompletions)),
        ];
    }

    /**
     * Generate monthly report data
     */
    private function generateMonthlyReportData($userHabits, $monthStart, $monthEnd)
    {
        $totalDays = Carbon::parse($monthStart)->diffInDays(Carbon::parse($monthEnd)) + 1;

        $habitData = [];
        $weeklyData = [];

        // Group progress by weeks
        $current = Carbon::parse($monthStart);
        $weekNumber = 1;

        while ($current <= Carbon::parse($monthEnd)) {
            $weekEnd = min($current->copy()->endOfWeek(), Carbon::parse($monthEnd));
            $weeklyData["Week {$weekNumber}"] = [
                'start' => $current->format('Y-m-d'),
                'end' => $weekEnd->format('Y-m-d'),
                'habits' => [],
            ];

            $current = $weekEnd->addDay();
            $weekNumber++;
        }

        foreach ($userHabits as $userHabit) {
            $progress = $userHabit->dailyProgress;
            $completed = $progress->where('completed', true);

            $habitData[] = [
                'habit' => $userHabit->habit,
                'target_value' => $userHabit->target_value,
                'total_days' => $totalDays,
                'completed_days' => $completed->count(),
                'completion_rate' => round(($completed->count() / $totalDays) * 100),
                'average_value' => $completed->avg('value') ?? 0,
                'best_streak' => $this->calculateBestStreak($progress),
                'current_streak' => $userHabit->current_streak,
            ];
        }

        return [
            'period' => 'Monthly',
            'start_date' => $monthStart,
            'end_date' => $monthEnd,
            'total_days' => $totalDays,
            'habits' => $habitData,
            'weekly_breakdown' => $weeklyData,
            'overall_completion_rate' => round(
                $habitData
                ? collect($habitData)->avg('completion_rate')
                : 0
            ),
        ];
    }

    /**
     * Get category performance data
     */
    private function getCategoryPerformanceData($user, $startDate, $endDate)
    {
        $categories = Category::whereHas('habits.userHabits', function ($query) use ($user) {
            $query->where('user_id', $user->id)->where('is_active', true);
        })->with([
                    'habits.userHabits' => function ($query) use ($user, $startDate, $endDate) {
                        $query->where('user_id', $user->id)
                            ->where('is_active', true)
                            ->with([
                                'dailyProgress' => function ($q) use ($startDate, $endDate) {
                                    $q->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')]);
                                }
                            ]);
                    }
                ])->get();

        $categoryData = [];

        foreach ($categories as $category) {
            $totalProgress = 0;
            $completedProgress = 0;
            $habits = [];

            foreach ($category->habits as $habit) {
                foreach ($habit->userHabits as $userHabit) {
                    $progress = $userHabit->dailyProgress;
                    $totalProgress += $progress->count();
                    $completedProgress += $progress->where('completed', true)->count();

                    $habits[] = [
                        'name' => $habit->name,
                        'completion_rate' => $progress->count() > 0
                            ? round(($progress->where('completed', true)->count() / $progress->count()) * 100)
                            : 0,
                    ];
                }
            }

            $categoryData[] = [
                'category' => $category,
                'habits' => $habits,
                'total_habits' => count($habits),
                'completion_rate' => $totalProgress > 0
                    ? round(($completedProgress / $totalProgress) * 100)
                    : 0,
                'total_completed' => $completedProgress,
            ];
        }

        return collect($categoryData)->sortByDesc('completion_rate');
    }

    /**
     * Generate habit comparison data
     */
    private function generateHabitComparisonData($userHabits, $days)
    {
        $comparisonData = [];

        foreach ($userHabits as $userHabit) {
            $progress = $userHabit->dailyProgress;
            $completed = $progress->where('completed', true);

            $comparisonData[] = [
                'habit' => $userHabit->habit,
                'category' => $userHabit->habit->category,
                'completion_rate' => $progress->count() > 0
                    ? round(($completed->count() / $progress->count()) * 100)
                    : 0,
                'average_value' => $completed->avg('value') ?? 0,
                'current_streak' => $userHabit->current_streak,
                'longest_streak' => $userHabit->longest_streak,
                'total_completed' => $completed->count(),
                'consistency_score' => $this->calculateConsistencyScore($progress),
            ];
        }

        return collect($comparisonData)->sortByDesc('completion_rate');
    }

    /**
     * Calculate best streak for a habit
     */
    private function calculateBestStreak($progress)
    {
        $maxStreak = 0;
        $currentStreak = 0;

        foreach ($progress->sortBy('date') as $day) {
            if ($day->completed) {
                $currentStreak++;
                $maxStreak = max($maxStreak, $currentStreak);
            } else {
                $currentStreak = 0;
            }
        }

        return $maxStreak;
    }

    /**
     * Calculate consistency score (how evenly distributed completions are)
     */
    private function calculateConsistencyScore($progress)
    {
        if ($progress->count() < 7)
            return 0;

        $totalDays = $progress->count();
        $completedDays = $progress->where('completed', true)->count();

        if ($completedDays == 0)
            return 0;

        // Calculate standard deviation of gaps between completions
        $completedDates = $progress->where('completed', true)
            ->pluck('date')
            ->map(fn($date) => Carbon::parse($date)->diffInDays(Carbon::parse($progress->min('date'))))
            ->sort()
            ->values();

        if ($completedDates->count() < 2)
            return 50;

        $gaps = [];
        for ($i = 1; $i < $completedDates->count(); $i++) {
            $gaps[] = $completedDates[$i] - $completedDates[$i - 1];
        }

        $avgGap = collect($gaps)->avg();
        $stdDev = sqrt(collect($gaps)->map(fn($gap) => pow($gap - $avgGap, 2))->avg());

        // Convert to score (lower std dev = higher consistency)
        $consistencyScore = max(0, 100 - ($stdDev * 10));

        return round($consistencyScore);
    }
}
