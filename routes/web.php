<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RepasController;
use App\Http\Controllers\AdminChallengeController;

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
    Route::get('/health/reports/weekly', [App\Http\Controllers\HealthReportController::class, 'weekly'])->name('health.reports.weekly');
    Route::get('/health/reports/monthly', [App\Http\Controllers\HealthReportController::class, 'monthly'])->name('health.reports.monthly');
    Route::get('/health/reports/category-performance', [App\Http\Controllers\HealthReportController::class, 'categoryPerformance'])->name('health.reports.category-performance');
    Route::get('/health/reports/habit-comparison', [App\Http\Controllers\HealthReportController::class, 'habitComparison'])->name('health.reports.habit-comparison');
    Route::get('/health/reports/export-pdf', [App\Http\Controllers\HealthReportController::class, 'exportPdf'])->name('health.reports.export-pdf');

<<<<<<< Updated upstream
    // Wellness Events resource routes
    Route::resource('events', EventController::class);
=======



    // Front office wellness events page (main events listing)
    Route::get('/wellness-events', [EventController::class, 'frontoffice'])->name('events.frontoffice');
    Route::get('/events', [EventController::class, 'frontoffice'])->name('events.index'); // Alias for backward compatibility

    // Public/Student-facing Challenges listing
    // Students should be able to browse approved challenges at /challenges
    Route::get('/challenges', [App\Http\Controllers\Professor\ChallengeController::class, 'index'])->name('challenges.index');


    // Event registration (student)
    Route::post('/events/{event}/register', [EventController::class, 'register'])->name('events.register');
    // Event unregistration (student)
    Route::post('/events/{event}/unregister', [EventController::class, 'unregister'])->name('events.unregister');

    // User event routes (view single event only)
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
>>>>>>> Stashed changes

    // ✅ AJOUTER CES ROUTES NUTRITION
    Route::resource('ingredients', IngredientController::class);
    Route::resource('repas', RepasController::class);

    // Routes API internes pour recherche dynamique
    Route::get('/api/internal/ingredients/search', [IngredientController::class, 'search'])->name('api.ingredients.search');
    Route::get('/api/internal/ingredients/categories', [IngredientController::class, 'getCategories'])->name('api.ingredients.categories');
<<<<<<< Updated upstream
=======

    // Advice routes
    Route::get('/advices', [AdviceController::class, 'index'])->name('advices.index');
    Route::get('/advices/{id}', [AdviceController::class, 'show'])->name('advices.show');

    // Chat session routes
    Route::get('/chat-sessions/start/{advice}', [ChatSessionController::class, 'start'])->name('chat.sessions.start');
    Route::get('/chat-sessions/{id}', [ChatSessionController::class, 'show'])->name('chat.sessions.show');
    Route::delete('/chat-sessions/{id}', [ChatSessionController::class, 'destroy'])->name('chat.sessions.destroy');


    // Chat messages
    Route::post('/chat-sessions/{id}/messages', [ChatMessageController::class, 'store'])->name('chat.messages.store');

    // Recommendation events (impression, click) - record for training
    Route::post('/recommendations/event', [App\Http\Controllers\RecommendationEventController::class, 'store'])->name('recommendations.event');

>>>>>>> Stashed changes
});

// Routes Admin ONLY
Route::middleware(['auth', 'isAdmin'])->name('admin.')->group(function () {
    
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



