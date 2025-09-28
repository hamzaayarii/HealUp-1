<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('My Habits') }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('habits.available') }}"
                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    Browse Habits
                </a>
                <a href="{{ route('habits.create') }}"
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    Create New Habit
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Today's Stats Overview -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Today's Overview</h3>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600">{{ $todayStats['total_habits'] }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Total Habits</div>
                        </div>
                        <div class="text-center p-4 bg-green-50 dark:bg-green-900/20 rounded-lg">
                            <div class="text-2xl font-bold text-green-600">{{ $todayStats['completed_today'] }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Completed Today</div>
                        </div>
                        <div class="text-center p-4 bg-orange-50 dark:bg-orange-900/20 rounded-lg">
                            <div class="text-2xl font-bold text-orange-600">{{ $todayStats['total_habits'] - $todayStats['completed_today'] }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Remaining</div>
                        </div>
                        <div class="text-center p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                            <div class="text-2xl font-bold text-purple-600">{{ $todayStats['completion_rate'] }}%</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Completion Rate</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Habits List -->
            @if($userHabits->count() > 0)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6">Your Habits</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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

                                <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-6 hover:shadow-lg transition-all duration-200 {{ $isCompleted ? 'bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-700' : '' }}">

                                    <!-- Header -->
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex items-center">
                                            <span class="text-3xl mr-3">{{ $categoryIcon }}</span>
                                            <div>
                                                <h4 class="font-semibold text-gray-900 dark:text-gray-100">{{ $userHabit->habit->name }}</h4>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $userHabit->habit->category->name }}</p>
                                            </div>
                                        </div>

                                        <!-- Status Badge -->
                                        @if($isCompleted)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                ✓ Complete
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                In Progress
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Description -->
                                    @if($userHabit->habit->description)
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">{{ $userHabit->habit->description }}</p>
                                    @endif

                                    <!-- Progress -->
                                    <div class="mb-4">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Today's Progress</span>
                                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $progressValue }} / {{ $userHabit->target_value }} {{ $userHabit->habit->unit }}
                                            </span>
                                        </div>
                                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                            <div class="bg-gradient-to-r {{ $isCompleted ? 'from-green-500 to-green-600' : 'from-blue-500 to-blue-600' }} h-2 rounded-full transition-all duration-500"
                                                 style="width: {{ min(100, $progressPercentage) }}%"></div>
                                        </div>
                                    </div>

                                    <!-- Stats -->
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div class="text-center">
                                            <div class="text-lg font-bold text-orange-600">{{ $userHabit->current_streak }}</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">Current Streak</div>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-lg font-bold text-purple-600">{{ $userHabit->longest_streak }}</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">Best Streak</div>
                                        </div>
                                    </div>

                                    <!-- Quick Actions -->
                                    <div class="flex space-x-2">
                                        <a href="{{ route('habits.show', $userHabit) }}"
                                           class="flex-1 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium py-2 px-3 rounded-md text-center transition duration-200">
                                            View Details
                                        </a>

                                        @if(!$isCompleted)
                                            <button class="quick-log-habit-btn bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-3 rounded-md transition duration-200"
                                                    data-habit-id="{{ $userHabit->id }}"
                                                    data-habit-name="{{ $userHabit->habit->name }}"
                                                    data-target-value="{{ $userHabit->target_value }}"
                                                    data-unit="{{ $userHabit->habit->unit }}"
                                                    data-current-value="{{ $progressValue }}">
                                                Log Progress
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                    <div class="p-12 text-center">
                        <div class="text-8xl mb-6">🎯</div>
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Start Your Wellness Journey</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-8 max-w-md mx-auto">
                            Create your first habit and begin tracking your progress towards a healthier, happier you.
                        </p>
                        <div class="flex justify-center space-x-4">
                            <a href="{{ route('habits.create') }}"
                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
                                Create Your First Habit
                            </a>
                            <a href="{{ route('habits.available') }}"
                               class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
                                Browse Popular Habits
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Log Modal -->
    <div id="quickLogModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4" id="modalHabitName">Log Progress</h3>

                <form id="quickLogForm" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Value</label>
                        <div class="flex items-center space-x-2">
                            <input type="number"
                                   id="progressValue"
                                   class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100"
                                   placeholder="Enter value"
                                   step="0.1"
                                   required>
                            <span id="progressUnit" class="text-sm text-gray-500 dark:text-gray-400"></span>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Target: <span id="targetValue"></span> <span id="targetUnit"></span>
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Notes (Optional)</label>
                        <textarea id="progressNotes"
                                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100"
                                  rows="3"
                                  placeholder="How did it go? Any thoughts?"></textarea>
                    </div>

                    <div class="flex space-x-3">
                        <button type="button"
                                id="cancelModalBtn"
                                class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium py-2 px-4 rounded-md transition duration-200">
                            Cancel
                        </button>
                        <button type="button"
                                id="completeHabitBtn"
                                class="flex-1 bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                            Complete Target
                        </button>
                        <button type="submit"
                                class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                            Log Progress
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('quickLogModal');
            const modalHabitName = document.getElementById('modalHabitName');
            const progressValue = document.getElementById('progressValue');
            const progressUnit = document.getElementById('progressUnit');
            const targetValue = document.getElementById('targetValue');
            const targetUnit = document.getElementById('targetUnit');
            const progressNotes = document.getElementById('progressNotes');
            const quickLogForm = document.getElementById('quickLogForm');
            const cancelModalBtn = document.getElementById('cancelModalBtn');
            const completeHabitBtn = document.getElementById('completeHabitBtn');

            let currentHabitId = null;
            let currentTargetValue = null;

            // Open modal for habit logging
            document.querySelectorAll('.quick-log-habit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    currentHabitId = this.dataset.habitId;
                    currentTargetValue = parseFloat(this.dataset.targetValue);

                    modalHabitName.textContent = this.dataset.habitName;
                    progressValue.value = this.dataset.currentValue || '';
                    progressValue.max = currentTargetValue;
                    progressUnit.textContent = this.dataset.unit;
                    targetValue.textContent = currentTargetValue;
                    targetUnit.textContent = this.dataset.unit;
                    progressNotes.value = '';

                    modal.classList.remove('hidden');
                });
            });

            // Close modal
            cancelModalBtn.addEventListener('click', function() {
                modal.classList.add('hidden');
            });

            // Complete habit with target value
            completeHabitBtn.addEventListener('click', function() {
                progressValue.value = currentTargetValue;
                submitProgress();
            });

            // Handle form submission
            quickLogForm.addEventListener('submit', function(e) {
                e.preventDefault();
                submitProgress();
            });

            function submitProgress() {
                const value = parseFloat(progressValue.value);
                const notes = progressNotes.value;

                if (!value || value < 0) {
                    alert('Please enter a valid value');
                    return;
                }

                const submitBtn = quickLogForm.querySelector('button[type="submit"]');
                const originalText = submitBtn.textContent;
                submitBtn.textContent = 'Logging...';
                submitBtn.disabled = true;

                fetch('{{ route("progress.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        user_habit_id: currentHabitId,
                        date: new Date().toISOString().split('T')[0],
                        value: value,
                        notes: notes
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification(data.message, 'success');
                        modal.classList.add('hidden');

                        // Refresh the page to show updated progress
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else {
                        showNotification(data.message || 'Failed to log progress', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Failed to log progress', 'error');
                })
                .finally(() => {
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
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
                }, 3000);
            }

            // Close modal when clicking outside
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
