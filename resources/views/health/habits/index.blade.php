<x-app-layout>
    <!-- My Habits Hero Section -->
    <div class="relative min-h-screen bg-gradient-to-br from-emerald-50 via-white to-teal-50 dark:from-gray-900 dark:via-gray-900 dark:to-emerald-900/20 theme-transition overflow-hidden">
        <!-- Fast-Moving Green Background Bubbles -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-20 left-10 w-80 h-80 bg-gradient-to-br from-emerald-200 to-teal-300 dark:from-emerald-800 dark:to-teal-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float-fast"></div>
            <div class="absolute top-40 right-10 w-72 h-72 bg-gradient-to-br from-green-200 to-emerald-300 dark:from-green-800 dark:to-emerald-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float-fast" style="animation-delay: 0.5s;"></div>
            <div class="absolute bottom-40 left-1/2 w-72 h-72 bg-gradient-to-br from-teal-200 to-cyan-300 dark:from-teal-800 dark:to-cyan-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float-fast" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/3 left-1/4 w-64 h-64 bg-gradient-to-br from-lime-200 to-emerald-300 dark:from-lime-800 dark:to-emerald-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-60 animate-float-fast" style="animation-delay: 0.3s;"></div>
            <div class="absolute bottom-1/4 right-1/4 w-56 h-56 bg-gradient-to-br from-emerald-200 to-green-300 dark:from-emerald-800 dark:to-green-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-60 animate-float-fast" style="animation-delay: 0.8s;"></div>
        </div>

        <!-- Header Bar -->
        <div class="relative z-30 bg-white/80 dark:bg-gray-900/80 backdrop-blur-lg border-b border-emerald-200 dark:border-emerald-700 shadow-sm">
            <div class="w-full px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('dashboard') }}"
                           class="inline-flex items-center text-gray-600 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 font-medium transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to Dashboard
                        </a>
                        <div class="hidden sm:block h-6 w-px bg-gray-300 dark:bg-gray-600"></div>
                        <div class="hidden sm:flex items-center space-x-2">
                            <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center">
                                <span class="text-lg">📋</span>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100">My Habits</h2>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('habits.create') }}"
                           class="inline-flex items-center bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white px-4 py-2 rounded-xl font-semibold text-sm transition-all duration-300 transform hover:scale-105 shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Add Habit
                        </a>
                        <a href="{{ route('habits.available') }}"
                           class="inline-flex items-center bg-white dark:bg-gray-800 hover:bg-emerald-50 dark:hover:bg-gray-700 text-emerald-700 dark:text-emerald-300 px-4 py-2 rounded-xl font-semibold text-sm transition-all duration-300 border-2 border-emerald-200 dark:border-emerald-700 hover:border-emerald-300 shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Browse Habits
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content - Full Width -->
        <div class="relative z-20 pb-12 pt-8">
            <div class="w-full px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto space-y-6">

                    <!-- Compact Stats Overview with Green Theme -->
                    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-lg rounded-2xl shadow-xl border border-emerald-200 dark:border-emerald-700">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Today's Overview</h3>
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ now()->format('l, F j, Y') }}
                                </div>
                            </div>

                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 rounded-xl p-5 border-2 border-emerald-200 dark:border-emerald-800 hover:shadow-lg transition-all duration-300 cursor-pointer">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-2xl">🎯</span>
                                        <div class="text-3xl font-bold text-emerald-600 dark:text-emerald-400">{{ $todayStats['total_habits'] }}</div>
                                    </div>
                                    <div class="text-sm text-gray-700 dark:text-gray-300 font-semibold">Total Habits</div>
                                </div>
                                <div class="bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl p-5 border-2 border-green-200 dark:border-green-800 hover:shadow-lg transition-all duration-300 cursor-pointer">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-2xl">✅</span>
                                        <div class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $todayStats['completed_today'] }}</div>
                                    </div>
                                    <div class="text-sm text-gray-700 dark:text-gray-300 font-semibold">Completed</div>
                                </div>
                                <div class="bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 rounded-xl p-5 border-2 border-amber-200 dark:border-amber-800 hover:shadow-lg transition-all duration-300 cursor-pointer">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-2xl">⏳</span>
                                        <div class="text-3xl font-bold text-amber-600 dark:text-amber-400">{{ $todayStats['total_habits'] - $todayStats['completed_today'] }}</div>
                                    </div>
                                    <div class="text-sm text-gray-700 dark:text-gray-300 font-semibold">Remaining</div>
                                </div>
                                <div class="bg-gradient-to-br from-teal-50 to-cyan-50 dark:from-teal-900/20 dark:to-cyan-900/20 rounded-xl p-5 border-2 border-teal-200 dark:border-teal-800 hover:shadow-lg transition-all duration-300 cursor-pointer">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-2xl">📊</span>
                                        <div class="text-3xl font-bold text-teal-600 dark:text-teal-400">{{ $todayStats['completion_rate'] }}%</div>
                                    </div>
                                    <div class="text-sm text-gray-700 dark:text-gray-300 font-semibold">Success Rate</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Habits List with Better UX -->
                    @if($userHabits->count() > 0)
                        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-lg overflow-hidden shadow-xl rounded-2xl border border-emerald-200 dark:border-emerald-700">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-6">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 flex items-center">
                                        <span class="text-2xl mr-3">📋</span>
                                        Your Active Habits
                                    </h3>
                                    <span class="text-sm text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-3 py-1 rounded-full">
                                        {{ $userHabits->count() }} {{ $userHabits->count() === 1 ? 'habit' : 'habits' }}
                                    </span>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                            @foreach($userHabits as $userHabit)
                                @php
                                    $todayProgress = $userHabit->dailyProgress->first();
                                    $isCompleted = $todayProgress && $todayProgress->completed;
                                    $progressValue = $todayProgress ? $todayProgress->value : 0;
                                    $progressPercentage = ($progressValue / $userHabit->target_value) * 100;
                                    $categoryIcon = match($userHabit->habit->category->name) {
                                        'Fitness' => '💪',
                                        'Mental Health' => '🧠',
                                        'Nutrition' => '🥗',
                                        'Sleep' => '😴',
                                        'Productivity' => '⚡',
                                        'Social' => '👥',
                                        'Learning' => '📚',
                                        'Meditation' => '🧘',
                                        'Hydration' => '💧',
                                        default => '⭐'
                                    };
                                @endphp

                                    <div class="relative group bg-white dark:bg-gray-800 border-2 {{ $isCompleted ? 'border-emerald-300 dark:border-emerald-600 bg-gradient-to-br from-emerald-50/50 to-green-50/50 dark:from-emerald-900/10 dark:to-green-900/10' : 'border-gray-200 dark:border-gray-700' }} rounded-2xl p-6 hover:shadow-2xl hover:scale-[1.02] transition-all duration-300">
                                        <!-- Completed Badge Overlay -->
                                        @if($isCompleted)
                                            <div class="absolute -top-2 -right-2 bg-gradient-to-r from-emerald-500 to-green-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg flex items-center space-x-1 z-10">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <span>DONE</span>
                                            </div>
                                        @endif

                                        <!-- Header with Icon -->
                                        <div class="flex items-start justify-between mb-4">
                                            <div class="flex items-center flex-1">
                                                <div class="w-14 h-14 bg-gradient-to-br from-emerald-100 to-teal-100 dark:from-emerald-900/30 dark:to-teal-900/30 rounded-xl flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-300">
                                                    <span class="text-3xl">{{ $categoryIcon }}</span>
                                                </div>
                                                <div class="flex-1">
                                                    <h4 class="font-bold text-gray-900 dark:text-gray-100 text-lg mb-1">{{ $userHabit->habit->name }}</h4>
                                                    <div class="flex items-center space-x-2">
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300">
                                                            {{ $userHabit->habit->category->name }}
                                                        </span>
                                                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ ucfirst($userHabit->frequency) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Description (if exists) -->
                                        @if($userHabit->habit->description)
                                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">{{ $userHabit->habit->description }}</p>
                                        @endif

                                        <!-- Progress Bar -->
                                        <div class="mb-5">
                                            <div class="flex justify-between items-center mb-2">
                                                <span class="text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide">Progress</span>
                                                <span class="text-sm font-bold {{ $isCompleted ? 'text-emerald-600 dark:text-emerald-400' : 'text-amber-600 dark:text-amber-400' }}">
                                                    {{ $progressValue }} / {{ $userHabit->target_value }} {{ $userHabit->habit->unit }}
                                                </span>
                                            </div>
                                            <div class="relative w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3 overflow-hidden shadow-inner">
                                                <div class="bg-gradient-to-r {{ $isCompleted ? 'from-emerald-500 via-green-500 to-teal-500' : 'from-amber-400 via-orange-400 to-amber-500' }} h-3 rounded-full transition-all duration-700 ease-out shadow-lg relative"
                                                     style="width: {{ min(100, $progressPercentage) }}%">
                                                    <div class="absolute inset-0 bg-white/20 animate-pulse"></div>
                                                </div>
                                            </div>
                                            <div class="text-right mt-1">
                                                <span class="text-xs font-bold {{ $isCompleted ? 'text-emerald-600' : 'text-gray-500' }}">
                                                    {{ min(100, round($progressPercentage)) }}%
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Streak Stats -->
                                        <div class="grid grid-cols-2 gap-3 mb-5">
                                            <div class="bg-gradient-to-br from-orange-50 to-amber-50 dark:from-orange-900/20 dark:to-amber-900/20 rounded-xl p-3 border border-orange-200 dark:border-orange-800">
                                                <div class="flex items-center justify-between">
                                                    <span class="text-xl">🔥</span>
                                                    <div class="text-right">
                                                        <div class="text-2xl font-bold text-orange-600 dark:text-orange-400">{{ $userHabit->current_streak }}</div>
                                                        <div class="text-xs text-gray-600 dark:text-gray-400 font-medium">Current Streak</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bg-gradient-to-br from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 rounded-xl p-3 border border-purple-200 dark:border-purple-800">
                                                <div class="flex items-center justify-between">
                                                    <span class="text-xl">🏆</span>
                                                    <div class="text-right">
                                                        <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $userHabit->longest_streak }}</div>
                                                        <div class="text-xs text-gray-600 dark:text-gray-400 font-medium">Best Streak</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="flex gap-2">
                                            <a href="{{ route('habits.show', $userHabit) }}"
                                               class="flex-1 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white text-sm font-bold py-3 px-4 rounded-xl transition-all duration-300 shadow-md hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center space-x-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                                <span>View Details</span>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Empty State with Better Design -->
                    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-lg overflow-hidden shadow-xl rounded-2xl border border-emerald-200 dark:border-emerald-700">
                        <div class="p-12 text-center">
                            <div class="inline-flex items-center justify-center w-32 h-32 bg-gradient-to-br from-emerald-100 to-teal-100 dark:from-emerald-900/30 dark:to-teal-900/30 rounded-full mb-6">
                                <span class="text-7xl">🎯</span>
                            </div>
                            <h3 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">Start Your Wellness Journey</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-8 max-w-lg mx-auto text-lg">
                                Create your first habit and begin tracking your progress towards a healthier, happier you. Every journey starts with a single step!
                            </p>
                            <div class="flex flex-col sm:flex-row justify-center gap-4">
                                <a href="{{ route('habits.create') }}"
                                   class="group bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:scale-105 flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    <span>Create Your First Habit</span>
                                </a>
                                <a href="{{ route('habits.available') }}"
                                   class="group bg-white dark:bg-gray-700 hover:bg-emerald-50 dark:hover:bg-gray-600 text-emerald-700 dark:text-emerald-300 font-bold py-4 px-8 rounded-xl border-2 border-emerald-200 dark:border-emerald-700 hover:border-emerald-300 transition-all duration-300 shadow-md hover:shadow-lg flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                    <span>Browse Popular Habits</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
