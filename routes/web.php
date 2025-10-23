
<?php
// Event recommendations (AI)
Route::get('/events/recommend', [App\Http\Controllers\EventController::class, 'recommendEvents'])->name('events.recommend')->middleware(['auth', 'verified']);

// Professor: View event participants
Route::get('/events/{event}/participants', [App\Http\Controllers\EventController::class, 'participants'])->name('events.participants');

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RepasController;
use App\Http\Controllers\AdminChallengeController;
use App\Http\Controllers\AdviceController;
use App\Http\Controllers\ChatSessionController;
use App\Http\Controllers\ChatMessageController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\AdviceController as AdminAdviceController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::get('/', function () {
    return view('pages.welcome');
})->name('welcome');

// Our first project route
Route::get('/activities', [ActivityController::class, 'index']);

// Theme routes
Route::post('/theme/toggle', [ThemeController::class, 'toggle'])->name('theme.toggle');
Route::post('/theme/set', [ThemeController::class, 'setTheme'])->name('theme.set');
Route::get('/theme/current', [ThemeController::class, 'getCurrentTheme'])->name('theme.current');

// Debug route (remove in production)
Route::get('/debug', function () {
    return view('debug');
})->name('debug');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('health.dashboard');
    })->name('dashboard');

    // Health Dashboard - Main health tracking interface
    Route::get('/health', [App\Http\Controllers\HealthDashboardController::class, 'index'])->name('health.dashboard');
    Route::get('/health/api', [App\Http\Controllers\HealthDashboardController::class, 'api'])->name('health.api');
    Route::get('/health/habit-stats', [App\Http\Controllers\HealthDashboardController::class, 'getHabitStats'])->name('health.habit-stats');

    // Habits Management
    Route::resource('habits', App\Http\Controllers\HabitController::class, [
        'parameters' => ['habits' => 'userHabit']
    ]);
    Route::get('/habits-available', [App\Http\Controllers\HabitController::class, 'available'])->name('habits.available');
    Route::post('/habits-add-existing', [App\Http\Controllers\HabitController::class, 'addExisting'])->name('habits.add-existing');

    // Daily Progress
    Route::get('/progress', [App\Http\Controllers\DailyProgressController::class, 'index'])->name('progress.index');
    Route::post('/progress', [App\Http\Controllers\DailyProgressController::class, 'store'])->name('progress.store');
    Route::get('/progress/{userHabit}', [App\Http\Controllers\DailyProgressController::class, 'show'])->name('progress.show');
    Route::put('/progress/{dailyProgress}', [App\Http\Controllers\DailyProgressController::class, 'update'])->name('progress.update');
    Route::delete('/progress/{dailyProgress}', [App\Http\Controllers\DailyProgressController::class, 'destroy'])->name('progress.destroy');
    Route::get('/progress/weekly', [App\Http\Controllers\DailyProgressController::class, 'weekly'])->name('progress.weekly');
    Route::post('/progress/quick-log', [App\Http\Controllers\DailyProgressController::class, 'quickLog'])->name('progress.quick-log');

    // Health Reports
    Route::get('/health/reports', [App\Http\Controllers\HealthReportController::class, 'index'])->name('health.reports.index');

    // My Events (Student)
    Route::get('/my-events', [App\Http\Controllers\EventController::class, 'myEvents'])->name('events.my');
    Route::get('/health/reports/weekly', [App\Http\Controllers\HealthReportController::class, 'weekly'])->name('health.reports.weekly');
    Route::get('/health/reports/monthly', [App\Http\Controllers\HealthReportController::class, 'monthly'])->name('health.reports.monthly');
    Route::get('/health/reports/category-performance', [App\Http\Controllers\HealthReportController::class, 'categoryPerformance'])->name('health.reports.category-performance');
    Route::get('/health/reports/habit-comparison', [App\Http\Controllers\HealthReportController::class, 'habitComparison'])->name('health.reports.habit-comparison');
    Route::get('/health/reports/export-pdf', [App\Http\Controllers\HealthReportController::class, 'exportPdf'])->name('health.reports.export-pdf');




    // Front office wellness events page (main events listing)
    Route::get('/wellness-events', [EventController::class, 'frontoffice'])->name('events.frontoffice');
    Route::get('/events', [EventController::class, 'frontoffice'])->name('events.index'); // Alias for backward compatibility


    // Event registration (student)
    Route::post('/events/{event}/register', [EventController::class, 'register'])->name('events.register');
    // Event unregistration (student)
    Route::post('/events/{event}/unregister', [EventController::class, 'unregister'])->name('events.unregister');

    // User event routes (view single event only)
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

    // ✅ AJOUTER CES ROUTES NUTRITION
    Route::resource('ingredients', IngredientController::class);
    Route::resource('repas', RepasController::class);

    // 🤖 Routes IA pour les Repas
    Route::prefix('repas')->name('repas.')->group(function () {
        Route::post('/ai/suggestions', [RepasController::class, 'aiSuggestions'])->name('ai.suggestions');
        Route::post('/ai/analyze-balance', [RepasController::class, 'analyzeBalance'])->name('ai.analyze-balance');
        Route::post('/ai/detect-deficiencies', [RepasController::class, 'detectDeficiencies'])->name('ai.detect-deficiencies');
        Route::post('/ai/nutrition-report', [RepasController::class, 'nutritionReport'])->name('ai.nutrition-report');
        Route::post('/ai/predict-goals', [RepasController::class, 'predictGoals'])->name('ai.predict-goals');
        Route::post('/ai/weekly-plan', [RepasController::class, 'weeklyPlan'])->name('ai.weekly-plan');
        Route::post('/{id}/optimize', [RepasController::class, 'optimizeRepas'])->name('optimize');
        Route::get('/{id}/analyze-quality', [RepasController::class, 'analyzeMealQuality'])->name('analyze-quality');
    });

    // 🔄 Routes IA pour les Ingrédients
    Route::prefix('ingredients')->name('ingredients.')->group(function () {
        Route::get('/{id}/alternatives', [IngredientController::class, 'alternatives'])->name('alternatives');
        Route::get('/{id}/stats', [IngredientController::class, 'stats'])->name('stats');
    });

    // Routes API internes pour recherche dynamique
    Route::get('/api/internal/ingredients/search', [IngredientController::class, 'search'])->name('api.ingredients.search');
    Route::get('/api/internal/ingredients/categories', [IngredientController::class, 'getCategories'])->name('api.ingredients.categories');

    // Advice routes
    Route::get('/advices', [AdviceController::class, 'index'])->name('advices.index');
    Route::get('/advices/{id}', [AdviceController::class, 'show'])->name('advices.show');

    // Chat session routes
    Route::get('/chat-sessions/start/{advice}', [ChatSessionController::class, 'start'])->name('chat.sessions.start');
    Route::get('/chat-sessions/{id}', [ChatSessionController::class, 'show'])->name('chat.sessions.show');
    Route::delete('/chat-sessions/{id}', [ChatSessionController::class, 'destroy'])->name('chat.sessions.destroy');


    // Chat messages
    Route::post('/chat-sessions/{id}/messages', [ChatMessageController::class, 'store'])->name('chat.messages.store');
    Route::get('/chat/messages/{id}/edit', [ChatMessageController::class, 'edit'])->name('chat.messages.edit');
    Route::put('/chat/messages/{id}', [ChatMessageController::class, 'update'])->name('chat.messages.update');
    Route::delete('/chat/messages/{id}', [ChatMessageController::class, 'destroy'])->name('chat.messages.destroy');


});

