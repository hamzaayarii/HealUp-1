<x-app-layout>
    <!-- Health Reports Hero Section -->
    <div class="relative min-h-screen bg-gradient-to-br from-amber-50 via-white to-orange-50 dark:from-gray-900 dark:via-gray-900 dark:to-amber-900/20 theme-transition overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-20 left-10 w-72 h-72 bg-gradient-to-br from-amber-200 to-orange-300 dark:from-amber-800 dark:to-orange-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float"></div>
            <div class="absolute top-40 right-10 w-72 h-72 bg-gradient-to-br from-orange-200 to-red-300 dark:from-orange-800 dark:to-red-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-40 left-1/2 w-72 h-72 bg-gradient-to-br from-red-200 to-pink-300 dark:from-red-800 dark:to-pink-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float" style="animation-delay: 4s;"></div>
        </div>

        <!-- Header Section -->
        <div class="relative z-20 pt-20 pb-10">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center space-x-2 bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 px-6 py-3 rounded-full text-sm font-medium mb-6 theme-transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span>Analytics & Insights</span>
                    </div>

                    <h1 class="text-4xl lg:text-6xl font-bold mb-6">
                        <span class="bg-gradient-to-r from-amber-600 to-orange-600 dark:from-amber-400 dark:to-orange-400 bg-clip-text text-transparent">Health Reports</span><br>
                        <span class="text-gray-900 dark:text-gray-100 theme-transition">& Analytics</span>
                    </h1>

                    <p class="text-xl text-gray-600 dark:text-gray-300 leading-relaxed mb-10 max-w-3xl mx-auto theme-transition">
                        Get comprehensive insights into your wellness journey with detailed analytics and progress reports.
                    </p>

                    <!-- Back Button -->
                    <div class="mb-8">
                        <a href="{{ route('health.dashboard') }}"
                           class="inline-flex items-center bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 text-amber-700 dark:text-amber-300 px-6 py-3 rounded-xl font-semibold transition-all duration-300 border-2 border-amber-200 dark:border-amber-700 hover:border-amber-300 dark:hover:border-amber-600 theme-transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="relative z-20 pb-20">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-8">

                @if(!$hasEnoughData)
                    <!-- Not Enough Data Notice -->
                    <div class="bg-gradient-to-br from-yellow-50 to-amber-50 dark:from-yellow-900/20 dark:to-amber-900/20 border border-yellow-200 dark:border-yellow-700 rounded-2xl p-8 theme-transition">
                        <div class="flex items-center">
                            <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-amber-500 rounded-2xl flex items-center justify-center mr-6">
                                <div class="text-2xl">📊</div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-yellow-800 dark:text-yellow-200 mb-3">Building Your Reports</h3>
                                <p class="text-yellow-700 dark:text-yellow-300 mb-6">
                                    Keep tracking your habits! Reports become more insightful with at least a week of consistent data.
                                </p>
                                <div class="flex flex-col sm:flex-row gap-4">
                                    <a href="{{ route('progress.index') }}"
                                       class="inline-flex items-center bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                        </svg>
                                        Log Today's Progress
                                    </a>
                                    <a href="{{ route('habits.index') }}"
                                       class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
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
                <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 theme-transition">
                    <div class="p-8">
                        <div class="flex items-center mb-8">
                            <div class="w-12 h-12 bg-gradient-to-br from-amber-600 to-orange-600 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 theme-transition">Overall Performance</h3>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
                            <div class="text-center bg-blue-50 dark:bg-blue-900/20 rounded-xl p-6 theme-transition">
                            <div class="text-2xl font-bold text-blue-600">{{ $overviewStats['total_habits'] }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Active Habits</div>
                        </div>
                        <div class="text-center p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
                            <div class="text-2xl font-bold text-green-600">{{ $overviewStats['active_streaks'] }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Active Streaks</div>
                        </div>
                        <div class="text-center p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                            <div class="text-2xl font-bold text-purple-600">{{ $overviewStats['completion_rate'] }}%</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">30-Day Rate</div>
                        </div>
                        <div class="text-center p-4 bg-orange-50 dark:bg-orange-900/20 rounded-lg">
                            <div class="text-2xl font-bold text-orange-600">{{ $overviewStats['longest_streak'] }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Best Streak</div>
                        </div>
                        <div class="text-center p-4 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg">
                            <div class="text-2xl font-bold text-indigo-600">{{ $overviewStats['total_completed'] }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Total Completed</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Report Types -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Weekly Reports -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="text-3xl mr-3">📅</div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Weekly Reports</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Track your week-by-week progress</p>
                            </div>
                        </div>

                        <div class="space-y-3 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">This Week</span>
                                <span class="font-medium">{{ now()->startOfWeek()->format('M j') }} - {{ now()->endOfWeek()->format('M j') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Last Week</span>
                                <span class="font-medium">{{ now()->subWeek()->startOfWeek()->format('M j') }} - {{ now()->subWeek()->endOfWeek()->format('M j') }}</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <a href="{{ route('health.reports.weekly', ['week_start' => now()->startOfWeek()->format('Y-m-d')]) }}"
                               class="block w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg text-center transition duration-200">
                                View This Week
                            </a>
                            <a href="{{ route('health.reports.weekly', ['week_start' => now()->subWeek()->startOfWeek()->format('Y-m-d')]) }}"
                               class="block w-full bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg text-center transition duration-200">
                                View Last Week
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Monthly Reports -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="text-3xl mr-3">📊</div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Monthly Reports</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Comprehensive monthly analysis</p>
                            </div>
                        </div>

                        <div class="space-y-3 mb-4">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">This Month</span>
                                <span class="font-medium">{{ now()->format('F Y') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Last Month</span>
                                <span class="font-medium">{{ now()->subMonth()->format('F Y') }}</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <a href="{{ route('health.reports.monthly', ['month' => now()->format('Y-m')]) }}"
                               class="block w-full bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-lg text-center transition duration-200">
                                View This Month
                            </a>
                            <a href="{{ route('health.reports.monthly', ['month' => now()->subMonth()->format('Y-m')]) }}"
                               class="block w-full bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg text-center transition duration-200">
                                View Last Month
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Category Performance -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="text-3xl mr-3">🏷️</div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Category Analysis</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Performance by wellness category</p>
                            </div>
                        </div>

                        <div class="space-y-3 mb-4">
                            <div class="text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Compare how you're doing across different areas of wellness</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <a href="{{ route('health.reports.category-performance', ['period' => 'month']) }}"
                               class="block w-full bg-purple-500 hover:bg-purple-600 text-white font-medium py-2 px-4 rounded-lg text-center transition duration-200">
                                Monthly View
                            </a>
                            <a href="{{ route('health.reports.category-performance', ['period' => 'week']) }}"
                               class="block w-full bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-2 px-4 rounded-lg text-center transition duration-200">
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
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Export Reports</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">Download your health reports for offline viewing or sharing with healthcare providers.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <button onclick="exportReport('monthly')"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 px-4 rounded-lg transition duration-200">
                            📄 Export Monthly Report (PDF)
                        </button>
                        <button onclick="exportReport('weekly')"
                                class="bg-green-500 hover:bg-green-600 text-white font-medium py-3 px-4 rounded-lg transition duration-200">
                            📊 Export Weekly Report (PDF)
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
