@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 via-white to-yellow-50 dark:from-gray-900 dark:to-gray-800 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-green-600 to-yellow-500 bg-clip-text text-transparent">
                        🥗 Ingredients Database
                    </h1>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Browse, search and discover nutritional information
                    </p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('ingredients.create') }}" 
                       class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold rounded-xl shadow-lg transition duration-200 ease-in-out transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Add Ingredient
                    </a>
                </div>
            </div>
        </div>

        <!-- AI Features Banner -->
        <div class="mb-6 bg-gradient-to-r from-green-50 via-yellow-50 to-orange-50 dark:from-green-900/20 dark:via-yellow-900/20 dark:to-orange-900/20 rounded-2xl shadow-lg border border-green-100 dark:border-green-800/30 overflow-hidden">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-yellow-600 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                            🤖 AI-Powered Ingredient Analysis
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Smart alternatives and nutritional insights with Python AI
                        </p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Feature 1 -->
                    <div class="flex items-start space-x-3 p-3 bg-white dark:bg-gray-800/50 rounded-lg border border-green-100 dark:border-green-800/30">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-green-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white">AI Alternatives</h4>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Smart substitutes</p>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="flex items-start space-x-3 p-3 bg-white dark:bg-gray-800/50 rounded-lg border border-yellow-100 dark:border-yellow-800/30">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white">Advanced Search</h4>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Filter by nutrition</p>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="flex items-start space-x-3 p-3 bg-white dark:bg-gray-800/50 rounded-lg border border-orange-100 dark:border-orange-800/30">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-gradient-to-br from-orange-400 to-orange-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white">Rich Database</h4>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Complete nutritional data</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="mt-4 pt-4 border-t border-green-100 dark:border-green-800/30">
                    <div class="flex flex-wrap items-center justify-center gap-6 text-sm">
                        <div class="flex items-center space-x-2">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                            <span class="text-gray-700 dark:text-gray-300">AI Active</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">{{ $ingredients->total() ?? 0 }} Ingredients</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">Python AI Local</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
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

        <!-- Search & Filters Section -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-6 mb-6">
            <form method="GET" action="{{ route('ingredients.index') }}" class="space-y-4">
                
                <!-- Search Bar -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Search ingredients by name..." 
                           class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                </div>

                <!-- Filters Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    
                    <!-- Category -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            🏷️ Category
                        </label>
                        <select name="categorie" 
                                class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500">
                            <option value="">All categories</option>
                            @foreach($categories as $categorie)
                                <option value="{{ $categorie }}" {{ request('categorie') == $categorie ? 'selected' : '' }}>
                                    {{ ucfirst($categorie) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Min Calories -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            🔥 Min Calories (per 100g)
                        </label>
                        <input type="number" 
                               name="min_calories" 
                               value="{{ request('min_calories') }}"
                               placeholder="0"
                               class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500">
                    </div>

                    <!-- Max Calories -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            🔥 Max Calories (per 100g)
                        </label>
                        <input type="number" 
                               name="max_calories" 
                               value="{{ request('max_calories') }}"
                               placeholder="1000"
                               class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500">
                    </div>

                    <!-- Sort -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            📊 Sort By
                        </label>
                        <select name="sort" 
                                class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500">
                            <option value="nom" {{ request('sort') == 'nom' ? 'selected' : '' }}>Name (A-Z)</option>
                            <option value="calories_pour_100g" {{ request('sort') == 'calories_pour_100g' ? 'selected' : '' }}>Calories</option>
                            <option value="proteines_pour_100g" {{ request('sort') == 'proteines_pour_100g' ? 'selected' : '' }}>Proteins</option>
                            <option value="glucides_pour_100g" {{ request('sort') == 'glucides_pour_100g' ? 'selected' : '' }}>Carbs</option>
                            <option value="lipides_pour_100g" {{ request('sort') == 'lipides_pour_100g' ? 'selected' : '' }}>Fats</option>
                        </select>
                    </div>
                </div>

                <!-- Advanced Filters -->
                <div x-data="{ showAdvanced: false }">
                    <button type="button" 
                            @click="showAdvanced = !showAdvanced"
                            class="text-sm text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300 font-medium">
                        <span x-show="!showAdvanced">+ Show advanced filters</span>
                        <span x-show="showAdvanced">- Hide advanced filters</span>
                    </button>

                    <div x-show="showAdvanced" 
                         x-cloak
                         class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                        
                        <!-- Min Proteins -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                💪 Min Proteins (g/100g)
                            </label>
                            <input type="number" 
                                   name="min_proteines" 
                                   value="{{ request('min_proteines') }}"
                                   placeholder="0"
                                   class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500">
                        </div>

                        <!-- Max Carbs -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                🥖 Max Carbs (g/100g)
                            </label>
                            <input type="number" 
                                   name="max_glucides" 
                                   value="{{ request('max_glucides') }}"
                                   placeholder="100"
                                   class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500">
                        </div>

                        <!-- Max Fats -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                🧈 Max Fats (g/100g)
                            </label>
                            <input type="number" 
                                   name="max_lipides" 
                                   value="{{ request('max_lipides') }}"
                                   placeholder="100"
                                   class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500">
                        </div>

                        <!-- Sort Direction -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                ↕️ Direction
                            </label>
                            <select name="direction" 
                                    class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500">
                                <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                                <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Descending</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-3">
                    <button type="submit" 
                            class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold rounded-lg shadow transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        Apply Filters
                    </button>
                    <a href="{{ route('ingredients.index') }}" 
                       class="inline-flex items-center px-6 py-2.5 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-semibold rounded-lg shadow transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Results Count -->
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $ingredients->total() }}</span> ingredients
        </div>

        <!-- Ingredients Grid -->
        @if($ingredients->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($ingredients as $ingredient)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition border border-gray-100 dark:border-gray-700 overflow-hidden group">
                        <!-- Card Header -->
                        <div class="bg-gradient-to-r from-green-400 to-green-500 p-4">
                            <div class="flex items-center justify-between">
                                <span class="text-3xl">{{ $ingredient->getCategorieEmoji() }}</span>
                                <span class="text-xs text-white bg-white/20 px-2 py-1 rounded-full">
                                    {{ ucfirst($ingredient->categorie) }}
                                </span>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-3">
                                {{ $ingredient->nom }}
                            </h3>

                            <!-- Nutrition Grid -->
                            <div class="grid grid-cols-2 gap-2 mb-4">
                                <div class="text-center p-2 bg-red-50 dark:bg-red-900/20 rounded-lg">
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Calories</p>
                                    <p class="text-sm font-bold text-red-600 dark:text-red-400">{{ round($ingredient->calories_pour_100g) }}</p>
                                </div>
                                <div class="text-center p-2 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Proteins</p>
                                    <p class="text-sm font-bold text-blue-600 dark:text-blue-400">{{ round($ingredient->proteines_pour_100g, 1) }}g</p>
                                </div>
                                <div class="text-center p-2 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Carbs</p>
                                    <p class="text-sm font-bold text-yellow-600 dark:text-yellow-400">{{ round($ingredient->glucides_pour_100g, 1) }}g</p>
                                </div>
                                <div class="text-center p-2 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Fats</p>
                                    <p class="text-sm font-bold text-purple-600 dark:text-purple-400">{{ round($ingredient->lipides_pour_100g, 1) }}g</p>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex flex-col space-y-2">
                                <div class="flex space-x-2">
                                    <a href="{{ route('ingredients.show', $ingredient->id) }}" 
                                       class="flex-1 text-center px-3 py-2 bg-green-100 hover:bg-green-200 dark:bg-green-900/30 dark:hover:bg-green-900/50 text-green-700 dark:text-green-300 text-sm font-medium rounded-lg transition">
                                        View
                                    </a>
                                    <a href="{{ route('ingredients.edit', $ingredient->id) }}" 
                                       class="flex-1 text-center px-3 py-2 bg-blue-100 hover:bg-blue-200 dark:bg-blue-900/30 dark:hover:bg-blue-900/50 text-blue-700 dark:text-blue-300 text-sm font-medium rounded-lg transition">
                                        Edit
                                    </a>
                                </div>
                                <button onclick="getAlternatives({{ $ingredient->id }})"
                                        class="w-full px-3 py-2 bg-purple-100 hover:bg-purple-200 dark:bg-purple-900/30 dark:hover:bg-purple-900/50 text-purple-700 dark:text-purple-300 text-sm font-medium rounded-lg transition">
                                    🔄 Find Alternatives
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $ingredients->links() }}
            </div>
        @else
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-12 text-center">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No ingredients found</h3>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Try adjusting your search filters or add a new ingredient.</p>
                <a href="{{ route('ingredients.create') }}" 
                   class="mt-6 inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Add Your First Ingredient
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Alternatives Modal -->
<div id="alternativesModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">🔄 Alternative Ingredients</h2>
                <button onclick="hideAlternatives()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div id="alternativesContent">
                <div class="animate-pulse">Loading alternatives...</div>
            </div>
        </div>
    </div>
