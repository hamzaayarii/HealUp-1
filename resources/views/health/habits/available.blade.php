<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Browse Available Habits') }}
            </h2>
            <div class="flex space-x-3">
                <a href="{{ route('habits.create') }}"
                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    Create Custom Habit
                </a>
                <a href="{{ route('habits.index') }}"
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    Back to My Habits
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Introduction -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                <div class="p-6">
                    <div class="text-center">
                        <div class="text-6xl mb-4">🌟</div>
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Discover New Wellness Habits</h3>
                        <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                            Browse popular wellness habits created by our community and health experts.
                            Add them to your routine with personalized targets that fit your lifestyle.
                        </p>
                    </div>
                </div>
            </div>

            @if($availableHabits->count() > 0)
                @foreach($availableHabits as $categoryName => $habits)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                        <div class="p-6">
                            <div class="flex items-center mb-6">
                                <span class="text-3xl mr-3">
                                    {{ $categoryName === 'Fitness' ? '💪' : ($categoryName === 'Mental Health' ? '🧠' : ($categoryName === 'Nutrition' ? '🥗' : ($categoryName === 'Sleep' ? '😴' : ($categoryName === 'Productivity' ? '⚡' : ($categoryName === 'Learning' ? '📚' : ($categoryName === 'Social' ? '👥' : '⭐')))))) }}
                                </span>
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">{{ $categoryName }}</h3>
                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    {{ $habits->count() }} habits
                                </span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($habits as $habit)
                                    <div class="border border-gray-200 dark:border-gray-700 rounded-xl p-6 hover:shadow-lg transition-all duration-200">

                                        <!-- Habit Header -->
                                        <div class="mb-4">
                                            <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-2">{{ $habit->name }}</h4>
                                            @if($habit->description)
                                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $habit->description }}</p>
                                            @endif
                                        </div>

                                        <!-- Habit Details -->
                                        <div class="space-y-2 mb-4 text-sm">
                                            <div class="flex justify-between">
                                                <span class="text-gray-600 dark:text-gray-400">Frequency:</span>
                                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ ucfirst($habit->frequency) }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600 dark:text-gray-400">Suggested Target:</span>
                                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ $habit->target_value }} {{ $habit->unit }}</span>
                                            </div>
                                        </div>

                                        <!-- Add Habit Button -->
                                        <button class="add-habit-btn w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200"
                                                data-habit-id="{{ $habit->id }}"
                                                data-habit-name="{{ $habit->name }}"
                                                data-suggested-target="{{ $habit->target_value }}"
                                                data-unit="{{ $habit->unit }}"
                                                data-description="{{ $habit->description }}">
                                            Add to My Habits
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Empty State -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                    <div class="p-12 text-center">
                        <div class="text-8xl mb-6">🔍</div>
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4">No Available Habits</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-8 max-w-md mx-auto">
                            Looks like you've already added all available habits or there are none created yet.
                        </p>
                        <a href="{{ route('habits.create') }}"
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
                            Create Your Own Habit
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Add Habit Modal -->
    <div id="addHabitModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4" id="modalHabitName">Add Habit</h3>

                <form id="addHabitForm" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                        <p id="habitDescription" class="text-sm text-gray-600 dark:text-gray-400 bg-gray-50 dark:bg-gray-700/50 p-3 rounded-lg"></p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Your Target Value</label>
                        <div class="flex items-center space-x-2">
                            <input type="number"
                                   id="targetValue"
                                   class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100"
                                   placeholder="Enter your target"
                                   step="0.1"
                                   min="0"
                                   required>
                            <span id="targetUnit" class="text-sm text-gray-500 dark:text-gray-400"></span>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Suggested: <span id="suggestedTarget"></span> <span id="suggestedUnit"></span>
                        </p>
                    </div>

                    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-3">
                        <h4 class="font-medium text-blue-900 dark:text-blue-200 text-sm mb-1">💡 Target Setting Tips</h4>
                        <ul class="text-xs text-blue-800 dark:text-blue-300 space-y-1">
                            <li>• Start with achievable goals to build consistency</li>
                            <li>• You can always adjust your target later</li>
                            <li>• Aim for 70-80% completion rate for sustainable growth</li>
                        </ul>
                    </div>

                    <div class="flex space-x-3">
                        <button type="button"
                                id="cancelAddBtn"
                                class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium py-2 px-4 rounded-md transition duration-200">
                            Cancel
                        </button>
                        <button type="button"
                                id="useSuggestedBtn"
                                class="flex-1 bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                            Use Suggested
                        </button>
                        <button type="submit"
                                class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                            Add Habit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('addHabitModal');
            const modalHabitName = document.getElementById('modalHabitName');
            const habitDescription = document.getElementById('habitDescription');
            const targetValue = document.getElementById('targetValue');
            const targetUnit = document.getElementById('targetUnit');
            const suggestedTarget = document.getElementById('suggestedTarget');
            const suggestedUnit = document.getElementById('suggestedUnit');
            const addHabitForm = document.getElementById('addHabitForm');
            const cancelAddBtn = document.getElementById('cancelAddBtn');
            const useSuggestedBtn = document.getElementById('useSuggestedBtn');

            let currentHabitId = null;
            let currentSuggestedTarget = null;

            // Open modal for adding habit
            document.querySelectorAll('.add-habit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    currentHabitId = this.dataset.habitId;
                    currentSuggestedTarget = parseFloat(this.dataset.suggestedTarget);

                    modalHabitName.textContent = `Add "${this.dataset.habitName}" to Your Habits`;
                    habitDescription.textContent = this.dataset.description || 'No description available.';
                    targetValue.value = currentSuggestedTarget;
                    targetUnit.textContent = this.dataset.unit;
                    suggestedTarget.textContent = currentSuggestedTarget;
                    suggestedUnit.textContent = this.dataset.unit;

                    modal.classList.remove('hidden');
                    targetValue.focus();
                });
            });

            // Close modal
            cancelAddBtn.addEventListener('click', function() {
                modal.classList.add('hidden');
            });

            // Use suggested target
            useSuggestedBtn.addEventListener('click', function() {
                targetValue.value = currentSuggestedTarget;
                targetValue.focus();
            });

            // Handle form submission
            addHabitForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const target = parseFloat(targetValue.value);

                if (!target || target <= 0) {
                    alert('Please enter a valid target value');
                    return;
                }

                const submitBtn = addHabitForm.querySelector('button[type="submit"]');
                const originalText = submitBtn.textContent;
                submitBtn.textContent = 'Adding...';
                submitBtn.disabled = true;

                fetch('{{ route("habits.add-existing") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        habit_id: currentHabitId,
                        target_value: target
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Habit added successfully! Start tracking your progress.', 'success');
                        modal.classList.add('hidden');

                        // Remove the habit card from the available list
                        const habitCard = document.querySelector(`[data-habit-id="${currentHabitId}"]`).closest('.border');
                        habitCard.style.display = 'none';

                        // Show option to go to habits page
                        setTimeout(() => {
                            if (confirm('Habit added! Would you like to go to your habits page to start tracking?')) {
                                window.location.href = '{{ route("habits.index") }}';
                            }
                        }, 1500);
                    } else {
                        showNotification(data.message || 'Failed to add habit', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Failed to add habit', 'error');
                })
                .finally(() => {
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                });
            });

            function showNotification(message, type) {
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 ${
                    type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
                }`;
                notification.textContent = message;

                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.remove();
                }, 4000);
            }

            // Close modal when clicking outside
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });

            // Quick target adjustments
            targetValue.addEventListener('input', function() {
                const current = parseFloat(this.value);
                const suggested = currentSuggestedTarget;

                if (current && suggested) {
                    const difference = ((current - suggested) / suggested * 100);
                    let message = '';

                    if (difference > 20) {
                        message = '⚠️ This target is quite ambitious!';
                        this.style.borderColor = '#f59e0b';
                    } else if (difference < -30) {
                        message = '💡 Consider a slightly higher target for better progress.';
                        this.style.borderColor = '#3b82f6';
                    } else {
                        message = '✅ Good target choice!';
                        this.style.borderColor = '#10b981';
                    }

                    // Update or create feedback message
                    let feedback = document.getElementById('targetFeedback');
                    if (!feedback) {
                        feedback = document.createElement('p');
                        feedback.id = 'targetFeedback';
                        feedback.className = 'text-xs mt-1';
                        this.parentNode.appendChild(feedback);
                    }
                    feedback.textContent = message;
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
