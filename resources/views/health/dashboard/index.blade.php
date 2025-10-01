<x-app-layout>
    <!-- Full-Width Professional Health Dashboard -->
    <div class="relative min-h-screen bg-gray-200 dark:bg-gray-800 theme-transition overflow-hidden">
        <!-- Background Floating Bubbles -->
        <div class="absolute inset-0 z-0">
            <!-- Large Bubbles -->
            <div class="absolute top-20 left-10 w-72 h-72 bg-gradient-to-br from-green-200 to-teal-300 dark:from-green-800 dark:to-teal-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float"></div>
            <div class="absolute top-40 right-10 w-72 h-72 bg-gradient-to-br from-blue-200 to-indigo-300 dark:from-blue-800 dark:to-indigo-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-40 left-1/2 w-72 h-72 bg-gradient-to-br from-purple-200 to-pink-300 dark:from-purple-800 dark:to-pink-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float" style="animation-delay: 4s;"></div>

            <!-- Medium Bubbles -->
            <div class="absolute top-1/3 left-1/4 w-64 h-64 bg-gradient-to-br from-cyan-200 to-blue-300 dark:from-cyan-800 dark:to-blue-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-60 animate-float" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 right-1/4 w-56 h-56 bg-gradient-to-br from-orange-200 to-amber-300 dark:from-orange-800 dark:to-amber-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-60 animate-float" style="animation-delay: 3s;"></div>
            <div class="absolute bottom-1/4 left-1/3 w-60 h-60 bg-gradient-to-br from-rose-200 to-pink-300 dark:from-rose-800 dark:to-pink-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-60 animate-float" style="animation-delay: 5s;"></div>

            <!-- Small Bubbles -->
            <div class="absolute top-60 right-1/3 w-40 h-40 bg-gradient-to-br from-emerald-200 to-green-300 dark:from-emerald-800 dark:to-green-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-lg opacity-50 animate-float" style="animation-delay: 1.5s;"></div>
            <div class="absolute bottom-60 right-20 w-48 h-48 bg-gradient-to-br from-violet-200 to-purple-300 dark:from-violet-800 dark:to-purple-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-lg opacity-50 animate-float" style="animation-delay: 2.5s;"></div>
            <div class="absolute top-1/4 right-1/2 w-36 h-36 bg-gradient-to-br from-sky-200 to-cyan-300 dark:from-sky-800 dark:to-cyan-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-lg opacity-50 animate-float" style="animation-delay: 3.5s;"></div>
            <div class="absolute bottom-1/3 right-1/3 w-44 h-44 bg-gradient-to-br from-lime-200 to-emerald-300 dark:from-lime-800 dark:to-emerald-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-lg opacity-50 animate-float" style="animation-delay: 4.5s;"></div>
        </div>

        <!-- Top Action Bar - Full Width -->
        <div class="relative z-20 header-sticky bg-white dark:bg-gray-900 shadow-md">
            <div class="w-full px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center justify-between">
                    <!-- Title & Date -->
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 icon-green-teal rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Health Dashboard</h1>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ now()->format('l, F j, Y') }}</p>
                        </div>
                        <!-- Weather Widget -->
                        <div class="hidden md:flex items-center space-x-3 ml-6 bg-gradient-to-r from-blue-50 to-cyan-50 dark:from-blue-900/20 dark:to-cyan-900/20 rounded-xl px-4 py-2 border border-blue-100 dark:border-blue-800">
                            <div id="weather-icon" class="text-2xl">
                                ☀️
                            </div>
                            <div>
                                <div id="weather-temp" class="text-lg font-bold text-gray-900 dark:text-white">
                                    --°C
                                </div>
                                <div id="weather-condition" class="text-xs text-gray-600 dark:text-gray-400">
                                    Loading...
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats Pills -->
                    <div class="hidden lg:flex items-center space-x-6">
                        <div class="status-badge-green">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                            <span class="text-sm font-medium">{{ $todayStats['completed'] }}/{{ $todayStats['total_habits'] }} completed</span>
                        </div>
                        <div class="status-badge-blue">
                            <span class="text-sm font-medium">{{ $todayStats['completion_rate'] }}% today</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('habits.create') }}" class="nav-btn nav-btn-green">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            <span class="hidden sm:inline">Add Habit</span>
                        </a>
                        <a href="{{ route('progress.index') }}" class="nav-btn nav-btn-blue">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            <span class="hidden sm:inline">Log Progress</span>
                        </a>
                        <a href="{{ route('health.reports.index') }}" class="nav-btn nav-btn-purple">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 712-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            <span class="hidden sm:inline">Reports</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Dashboard Content - Full Width -->
        <div class="relative z-20 w-full px-4 sm:px-6 lg:px-8 py-6 space-y-6">

            <!-- Enhanced Daily Stats Overview - Full Width -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
                <!-- Total Habits Card -->
                <div class="group stats-card">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-indigo-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide">Total Habits</p>
                                <p class="text-4xl font-bold text-gray-900 dark:text-white mt-2">{{ $todayStats['total_habits'] }}</p>
                                <p class="text-xs text-blue-600 dark:text-blue-400 mt-1 font-medium">Active today</p>
                            </div>
                            <div class="stats-icon-animated icon-blue-indigo">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Completed Card -->
                <div class="group stats-card">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-emerald-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide">Completed</p>
                                <p class="text-4xl font-bold text-green-600 dark:text-green-400 mt-2">{{ $todayStats['completed'] }}</p>
                                <p class="text-xs text-green-600 dark:text-green-400 mt-1 font-medium">Great progress!</p>
                            </div>
                            <div class="stats-icon-animated icon-green-emerald">
                                <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Card -->
                <div class="group stats-card">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-500/5 to-amber-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide">Pending</p>
                                <p class="text-4xl font-bold text-orange-600 dark:text-orange-400 mt-2">{{ $todayStats['pending'] }}</p>
                                <p class="text-xs text-orange-600 dark:text-orange-400 mt-1 font-medium">Keep going!</p>
                            </div>
                            <div class="stats-icon-animated icon-orange-amber">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Success Rate Card -->
                <div class="group stats-card">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-pink-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wide">Success Rate</p>
                                <p class="text-4xl font-bold text-purple-600 dark:text-purple-400 mt-2">{{ $todayStats['completion_rate'] }}%</p>
                                <p class="text-xs text-purple-600 dark:text-purple-400 mt-1 font-medium">
                                    @if($todayStats['completion_rate'] >= 80)
                                        Excellent! 🎉
                                    @elseif($todayStats['completion_rate'] >= 60)
                                        Good work! 👍
                                    @elseif($todayStats['completion_rate'] >= 40)
                                        Keep trying! 💪
                                    @else
                                        Start strong! 🚀
                                    @endif
                                </p>
                            </div>
                            <div class="stats-icon-animated icon-purple-pink">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                </svg>
                            </div>
                        </div>
                        <!-- Mini Progress Ring -->
                        <div class="mt-4">
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-2 rounded-full transition-all duration-1000 shadow-sm"
                                     style="width: {{ $todayStats['completion_rate'] }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Motivational Banner - Full Width -->
            @if($motivationalMessage)
                <div class="relative bg-motivational-banner rounded-3xl p-8 text-white shadow-2xl overflow-hidden">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 opacity-10">
                        <svg class="w-full h-full" fill="currentColor" viewBox="0 0 100 100">
                            <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                                <path d="M 10 0 L 0 0 0 10" fill="none" stroke="currentColor" stroke-width="0.5"/>
                            </pattern>
                            <rect width="100" height="100" fill="url(#grid)" />
                        </svg>
                    </div>

                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                                <h2 class="text-2xl font-bold text-white">Daily Inspiration</h2>
                            </div>
                            <div class="text-white/70 text-sm font-medium">
                                {{ now()->format('M j, Y') }}
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            @foreach($motivationalMessage as $message)
                                <div class="group flex items-start space-x-4 bg-white/10 backdrop-blur-sm rounded-2xl p-6 hover:bg-white/20 transition-all duration-300">
                                    <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
                                        <span class="text-2xl">
                                            @if($loop->first)
                                                🎯
                                            @else
                                                ⭐
                                            @endif
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold mb-2 text-white">{{ $message['title'] }}</h3>
                                        <p class="text-white/90 leading-relaxed">{{ $message['message'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Enhanced Quick Actions Section - Full Width -->
            @if($quickActions->count() > 0)
                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <!-- Professional Header -->
                    <div class="bg-gradient-to-r from-teal-500 to-cyan-500 px-8 py-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-white">Quick Actions</h3>
                                    <p class="text-white/80 text-sm">Log your progress instantly</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2 bg-white/10 hover:bg-white/20 px-4 py-2 rounded-xl backdrop-blur-sm transition-colors">
                                <span class="text-2xl text-white animate-pulse">⚡</span>
                                <span class="text-white font-bold">{{ $quickActions->count() }} pending</span>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-8">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-6">
                            @foreach($quickActions as $action)
                                <div class="group bg-habit-pending border border-blue-100 dark:border-blue-800 rounded-2xl p-6 hover:shadow-xl transition-all duration-300 hover:scale-[1.02] relative overflow-hidden">
                                    <!-- Subtle background pattern -->
                                    <div class="absolute inset-0 opacity-5">
                                        <svg class="w-full h-full" fill="currentColor" viewBox="0 0 100 100">
                                            <pattern id="grid-{{ $loop->index }}" width="10" height="10" patternUnits="userSpaceOnUse">
                                                <path d="M 10 0 L 0 0 0 10" fill="none" stroke="currentColor" stroke-width="0.5"/>
                                            </pattern>
                                            <rect width="100" height="100" fill="url(#grid-{{ $loop->index }})" />
                                        </svg>
                                    </div>

                                    <div class="relative z-10">
                                        <div class="flex items-center mb-4">
                                            <div class="w-14 h-14 icon-blue-indigo-large rounded-2xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform shadow-lg">
                                                <span class="text-2xl">{{ $action['icon'] }}</span>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <h4 class="font-bold text-gray-900 dark:text-gray-100 text-lg truncate">{{ $action['habit_name'] }}</h4>
                                                <p class="text-sm text-gray-500 dark:text-gray-400 truncate flex items-center mt-1">
                                                    <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                                                    {{ $action['category'] }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="quick-log-form" data-habit-id="{{ $action['user_habit_id'] }}">
                                            <!-- Enhanced Input -->
                                            <div class="mb-4">
                                                <div class="flex items-center space-x-3 bg-white dark:bg-gray-700 rounded-xl p-3 border border-gray-200 dark:border-gray-600 shadow-sm">
                                                    <input type="number"
                                                           class="flex-1 px-0 py-1 bg-transparent border-0 text-lg font-semibold text-gray-900 dark:text-gray-100 focus:ring-0 focus:outline-none"
                                                           placeholder="0"
                                                           step="0.1"
                                                           max="{{ $action['target_value'] }}"
                                                           value="{{ $action['current_value'] }}">
                                                    <span class="text-sm text-gray-500 dark:text-gray-400 font-bold bg-gray-100 dark:bg-gray-600 px-3 py-1 rounded-lg">{{ $action['unit'] }}</span>
                                                </div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-2 text-center">
                                                    Target: {{ $action['target_value'] }} {{ $action['unit'] }}
                                                </div>
                                            </div>

                                            <!-- Enhanced Buttons -->
                                            <div class="space-y-3">
                                                <button class="quick-complete-btn w-full btn-gradient-green text-white font-bold py-3 px-4 rounded-xl flex items-center justify-center space-x-2"
                                                        data-habit-id="{{ $action['user_habit_id'] }}"
                                                        data-target="{{ $action['target_value'] }}">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    <span>Complete Goal</span>
                                                </button>
                                                <button class="quick-log-btn w-full btn-gradient-blue text-white font-bold py-3 px-4 rounded-xl flex items-center justify-center space-x-2"
                                                        data-habit-id="{{ $action['user_habit_id'] }}">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                    </svg>
                                                    <span>Log Progress</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Main Content Grid - Professional Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Today's Habits Section -->
                <div class="">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-8">
                        <div class="flex items-center mb-8">
                            <div class="w-12 h-12 icon-blue-indigo-large rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 theme-transition">Today's Progress</h3>
                        </div>

                        @if($habitsWithProgress->count() > 0)
                            <div class="space-y-4">
                            @foreach($habitsWithProgress as $userHabit)
                                @php
                                    $todayProgress = $userHabit->dailyProgress->first();
                                    $isCompleted = $todayProgress && $todayProgress->completed;
                                    $progressValue = $todayProgress ? $todayProgress->value : 0;
                                    $progressPercentage = ($progressValue / $userHabit->target_value) * 100;
                                @endphp

                                <div class="group {{ $isCompleted ? 'habit-card-completed' : 'habit-card-pending' }} border rounded-2xl p-6 card-hover will-change-transform">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center min-w-0 flex-1">
                                            <div class="w-16 h-16 {{ $isCompleted ? 'bg-green-600 dark:bg-green-700' : 'bg-blue-600 dark:bg-blue-700' }} rounded-2xl icon-container mr-4 flex-shrink-0 shadow-lg">
                                                <span class="text-3xl">{{ $userHabit->habit->category->name === 'Fitness' ? '💪' : ($userHabit->habit->category->name === 'Mental Health' ? '🧠' : ($userHabit->habit->category->name === 'Nutrition' ? '🥗' : '⭐')) }}</span>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <h4 class="font-bold text-gray-900 dark:text-gray-100 text-2xl truncate">{{ $userHabit->habit->name }}</h4>
                                                <p class="text-lg text-gray-500 dark:text-gray-400 truncate flex items-center mt-2">
                                                    <span class="w-3 h-3 bg-{{ $isCompleted ? 'green' : 'blue' }}-500 rounded-full mr-3"></span>
                                                    {{ $userHabit->habit->category->name }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex items-center space-x-4 flex-shrink-0">
                                            @if($isCompleted)
                                                <div class="flex items-center bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 px-6 py-3 rounded-full shadow-sm">
                                                    <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    <span class="text-lg font-bold">Complete</span>
                                                </div>
                                            @else
                                                <div class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-6 py-3 rounded-xl text-lg font-bold shadow-sm">
                                                    {{ $progressValue }}/{{ $userHabit->target_value }} {{ $userHabit->habit->unit }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Enhanced Progress Bar -->
                                    <div class="mb-6">
                                        <div class="flex justify-between items-center mb-3">
                                            <span class="text-lg font-semibold text-gray-700 dark:text-gray-300">Progress</span>
                                            <span class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ number_format(min(100, $progressPercentage), 1) }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-4 overflow-hidden shadow-inner">
                                            <div class="bg-gradient-to-r {{ $isCompleted ? 'from-green-500 to-emerald-500' : 'from-blue-500 to-indigo-500' }} h-4 rounded-full progress-bar-animated theme-transition"
                                                 style="width: {{ min(100, $progressPercentage) }}%"></div>
                                        </div>
                                    </div>

                                    <!-- Enhanced Streak Information -->
                                    @if($userHabit->current_streak > 0)
                                        <div class="flex items-center justify-between streak-info rounded-2xl p-6 shadow-sm">
                                            <div class="flex items-center text-orange-600 dark:text-orange-400">
                                                <span class="text-3xl mr-4 animate-pulse">🔥</span>
                                                <div>
                                                    <div class="text-2xl font-bold">{{ $userHabit->current_streak }} Days</div>
                                                    <div class="text-sm opacity-75">Current Streak</div>
                                                </div>
                                            </div>
                                            <div class="flex items-center text-orange-600 dark:text-orange-400">
                                                <span class="text-3xl mr-4">🏆</span>
                                                <div>
                                                    <div class="text-2xl font-bold">{{ $userHabit->longest_streak }}</div>
                                                    <div class="text-sm opacity-75">Personal Best</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        @else
                            <div class="text-center py-20">
                                <div class="w-32 h-32 icon-green-teal-large rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-lg">
                                    <div class="text-6xl">🚀</div>
                                </div>
                                <h3 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">Ready to Transform?</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-10 max-w-lg mx-auto leading-relaxed text-lg">Start building healthy habits today. Every journey begins with a single step.</p>
                                <a href="{{ route('habits.create') }}"
                                   class="inline-flex items-center btn-gradient-teal text-white font-bold py-5 px-10 rounded-2xl text-lg">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                <div class="space-y-6">

                        <!-- Weekly Overview -->
                        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                            <!-- Professional Header -->
                            <div class="bg-gradient-to-r from-purple-500 to-indigo-500 px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-white">Weekly Stats</h3>
                                        <p class="text-white/80 text-sm">Your progress overview</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6">

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
                        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                            <!-- Professional Header -->
                            <div class="bg-gradient-to-r from-teal-500 to-cyan-500 px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-white">Recent Activity</h3>
                                        <p class="text-white/80 text-sm">Latest habit updates</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6">

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
                                           class="inline-flex items-center bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                            <span>View All Activity</span>
                                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/health-dashboard.css') }}">
    @endpush

    @push('scripts')
    <script>
        // Fetch Weather Data
        async function fetchWeather() {
            try {
                // Get user's location
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(async (position) => {
                        const lat = position.coords.latitude;
                        const lon = position.coords.longitude;

                        // Using Open-Meteo API (free, no API key required)
                        const response = await fetch(`https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current=temperature_2m,weather_code&timezone=auto`);
                        const data = await response.json();

                        if (data && data.current) {
                            const temp = Math.round(data.current.temperature_2m);
                            const weatherCode = data.current.weather_code;

                            // Update temperature
                            document.getElementById('weather-temp').textContent = `${temp}°C`;

                            // Map weather codes to icons and descriptions
                            const weatherInfo = getWeatherInfo(weatherCode);
                            document.getElementById('weather-icon').textContent = weatherInfo.icon;
                            document.getElementById('weather-condition').textContent = weatherInfo.description;
                        }
                    }, (error) => {
                        // If location access denied, show default
                        document.getElementById('weather-temp').textContent = '22°C';
                        document.getElementById('weather-condition').textContent = 'Unable to get location';
                        console.log('Location access denied:', error);
                    });
                } else {
                    document.getElementById('weather-temp').textContent = '22°C';
                    document.getElementById('weather-condition').textContent = 'Location not supported';
                }
            } catch (error) {
                console.error('Weather fetch error:', error);
                document.getElementById('weather-temp').textContent = '22°C';
                document.getElementById('weather-condition').textContent = 'Weather unavailable';
            }
        }

        function getWeatherInfo(code) {
            // WMO Weather interpretation codes
            const weatherMap = {
                0: { icon: '☀️', description: 'Clear sky' },
                1: { icon: '🌤️', description: 'Mainly clear' },
                2: { icon: '⛅', description: 'Partly cloudy' },
                3: { icon: '☁️', description: 'Overcast' },
                45: { icon: '🌫️', description: 'Foggy' },
                48: { icon: '🌫️', description: 'Foggy' },
                51: { icon: '🌦️', description: 'Light drizzle' },
                53: { icon: '🌦️', description: 'Moderate drizzle' },
                55: { icon: '🌧️', description: 'Dense drizzle' },
                61: { icon: '🌧️', description: 'Slight rain' },
                63: { icon: '🌧️', description: 'Moderate rain' },
                65: { icon: '⛈️', description: 'Heavy rain' },
                71: { icon: '🌨️', description: 'Slight snow' },
                73: { icon: '🌨️', description: 'Moderate snow' },
                75: { icon: '❄️', description: 'Heavy snow' },
                77: { icon: '🌨️', description: 'Snow grains' },
                80: { icon: '🌦️', description: 'Slight rain showers' },
                81: { icon: '🌧️', description: 'Moderate rain showers' },
                82: { icon: '⛈️', description: 'Violent rain showers' },
                85: { icon: '🌨️', description: 'Slight snow showers' },
                86: { icon: '❄️', description: 'Heavy snow showers' },
                95: { icon: '⛈️', description: 'Thunderstorm' },
                96: { icon: '⛈️', description: 'Thunderstorm with hail' },
                99: { icon: '⛈️', description: 'Thunderstorm with heavy hail' }
            };

            return weatherMap[code] || { icon: '🌡️', description: 'Unknown' };
        }

        // Enhanced Quick Log Functionality with Professional UX
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch weather on page load
            fetchWeather();

            // Add professional hover effects
            document.querySelectorAll('.group').forEach(element => {
                element.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });

                element.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

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
                // Remove existing notifications
                document.querySelectorAll('.notification-toast').forEach(n => n.remove());

                // Create professional notification element
                const notification = document.createElement('div');
                notification.className = `notification-toast fixed top-24 right-4 z-50 p-4 rounded-xl shadow-2xl transition-all duration-500 transform ${
                    type === 'success' ? 'bg-gradient-to-r from-green-500 to-emerald-500 text-white' : 'bg-gradient-to-r from-red-500 to-pink-500 text-white'
                } translate-x-full backdrop-blur-sm border border-white/20`;

                const icon = type === 'success' ?
                    '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>' :
                    '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>';

                notification.innerHTML = `
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">${icon}</div>
                        <div class="flex-1">
                            <p class="font-medium">${message}</p>
                        </div>
                        <button onclick="this.parentElement.parentElement.remove()" class="flex-shrink-0 p-1 rounded-lg hover:bg-white/20 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                `;

                document.body.appendChild(notification);

                // Slide in animation
                setTimeout(() => {
                    notification.classList.remove('translate-x-full');
                }, 100);

                // Auto-remove after 4 seconds
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.classList.add('translate-x-full');
                        setTimeout(() => notification.remove(), 300);
                    }
                }, 4000);
            }
        });
    </script>
    @endpush
</x-app-layout>
