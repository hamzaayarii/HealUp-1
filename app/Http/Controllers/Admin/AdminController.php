<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Habit;
use App\Models\Challenge;
use App\Models\Team;
use App\Models\DailyProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Show the admin dashboard.
     */
    public function dashboard()
    {
        // Get statistics
        $stats = [
            'total_users' => User::count(),
            'active_habits' => Habit::count(),
            'total_challenges' => Challenge::count(),
            'total_teams' => Team::count(),
        ];

        // Get recent users
        $recentUsers = User::latest()->take(5)->get();

        // Get user registration data for chart (last 6 months)
        $userRegistrations = User::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Get activity data
        $activityData = [
            'active' => User::where('updated_at', '>=', Carbon::now()->subDays(30))->count(),
            'inactive' => User::where('updated_at', '<', Carbon::now()->subDays(30))->count(),
            'pending' => User::whereNull('email_verified_at')->count(),
        ];

        return view('admin.dashboard', compact('stats', 'recentUsers', 'userRegistrations', 'activityData'));
    }

    /**
     * Show the admin profile management page.
     */
    public function profile()
    {
        return view('admin.profile');
    }

    /**
     * Show system information.
     */
    public function systemInfo()
    {
        $info = [
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
            'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown',
            'database' => config('database.default'),
            'cache_driver' => config('cache.default'),
            'queue_driver' => config('queue.default'),
            'mail_driver' => config('mail.default'),
            'storage_driver' => config('filesystems.default'),
            'memory_limit' => ini_get('memory_limit'),
            'max_execution_time' => ini_get('max_execution_time'),
            'upload_max_filesize' => ini_get('upload_max_filesize'),
            'post_max_size' => ini_get('post_max_size'),
        ];

        return response()->json($info);
    }

    /**
     * Get dashboard statistics API.
     */
    public function getStats()
    {
        $stats = [
            'users' => [
                'total' => User::count(),
                'active' => User::where('updated_at', '>=', Carbon::now()->subDays(30))->count(),
                'new_today' => User::whereDate('created_at', Carbon::today())->count(),
                'new_this_week' => User::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count(),
            ],
            'habits' => [
                'total' => Habit::count(),
                'active' => Habit::whereHas('userHabits', function ($query) {
                    $query->where('is_active', true);
                })->count(),
                'completed_today' => DailyProgress::whereDate('date', Carbon::today())->count(),
            ],
            'challenges' => [
                'total' => Challenge::count(),
                'active' => Challenge::where('end_date', '>=', Carbon::now())->count(),
                'participations' => DB::table('participations')->count(),
            ],
            'teams' => [
                'total' => Team::count(),
                'active' => Team::whereHas('members', function ($query) {
                    $query->where('updated_at', '>=', Carbon::now()->subDays(30));
                })->count(),
            ],
        ];

        return response()->json($stats);
    }

    /**
     * Get chart data for dashboard.
     */
    public function getChartData(Request $request)
    {
        $type = $request->get('type', 'users');
        $period = $request->get('period', '6months');

        switch ($type) {
            case 'users':
                return $this->getUserChartData($period);
            case 'habits':
                return $this->getHabitChartData($period);
            case 'challenges':
                return $this->getChallengeChartData($period);
            default:
                return response()->json(['error' => 'Invalid chart type'], 400);
        }
    }

    /**
     * Get user registration chart data.
     */
    private function getUserChartData($period)
    {
        $startDate = $this->getStartDate($period);

        $data = User::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->where('created_at', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json([
            'labels' => $data->pluck('date'),
            'data' => $data->pluck('count'),
        ]);
    }

    /**
     * Get habit completion chart data.
     */
    private function getHabitChartData($period)
    {
        $startDate = $this->getStartDate($period);

        $data = DailyProgress::select(
            DB::raw('DATE(date) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->where('date', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json([
            'labels' => $data->pluck('date'),
            'data' => $data->pluck('count'),
        ]);
    }

    /**
     * Get challenge participation chart data.
     */
    private function getChallengeChartData($period)
    {
        $startDate = $this->getStartDate($period);

        $data = DB::table('participations')
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json([
            'labels' => $data->pluck('date'),
            'data' => $data->pluck('count'),
        ]);
    }

    /**
     * Get start date based on period.
     */
    private function getStartDate($period)
    {
        switch ($period) {
            case '7days':
                return Carbon::now()->subDays(7);
            case '30days':
                return Carbon::now()->subDays(30);
            case '3months':
                return Carbon::now()->subMonths(3);
            case '6months':
                return Carbon::now()->subMonths(6);
            case '1year':
                return Carbon::now()->subYear();
            default:
                return Carbon::now()->subMonths(6);
        }
    }

    /**
     * Clear application cache.
     */
    public function clearCache()
    {
        try {
            \Artisan::call('cache:clear');
            \Artisan::call('config:clear');
            \Artisan::call('route:clear');
            \Artisan::call('view:clear');

            return response()->json([
                'success' => true,
                'message' => 'Cache cleared successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to clear cache: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Run database migrations.
     */
    public function runMigrations()
    {
        try {
            \Artisan::call('migrate', ['--force' => true]);

            return response()->json([
                'success' => true,
                'message' => 'Migrations completed successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Migration failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Optimize application.
     */
    public function optimize()
    {
        try {
            \Artisan::call('optimize');

            return response()->json([
                'success' => true,
                'message' => 'Application optimized successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Optimization failed: ' . $e->getMessage()
            ], 500);
        }
    }
}
