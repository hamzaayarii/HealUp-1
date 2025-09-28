<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\ChallengeController;

Route::get('/', function () {
    return view('pages.welcome');
})->name('welcome');

// Our first project route
Route::get('/activities', [ActivityController::class, 'index']);

// Theme routes
Route::post('/theme/toggle', [ThemeController::class, 'toggle'])->name('theme.toggle');
Route::post('/theme/set', [ThemeController::class, 'setTheme'])->name('theme.set');
Route::get('/theme/current', [ThemeController::class, 'getCurrentTheme'])->name('theme.current');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('challenges', [ChallengeController::class, 'index'])->name('challenges.index');
    Route::get('challenges/create', [ChallengeController::class, 'create'])->name('challenges.create');
    Route::post('challenges', [ChallengeController::class, 'store'])->name('challenges.store');
});



