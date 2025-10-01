<x-app-layout>
    <div class="relative min-h-screen bg-gradient-to-br from-emerald-50 via-white to-teal-50 dark:from-gray-900 dark:via-gray-900 dark:to-emerald-900/20 theme-transition overflow-hidden">

        <!-- Fast-Moving Green Background Bubbles -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-20 left-10 w-80 h-80 bg-gradient-to-br from-emerald-200 to-teal-300 dark:from-emerald-800 dark:to-teal-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float-fast"></div>
            <div class="absolute top-40 right-10 w-72 h-72 bg-gradient-to-br from-green-200 to-emerald-300 dark:from-green-800 dark:to-emerald-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float-fast" style="animation-delay: 0.5s;"></div>
            <div class="absolute bottom-40 left-1/2 w-72 h-72 bg-gradient-to-br from-teal-200 to-cyan-300 dark:from-teal-800 dark:to-cyan-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float-fast" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/3 left-1/4 w-64 h-64 bg-gradient-to-br from-lime-200 to-emerald-300 dark:from-lime-800 dark:to-emerald-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-60 animate-float-fast" style="animation-delay: 0.3s;"></div>
            <div class="absolute bottom-1/4 right-1/4 w-56 h-56 bg-gradient-to-br from-emerald-200 to-green-300 dark:from-emerald-800 dark:to-green-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-60 animate-float-fast" style="animation-delay: 0.8s;"></div>
        </div>

        <!-- Sticky Header Bar -->
        <div class="relative z-30 bg-white/80 dark:bg-gray-900/80 backdrop-blur-lg border-b border-emerald-200 dark:border-emerald-700 sticky top-0 shadow-sm">
            <div class="w-full px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('health.dashboard') }}" class="inline-flex items-center text-gray-600 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 font-medium transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to Dashboard
                        </a>
                        <div class="hidden sm:block h-6 w-px bg-gray-300 dark:bg-gray-600"></div>
                        <div class="hidden sm:flex items-center space-x-2">
                            <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center">
                                <span class="text-lg">📊</span>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100">Health Reports</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="relative z-20 pb-12 pt-8">
            <div class="w-full px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto space-y-8">

                @if(!$hasEnoughData)
                    <!-- Not Enough Data Notice -->
                    <div class="bg-gradient-to-br from-yellow-50 to-amber-50 dark:from-yellow-900/20 dark:to-amber-900/20 border-2 border-yellow-200 dark:border-yellow-700 rounded-2xl p-8 theme-transition">
                        <div class="flex items-center">
                            <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-amber-500 rounded-2xl flex items-center justify-center mr-6 flex-shrink-0">
                                <div class="text-3xl">📊</div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-yellow-800 dark:text-yellow-200 mb-3">Building Your Reports</h3>
                                <p class="text-yellow-700 dark:text-yellow-300 mb-6">
                                    Keep tracking your habits! Reports become more insightful with at least a week of consistent data.
                                </p>
                                <div class="flex flex-col sm:flex-row gap-4">
                                    <a href="{{ route('progress.index') }}"
                                       class="inline-flex items-center bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                        </svg>
                                        Log Today's Progress
                                    </a>
                                    <a href="{{ route('habits.index') }}"
                                       class="inline-flex items-center bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Manage Habits
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Overview Stats -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-emerald-100 dark:border-emerald-700 overflow-hidden theme-transition">
                    <div class="p-8">
                        <div class="flex items-center mb-8">
                            <div class="w-12 h-12 bg-gradient-to-br from-emerald-600 to-teal-600 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 theme-transition">Overall Performance</h3>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
                            <div class="text-center bg-emerald-50 dark:bg-emerald-900/20 rounded-xl p-6 hover:shadow-lg transition-all theme-transition">
                                <div class="text-3xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent mb-2">{{ $overviewStats['total_habits'] }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">Active Habits</div>
                            </div>
                            <div class="text-center bg-green-50 dark:bg-green-900/20 rounded-xl p-6 hover:shadow-lg transition-all theme-transition">
                                <div class="text-3xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent mb-2">{{ $overviewStats['active_streaks'] }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">Active Streaks</div>
                            </div>
                            <div class="text-center bg-teal-50 dark:bg-teal-900/20 rounded-xl p-6 hover:shadow-lg transition-all theme-transition">
                                <div class="text-3xl font-bold bg-gradient-to-r from-teal-600 to-cyan-600 bg-clip-text text-transparent mb-2">{{ $overviewStats['completion_rate'] }}%</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">30-Day Rate</div>
                            </div>
                            <div class="text-center bg-lime-50 dark:bg-lime-900/20 rounded-xl p-6 hover:shadow-lg transition-all theme-transition">
                                <div class="text-3xl font-bold bg-gradient-to-r from-lime-600 to-green-600 bg-clip-text text-transparent mb-2">{{ $overviewStats['longest_streak'] }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">Best Streak</div>
                            </div>
                            <div class="text-center bg-cyan-50 dark:bg-cyan-900/20 rounded-xl p-6 hover:shadow-lg transition-all theme-transition">
                                <div class="text-3xl font-bold bg-gradient-to-r from-cyan-600 to-teal-600 bg-clip-text text-transparent mb-2">{{ $overviewStats['total_completed'] }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">Total Completed</div>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- Report Types -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Weekly Reports -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-emerald-100 dark:border-emerald-700 overflow-hidden hover:shadow-xl transition-all">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center mr-3">
                                <span class="text-2xl">📅</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Weekly Reports</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Track your week-by-week progress</p>
                            </div>
                        </div>

                        <div class="space-y-3 mb-4">
                            <div class="flex justify-between text-sm bg-emerald-50 dark:bg-emerald-900/20 rounded-lg p-3">
                                <span class="text-gray-600 dark:text-gray-400">This Week</span>
                                <span class="font-medium text-emerald-700 dark:text-emerald-300">{{ now()->startOfWeek()->format('M j') }} - {{ now()->endOfWeek()->format('M j') }}</span>
                            </div>
                            <div class="flex justify-between text-sm bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3">
                                <span class="text-gray-600 dark:text-gray-400">Last Week</span>
                                <span class="font-medium text-gray-700 dark:text-gray-300">{{ now()->subWeek()->startOfWeek()->format('M j') }} - {{ now()->subWeek()->endOfWeek()->format('M j') }}</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <a href="{{ route('health.reports.weekly', ['week_start' => now()->startOfWeek()->format('Y-m-d')]) }}"
                               class="block w-full bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-semibold py-3 px-4 rounded-xl text-center transition-all transform hover:scale-105 shadow-md">
                                View This Week
                            </a>
                            <a href="{{ route('health.reports.weekly', ['week_start' => now()->subWeek()->startOfWeek()->format('Y-m-d')]) }}"
                               class="block w-full bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 font-medium py-3 px-4 rounded-xl text-center transition-all">
                                View Last Week
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Monthly Reports -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-emerald-100 dark:border-emerald-700 overflow-hidden hover:shadow-xl transition-all">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center mr-3">
                                <span class="text-2xl">📊</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Monthly Reports</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Comprehensive monthly analysis</p>
                            </div>
                        </div>

                        <div class="space-y-3 mb-4">
                            <div class="flex justify-between text-sm bg-green-50 dark:bg-green-900/20 rounded-lg p-3">
                                <span class="text-gray-600 dark:text-gray-400">This Month</span>
                                <span class="font-medium text-green-700 dark:text-green-300">{{ now()->format('F Y') }}</span>
                            </div>
                            <div class="flex justify-between text-sm bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3">
                                <span class="text-gray-600 dark:text-gray-400">Last Month</span>
                                <span class="font-medium text-gray-700 dark:text-gray-300">{{ now()->subMonth()->format('F Y') }}</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <a href="{{ route('health.reports.monthly', ['month' => now()->format('Y-m')]) }}"
                               class="block w-full bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold py-3 px-4 rounded-xl text-center transition-all transform hover:scale-105 shadow-md">
                                View This Month
                            </a>
                            <a href="{{ route('health.reports.monthly', ['month' => now()->subMonth()->format('Y-m')]) }}"
                               class="block w-full bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 font-medium py-3 px-4 rounded-xl text-center transition-all">
                                View Last Month
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Category Performance -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-emerald-100 dark:border-emerald-700 overflow-hidden hover:shadow-xl transition-all">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-teal-500 to-cyan-600 rounded-xl flex items-center justify-center mr-3">
                                <span class="text-2xl">🏷️</span>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Category Analysis</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Performance by wellness category</p>
                            </div>
                        </div>

                        <div class="space-y-3 mb-4">
                            <div class="text-sm bg-teal-50 dark:bg-teal-900/20 rounded-lg p-3">
                                <span class="text-gray-600 dark:text-gray-400">Compare how you're doing across different areas of wellness</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <a href="{{ route('health.reports.category-performance', ['period' => 'month']) }}"
                               class="block w-full bg-gradient-to-r from-teal-600 to-cyan-600 hover:from-teal-700 hover:to-cyan-700 text-white font-semibold py-3 px-4 rounded-xl text-center transition-all transform hover:scale-105 shadow-md">
                                Monthly View
                            </a>
                            <a href="{{ route('health.reports.category-performance', ['period' => 'week']) }}"
                               class="block w-full bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 font-medium py-3 px-4 rounded-xl text-center transition-all">
                                Weekly View
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Achievements -->
            @if($achievements->count() > 0)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6">Recent Achievements</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($achievements as $achievement)
                                <div class="bg-gradient-to-r from-yellow-400 to-orange-500 rounded-lg p-4 text-white">
                                    <div class="flex items-center mb-2">
                                        <span class="text-2xl mr-2">{{ $achievement['icon'] }}</span>
                                        <h4 class="font-semibold">{{ $achievement['title'] }}</h4>
                                    </div>
                                    <p class="text-sm opacity-90 mb-2">{{ $achievement['description'] }}</p>
                                    <div class="text-xs opacity-75">
                                        {{ $achievement['habit'] }} • {{ $achievement['date']->format('M j, Y') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Habit Comparison -->
            @if($userHabits->count() > 1)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Habit Comparison</h3>
                            <a href="{{ route('health.reports.habit-comparison') }}"
                               class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                View Detailed Comparison →
                            </a>
                        </div>

                        <div class="space-y-4">
                            @php
                                $topHabits = $userHabits->sortByDesc(function($habit) {
                                    $progress = $habit->dailyProgress()->whereBetween('date', [now()->subDays(30), now()])->get();
                                    return $progress->count() > 0 ? $progress->where('completed', true)->count() / $progress->count() : 0;
                                })->take(5);
                            @endphp

                            @foreach($topHabits as $userHabit)
                                @php
                                    $progress = $userHabit->dailyProgress()->whereBetween('date', [now()->subDays(30), now()])->get();
                                    $completionRate = $progress->count() > 0 ? round(($progress->where('completed', true)->count() / $progress->count()) * 100) : 0;
                                @endphp

                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <span class="text-lg mr-3">
                                            {{ $userHabit->habit->category->name === 'Fitness' ? '💪' : ($userHabit->habit->category->name === 'Mental Health' ? '🧠' : ($userHabit->habit->category->name === 'Nutrition' ? '🥗' : '⭐')) }}
                                        </span>
                                        <div>
                                            <h4 class="font-medium text-gray-900 dark:text-gray-100">{{ $userHabit->habit->name }}</h4>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $userHabit->habit->category->name }}</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center space-x-4">
                                        <div class="text-right">
                                            <div class="font-bold text-lg text-blue-600">{{ $completionRate }}%</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">30-day rate</div>
                                        </div>

                                        @if($userHabit->current_streak > 0)
                                            <div class="text-right">
                                                <div class="font-bold text-lg text-orange-600">{{ $userHabit->current_streak }}</div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">streak</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Export Options -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-emerald-100 dark:border-emerald-700 overflow-hidden">
                <div class="p-8">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-600 to-teal-600 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Export Reports</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Download your health reports for offline viewing or sharing</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <button onclick="exportReport('monthly')"
                                class="bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-semibold py-4 px-6 rounded-xl transition-all transform hover:scale-105 shadow-md flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>Export Monthly Report (PDF)</span>
                        </button>
                        <button onclick="exportReport('weekly')"
                                class="bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold py-4 px-6 rounded-xl transition-all transform hover:scale-105 shadow-md flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>Export Weekly Report (PDF)</span>
                        </button>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function exportReport(type) {
            const date = type === 'monthly' ? '{{ now()->format("Y-m") }}' : '{{ now()->startOfWeek()->format("Y-m-d") }}';

            // Show loading state
            const button = event.target;
            const originalText = button.textContent;
            button.textContent = 'Generating...';
            button.disabled = true;

            fetch(`{{ route("health.reports.export-pdf") }}?type=${type}&date=${date}`, {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                // For now, show the data in console (PDF generation would be implemented)
                console.log('Report data:', data);
                showNotification(`${type.charAt(0).toUpperCase() + type.slice(1)} report data prepared. PDF generation can be implemented with a PDF library.`, 'success');
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Failed to generate report', 'error');
            })
            .finally(() => {
                button.textContent = originalText;
                button.disabled = false;
            });
        }

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 ${
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;
            notification.textContent = message;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 5000);
        }
    </script>
    @endpush
</x-app-layout>