</div>

<script>
async function getAlternatives(ingredientId) {
    const modal = document.getElementById('alternativesModal');
    const content = document.getElementById('alternativesContent');
    
    modal.classList.remove('hidden');
    content.innerHTML = '<div class="p-8 flex flex-col items-center justify-center"><svg class="w-12 h-12 text-green-500 animate-spin mb-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><p class="text-gray-600 dark:text-gray-300 font-medium">Recherche d\'alternatives nutritionnelles...</p></div>';
    
    try {
        const response = await fetch(`/ingredients/${ingredientId}/alternatives`);
        const data = await response.json();
        
        let html = '<div class="space-y-6">';
        
        // En-tête
        html += `
            <div class="bg-gradient-to-r from-green-500 to-teal-500 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold mb-2">🔄 Alternatives Nutritionnelles</h3>
                        <p class="text-green-100">Ingrédients similaires trouvés</p>
                    </div>
                    <div class="text-6xl">🥗</div>
                </div>
            </div>
        `;
        
        if (data.alternatives && data.alternatives.length > 0) {
            html += `<div class="mb-4"><span class="px-4 py-2 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 rounded-full text-sm font-semibold">${data.alternatives.length} alternative(s) disponible(s)</span></div>`;
            
            html += '<div class="grid grid-cols-1 md:grid-cols-2 gap-4">';
            
            const colors = [
                'from-blue-50 to-cyan-50 border-blue-300',
                'from-purple-50 to-pink-50 border-purple-300',
                'from-yellow-50 to-orange-50 border-yellow-300',
                'from-green-50 to-teal-50 border-green-300'
            ];
            
            data.alternatives.forEach((alt, index) => {
                const colorClass = colors[index % colors.length];
                html += `
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border-2 ${colorClass} hover:shadow-lg transition-shadow">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <span class="text-2xl mb-2 block">🥬</span>
                                <h4 class="font-bold text-xl text-gray-900 dark:text-white mb-1">${alt.nom}</h4>
                                <span class="inline-block px-3 py-1 bg-gradient-to-r from-purple-100 to-blue-100 dark:from-purple-900/40 dark:to-blue-900/40 text-purple-800 dark:text-purple-200 rounded-full text-xs font-bold uppercase tracking-wide">${alt.categorie || 'Ingrédient'}</span>
                            </div>
                            <div class="text-center">
                                <div class="w-16 h-16 bg-gradient-to-br from-orange-400 to-red-500 rounded-2xl flex items-center justify-center shadow-lg">
                                    <span class="text-2xl font-bold text-white">${Math.round(alt.calories_pour_100g)}</span>
                                </div>
                                <span class="block mt-2 text-xs font-bold text-gray-600 dark:text-gray-400">kcal</span>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-3 gap-3 mt-4">
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:bg-blue-900/20 rounded-xl p-3 text-center border border-blue-200 dark:border-blue-800">
                                <div class="text-blue-700 dark:text-blue-300 font-bold text-lg">${Math.round(alt.proteines_pour_100g)}g</div>
                                <div class="text-xs font-bold text-blue-900 dark:text-blue-100 mt-1">Protéines</div>
                            </div>
                            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 dark:bg-yellow-900/20 rounded-xl p-3 text-center border border-yellow-200 dark:border-yellow-800">
                                <div class="text-yellow-700 dark:text-yellow-300 font-bold text-lg">${Math.round(alt.glucides_pour_100g)}g</div>
                                <div class="text-xs font-bold text-yellow-900 dark:text-yellow-100 mt-1">Glucides</div>
                            </div>
                            <div class="bg-gradient-to-br from-green-50 to-green-100 dark:bg-green-900/20 rounded-xl p-3 text-center border border-green-200 dark:border-green-800">
                                <div class="text-green-700 dark:text-green-300 font-bold text-lg">${Math.round(alt.lipides_pour_100g)}g</div>
                                <div class="text-xs font-bold text-green-900 dark:text-green-100 mt-1">Lipides</div>
                            </div>
                        </div>
                        
                        ${alt.fibres_pour_100g ? `
                            <div class="mt-4 bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 rounded-xl p-3 border border-purple-200 dark:border-purple-800">
                                <div class="flex items-center justify-center space-x-2">
                                    <span class="font-bold text-purple-900 dark:text-purple-100">Fibres:</span>
                                    <span class="text-lg font-bold text-purple-700 dark:text-purple-300">${Math.round(alt.fibres_pour_100g)}g</span>
                                </div>
                            </div>
                        ` : ''}
                    </div>
                `;
            });
            
            html += '</div>';
        } else {
            html += `
                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-12 text-center border-2 border-dashed border-gray-300">
                    <div class="text-6xl mb-4">🔍</div>
                    <h4 class="font-bold text-xl text-gray-900 dark:text-white mb-2">Aucune alternative trouvée</h4>
                    <p class="text-gray-700 dark:text-gray-300">Cet ingrédient est unique dans notre base de données</p>
                </div>
            `;
        }
        
        // Analyse AI
        if (data.ai_analysis) {
            const analysis = data.ai_analysis;
            html += `
                <div class="bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 rounded-xl p-6 border-2 border-indigo-200">
                    <div class="flex items-start space-x-3">
                        <svg class="w-8 h-8 text-indigo-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                        <div class="flex-1">
                            <h4 class="font-bold text-lg text-indigo-900 dark:text-indigo-300 mb-3">💡 Analyse Nutritionnelle IA</h4>
                            <div class="bg-white dark:bg-gray-800 rounded-lg p-4">
                                <p class="text-gray-900 dark:text-white leading-relaxed">${analysis.message || analysis.recommendation || 'Alternatives similaires sur le plan nutritionnel'}</p>
                            </div>
                            ${analysis.recommendations && analysis.recommendations.length > 0 ? `
                                <div class="mt-4 space-y-2">
                                    <h5 class="font-semibold text-indigo-800 dark:text-indigo-300 text-sm">Recommandations:</h5>
                                    <ul class="space-y-1">
                                        ${analysis.recommendations.map(rec => `
                                            <li class="flex items-start space-x-2 text-sm text-gray-900 dark:text-white">
                                                <svg class="w-4 h-4 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span>${rec}</span>
                                            </li>
                                        `).join('')}
                                    </ul>
                                </div>
                            ` : ''}
                        </div>
                    </div>
                </div>
            `;
        }
        
        html += '</div>';
        content.innerHTML = html;
        
    } catch (error) {
        console.error('Error:', error);
        content.innerHTML = `
            <div class="p-8 bg-red-50 dark:bg-red-900/20 rounded-xl border-2 border-red-200">
                <div class="flex flex-col items-center space-y-4">
                    <svg class="w-16 h-16 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="text-center">
                        <h4 class="font-bold text-xl text-red-800 dark:text-red-300 mb-2">Erreur de Chargement</h4>
                        <p class="text-red-600 dark:text-red-400">Impossible de charger les alternatives</p>
                        <p class="text-sm text-gray-700 dark:text-gray-300 mt-2">Vérifiez que le serveur Python AI est actif</p>
                    </div>
                </div>
            </div>
        `;
    }
}

function hideAlternatives() {
    document.getElementById('alternativesModal').classList.add('hidden');
}

</script>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
