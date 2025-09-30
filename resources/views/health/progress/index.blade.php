<x-app-layout>
    <!-- Daily Progress Hero Section -->
    <div class="relative min-h-screen bg-gradient-to-br from-purple-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-900 dark:to-purple-900/20 theme-transition overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-20 left-10 w-72 h-72 bg-gradient-to-br from-purple-200 to-indigo-300 dark:from-purple-800 dark:to-indigo-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float"></div>
            <div class="absolute top-40 right-10 w-72 h-72 bg-gradient-to-br from-indigo-200 to-blue-300 dark:from-indigo-800 dark:to-blue-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-40 left-1/2 w-72 h-72 bg-gradient-to-br from-blue-200 to-purple-300 dark:from-blue-800 dark:to-purple-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float" style="animation-delay: 4s;"></div>
        </div>

        <!-- Header Section -->
        <div class="relative z-20 pt-20 pb-10">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center space-x-2 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 px-6 py-3 rounded-full text-sm font-medium mb-6 theme-transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span>{{ now()->format('l, F j, Y') }}</span>
                    </div>

                    <h1 class="text-4xl lg:text-6xl font-bold mb-6">
                        <span class="bg-gradient-to-r from-purple-600 to-indigo-600 dark:from-purple-400 dark:to-indigo-400 bg-clip-text text-transparent">Daily Progress</span><br>
                        <span class="text-gray-900 dark:text-gray-100 theme-transition">Tracker</span>
                    </h1>

                    <p class="text-xl text-gray-600 dark:text-gray-300 leading-relaxed mb-10 max-w-3xl mx-auto theme-transition">
                        Track your daily habit progress and stay motivated on your wellness journey.
                    </p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="relative z-20 pb-20">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-8">

                <!-- Today's Summary -->
                <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 theme-transition">
                    <div class="p-8">
                        <div class="flex items-center mb-8">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 theme-transition">Today's Summary</h3>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                            <div class="text-center bg-blue-50 dark:bg-blue-900/20 rounded-xl p-6 theme-transition">
                                <div class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-2">{{ $todayStats['total_habits'] }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">Total Habits</div>
                            </div>
                            <div class="text-center bg-green-50 dark:bg-green-900/20 rounded-xl p-6 theme-transition">
                                <div class="text-3xl font-bold text-green-600 dark:text-green-400 mb-2">{{ $todayStats['completed'] }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">Completed</div>
                            </div>
                            <div class="text-center bg-orange-50 dark:bg-orange-900/20 rounded-xl p-6 theme-transition">
                                <div class="text-3xl font-bold text-orange-600 dark:text-orange-400 mb-2">{{ $todayStats['pending'] }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">Pending</div>
                            </div>
                            <div class="text-center bg-purple-50 dark:bg-purple-900/20 rounded-xl p-6 theme-transition">
                                <div class="text-3xl font-bold text-purple-600 dark:text-purple-400 mb-2">{{ $todayStats['completion_rate'] }}%</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 font-medium">Completion Rate</div>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="mb-6">
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-lg font-semibold text-gray-700 dark:text-gray-300">Overall Progress</span>
                                <span class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ $todayStats['completion_rate'] }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-4">
                                <div class="bg-gradient-to-r from-purple-500 to-indigo-500 h-4 rounded-full flex items-center justify-center transition-all duration-1000 shadow-lg"
                                     style="width: {{ $todayStats['completion_rate'] }}%">
                                    @if($todayStats['completion_rate'] > 15)
                                        <span class="text-white text-xs font-semibold">{{ $todayStats['completion_rate'] }}%</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                    @if($todayStats['completion_rate'] == 100)
                        <div class="text-center">
                            <span class="text-2xl">🎉</span>
                            <p class="text-green-600 font-medium">Perfect day! All habits completed!</p>
                        </div>
                    @elseif($todayStats['completion_rate'] >= 75)
                        <div class="text-center">
                            <span class="text-2xl">💪</span>
                            <p class="text-blue-600 font-medium">Great progress! You're almost there!</p>
                        </div>
                    @elseif($todayStats['pending'] > 0)
                        <div class="text-center">
                            <span class="text-2xl">🚀</span>
                            <p class="text-gray-600 dark:text-gray-400">{{ $todayStats['pending'] }} habits remaining. Keep going!</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Today's Habits Progress -->
            @if($habitsWithProgress->count() > 0)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6">Today's Habits</h3>

                        <div class="space-y-4">
                            @foreach($habitsWithProgress as $userHabit)
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

                                <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-6 {{ $isCompleted ? 'bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-700' : '' }}">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center">
                                            <span class="text-3xl mr-4">{{ $categoryIcon }}</span>
                                            <div>
                                                <h4 class="font-semibold text-gray-900 dark:text-gray-100">{{ $userHabit->habit->name }}</h4>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $userHabit->habit->category->name }}</p>
                                            </div>
                                        </div>

                                        @if($isCompleted)
                                            <div class="flex items-center space-x-2">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                    ✓ Complete
                                                </span>
                                                @if($userHabit->current_streak > 0)
                                                    <span class="text-orange-600 font-medium text-sm">🔥 {{ $userHabit->current_streak }}</span>
                                                @endif
                                            </div>
                                        @else
                                            <button class="log-progress-btn bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200"
                                                    data-habit-id="{{ $userHabit->id }}"
                                                    data-habit-name="{{ $userHabit->habit->name }}"
                                                    data-target-value="{{ $userHabit->target_value }}"
                                                    data-unit="{{ $userHabit->habit->unit }}"
                                                    data-current-value="{{ $progressValue }}">
                                                Log Progress
                                            </button>
                                        @endif
                                    </div>

                                    <!-- Progress Information -->
                                    <div class="mb-4">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Progress</span>
                                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $progressValue }} / {{ $userHabit->target_value }} {{ $userHabit->habit->unit }}
                                            </span>
                                        </div>

                                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                                            <div class="bg-gradient-to-r {{ $isCompleted ? 'from-green-500 to-green-600' : 'from-blue-500 to-blue-600' }} h-3 rounded-full transition-all duration-500"
                                                 style="width: {{ min(100, $progressPercentage) }}%"></div>
                                        </div>

                                        @if($progressPercentage > 100)
                                            <p class="text-xs text-green-600 dark:text-green-400 mt-1">
                                                🎯 Target exceeded! Great job!
                                            </p>
                                        @endif
                                    </div>

                                    <!-- Notes -->
                                    @if($todayProgress && $todayProgress->notes)
                                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3">
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                <strong>Notes:</strong> {{ $todayProgress->notes }}
                                            </p>
                                        </div>
                                    @endif

                                    <!-- Quick Actions -->
                                    @if($isCompleted)
                                        <div class="flex space-x-2 mt-4">
                                            <button class="edit-progress-btn flex-1 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium py-2 px-3 rounded-lg transition duration-200"
                                                    data-progress-id="{{ $todayProgress->id }}"
                                                    data-habit-name="{{ $userHabit->habit->name }}"
                                                    data-current-value="{{ $progressValue }}"
                                                    data-unit="{{ $userHabit->habit->unit }}"
                                                    data-notes="{{ $todayProgress->notes }}">
                                                Edit Entry
                                            </button>
                                            <a href="{{ route('habits.show', $userHabit) }}"
                                               class="flex-1 bg-blue-100 hover:bg-blue-200 dark:bg-blue-900/50 dark:hover:bg-blue-800/50 text-blue-700 dark:text-blue-300 text-sm font-medium py-2 px-3 rounded-lg text-center transition duration-200">
                                                View History
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                    <div class="p-12 text-center">
                        <div class="text-8xl mb-6">📊</div>
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4">No Habits to Track</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-8 max-w-md mx-auto">
                            Start by creating some habits to track your daily progress.
                        </p>
                        <a href="{{ route('habits.create') }}"
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
                            Create Your First Habit
                        </a>
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>

    <!-- Progress Log Modal -->
    <div id="progressModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4" id="modalTitle">Log Progress</h3>

                <form id="progressForm" class="space-y-4">
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
                                id="completeTargetBtn"
                                class="flex-1 bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                            Complete Target
                        </button>
                        <button type="submit"
                                class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                            <span id="submitBtnText">Log Progress</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('progressModal');
            const modalTitle = document.getElementById('modalTitle');
            const progressForm = document.getElementById('progressForm');
            const progressValue = document.getElementById('progressValue');
            const progressUnit = document.getElementById('progressUnit');
            const targetValue = document.getElementById('targetValue');
            const targetUnit = document.getElementById('targetUnit');
            const progressNotes = document.getElementById('progressNotes');
            const cancelModalBtn = document.getElementById('cancelModalBtn');
            const completeTargetBtn = document.getElementById('completeTargetBtn');
            const submitBtnText = document.getElementById('submitBtnText');

            let currentHabitId = null;
            let currentTargetValue = null;
            let isEditMode = false;
            let currentProgressId = null;

            // Open modal for new progress logging
            document.querySelectorAll('.log-progress-btn').forEach(button => {
                button.addEventListener('click', function() {
                    openModal(
                        this.dataset.habitId,
                        this.dataset.habitName,
                        this.dataset.targetValue,
                        this.dataset.unit,
                        this.dataset.currentValue || ''
                    );
                });
            });

            // Open modal for editing existing progress
            document.querySelectorAll('.edit-progress-btn').forEach(button => {
                button.addEventListener('click', function() {
                    openEditModal(
                        this.dataset.progressId,
                        this.dataset.habitName,
                        this.dataset.currentValue,
                        this.dataset.unit,
                        this.dataset.notes
                    );
                });
            });

            function openModal(habitId, habitName, targetVal, unit, currentValue = '') {
                isEditMode = false;
                currentHabitId = habitId;
                currentTargetValue = parseFloat(targetVal);

                modalTitle.textContent = `Log Progress - ${habitName}`;
                progressValue.value = currentValue;
                progressValue.max = currentTargetValue * 2; // Allow exceeding target
                progressUnit.textContent = unit;
                targetValue.textContent = currentTargetValue;
                targetUnit.textContent = unit;
                progressNotes.value = '';
                submitBtnText.textContent = 'Log Progress';

                modal.classList.remove('hidden');
                progressValue.focus();
            }

            function openEditModal(progressId, habitName, currentValue, unit, notes) {
                isEditMode = true;
                currentProgressId = progressId;

                modalTitle.textContent = `Edit Progress - ${habitName}`;
                progressValue.value = currentValue;
                progressUnit.textContent = unit;
                progressNotes.value = notes || '';
                submitBtnText.textContent = 'Update Progress';

                // Hide target info and complete button for edit mode
                document.querySelector('.text-xs.text-gray-500').style.display = 'none';
                completeTargetBtn.style.display = 'none';

                modal.classList.remove('hidden');
                progressValue.focus();
            }

            // Close modal
            cancelModalBtn.addEventListener('click', closeModal);

            function closeModal() {
                modal.classList.add('hidden');
                // Reset display properties
                document.querySelector('.text-xs.text-gray-500').style.display = 'block';
                completeTargetBtn.style.display = 'block';
            }

            // Complete target value
            completeTargetBtn.addEventListener('click', function() {
                progressValue.value = currentTargetValue;
                submitProgress();
            });

            // Handle form submission
            progressForm.addEventListener('submit', function(e) {
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

                const submitBtn = progressForm.querySelector('button[type="submit"]');
                const originalText = submitBtnText.textContent;
                submitBtnText.textContent = isEditMode ? 'Updating...' : 'Logging...';
                submitBtn.disabled = true;

                const url = isEditMode
                    ? `/progress/${currentProgressId}`
                    : '{{ route("progress.store") }}';

                const method = isEditMode ? 'PUT' : 'POST';

                const data = isEditMode
                    ? { value: value, notes: notes }
                    : {
                        user_habit_id: currentHabitId,
                        date: new Date().toISOString().split('T')[0],
                        value: value,
                        notes: notes
                    };

                fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification(data.message, 'success');
                        closeModal();

                        // Refresh the page to show updated progress
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else {
                        showNotification(data.message || 'Failed to save progress', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Failed to save progress', 'error');
                })
                .finally(() => {
                    submitBtnText.textContent = originalText;
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
                    closeModal();
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
