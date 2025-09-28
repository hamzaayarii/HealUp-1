<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $userHabit->habit->name }} - Details
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('habits.edit', $userHabit) }}"
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    Edit Habit
                </a>
                <a href="{{ route('habits.index') }}"
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    Back to Habits
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Habit Overview -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                <div class="p-6">
                    <div class="flex items-center mb-6">
                        <span class="text-4xl mr-4">
                            {{ $userHabit->habit->category->name === 'Fitness' ? '💪' : ($userHabit->habit->category->name === 'Mental Health' ? '🧠' : ($userHabit->habit->category->name === 'Nutrition' ? '🥗' : '⭐')) }}
                        </span>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $userHabit->habit->name }}</h3>
                            <p class="text-gray-600 dark:text-gray-400">{{ $userHabit->habit->category->name }}</p>
                            @if($userHabit->habit->description)
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">{{ $userHabit->habit->description }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Key Stats -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600">{{ $userHabit->target_value }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Daily Target</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ $userHabit->habit->unit }}</div>
                        </div>
                        <div class="text-center p-4 bg-orange-50 dark:bg-orange-900/20 rounded-lg">
                            <div class="text-2xl font-bold text-orange-600">{{ $stats['current_streak'] }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Current Streak</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">days</div>
                        </div>
                        <div class="text-center p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                            <div class="text-2xl font-bold text-purple-600">{{ $userHabit->longest_streak }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Best Streak</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">days</div>
                        </div>
                        <div class="text-center p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
                            <div class="text-2xl font-bold text-green-600">{{ $stats['completion_rate'] }}%</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Success Rate</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">last 30 days</div>
                        </div>
                    </div>

                    <!-- Additional Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="text-center p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <div class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ $stats['total_completed'] }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Total Completions</div>
                        </div>
                        <div class="text-center p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <div class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ number_format($stats['average_value'], 1) }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Average {{ $userHabit->habit->unit }}</div>
                        </div>
                        <div class="text-center p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <div class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ \Carbon\Carbon::parse($userHabit->started_at)->diffInDays(now()) }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Days Since Started</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Progress -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6">Recent Progress (Last 30 Days)</h3>

                    @if($stats['recent_progress']->count() > 0)
                        <div class="space-y-3">
                            @foreach($stats['recent_progress'] as $progress)
                                @php
                                    $progressPercentage = ($progress->value / $userHabit->target_value) * 100;
                                @endphp

                                <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg {{ $progress->completed ? 'bg-green-50 dark:bg-green-900/20' : 'bg-gray-50 dark:bg-gray-700/50' }}">
                                    <div class="flex items-center">
                                        <div class="mr-4">
                                            @if($progress->completed)
                                                <span class="text-green-600 text-xl">✅</span>
                                            @else
                                                <span class="text-gray-400 text-xl">⭕</span>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900 dark:text-gray-100">
                                                {{ \Carbon\Carbon::parse($progress->date)->format('l, M j, Y') }}
                                            </div>
                                            @if($progress->notes)
                                                <div class="text-sm text-gray-600 dark:text-gray-400">{{ $progress->notes }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <div class="font-bold text-lg {{ $progress->completed ? 'text-green-600' : 'text-gray-600' }}">
                                            {{ $progress->value }} {{ $userHabit->habit->unit }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ number_format($progressPercentage, 1) }}% of target
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Load More Button -->
                        <div class="text-center mt-6">
                            <button onclick="loadMoreProgress()"
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                                Load More History
                            </button>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="text-4xl mb-4">📊</div>
                            <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No Progress Yet</h4>
                            <p class="text-gray-600 dark:text-gray-400 mb-4">Start logging your daily progress to see your journey here.</p>
                            <a href="{{ route('progress.index') }}"
                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                                Log Today's Progress
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Progress Chart Placeholder -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6">Progress Visualization</h3>

                    <!-- Chart would go here - using Canvas or Chart.js -->
                    <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-8 text-center">
                        <div class="text-4xl mb-4">📈</div>
                        <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Progress Chart</h4>
                        <p class="text-gray-600 dark:text-gray-400">Visual chart showing your progress trend over time can be implemented here using Chart.js or similar library.</p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6">Actions</h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('progress.index') }}"
                           class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-lg text-center transition duration-200">
                            📝 Log Today's Progress
                        </a>
                        <a href="{{ route('habits.edit', $userHabit) }}"
                           class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-lg text-center transition duration-200">
                            ⚙️ Edit Habit Settings
                        </a>
                        <button onclick="confirmDeactivate()"
                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-4 rounded-lg transition duration-200">
                            🗑️ Deactivate Habit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function loadMoreProgress() {
            // Implement loading more progress history
            console.log('Loading more progress history...');
            showNotification('Loading more history... (Feature can be implemented with AJAX)', 'info');
        }

        function confirmDeactivate() {
            if (confirm('Are you sure you want to deactivate this habit? You can reactivate it later, and your progress history will be preserved.')) {
                // Submit deactivation form
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("habits.destroy", $userHabit) }}';
                form.innerHTML = `
                    @csrf
                    @method('DELETE')
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 ${
                type === 'success' ? 'bg-green-500 text-white' :
                type === 'error' ? 'bg-red-500 text-white' :
                'bg-blue-500 text-white'
            }`;
            notification.textContent = message;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    </script>
    @endpush
</x-app-layout>
