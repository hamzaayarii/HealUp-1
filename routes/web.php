<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RepasController;
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

    // Wellness Events resource routes
    Route::resource('events', EventController::class);

    // ✅ AJOUTER CES ROUTES NUTRITION
    Route::resource('ingredients', IngredientController::class);
    Route::resource('repas', RepasController::class);

    // Routes API internes pour recherche dynamique
    Route::get('/api/internal/ingredients/search', [IngredientController::class, 'search'])->name('api.ingredients.search');
    Route::get('/api/internal/ingredients/categories', [IngredientController::class, 'getCategories'])->name('api.ingredients.categories');
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('challenges/index', [ChallengeController::class, 'index'])->name('challenges.index');
    Route::get('challenges/create', [ChallengeController::class, 'create'])->name('challenges.create');
    Route::get('challenges/{id}/edit', [ChallengeController::class, 'edit'])->name('challenges.edit');
    Route::put('challenges/{id}', [ChallengeController::class, 'update'])->name('challenges.update');
    Route::delete('challenges/{id}', [ChallengeController::class, 'destroy'])->name('challenges.destroy');
    Route::post('challenges', [ChallengeController::class, 'store'])->name('challenges.store');

});



