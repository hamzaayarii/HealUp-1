@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-green-50 dark:from-gray-900 dark:to-gray-800 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <div class="flex items-center space-x-3">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-green-500 rounded-2xl flex items-center justify-center shadow-lg">
                                <span class="text-3xl">🍽️</span>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-green-500 bg-clip-text text-transparent">
                                    Meal Tracking
                                </h1>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    Track, analyze and optimize your daily meals with AI
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0 flex flex-wrap gap-3">
                        <button onclick="showAIPanel()" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-500 via-purple-600 to-pink-500 hover:from-purple-600 hover:via-purple-700 hover:to-pink-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-105 hover:-translate-y-0.5">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                            <span>AI Analysis</span>
                            <span class="ml-2 px-2 py-0.5 bg-white/20 rounded-full text-xs">Python</span>
                        </button>
                        <a href="{{ route('repas.create') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-105 hover:-translate-y-0.5">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Add Meal
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- AI Features Banner -->
        <div class="mb-6 relative overflow-hidden bg-gradient-to-r from-purple-500 via-blue-500 to-green-500 rounded-2xl shadow-2xl p-0.5">
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6">
                <div class="flex items-center mb-6">
                    <div class="flex-shrink-0">
                        <div class="w-14 h-14 bg-gradient-to-br from-purple-500 via-pink-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg animate-pulse">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 flex-1">
                        <h3 class="text-xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">
                            🤖 Local Python Artificial Intelligence
                        </h3>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Advanced nutritional analysis with expert system based on WHO/ANSES recommendations
                        </p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Feature 1 -->
                    <div class="group relative overflow-hidden p-4 bg-gradient-to-br from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 rounded-xl border-2 border-purple-200 dark:border-purple-700/50 hover:border-purple-400 dark:hover:border-purple-500 transition-all duration-300 hover:shadow-lg cursor-pointer">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-purple-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-bold text-gray-900 dark:text-white">Python AI Local</h4>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Integrated expert system</p>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="group relative overflow-hidden p-4 bg-gradient-to-br from-blue-50 to-cyan-50 dark:from-blue-900/20 dark:to-cyan-900/20 rounded-xl border-2 border-blue-200 dark:border-blue-700/50 hover:border-blue-400 dark:hover:border-blue-500 transition-all duration-300 hover:shadow-lg cursor-pointer">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-bold text-gray-900 dark:text-white">5 AI Functions</h4>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Intelligent suggestions</p>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="group relative overflow-hidden p-4 bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl border-2 border-green-200 dark:border-green-700/50 hover:border-green-400 dark:hover:border-green-500 transition-all duration-300 hover:shadow-lg cursor-pointer">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-bold text-gray-900 dark:text-white">Modern Interface</h4>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Intuitive design</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex flex-wrap items-center justify-center gap-8 text-sm">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <span class="font-medium text-gray-700 dark:text-gray-300">GDPR Compliant</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="font-medium text-gray-700 dark:text-gray-300">WHO/ANSES</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-6 relative overflow-hidden bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl shadow-xl p-0.5 animate-in slide-in-from-top duration-500">
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                        </div>
                        <p class="ml-4 text-lg font-semibold text-gray-900 dark:text-white">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 relative overflow-hidden bg-gradient-to-r from-red-500 to-pink-500 rounded-2xl shadow-xl p-0.5 animate-in slide-in-from-top duration-500">
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-gradient-to-br from-red-400 to-red-600 rounded-xl flex items-center justify-center">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                        </div>
                        <p class="ml-4 text-lg font-semibold text-gray-900 dark:text-white">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Search & Filters Section -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden mb-6 transition-all duration-300 hover:shadow-2xl">
            <div class="bg-gradient-to-r from-purple-500 via-blue-500 to-cyan-500 p-0.5">
                <div class="bg-white dark:bg-gray-800 p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-blue-600 rounded-xl flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Search and Filters</h3>
                    </div>
                    
                    <form method="GET" action="{{ route('repas.index') }}" class="space-y-4">
                
                <!-- Search Bar -->
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-purple-500 transition-colors duration-200 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Search by meal name or ingredients..." 
                           class="block w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 dark:border-gray-600 rounded-xl bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 group-hover:border-purple-300 group-hover:shadow-md">
                </div>

                <!-- Filters Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    
                    <!-- Type de Repas -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                            <span class="mr-2">🍽️</span> Meal Type
                        </label>
                        <select name="type_repas" 
                                class="block w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 group-hover:border-purple-300 group-hover:shadow-md">
                            <option value="">All types</option>
                            @foreach($typesRepas as $type)
                                <option value="{{ $type }}" {{ request('type_repas') == $type ? 'selected' : '' }}>
                                    {{ ucfirst(str_replace('-', ' ', $type)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Date Début -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                            <span class="mr-2">📅</span> Start Date
                        </label>
                        <input type="date" 
                               name="date_debut" 
                               value="{{ request('date_debut') }}"
                               class="block w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 group-hover:border-blue-300 group-hover:shadow-md">
                    </div>

                    <!-- Date Fin -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                            <span class="mr-2">📅</span> End Date
                        </label>
                        <input type="date" 
                               name="date_fin" 
                               value="{{ request('date_fin') }}"
                               class="block w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition-all duration-200 group-hover:border-cyan-300 group-hover:shadow-md">
                    </div>

                    <!-- Sort -->
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                            <span class="mr-2">📊</span> Sort by
                        </label>
                        <select name="sort" 
                                class="block w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 group-hover:border-green-300 group-hover:shadow-md">
                            <option value="date_consommation" {{ request('sort') == 'date_consommation' ? 'selected' : '' }}>Date (newest)</option>
                            <option value="nom" {{ request('sort') == 'nom' ? 'selected' : '' }}>Name (A-Z)</option>
                            <option value="calories_total" {{ request('sort') == 'calories_total' ? 'selected' : '' }}>Calories</option>
                            <option value="proteines_total" {{ request('sort') == 'proteines_total' ? 'selected' : '' }}>Proteins</option>
                        </select>
                    </div>
                </div>

                <!-- Advanced Filters Toggle -->
                <div x-data="{ showAdvanced: false }" class="mt-2">
                    <button type="button" 
                            @click="showAdvanced = !showAdvanced"
                            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-purple-600 dark:text-purple-400 hover:text-purple-700 dark:hover:text-purple-300 bg-purple-50 dark:bg-purple-900/20 rounded-lg hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-all duration-200">
                        <svg class="w-4 h-4 transition-transform duration-200" :class="showAdvanced ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                        <span x-show="!showAdvanced">Show advanced filters</span>
                        <span x-show="showAdvanced">Hide advanced filters</span>
                    </button>

                    <div x-show="showAdvanced" 
                         x-cloak
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 transform -translate-y-2"
                         x-transition:enter-end="opacity-100 transform translate-y-0"
                         class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4 p-4 bg-gradient-to-br from-purple-50 to-blue-50 dark:from-gray-700 dark:to-gray-800 rounded-xl">
                        
                        <!-- Min Calories -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                <span class="mr-2">🔥</span> Min Calories
                            </label>
                            <input type="number" 
                                   name="min_calories" 
                                   value="{{ request('min_calories') }}"
                                   placeholder="0"
                                   class="block w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 group-hover:border-orange-300 group-hover:shadow-md">
                        </div>

                        <!-- Max Calories -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                <span class="mr-2">🔥</span> Max Calories
                            </label>
                            <input type="number" 
                                   name="max_calories" 
                                   value="{{ request('max_calories') }}"
                                   placeholder="3000"
                                   class="block w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all duration-200 group-hover:border-orange-300 group-hover:shadow-md">
                        </div>

                        <!-- Min Proteins -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                <span class="mr-2">💪</span> Min Proteins (g)
                            </label>
                            <input type="number" 
                                   name="min_proteines" 
                                   value="{{ request('min_proteines') }}"
                                   placeholder="0"
                                   class="block w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 group-hover:border-green-300 group-hover:shadow-md">
                        </div>

                        <!-- Sort Direction -->
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                <span class="mr-2">↕️</span> Direction
                            </label>
                            <select name="direction" 
                                    class="block w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 group-hover:border-blue-300 group-hover:shadow-md">
                                <option value="desc" {{ request('direction') == 'desc' ? 'selected' : '' }}>Descending</option>
                                <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-3 pt-2">
                    <button type="submit" 
                            class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-purple-500 via-blue-500 to-cyan-500 hover:from-purple-600 hover:via-blue-600 hover:to-cyan-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl hover:scale-105 hover:-translate-y-0.5 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        Apply Filters
                    </button>
                    <a href="{{ route('repas.index') }}" 
                       class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-200 hover:scale-105 hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Reset
                    </a>
                </div>
            </form>
                </div>
            </div>
        </div>

        <!-- Results Count -->
        <div class="mb-6 flex items-center justify-between bg-gradient-to-r from-purple-50 to-blue-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-4 border border-purple-100 dark:border-gray-600">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Total Meals</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $repas->total() }}</p>
                </div>
            </div>
            @if(request()->hasAny(['search', 'type_repas', 'date_debut', 'date_fin']))
                <div class="flex items-center gap-2 px-4 py-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                    <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    <span class="text-sm font-semibold text-purple-700 dark:text-purple-300">Active Filters</span>
                </div>
            @endif
        </div>

        <!-- Meals List -->
        @if($repas->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($repas as $repas_item)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <!-- Card Header -->
                        <div class="bg-gradient-to-r 
                            @if($repas_item->type_repas == 'petit-dejeuner') from-yellow-400 to-yellow-500
                            @elseif($repas_item->type_repas == 'dejeuner') from-orange-400 to-orange-500
                            @elseif($repas_item->type_repas == 'diner') from-blue-400 to-blue-500
                            @else from-gray-400 to-gray-500
                            @endif
                            p-4">
                            <h3 class="text-white font-bold text-lg">{{ $repas_item->nom }}</h3>
                            <p class="text-white text-sm opacity-90">
                                {{ \Carbon\Carbon::parse($repas_item->date_consommation)->format('M d, Y') }}
                            </p>
                        </div>

                        <!-- Card Body -->
                        <div class="p-4">
                            <!-- Nutrition Info -->
                            <div class="grid grid-cols-2 gap-3 mb-4">
                                <div class="text-center p-3 bg-gradient-to-br from-red-50 to-orange-50 dark:bg-red-900/20 rounded-xl border border-red-200 dark:border-red-800">
                                    <p class="text-xs font-semibold text-red-800 dark:text-red-300 mb-1">🔥 Calories</p>
                                    <p class="text-xl font-bold text-red-600 dark:text-red-400">{{ round($repas_item->calories_total) }}</p>
                                    <p class="text-xs text-red-600 dark:text-red-400">kcal</p>
                                </div>
                                <div class="text-center p-3 bg-gradient-to-br from-blue-50 to-cyan-50 dark:bg-blue-900/20 rounded-xl border border-blue-200 dark:border-blue-800">
                                    <p class="text-xs font-semibold text-blue-800 dark:text-blue-300 mb-1">💪 Protéines</p>
                                    <p class="text-xl font-bold text-blue-600 dark:text-blue-400">{{ round($repas_item->proteines_total) }}</p>
                                    <p class="text-xs text-blue-600 dark:text-blue-400">grammes</p>
                                </div>
                                <div class="text-center p-3 bg-gradient-to-br from-yellow-50 to-amber-50 dark:bg-yellow-900/20 rounded-xl border border-yellow-200 dark:border-yellow-800">
                                    <p class="text-xs font-semibold text-yellow-800 dark:text-yellow-300 mb-1">🌾 Glucides</p>
                                    <p class="text-xl font-bold text-yellow-600 dark:text-yellow-400">{{ round($repas_item->glucides_total) }}</p>
                                    <p class="text-xs text-yellow-600 dark:text-yellow-400">grammes</p>
                                </div>
                                <div class="text-center p-3 bg-gradient-to-br from-green-50 to-emerald-50 dark:bg-green-900/20 rounded-xl border border-green-200 dark:border-green-800">
                                    <p class="text-xs font-semibold text-green-800 dark:text-green-300 mb-1">🥑 Lipides</p>
                                    <p class="text-xl font-bold text-green-600 dark:text-green-400">{{ round($repas_item->lipides_total) }}</p>
                                    <p class="text-xs text-green-600 dark:text-green-400">grammes</p>
                                </div>
                            </div>

                            <!-- Ingredients Count -->
                            <div class="flex items-center justify-center text-sm text-gray-700 dark:text-gray-300 mb-4 p-2 bg-gray-50 dark:bg-gray-700/50 rounded-lg border border-gray-200 dark:border-gray-600">
                                <svg class="w-4 h-4 mr-2 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                <span class="font-semibold">{{ $repas_item->repasIngredients->count() }}</span>
                                <span class="ml-1">ingredients</span>
                            </div>

                            <!-- Actions -->
                            <div class="flex space-x-2">
                                <a href="{{ route('repas.show', $repas_item->id) }}" 
                                   class="flex-1 text-center px-3 py-2.5 bg-gradient-to-r from-blue-100 to-cyan-100 hover:from-blue-200 hover:to-cyan-200 dark:bg-blue-900/30 dark:hover:bg-blue-900/50 text-blue-700 dark:text-blue-300 text-sm font-semibold rounded-lg transition-all duration-200 border border-blue-200 dark:border-blue-700">
                                    👁️ View
                                </a>
                                <a href="{{ route('repas.edit', $repas_item->id) }}" 
                                   class="flex-1 text-center px-3 py-2.5 bg-gradient-to-r from-green-100 to-emerald-100 hover:from-green-200 hover:to-emerald-200 dark:bg-green-900/30 dark:hover:bg-green-900/50 text-green-700 dark:text-green-300 text-sm font-semibold rounded-lg transition-all duration-200 border border-green-200 dark:border-green-700">
                                    ✏️ Edit
                                </a>
                                <button onclick="analyzeMealQuality({{ $repas_item->id }})"
                                        title="Analyze with AI"
                                        class="px-3 py-2.5 bg-gradient-to-r from-purple-100 to-pink-100 hover:from-purple-200 hover:to-pink-200 dark:bg-purple-900/30 dark:hover:bg-purple-900/50 text-purple-700 dark:text-purple-300 text-sm font-semibold rounded-lg transition-all duration-200 border border-purple-200 dark:border-purple-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $repas->links() }}
            </div>
        @else
            <div class="bg-gradient-to-br from-blue-50 to-purple-50 dark:bg-gray-800 rounded-2xl shadow-xl border-2 border-blue-200 dark:border-gray-700 p-12 text-center">
                <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-blue-400 to-purple-600 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">📋 No Meals Found</h3>
                <p class="text-base text-gray-600 dark:text-gray-400 mb-6 max-w-md mx-auto">
                    Start tracking your nutrition by adding your first meal. AI will help you analyze and optimize your diet!
                </p>
                <a href="{{ route('repas.create') }}" 
                   class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-purple-500 via-blue-500 to-cyan-500 hover:from-purple-600 hover:via-blue-600 hover:to-cyan-600 text-white font-bold text-lg rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 hover:scale-105 hover:-translate-y-0.5">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    ➕ Add My First Meal
                </a>
            </div>
        @endif
    </div>
</div>

<!-- AI Panel Modal -->
<div id="aiPanel" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto border-2 border-purple-200 dark:border-purple-700">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6 pb-4 border-b-2 border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">🤖 AI Nutrition Intelligence</h2>
                </div>
                <button onclick="hideAIPanel()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="space-y-4">
                <button onclick="getMealSuggestions()" class="w-full text-left p-4 bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 rounded-lg hover:shadow-lg transition-all duration-200 border-2 border-purple-200 dark:border-purple-700 hover:border-purple-400 dark:hover:border-purple-500">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-pink-600 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-purple-900 dark:text-purple-300">📋 Meal Suggestions</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">AI-powered personalized recommendations</p>
                        </div>
                    </div>
                </button>

                <button onclick="analyzeNutrition()" class="w-full text-left p-4 bg-gradient-to-r from-blue-50 to-cyan-50 dark:from-blue-900/20 dark:to-cyan-900/20 rounded-lg hover:shadow-lg transition-all duration-200 border-2 border-blue-200 dark:border-blue-700 hover:border-blue-400 dark:hover:border-blue-500">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-cyan-600 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-blue-900 dark:text-blue-300">📊 Analyze Nutritional Balance</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Insights on your eating patterns</p>
                        </div>
                    </div>
                </button>

                <button onclick="detectDeficiencies()" class="w-full text-left p-4 bg-gradient-to-r from-orange-50 to-yellow-50 dark:from-orange-900/20 dark:to-yellow-900/20 rounded-lg hover:shadow-lg transition-all duration-200 border-2 border-orange-200 dark:border-orange-700 hover:border-orange-400 dark:hover:border-orange-500">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-orange-400 to-yellow-600 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-orange-900 dark:text-orange-300">⚠️ Detect Deficiencies</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Identify nutritional gaps in your diet</p>
                        </div>
                    </div>
                </button>

                <button onclick="generateWeeklyPlan()" class="w-full text-left p-4 bg-gradient-to-r from-green-50 to-teal-50 dark:from-green-900/20 dark:to-teal-900/20 rounded-lg hover:shadow-lg transition-all duration-200 border-2 border-green-200 dark:border-green-700 hover:border-green-400 dark:hover:border-green-500">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-teal-600 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-green-900 dark:text-green-300">📅 Generate Weekly Plan</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Complete 7-day meal plan</p>
                        </div>
                    </div>
                </button>
            </div>

            <div id="aiResults" class="mt-6 hidden">
                <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div class="animate-pulse flex items-center justify-center py-4">
                        <svg class="w-6 h-6 text-purple-500 animate-spin mr-2" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="text-gray-700 dark:text-gray-300">Loading AI insights...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showAIPanel() {
    document.getElementById('aiPanel').classList.remove('hidden');
}

function hideAIPanel() {
    document.getElementById('aiPanel').classList.add('hidden');
}

async function analyzeMealQuality(mealId) {
    const resultsDiv = document.getElementById('aiResults');
    const panel = document.getElementById('aiPanel');
    
    // Show panel and loading state
    panel.classList.remove('hidden');
    resultsDiv.classList.remove('hidden');
    resultsDiv.innerHTML = '<div class="p-6 bg-gray-50 dark:bg-gray-700 rounded-lg"><div class="animate-pulse flex items-center justify-center py-8"><svg class="w-8 h-8 text-blue-500 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><span class="ml-3 text-gray-600 dark:text-gray-300">Analyzing meal quality...</span></div></div>';
    
    try {
        const response = await fetch(`/repas/${mealId}/analyze-quality`);
        const data = await response.json();
        const quality = data.quality || data;
        const scores = quality.scores || {};
        const evaluation = quality.ai_evaluation || {};
        
        let html = '<div class="space-y-6">';
        
        // Header
        const globalScore = scores.global || 0;
        const scoreColor = globalScore >= 80 ? 'from-green-500 to-emerald-500' : 
                          globalScore >= 60 ? 'from-yellow-500 to-orange-500' : 
                          'from-red-500 to-pink-500';
        
        html += `
            <div class="bg-gradient-to-r ${scoreColor} rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold mb-2">🎯 Meal Quality Analysis</h3>
                        <p class="text-white/90">AI-powered nutritional evaluation</p>
                    </div>
                    <div class="text-center">
                        <div class="text-5xl font-bold">${globalScore}</div>
                        <div class="text-sm text-white/90">/ 100</div>
                    </div>
                </div>
            </div>
        `;
        
        // Detailed Scores
        html += '<div class="grid grid-cols-1 md:grid-cols-3 gap-4">';
        
        if (scores.equilibre !== undefined) {
            html += `
                <div class="bg-gradient-to-br from-blue-50 to-cyan-50 dark:from-blue-900/20 dark:to-cyan-900/20 rounded-xl p-5 border-2 border-blue-200 dark:border-blue-700">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-3xl">⚖️</span>
                        <div class="text-2xl font-bold text-blue-900 dark:text-blue-100">${scores.equilibre}/100</div>
                    </div>
                    <h4 class="font-bold text-gray-800 dark:text-white">Balance</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Nutritional equilibrium</p>
                </div>
            `;
        }
        
        if (scores.qualite !== undefined) {
            html += `
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl p-5 border-2 border-green-200 dark:border-green-700">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-3xl">✨</span>
                        <div class="text-2xl font-bold text-green-900 dark:text-green-100">${scores.qualite}/100</div>
                    </div>
                    <h4 class="font-bold text-gray-800 dark:text-white">Quality</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Ingredient quality</p>
                </div>
            `;
        }
        
        if (scores.diversite !== undefined) {
            html += `
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 rounded-xl p-5 border-2 border-purple-200 dark:border-purple-700">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-3xl">🌈</span>
                        <div class="text-2xl font-bold text-purple-900 dark:text-purple-100">${scores.diversite}/100</div>
                    </div>
                    <h4 class="font-bold text-gray-800 dark:text-white">Diversity</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Ingredient variety</p>
                </div>
            `;
        }
        
        html += '</div>';
        
        // AI Evaluation
        if (evaluation.points_forts && evaluation.points_forts.length > 0) {
            html += `
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl p-6 border-2 border-green-200 dark:border-green-800">
                    <h4 class="font-bold text-lg text-gray-800 dark:text-white mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Strengths
                    </h4>
                    <ul class="space-y-2">
            `;
            evaluation.points_forts.forEach(point => {
                html += `
                    <li class="flex items-start space-x-2 text-gray-700 dark:text-gray-300">
                        <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>${point}</span>
                    </li>
                `;
            });
            html += '</ul></div>';
        }
        
        if (evaluation.ameliorations && evaluation.ameliorations.length > 0) {
            html += `
                <div class="bg-gradient-to-r from-orange-50 to-yellow-50 dark:from-orange-900/20 dark:to-yellow-900/20 rounded-xl p-6 border-2 border-orange-200 dark:border-orange-800">
                    <h4 class="font-bold text-lg text-gray-800 dark:text-white mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Improvements
                    </h4>
                    <ul class="space-y-2">
            `;
            evaluation.ameliorations.forEach(point => {
                html += `
                    <li class="flex items-start space-x-2 text-gray-700 dark:text-gray-300">
                        <svg class="w-5 h-5 text-orange-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                        <span>${point}</span>
                    </li>
                `;
            });
            html += '</ul></div>';
        }
        
        html += '</div>';
        resultsDiv.innerHTML = html;
        
    } catch (error) {
        console.error('Error:', error);
        resultsDiv.innerHTML = `
            <div class="p-6 bg-red-50 dark:bg-red-900/20 rounded-xl border-2 border-red-200 dark:border-red-800">
                <div class="flex items-center space-x-3">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <h4 class="font-bold text-red-800 dark:text-red-300">Analysis Error</h4>
                        <p class="text-sm text-red-600 dark:text-red-400">Unable to analyze meal quality. Please try again.</p>
                    </div>
                </div>
            </div>
        `;
    }
}

async function getMealSuggestions() {
    const resultsDiv = document.getElementById('aiResults');
    resultsDiv.classList.remove('hidden');
    resultsDiv.innerHTML = '<div class="p-6 bg-gray-50 dark:bg-gray-700 rounded-lg"><div class="animate-pulse flex items-center justify-center py-8"><svg class="w-8 h-8 text-purple-500 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><span class="ml-3 text-gray-600 dark:text-gray-300">Generating meal suggestions...</span></div></div>';
    
    try {
        const response = await fetch('/repas/ai/suggestions', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                objectif_calories: 2000,
                objectif_proteines: 100
            })
        });
        const result = await response.json();
        console.log('Full API Response:', result); // Debug
        
        // Le serveur Laravel retourne { success: true, suggestions: { data: { plan_hebdomadaire: [...] } } }
        // Le serveur Python retourne { success: true, data: { plan_hebdomadaire: [...] } }
        let data;
        if (result.suggestions) {
            // Réponse de Laravel qui a wrappé la réponse Python
            data = result.suggestions.data || result.suggestions;
        } else {
            // Réponse directe du Python
            data = result.data || result;
        }
        console.log('Extracted data:', data); // Debug
        
        let html = '<div class="space-y-6">';
        
        // Header
        const targetCalories = data.objectif_calories || data.target_calories || 2000;
        html += `
            <div class="bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold mb-2">📋 Meal Suggestions</h3>
                        <p class="text-purple-100">AI-powered personalized recommendations</p>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold">${targetCalories}</div>
                        <div class="text-sm text-purple-100">kcal/day</div>
                    </div>
                </div>
            </div>
        `;
        
        // Meal suggestions - Chercher dans plusieurs formats possibles
        const suggestions = data.plan_hebdomadaire || data.repas_suggeres || data.suggestions || data.meals || [];
        if (suggestions && suggestions.length > 0) {
            html += `<div class="mb-4 text-center"><p class="text-sm text-gray-600 dark:text-gray-400">Generated <strong>${suggestions.length}</strong> meal suggestions for you</p></div>`;
            html += '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">';
            suggestions.forEach((meal, index) => {
                const colors = [
                    'from-blue-50 to-blue-100 border-blue-200',
                    'from-green-50 to-green-100 border-green-200',
                    'from-orange-50 to-orange-100 border-orange-200',
                    'from-purple-50 to-purple-100 border-purple-200',
                    'from-pink-50 to-pink-100 border-pink-200',
                    'from-yellow-50 to-yellow-100 border-yellow-200'
                ];
                const mealTypes = {
                    'petit_dejeuner': '🌅 Breakfast',
                    'petit-dejeuner': '🌅 Breakfast',
                    'breakfast': '🌅 Breakfast',
                    'dejeuner': '🍽️ Lunch',
                    'lunch': '🍽️ Lunch',
                    'diner': '🌙 Dinner',
                    'dinner': '🌙 Dinner',
                    'collation': '🥤 Snack',
                    'snack': '🥤 Snack'
                };
                
                const mealType = meal.type_repas || meal.type || meal.meal_type || 'meal';
                const mealName = meal.nom || meal.name || meal.meal_name || 'Suggested Meal';
                const mealDesc = meal.description || meal.desc || '';
                const mealDay = meal.jour || meal.day || `Suggestion ${index + 1}`;
                const calories = Math.round(meal.calories || meal.calories_total || 0);
                
                // Calculer les macros proportionnellement si non fournis
                const proteins = meal.proteines || meal.proteins || meal.proteines_total || Math.round(calories * 0.2 / 4);
                const carbs = meal.glucides || meal.carbs || meal.glucides_total || Math.round(calories * 0.5 / 4);
                const fats = meal.lipides || meal.fats || meal.lipides_total || Math.round(calories * 0.3 / 9);
                
                html += `
                    <div class="bg-gradient-to-br ${colors[index % colors.length]} dark:from-gray-800 dark:to-gray-700 border-2 rounded-xl p-5 shadow-lg hover:shadow-xl transition hover:scale-105 duration-200">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm font-bold text-gray-700 dark:text-gray-200 px-3 py-1 bg-white/80 dark:bg-gray-600/80 rounded-full">
                                ${mealTypes[mealType.toLowerCase()] || '🍴 Meal'}
                            </span>
                            <span class="px-3 py-1 bg-white dark:bg-gray-600 rounded-full text-sm font-bold text-gray-700 dark:text-gray-200">
                                ${calories} kcal
                            </span>
                        </div>
                        <div class="mb-2">
                            <span class="text-xs font-semibold text-gray-500 dark:text-gray-400">${mealDay}</span>
                        </div>
                        <h4 class="font-bold text-lg text-gray-800 dark:text-white mb-2">${mealName}</h4>
                        ${mealDesc ? `<p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed mb-3">${mealDesc}</p>` : ''}
                        <div class="flex items-center justify-between text-xs text-gray-600 dark:text-gray-400 pt-3 border-t border-gray-200 dark:border-gray-600">
                            <span title="Proteins">💪 ${proteins}g</span>
                            <span title="Carbohydrates">🌾 ${carbs}g</span>
                            <span title="Fats">🥑 ${fats}g</span>
                        </div>
                    </div>
                `;
            });
            html += '</div>';
        } else {
            html += `
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 rounded-xl p-8 text-center border-2 border-gray-200 dark:border-gray-600">
                    <div class="text-6xl mb-4">🍽️</div>
                    <h4 class="font-bold text-xl text-gray-900 dark:text-white mb-2">No suggestions available</h4>
                    <p class="text-gray-600 dark:text-gray-400">The AI couldn't generate meal suggestions. Try adding more meals to your history.</p>
                </div>
            `;
        }
        
        // Tips/Advice
        const tips = data.conseils || data.tips || data.recommendations || [];
        if (tips && tips.length > 0) {
            html += `
                <div class="bg-gradient-to-r from-green-50 to-teal-50 dark:from-green-900/20 dark:to-teal-900/20 rounded-xl p-6 border-2 border-green-200 dark:border-green-800">
                    <h4 class="font-bold text-lg text-gray-800 dark:text-white mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Nutritional Tips
                    </h4>
                    <ul class="space-y-2">
            `;
            tips.forEach(tip => {
                html += `
                    <li class="flex items-start space-x-2 text-gray-700 dark:text-gray-300">
                        <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                        <span>${tip}</span>
                    </li>
                `;
            });
            html += `
                    </ul>
                </div>
            `;
        }
        
        html += '</div>';
        resultsDiv.innerHTML = html;
        
    } catch (error) {
        console.error('Error:', error);
        resultsDiv.innerHTML = `
            <div class="p-6 bg-red-50 dark:bg-red-900/20 rounded-xl border-2 border-red-200 dark:border-red-800">
                <div class="flex items-center space-x-3">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <h4 class="font-bold text-red-800 dark:text-red-300">Loading Error</h4>
                        <p class="text-sm text-red-600 dark:text-red-400">Make sure the Python AI server is running on port 5000</p>
                    </div>
                </div>
            </div>
        `;
    }
}

async function analyzeNutrition() {
    const resultsDiv = document.getElementById('aiResults');
    resultsDiv.classList.remove('hidden');
    resultsDiv.innerHTML = '<div class="p-6 bg-gray-50 dark:bg-gray-700 rounded-lg"><div class="animate-pulse flex items-center justify-center py-8"><svg class="w-8 h-8 text-blue-500 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><span class="ml-3 text-gray-600 dark:text-gray-300">Nutritional analysis in progress...</span></div></div>';
    
    try {
        const response = await fetch('/repas/ai/analyze-balance', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ periode: 7 })
        });
        const result = await response.json();
        const data = result.analysis || result.data || result;
        
        let html = '<div class="space-y-6">';
        
        // Header
        html += `
            <div class="bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold mb-2">📊 Nutritional Analysis</h3>
                        <p class="text-blue-100">Period: Last 7 days</p>
                    </div>
                    <div class="text-6xl">🥗</div>
                </div>
            </div>
        `;
        
        // Statistics
        if (data.moyennes || data.stats) {
            const stats = data.moyennes || data.stats || {};
            html += `
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border-2 border-red-300 dark:border-red-700 hover:shadow-lg transition-shadow">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-3xl">🔥</span>
                            <div class="w-10 h-10 bg-gradient-to-br from-red-400 to-red-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="text-sm font-bold text-gray-800 dark:text-gray-200 mb-2">Calories/day</div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-white">${Math.round(stats.calories_total || stats.calories || 0)}</div>
                        <div class="text-xs font-semibold text-gray-600 dark:text-gray-400 mt-1">kcal</div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border-2 border-blue-300 dark:border-blue-700 hover:shadow-lg transition-shadow">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-3xl">💪</span>
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="text-sm font-bold text-blue-900 dark:text-blue-100 mb-2">Proteins</div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-white">${Math.round(stats.proteines_total || stats.proteines || 0)}</div>
                        <div class="text-xs font-semibold text-blue-700 dark:text-blue-300 mt-1">grams</div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border-2 border-yellow-300 dark:border-yellow-700 hover:shadow-lg transition-shadow">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-3xl">🌾</span>
                            <div class="w-10 h-10 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="text-sm font-bold text-yellow-900 dark:text-yellow-100 mb-2">Carbs</div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-white">${Math.round(stats.glucides_total || stats.glucides || 0)}</div>
                        <div class="text-xs font-semibold text-yellow-700 dark:text-yellow-300 mt-1">grams</div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border-2 border-green-300 dark:border-green-700 hover:shadow-lg transition-shadow">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-3xl">🥑</span>
                            <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"/>
                                </svg>
                            </div>
                        </div>
                        <div class="text-sm font-bold text-green-900 dark:text-green-100 mb-2">Fats</div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-white">${Math.round(stats.lipides_total || stats.lipides || 0)}</div>
                        <div class="text-xs font-semibold text-green-700 dark:text-green-300 mt-1">grams</div>
                    </div>
                </div>
            `;
        }
        
        // Recommandations
        if (data.recommendations || data.ai_analysis) {
            const recs = data.recommendations || data.ai_analysis.recommendations || [];
            if (recs.length > 0) {
                html += `
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 rounded-xl p-6 border-2 border-purple-200">
                        <h4 class="font-bold text-lg text-gray-800 dark:text-white mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            Recommendations
                        </h4>
                        <ul class="space-y-2">
                `;
                recs.forEach(rec => {
                    html += `
                        <li class="flex items-start space-x-2 text-gray-700 dark:text-gray-300">
                            <svg class="w-5 h-5 text-purple-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            <span>${rec}</span>
                        </li>
                    `;
                });
                html += `</ul></div>`;
            }
        }
        
        html += '</div>';
        resultsDiv.innerHTML = html;
        
    } catch (error) {
        console.error('Error:', error);
        resultsDiv.innerHTML = `
            <div class="p-6 bg-red-50 dark:bg-red-900/20 rounded-xl border-2 border-red-200">
                <div class="flex items-center space-x-3">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <h4 class="font-bold text-red-800 dark:text-red-300">Analysis Error</h4>
                        <p class="text-sm text-red-600 dark:text-red-400">Check that the Python AI server is active</p>
                    </div>
                </div>
            </div>
        `;
    }
}

async function detectDeficiencies() {
    const resultsDiv = document.getElementById('aiResults');
    resultsDiv.classList.remove('hidden');
    resultsDiv.innerHTML = '<div class="p-6 bg-gray-50 dark:bg-gray-700 rounded-lg"><div class="animate-pulse flex items-center justify-center py-8"><svg class="w-8 h-8 text-orange-500 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><span class="ml-3 text-gray-600 dark:text-gray-300">Detecting deficiencies...</span></div></div>';

    try {
        const response = await fetch('/repas/ai/detect-deficiencies', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ periode: 14 })
        });
        const result = await response.json();
        console.log('Deficiencies API Response:', result); // Debug
        
        // Laravel retourne: { success: true, data: { deficiencies: [...], recommendations: [...], stats: {...} } }
        const data = result.data || result;
        console.log('Extracted data:', data); // Debug
        
        let html = '<div class="space-y-6">';
        
        // Header
        html += `
            <div class="bg-gradient-to-r from-orange-500 to-red-500 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold mb-2">⚠️ Deficiency Detection</h3>
                        <p class="text-orange-100">14-day analysis</p>
                    </div>
                    <div class="text-6xl">🔍</div>
                </div>
            </div>
        `;
        
        // Detected deficiencies - Le service Laravel retourne 'deficiencies', pas 'carences_detectees'
        const carences = data.deficiencies || data.carences_detectees || data.carences || [];
        console.log('Found deficiencies:', carences); // Debug
        
        if (carences && carences.length > 0) {
            html += '<div class="space-y-3">';
            carences.forEach(carence => {
                const severity = carence.severite || carence.severity || 'moderate';
                const colorClass = severity === 'élevée' || severity === 'high' 
                    ? 'from-red-100 to-red-200 border-red-300 dark:from-red-900/40 dark:to-red-800/40' 
                    : 'from-yellow-100 to-yellow-200 border-yellow-300 dark:from-yellow-900/40 dark:to-yellow-800/40';
                const icon = severity === 'élevée' || severity === 'high' ? '🔴' : '🟡';
                const nutrient = carence.nutriment || carence.nutrient || carence.nom || 'Unknown';
                
                // Générer un message descriptif si manquant
                let message = carence.message || carence.description || '';
                if (!message) {
                    const severityText = severity === 'élevée' || severity === 'high' ? 'Severe' : 'Moderate';
                    message = `${severityText} deficiency detected. Consider increasing your intake of ${nutrient}.`;
                }
                
                const current = carence.valeur_actuelle || carence.apport_actuel || carence.current_intake || 0;
                const recommended = carence.valeur_recommandee || carence.apport_recommande || carence.recommended_intake || 0;
                
                html += `
                    <div class="bg-gradient-to-r ${colorClass} rounded-xl p-5 border-2">
                        <div class="flex items-start space-x-3">
                            <span class="text-3xl">${icon}</span>
                            <div class="flex-1">
                                <h4 class="font-bold text-lg text-gray-900 dark:text-white mb-1">${nutrient.charAt(0).toUpperCase() + nutrient.slice(1)}</h4>
                                <p class="text-sm text-gray-700 dark:text-gray-300 mb-2">${message}</p>
                                <div class="flex items-center space-x-4 text-xs text-gray-600 dark:text-gray-400">
                                    <span>Current: <strong>${Math.round(current)}</strong></span>
                                    <span>Recommended: <strong>${Math.round(recommended)}</strong></span>
                                    <span class="px-2 py-1 bg-white dark:bg-gray-700 rounded-full font-semibold">
                                        Severity: ${severity === 'élevée' ? 'High' : severity === 'modérée' ? 'Moderate' : severity}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
            html += '</div>';
        } else {
            html += `
                <div class="bg-gradient-to-r from-green-50 to-teal-50 dark:from-green-900/20 dark:to-teal-900/20 rounded-xl p-8 text-center border-2 border-green-200">
                    <div class="text-6xl mb-4">✅</div>
                    <h4 class="font-bold text-xl text-gray-900 dark:text-white mb-2">No deficiencies detected!</h4>
                    <p class="text-gray-600 dark:text-gray-400">Your diet appears to be well balanced</p>
                </div>
            `;
        }
        
        // Recommendations
        const aliments = data.aliments_recommandes || data.recommendations || [];
        if (aliments && aliments.length > 0) {
            html += `
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-xl p-6 border-2 border-blue-200">
                    <h4 class="font-bold text-lg text-gray-800 dark:text-white mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Recommended Foods
                    </h4>
                    <div class="flex flex-wrap gap-2">
            `;
            aliments.forEach(aliment => {
                html += `
                    <span class="px-4 py-2 bg-white dark:bg-gray-700 rounded-full text-sm font-medium text-gray-700 dark:text-gray-300 shadow">
                        🥗 ${aliment}
                    </span>
                `;
            });
            html += `</div></div>`;
        }
        
        html += '</div>';
        resultsDiv.innerHTML = html;
        
    } catch (error) {
        console.error('Error:', error);
        resultsDiv.innerHTML = `
            <div class="p-6 bg-red-50 dark:bg-red-900/20 rounded-xl border-2 border-red-200">
                <div class="flex items-center space-x-3">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <h4 class="font-bold text-red-800 dark:text-red-300">Detection Error</h4>
                        <p class="text-sm text-red-600 dark:text-red-400">Unable to detect deficiencies</p>
                    </div>
                </div>
            </div>
        `;
    }
}

async function generateWeeklyPlan() {
    const resultsDiv = document.getElementById('aiResults');
    resultsDiv.classList.remove('hidden');
    resultsDiv.innerHTML = '<div class="p-6 bg-gray-50 dark:bg-gray-700 rounded-lg"><div class="animate-pulse flex items-center justify-center py-8"><svg class="w-8 h-8 text-green-500 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><span class="ml-3 text-gray-600 dark:text-gray-300">Generating weekly plan...</span></div></div>';
    
    try {
        const response = await fetch('/repas/ai/weekly-plan', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                objectif_calories: 2000,
                nombre_repas: 3
            })
        });
        const result = await response.json();
        const data = result.plan || result.data || result;
        
        let html = '<div class="space-y-6">';
        
        // En-tête
        const totalWeeklyCalories = data.plan_hebdomadaire ? data.plan_hebdomadaire.reduce((sum, day) => {
            return sum + (day.repas ? day.repas.reduce((daySum, meal) => daySum + (meal.calories || 0), 0) : 0);
        }, 0) : 0;
        const avgDailyCalories = Math.round(totalWeeklyCalories / 7);
        
        html += `
            <div class="bg-gradient-to-r from-green-500 to-teal-500 rounded-xl p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold mb-2">📅 Weekly Plan</h3>
                        <p class="text-green-100">7 days of balanced meals</p>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold">${avgDailyCalories}</div>
                        <div class="text-sm text-green-100">kcal/day</div>
                    </div>
                </div>
            </div>
        `;
        
        // Plan hebdomadaire
        if (data.plan_hebdomadaire && data.plan_hebdomadaire.length > 0) {
            const daysEmojis = ['🌅', '☀️', '🌤️', '⛅', '🌥️', '🌦️', '🌙'];
            const dayColors = [
                'from-blue-50 to-blue-100 border-blue-300',
                'from-green-50 to-green-100 border-green-300',
                'from-yellow-50 to-yellow-100 border-yellow-300',
                'from-orange-50 to-orange-100 border-orange-300',
                'from-pink-50 to-pink-100 border-pink-300',
                'from-purple-50 to-purple-100 border-purple-300',
                'from-indigo-50 to-indigo-100 border-indigo-300'
            ];
            
            html += '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">';
            
            data.plan_hebdomadaire.forEach((day, index) => {
                const dayCalories = day.repas ? day.repas.reduce((sum, meal) => sum + (meal.calories || 0), 0) : 0;
                const colorClass = dayColors[index % dayColors.length];
                const emoji = daysEmojis[index % daysEmojis.length];
                
                html += `
                    <div class="bg-gradient-to-br ${colorClass} dark:bg-gray-800 rounded-xl p-5 border-2">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-2">
                                <span class="text-2xl">${emoji}</span>
                                <h4 class="font-bold text-lg text-gray-900 dark:text-white">${day.jour || 'Day ' + (index + 1)}</h4>
                            </div>
                            <span class="px-3 py-1 bg-white dark:bg-gray-700 rounded-full text-sm font-bold text-gray-700 dark:text-gray-300">
                                ${Math.round(dayCalories)} kcal
                            </span>
                        </div>
                        <div class="space-y-2">
                `;
                
                if (day.repas && day.repas.length > 0) {
                    const mealIcons = ['🌅', '🍽️', '🌙'];
                    const mealNames = ['Breakfast', 'Lunch', 'Dinner'];
                    
                    day.repas.forEach((meal, mealIndex) => {
                        html += `
                            <div class="bg-white dark:bg-gray-700 rounded-lg p-3">
                                <div class="flex items-center justify-between mb-1">
                                    <div class="flex items-center space-x-2">
                                        <span>${mealIcons[mealIndex % 3]}</span>
                                        <span class="font-semibold text-sm text-gray-700 dark:text-gray-300">${mealNames[mealIndex % 3]}</span>
                                    </div>
                                    <span class="text-xs font-medium text-gray-500">${Math.round(meal.calories || 0)} kcal</span>
                                </div>
                                <p class="text-xs text-gray-600 dark:text-gray-400">${meal.nom || meal.description || 'Balanced meal'}</p>
                            </div>
                        `;
                    });
                } else {
                    html += '<p class="text-sm text-gray-500 dark:text-gray-400 text-center py-2">No meals planned</p>';
                }
                
                html += `
                        </div>
                    </div>
                `;
            });
            
            html += '</div>';
        } else {
            html += `
                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-8 text-center">
                    <div class="text-6xl mb-4">📋</div>
                    <p class="text-gray-600 dark:text-gray-400">No plan available</p>
                </div>
            `;
        }
        
        // Conseils
        if (data.conseils && data.conseils.length > 0) {
            html += `
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-xl p-6 border-2 border-blue-200">
                    <h4 class="font-bold text-lg text-gray-800 dark:text-white mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                        Weekly Tips
                    </h4>
                    <ul class="space-y-2">
            `;
            data.conseils.forEach(conseil => {
                html += `
                    <li class="flex items-start space-x-2 text-gray-700 dark:text-gray-300">
                        <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm">${conseil}</span>
                    </li>
                `;
            });
            html += `</ul></div>`;
        }
        
        html += '</div>';
        resultsDiv.innerHTML = html;
        
    } catch (error) {
        console.error('Error:', error);
        resultsDiv.innerHTML = `
            <div class="p-6 bg-red-50 dark:bg-red-900/20 rounded-xl border-2 border-red-200">
                <div class="flex items-center space-x-3">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <h4 class="font-bold text-red-800 dark:text-red-300">Generation Error</h4>
                        <p class="text-sm text-red-600 dark:text-red-400">Unable to generate weekly plan</p>
                    </div>
                </div>
            </div>
        `;
    }
}
</script>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
