<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Health Reports') }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('health.dashboard') }}"
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    Back to Dashboard
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(!$hasEnoughData)
                <!-- Not Enough Data Notice -->
                <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700 rounded-xl p-6">
                    <div class="flex items-center">
                        <div class="text-4xl mr-4">📊</div>
                        <div>
                            <h3 class="text-lg font-medium text-yellow-800 dark:text-yellow-200 mb-2">Building Your Reports</h3>
                            <p class="text-yellow-700 dark:text-yellow-300 mb-4">
                                Keep tracking your habits! Reports become more insightful with at least a week of consistent data.
                            </p>
                            <div class="flex space-x-4">
                                <a href="{{ route('progress.index') }}"
                                   class="bg-yellow-600 hover:bg-yellow-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                                    Log Today's Progress
                                </a>
                                <a href="{{ route('habits.index') }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                                    Manage Habits
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Overview Stats -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6">Overall Performance</h3>

                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                        <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
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