// Admin Routes - Protected by auth and admin middleware
Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // View participants for an event (admin)
    Route::get('events/{event}/participants', [App\Http\Controllers\Admin\EventController::class, 'participants'])->name('events.participants');
    // Admin Dashboard
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [App\Http\Controllers\Admin\AdminController::class, 'profile'])->name('profile');

    // Admin API Routes
    Route::get('/api/stats', [App\Http\Controllers\Admin\AdminController::class, 'getStats'])->name('api.stats');
    Route::get('/api/chart-data', [App\Http\Controllers\Admin\AdminController::class, 'getChartData'])->name('api.chart-data');
    Route::get('/api/system-info', [App\Http\Controllers\Admin\AdminController::class, 'systemInfo'])->name('api.system-info');

    // System Management
    Route::post('/cache/clear', [App\Http\Controllers\Admin\AdminController::class, 'clearCache'])->name('cache.clear');
    Route::post('/migrations/run', [App\Http\Controllers\Admin\AdminController::class, 'runMigrations'])->name('migrations.run');
    Route::post('/optimize', [App\Http\Controllers\Admin\AdminController::class, 'optimize'])->name('optimize');

    // User Management
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::post('/users/{user}/toggle-status', [App\Http\Controllers\Admin\UserController::class, 'toggleStatus'])->name('users.toggle-status');

    // Habits Management
    Route::resource('habits', App\Http\Controllers\Admin\HabitController::class);
    Route::get('/habits/{habit}/users', [App\Http\Controllers\Admin\HabitController::class, 'users'])->name('habits.users');

    // Reports Management
    Route::get('/reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/users', [App\Http\Controllers\Admin\ReportController::class, 'users'])->name('reports.users');
    Route::get('/reports/habits', [App\Http\Controllers\Admin\ReportController::class, 'habits'])->name('reports.habits');
    Route::get('/reports/challenges', [App\Http\Controllers\Admin\ReportController::class, 'challenges'])->name('reports.challenges');
    Route::get('/reports/export', [App\Http\Controllers\Admin\ReportController::class, 'export'])->name('reports.export');

    // Admin-only Categories Management
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);

    // Teams Management (TODO: Create TeamController)
    // Route::resource('teams', App\Http\Controllers\Admin\TeamController::class);
    // Route::post('/teams/{team}/toggle-status', [App\Http\Controllers\Admin\TeamController::class, 'toggleStatus'])->name('teams.toggle-status');
    // Route::get('/teams/{team}/members', [App\Http\Controllers\Admin\TeamController::class, 'members'])->name('teams.members');

    // Nutrition Management - ✅ IMPLEMENTED
    Route::prefix('nutrition')->name('nutrition.')->group(function () {
        Route::resource('ingredients', App\Http\Controllers\Admin\IngredientController::class);
        Route::resource('repas', App\Http\Controllers\Admin\RepasController::class)->parameters([
            'repas' => 'repas'
        ]);
        
        // Additional statistics routes
        Route::get('ingredients/{ingredient}/statistics', [App\Http\Controllers\Admin\IngredientController::class, 'statistics'])->name('ingredients.statistics');
        Route::get('repas/{repas}/statistics', [App\Http\Controllers\Admin\RepasController::class, 'statistics'])->name('repas.statistics');
    });

    // Reports (TODO: Create ReportController)
    // Route::get('/reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
    // Route::get('/reports/users', [App\Http\Controllers\Admin\ReportController::class, 'users'])->name('reports.users');
    // Route::get('/reports/habits', [App\Http\Controllers\Admin\ReportController::class, 'habits'])->name('reports.habits');
    // Route::get('/reports/challenges', [App\Http\Controllers\Admin\ReportController::class, 'challenges'])->name('reports.challenges');
    // Route::get('/reports/export/{type}', [App\Http\Controllers\Admin\ReportController::class, 'export'])->name('reports.export');

    // Settings (TODO: Create SettingController)
    // Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    // Route::put('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    // Route::post('/settings/backup', [App\Http\Controllers\Admin\SettingController::class, 'backup'])->name('settings.backup');
    // Route::post('/settings/restore', [App\Http\Controllers\Admin\SettingController::class, 'restore'])->name('settings.restore');

    // Event Management
    Route::resource('events', App\Http\Controllers\Admin\EventController::class);

    // Advice Management
    Route::resource('advices', AdminAdviceController::class);

        // Route principale pour l'interface admin
    Route::get('/challenges', [AdminChallengeController::class, 'index'])->name('challenges.index');
    

    Route::put('/challenges/{id}/approve', [AdminChallengeController::class, 'approve'])->name('challenges.approve');
    Route::put('/challenges/{id}/reject', [AdminChallengeController::class, 'reject'])->name('challenges.reject');
    Route::delete('/challenges/{id}', [AdminChallengeController::class, 'destroy'])->name('challenges.destroy');
    
    // Routes standards
    Route::get('/challenges/create', [AdminChallengeController::class, 'create'])->name('challenges.create');
    Route::post('/challenges', [AdminChallengeController::class, 'store'])->name('challenges.store');
    Route::get('/challenges/{id}/edit', [AdminChallengeController::class, 'edit'])->name('challenges.edit');
    Route::get('/challenges/{id}/details', [AdminChallengeController::class, 'showDetails'])->name('challenges.details');
    Route::put('/challenges/{id}', [AdminChallengeController::class, 'update'])->name('challenges.update');
});

