<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Health Dashboard') }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('habits.index') }}"
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    Manage Habits
                </a>
                <a href="{{ route('health.reports.index') }}"
                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    View Reports
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Motivational Messages -->
            @if($motivationalMessage)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($motivationalMessage as $message)
                        <div class="bg-gradient-to-r from-{{ $message['color'] }}-400 to-{{ $message['color'] }}-600 rounded-xl p-6 text-white shadow-lg">
                            <h3 class="text-lg font-bold mb-2">{{ $message['title'] }}</h3>
                            <p class="text-sm opacity-90">{{ $message['message'] }}</p>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Today's Overview -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Today's Progress</h3>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-blue-600">{{ $todayStats['total_habits'] }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Total Habits</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-green-600">{{ $todayStats['completed'] }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Completed</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-orange-600">{{ $todayStats['pending'] }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Pending</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-purple-600">{{ $todayStats['completion_rate'] }}%</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Completion Rate</div>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-4 mb-4">
                        <div class="bg-gradient-to-r from-blue-500 to-green-500 h-4 rounded-full transition-all duration-500"
                             style="width: {{ $todayStats['completion_rate'] }}%"></div>
                    </div>

                    <!-- Streak Information -->
                    @if($todayStats['streak_status']['active_streaks'] > 0)
                        <div class="flex items-center justify-center space-x-4 text-sm text-gray-600 dark:text-gray-400">
                            <span>🔥 {{ $todayStats['streak_status']['active_streaks'] }} Active Streaks</span>
                            <span>📊 Longest: {{ $todayStats['streak_status']['longest_current'] }} days</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            @if($quickActions->count() > 0)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Quick Log Progress</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            @foreach($quickActions as $action)
                                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:shadow-md transition-shadow">
                                    <div class="flex items-center mb-3">
                                        <span class="text-2xl mr-3">{{ $action['icon'] }}</span>
                                        <div>
                                            <h4 class="font-medium text-gray-900 dark:text-gray-100">{{ $action['habit_name'] }}</h4>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $action['category'] }}</p>
                                        </div>
                                    </div>

                                    <div class="quick-log-form" data-habit-id="{{ $action['user_habit_id'] }}">
                                        <div class="flex items-center space-x-2 mb-2">
                                            <input type="number"
                                                   class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100"
                                                   placeholder="Value"
                                                   step="0.1"
                                                   max="{{ $action['target_value'] }}"
                                                   value="{{ $action['current_value'] }}">
                                            <span class="text-xs text-gray-500">{{ $action['unit'] }}</span>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button class="quick-complete-btn flex-1 bg-green-500 hover:bg-green-600 text-white text-xs py-2 px-3 rounded-md transition duration-200"
                                                    data-habit-id="{{ $action['user_habit_id'] }}"
                                                    data-target="{{ $action['target_value'] }}">
                                                Complete ({{ $action['target_value'] }} {{ $action['unit'] }})
                                            </button>
                                            <button class="quick-log-btn bg-blue-500 hover:bg-blue-600 text-white text-xs py-2 px-3 rounded-md transition duration-200"
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
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Left Column: Today's Habits -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Today's Habits</h3>

                            @if($habitsWithProgress->count() > 0)
                                <div class="space-y-4">
                                    @foreach($habitsWithProgress as $userHabit)
                                        @php
                                            $todayProgress = $userHabit->dailyProgress->first();
                                            $isCompleted = $todayProgress && $todayProgress->completed;
                                            $progressValue = $todayProgress ? $todayProgress->value : 0;
                                            $progressPercentage = ($progressValue / $userHabit->target_value) * 100;
                                        @endphp

                                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 {{ $isCompleted ? 'bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-700' : '' }}">
                                            <div class="flex items-center justify-between mb-3">
                                                <div class="flex items-center">
                                                    <span class="text-2xl mr-3">{{ $userHabit->habit->category->name === 'Fitness' ? '💪' : ($userHabit->habit->category->name === 'Mental Health' ? '🧠' : ($userHabit->habit->category->name === 'Nutrition' ? '🥗' : '⭐')) }}</span>
                                                    <div>
                                                        <h4 class="font-medium text-gray-900 dark:text-gray-100">{{ $userHabit->habit->name }}</h4>
                                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $userHabit->habit->category->name }}</p>
                                                    </div>
                                                </div>

                                                @if($isCompleted)
                                                    <div class="flex items-center text-green-600">
                                                        <span class="text-sm font-medium mr-1">✓ Complete</span>
                                                    </div>
                                                @else
                                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                                        {{ $progressValue }} / {{ $userHabit->target_value }} {{ $userHabit->habit->unit }}
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Progress Bar -->
                                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mb-2">
                                                <div class="bg-gradient-to-r {{ $isCompleted ? 'from-green-500 to-green-600' : 'from-blue-500 to-blue-600' }} h-2 rounded-full transition-all duration-500"
                                                     style="width: {{ min(100, $progressPercentage) }}%"></div>
                                            </div>

                                            <!-- Streak Information -->
                                            @if($userHabit->current_streak > 0)
                                                <div class="flex items-center justify-between text-xs text-gray-600 dark:text-gray-400">
                                                    <span>🔥 {{ $userHabit->current_streak }} day streak</span>
                                                    <span>🏆 Best: {{ $userHabit->longest_streak }} days</span>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <div class="text-6xl mb-4">🎯</div>
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No habits yet!</h3>
                                    <p class="text-gray-600 dark:text-gray-400 mb-4">Start your wellness journey by creating your first habit.</p>
                                    <a href="{{ route('habits.create') }}"
                                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
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
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">This Week</h3>

                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Completion Rate</span>
                                    <span class="font-bold text-lg text-blue-600">{{ $weeklyOverview['completion_rate'] }}%</span>
                                </div>

                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                                    <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-3 rounded-full transition-all duration-500"
                                         style="width: {{ $weeklyOverview['completion_rate'] }}%"></div>
                                </div>

                                <div class="grid grid-cols-2 gap-4 text-center">
                                    <div>
                                        <div class="text-xl font-bold text-green-600">{{ $weeklyOverview['active_streaks'] }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Active Streaks</div>
                                    </div>
                                    <div>
                                        <div class="text-xl font-bold text-orange-600">{{ $weeklyOverview['consistency_score'] }}%</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Consistency</div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <div class="text-sm text-gray-600 dark:text-gray-400">Best Day: <span class="font-medium">{{ $weeklyOverview['best_day'] }}</span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Recent Activity</h3>

                            @if($recentActivity->count() > 0)
                                <div class="space-y-3">
                                    @foreach($recentActivity->take(5) as $activity)
                                        <div class="flex items-center space-x-3">
                                            <span class="text-lg">{{ $activity['icon'] }}</span>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">
                                                    {{ $activity['habit_name'] }}
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $activity['value'] }} {{ $activity['unit'] }} • {{ $activity['time_ago'] }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('progress.index') }}"
                                       class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                        View all activity →
                                    </a>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <div class="text-3xl mb-2">📈</div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">No recent activity</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Upcoming Challenges -->
                    @if($upcomingChallenges->count() > 0)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Upcoming Challenges</h3>

                                <div class="space-y-3">
                                    @foreach($upcomingChallenges as $challenge)
                                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-3">
                                            <h4 class="font-medium text-gray-900 dark:text-gray-100 text-sm">{{ $challenge->name }}</h4>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                Starts {{ \Carbon\Carbon::parse($challenge->start_date)->format('M j') }} •
                                                {{ $challenge->duration_days }} days •
                                                {{ $challenge->points }} points
                                            </p>
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
