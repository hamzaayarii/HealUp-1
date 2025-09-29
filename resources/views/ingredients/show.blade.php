@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-green-50 dark:from-gray-900 dark:to-gray-800 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('ingredients.index') }}" 
               class="inline-flex items-center text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Ingredients List
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Ingredient Header Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden mb-6 border border-gray-100 dark:border-gray-700">
            <div class="bg-gradient-to-r from-blue-500 to-green-500 p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-white">{{ $ingredient->nom }}</h1>
                        <p class="text-blue-100 mt-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white bg-opacity-20 backdrop-blur-sm">
                                {{ ucfirst($ingredient->categorie ?? 'Other') }}
                            </span>
                        </p>
                    </div>
                    <div class="mt-4 md:mt-0 flex space-x-3">
                        <a href="{{ route('ingredients.edit', $ingredient) }}" 
                           class="inline-flex items-center px-4 py-2 bg-white hover:bg-gray-100 text-blue-600 font-semibold rounded-xl shadow-lg transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('ingredients.destroy', $ingredient) }}" 
                              method="POST" 
                              class="inline"
                              onsubmit="return confirm('Are you sure you want to delete this ingredient?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold rounded-xl shadow-lg transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Calories Summary -->
            <div class="bg-gradient-to-r from-blue-50 to-green-50 dark:bg-gray-700 p-6 border-b dark:border-gray-600">
                <div class="flex items-center justify-center">
                    <div class="text-center">
                        <p class="text-gray-600 dark:text-gray-400 text-sm uppercase tracking-wide mb-2">Total Calories per 100g</p>
                        <p class="text-5xl font-bold bg-gradient-to-r from-blue-600 to-green-500 bg-clip-text text-transparent">
                            {{ round($ingredient->calories_pour_100g) }}
                        </p>
                        <p class="text-gray-600 dark:text-gray-400 text-lg mt-1">kcal</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Macronutrients Details -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 border border-gray-100 dark:border-gray-700">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                <span class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mr-3">
                    <span class="text-white text-lg">🥗</span>
                </span>
                Nutritional Information (per 100g)
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Proteins -->
                <div class="bg-gradient-to-r from-red-50 to-red-100 dark:from-red-900 dark:to-red-800 p-6 rounded-xl shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Proteins</h3>
                        <span class="text-3xl">💪</span>
                    </div>
                    <p class="text-4xl font-bold text-red-600 dark:text-red-300">
                        {{ number_format($ingredient->proteines_pour_100g, 1) }}
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">grams per 100g</p>
                </div>

                <!-- Carbohydrates -->
                <div class="bg-gradient-to-r from-yellow-50 to-yellow-100 dark:from-yellow-900 dark:to-yellow-800 p-6 rounded-xl shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Carbohydrates</h3>
                        <span class="text-3xl">🌾</span>
                    </div>
                    <p class="text-4xl font-bold text-yellow-600 dark:text-yellow-300">
                        {{ number_format($ingredient->glucides_pour_100g, 1) }}
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">grams per 100g</p>
                </div>

                <!-- Fats -->
                <div class="bg-gradient-to-r from-purple-50 to-purple-100 dark:from-purple-900 dark:to-purple-800 p-6 rounded-xl shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Fats</h3>
                        <span class="text-3xl">🥑</span>
                    </div>
                    <p class="text-4xl font-bold text-purple-600 dark:text-purple-300">
                        {{ number_format($ingredient->lipides_pour_100g, 1) }}
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">grams per 100g</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