//Professor role - Challenge Management
Route::middleware(['auth', 'verified', 'professor']) 
    ->prefix('professor') 
    ->name('professor.') 
    ->group(function () {
        
        Route::get('/challenges', [App\Http\Controllers\Professor\ChallengeController::class, 'index'])->name('challenges.index');
        

});

// Student Routes
Route::middleware(['auth', 'verified', 'student']) 
    ->prefix('student')
    ->name('student.')
    ->group(function () {
        // Dashboard and challenges
        Route::get('/dashboard', [App\Http\Controllers\Student\StudentController::class, 'dashboard'])->name('dashboard');
        Route::get('/challenges', [App\Http\Controllers\Student\ChallengeController::class, 'index'])->name('challenges.index');
        Route::post('/challenges/{challenge}/join', [App\Http\Controllers\Student\ChallengeController::class, 'join'])->name('challenges.join');
        Route::get('/progress', [App\Http\Controllers\Student\StudentController::class, 'progress'])->name('progress');
        Route::get('/badges', [App\Http\Controllers\Student\StudentController::class, 'badges'])->name('badges');
        
        // Calendar routes
        Route::get('/calendar', [App\Http\Controllers\Student\CalendarController::class, 'index'])->name('calendar.index');
        Route::get('/calendar/events', [App\Http\Controllers\Student\CalendarController::class, 'getEvents'])->name('calendar.events');
        Route::post('/calendar/checkin', [App\Http\Controllers\Student\CalendarController::class, 'checkin'])->name('calendar.checkin');
        Route::get('/calendar/stats', [App\Http\Controllers\Student\CalendarController::class, 'getStats'])->name('calendar.stats');
        Route::post('/calendar/sync-all', [App\Http\Controllers\Student\CalendarController::class, 'syncAllProgress'])->name('calendar.sync-all');
});



Route::get('/debug-habits', function () {
    $habit = App\Models\Habit::with(['userHabits.user'])->first();

    if (!$habit) {
        return 'No habits found';
    }

    return [
        'habit_id' => $habit->id,
        'habit_name' => $habit->name,
        'userHabits_count' => $habit->userHabits->count(),
        'userHabits_details' => $habit->userHabits->map(function ($uh) {
            return [
                'id' => $uh->id,
                'user_name' => $uh->user->name,
                'is_active' => $uh->is_active,
                'created_at' => $uh->created_at
            ];
        })
    ];
});



