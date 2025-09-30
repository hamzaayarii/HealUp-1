<x-app-layout>
    <!-- Health Dashboard Hero Section -->
    <div class="relative min-h-screen bg-gradient-to-br from-green-50 via-white to-teal-50 dark:from-gray-900 dark:via-gray-900 dark:to-green-900/20 theme-transition overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-20 left-10 w-72 h-72 bg-gradient-to-br from-green-200 to-emerald-300 dark:from-green-800 dark:to-emerald-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float"></div>
            <div class="absolute top-40 right-10 w-72 h-72 bg-gradient-to-br from-teal-200 to-cyan-300 dark:from-teal-800 dark:to-cyan-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-40 left-1/2 w-72 h-72 bg-gradient-to-br from-blue-200 to-indigo-300 dark:from-blue-800 dark:to-indigo-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float" style="animation-delay: 4s;"></div>
        </div>

        <!-- Header Section -->
        <div class="relative z-20 pt-20 pb-10">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center space-x-2 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 px-6 py-3 rounded-full text-sm font-medium mb-6 theme-transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                        <span>Welcome to Your Health Dashboard</span>
                    </div>

                    <h1 class="text-4xl lg:text-6xl font-bold mb-6">
                        <span class="bg-gradient-to-r from-green-600 to-teal-600 dark:from-green-400 dark:to-teal-400 bg-clip-text text-transparent">Your Wellness</span><br>
                        <span class="text-gray-900 dark:text-gray-100 theme-transition">Journey Today</span>
                    </h1>

                    <!-- Quick Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12">
                        <a href="{{ route('habits.index') }}"
                           class="group bg-green-600 hover:bg-green-700 dark:bg-green-700 dark:hover:bg-green-600 text-white px-8 py-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Manage Habits</span>
                        </a>
                        <a href="{{ route('health.reports.index') }}"
                           class="group bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 text-green-700 dark:text-green-300 px-8 py-4 rounded-xl font-semibold transition-all duration-300 border-2 border-green-200 dark:border-green-700 hover:border-green-300 dark:hover:border-green-600 flex items-center space-x-2 theme-transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            <span>View Reports</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="relative z-20 pb-20">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-8">

                <!-- Motivational Messages -->
                @if($motivationalMessage)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($motivationalMessage as $message)
                            <div class="group bg-gradient-to-br from-{{ $message['color'] }}-50 to-{{ $message['color'] }}-100 dark:from-{{ $message['color'] }}-900/20 dark:to-{{ $message['color'] }}-900/30 rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-{{ $message['color'] }}-100 dark:border-{{ $message['color'] }}-800 theme-transition">
                                <div class="w-12 h-12 bg-{{ $message['color'] }}-600 dark:bg-{{ $message['color'] }}-700 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-3 theme-transition">{{ $message['title'] }}</h3>
                                <p class="text-gray-600 dark:text-gray-300 theme-transition">{{ $message['message'] }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Today's Overview -->
                <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 theme-transition">
                    <div class="p-8">
                        <div class="flex items-center mb-8">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 theme-transition">Today's Progress</h3>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                            <div class="text-center bg-blue-50 dark:bg-blue-900/20 rounded-xl p-4 theme-transition">
                                <div class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $todayStats['total_habits'] }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">Total Habits</div>
                            </div>
                            <div class="text-center bg-green-50 dark:bg-green-900/20 rounded-xl p-4 theme-transition">
                                <div class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $todayStats['completed'] }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">Completed</div>
                            </div>
                            <div class="text-center bg-orange-50 dark:bg-orange-900/20 rounded-xl p-4 theme-transition">
                                <div class="text-3xl font-bold text-orange-600 dark:text-orange-400">{{ $todayStats['pending'] }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">Pending</div>
                            </div>
                            <div class="text-center bg-purple-50 dark:bg-purple-900/20 rounded-xl p-4 theme-transition">
                                <div class="text-3xl font-bold text-purple-600 dark:text-purple-400">{{ $todayStats['completion_rate'] }}%</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">Completion Rate</div>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="mb-6">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Daily Progress</span>
                                <span class="text-sm font-bold text-gray-900 dark:text-gray-100">{{ $todayStats['completion_rate'] }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                                <div class="bg-gradient-to-r from-green-500 to-teal-500 h-3 rounded-full transition-all duration-1000 shadow-lg"
                                     style="width: {{ $todayStats['completion_rate'] }}%"></div>
                            </div>
                        </div>

                        <!-- Streak Information -->
                        @if($todayStats['streak_status']['active_streaks'] > 0)
                            <div class="bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 rounded-xl p-4 theme-transition">
                                <div class="flex items-center justify-center space-x-6 text-sm font-medium">
                                    <div class="flex items-center space-x-2 text-orange-600 dark:text-orange-400">
                                        <span class="text-lg">🔥</span>
                                        <span>{{ $todayStats['streak_status']['active_streaks'] }} Active Streaks</span>
                                    </div>
                                    <div class="flex items-center space-x-2 text-orange-600 dark:text-orange-400">
                                        <span class="text-lg">📊</span>
                                        <span>Longest: {{ $todayStats['streak_status']['longest_current'] }} days</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                @if($quickActions->count() > 0)
                    <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 theme-transition">
                        <div class="p-8">
                            <div class="flex items-center mb-8">
                                <div class="w-12 h-12 bg-gradient-to-br from-teal-600 to-cyan-600 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 theme-transition">Quick Log Progress</h3>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                @foreach($quickActions as $action)
                                    <div class="group bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/30 border border-blue-100 dark:border-blue-800 rounded-2xl p-6 hover:shadow-lg transition-all duration-300 theme-transition">
                                        <div class="flex items-center mb-4">
                                            <div class="w-10 h-10 bg-blue-600 dark:bg-blue-700 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                                                <span class="text-lg">{{ $action['icon'] }}</span>
                                            </div>
                                            <div>
                                                <h4 class="font-semibold text-gray-900 dark:text-gray-100 text-sm">{{ $action['habit_name'] }}</h4>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $action['category'] }}</p>
                                            </div>
                                        </div>

                                        <div class="quick-log-form" data-habit-id="{{ $action['user_habit_id'] }}">
                                            <div class="flex items-center space-x-2 mb-4">
                                                <input type="number"
                                                       class="flex-1 px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100 theme-transition"
                                                       placeholder="Value"
                                                       step="0.1"
                                                       max="{{ $action['target_value'] }}"
                                                       value="{{ $action['current_value'] }}">
                                                <span class="text-xs text-gray-500 dark:text-gray-400 font-medium">{{ $action['unit'] }}</span>
                                            </div>
                                            <div class="flex space-x-2">
                                                <button class="quick-complete-btn flex-1 bg-green-600 hover:bg-green-700 text-white text-xs py-2 px-3 rounded-lg font-medium transition-all duration-200 transform hover:scale-105"
                                                        data-habit-id="{{ $action['user_habit_id'] }}"
                                                        data-target="{{ $action['target_value'] }}">
                                                    Complete ({{ $action['target_value'] }} {{ $action['unit'] }})
                                                </button>
                                                <button class="quick-log-btn bg-blue-600 hover:bg-blue-700 text-white text-xs py-2 px-3 rounded-lg font-medium transition-all duration-200 transform hover:scale-105"
                                                        data-habit-id="{{ $action['user_habit_id'] }}">
                                                    Log
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Two Column Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <!-- Left Column: Today's Habits -->
                    <div class="lg:col-span-2">
                        <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 theme-transition">
                            <div class="p-8">
                                <div class="flex items-center mb-8">
                                    <div class="w-12 h-12 bg-gradient-to-br from-green-600 to-emerald-600 rounded-xl flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 theme-transition">Today's Habits</h3>
                                </div>

                                @if($habitsWithProgress->count() > 0)
                                    <div class="space-y-6">
                                    @foreach($habitsWithProgress as $userHabit)
                                        @php
                                            $todayProgress = $userHabit->dailyProgress->first();
                                            $isCompleted = $todayProgress && $todayProgress->completed;
                                            $progressValue = $todayProgress ? $todayProgress->value : 0;
                                            $progressPercentage = ($progressValue / $userHabit->target_value) * 100;
                                        @endphp

                                        <div class="group bg-gradient-to-br {{ $isCompleted ? 'from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/30' : 'from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/30' }} border {{ $isCompleted ? 'border-green-200 dark:border-green-700' : 'border-blue-200 dark:border-blue-700' }} rounded-2xl p-6 hover:shadow-lg transition-all duration-300 theme-transition">
                                            <div class="flex items-center justify-between mb-4">
                                                <div class="flex items-center">
                                                    <div class="w-12 h-12 {{ $isCompleted ? 'bg-green-600 dark:bg-green-700' : 'bg-blue-600 dark:bg-blue-700' }} rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                                                        <span class="text-xl">{{ $userHabit->habit->category->name === 'Fitness' ? '💪' : ($userHabit->habit->category->name === 'Mental Health' ? '🧠' : ($userHabit->habit->category->name === 'Nutrition' ? '🥗' : '⭐')) }}</span>
                                                    </div>
                                                    <div>
                                                        <h4 class="font-semibold text-gray-900 dark:text-gray-100 text-lg">{{ $userHabit->habit->name }}</h4>
                                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $userHabit->habit->category->name }}</p>
                                                    </div>
                                                </div>

                                                @if($isCompleted)
                                                    <div class="flex items-center bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 px-3 py-1 rounded-full">
                                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        <span class="text-sm font-medium">Complete</span>
                                                    </div>
                                                @else
                                                    <div class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-3 py-1 rounded-lg text-sm font-medium">
                                                        {{ $progressValue }} / {{ $userHabit->target_value }} {{ $userHabit->habit->unit }}
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Progress Bar -->
                                            <div class="mb-4">
                                                <div class="flex justify-between items-center mb-2">
                                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Progress</span>
                                                    <span class="text-sm font-bold text-gray-900 dark:text-gray-100">{{ number_format(min(100, $progressPercentage), 1) }}%</span>
                                                </div>
                                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                                                    <div class="bg-gradient-to-r {{ $isCompleted ? 'from-green-500 to-emerald-500' : 'from-blue-500 to-indigo-500' }} h-3 rounded-full transition-all duration-1000 shadow-sm"
                                                         style="width: {{ min(100, $progressPercentage) }}%"></div>
                                                </div>
                                            </div>

                                            <!-- Streak Information -->
                                            @if($userHabit->current_streak > 0)
                                                <div class="flex items-center justify-between bg-gradient-to-r from-orange-50 to-red-50 dark:from-orange-900/20 dark:to-red-900/20 rounded-xl p-3">
                                                    <div class="flex items-center text-orange-600 dark:text-orange-400">
                                                        <span class="text-lg mr-1">🔥</span>
                                                        <span class="text-sm font-medium">{{ $userHabit->current_streak }} day streak</span>
                                                    </div>
                                                    <div class="flex items-center text-orange-600 dark:text-orange-400">
                                                        <span class="text-lg mr-1">🏆</span>
                                                        <span class="text-sm font-medium">Best: {{ $userHabit->longest_streak }} days</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                @else
                                    <div class="text-center py-12">
                                        <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 rounded-2xl flex items-center justify-center mx-auto mb-6">
                                            <div class="text-4xl">🎯</div>
                                        </div>
                                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-3">No habits yet!</h3>
                                        <p class="text-gray-600 dark:text-gray-400 mb-6">Start your wellness journey by creating your first habit.</p>
                                        <a href="{{ route('habits.create') }}"
                                           class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                            Create Your First Habit
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Stats & Activity -->
                    <div class="space-y-8">

                        <!-- Weekly Overview -->
                        <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 theme-transition">
                            <div class="p-8">
                                <div class="flex items-center mb-6">
                                    <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 theme-transition">This Week</h3>
                                </div>

                                <div class="space-y-6">
                                    <div class="bg-purple-50 dark:bg-purple-900/20 rounded-xl p-4 theme-transition">
                                        <div class="flex justify-between items-center mb-3">
                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Completion Rate</span>
                                            <span class="font-bold text-xl text-purple-600 dark:text-purple-400">{{ $weeklyOverview['completion_rate'] }}%</span>
                                        </div>

                                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                                            <div class="bg-gradient-to-r from-purple-500 to-indigo-500 h-3 rounded-full transition-all duration-1000 shadow-sm"
                                                 style="width: {{ $weeklyOverview['completion_rate'] }}%"></div>
                                        </div>
                                    </div>

                                        <div class="grid grid-cols-2 gap-4">
                                            <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-3 text-center theme-transition">
                                                <div class="text-xl font-bold text-green-600 dark:text-green-400">{{ $weeklyOverview['active_streaks'] }}</div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400 font-medium">Active Streaks</div>
                                            </div>
                                            <div class="bg-orange-50 dark:bg-orange-900/20 rounded-lg p-3 text-center theme-transition">
                                                <div class="text-xl font-bold text-orange-600 dark:text-orange-400">{{ $weeklyOverview['consistency_score'] }}%</div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400 font-medium">Consistency</div>
                                            </div>
                                        </div>

                                        <div class="bg-gradient-to-r from-blue-50 to-teal-50 dark:from-blue-900/20 dark:to-teal-900/20 rounded-lg p-3 text-center theme-transition">
                                            <div class="text-sm text-gray-700 dark:text-gray-300">Best Day: <span class="font-semibold text-blue-600 dark:text-blue-400">{{ $weeklyOverview['best_day'] }}</span></div>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <!-- Recent Activity -->
                        <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 theme-transition">
                            <div class="p-8">
                                <div class="flex items-center mb-6">
                                    <div class="w-10 h-10 bg-gradient-to-br from-teal-600 to-cyan-600 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 theme-transition">Recent Activity</h3>
                                </div>

                                @if($recentActivity->count() > 0)
                                    <div class="space-y-4">
                                        @foreach($recentActivity->take(5) as $activity)
                                            <div class="flex items-center bg-gradient-to-r from-gray-50 to-blue-50 dark:from-gray-700 dark:to-blue-900/20 rounded-xl p-4 theme-transition">
                                                <div class="w-10 h-10 bg-blue-600 dark:bg-blue-700 rounded-lg flex items-center justify-center mr-4">
                                                    <span class="text-lg">{{ $activity['icon'] }}</span>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate">
                                                        {{ $activity['habit_name'] }}
                                                    </p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                                        {{ $activity['value'] }} {{ $activity['unit'] }} • {{ $activity['time_ago'] }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="mt-6 text-center">
                                        <a href="{{ route('progress.index') }}"
                                           class="inline-flex items-center text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-semibold transition-colors">
                                            View all activity
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </a>
                                    </div>
                                @else
                                    <div class="text-center py-8">
                                        <div class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                            <div class="text-2xl">📈</div>
                                        </div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">No recent activity</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Upcoming Challenges -->
                        @if($upcomingChallenges->count() > 0)
                            <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 theme-transition">
                                <div class="p-8">
                                    <div class="flex items-center mb-6">
                                        <div class="w-10 h-10 bg-gradient-to-br from-amber-600 to-orange-600 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/>
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 theme-transition">Upcoming Challenges</h3>
                                    </div>

                                    <div class="space-y-4">
                                        @foreach($upcomingChallenges as $challenge)
                                            <div class="bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/30 border border-amber-200 dark:border-amber-700 rounded-xl p-4 theme-transition">
                                                <h4 class="font-semibold text-gray-900 dark:text-gray-100 text-sm mb-2">{{ $challenge->name }}</h4>
                                                <div class="flex items-center justify-between text-xs text-gray-600 dark:text-gray-400">
                                                    <span class="flex items-center">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zM4 9h12v7H4V9z"/>
                                                        </svg>
                                                        Starts {{ \Carbon\Carbon::parse($challenge->start_date)->format('M j') }}
                                                    </span>
                                                    <span class="flex items-center">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>
                                                        {{ $challenge->points }} points
                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Quick log functionality
        document.addEventListener('DOMContentLoaded', function() {

            // Quick complete buttons
            document.querySelectorAll('.quick-complete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const habitId = this.dataset.habitId;
                    const targetValue = this.dataset.target;

                    quickLog(habitId, true, targetValue, this);
                });
            });

            // Quick log buttons
            document.querySelectorAll('.quick-log-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const habitId = this.dataset.habitId;
                    const form = this.closest('.quick-log-form');
                    const valueInput = form.querySelector('input[type="number"]');
                    const value = parseFloat(valueInput.value) || 0;

                    if (value <= 0) {
                        alert('Please enter a valid value');
                        return;
                    }

                    quickLog(habitId, false, value, this);
                });
            });

            function quickLog(habitId, completed, value, button) {
                const originalText = button.textContent;
                button.textContent = 'Logging...';
                button.disabled = true;

                fetch('{{ route("progress.quick-log") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        user_habit_id: habitId,
                        completed: completed,
                        value: value
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message
                        showNotification(data.message, 'success');

                        // Hide the quick action card if completed
                        if (completed) {
                            button.closest('.border').style.display = 'none';
                        }

                        // Refresh the page after a short delay to show updated progress
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else {
                        showNotification('Failed to log progress', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Failed to log progress', 'error');
                })
                .finally(() => {
                    button.textContent = originalText;
                    button.disabled = false;
                });
            }

            function showNotification(message, type) {
                // Create notification element
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 ${
                    type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
                }`;
                notification.textContent = message;

                document.body.appendChild(notification);

                // Remove after 3 seconds
                setTimeout(() => {
                    notification.remove();
                }, 3000);
            }
        });
    </script>
    @endpush
</x-app-layout>
