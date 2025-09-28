<x-app-layout>
    <!-- Browse Available Habits Hero Section -->
    <div class="relative min-h-screen bg-gradient-to-br from-green-50 via-white to-emerald-50 dark:from-gray-900 dark:via-gray-900 dark:to-green-900/20 theme-transition overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-20 left-10 w-72 h-72 bg-gradient-to-br from-green-200 to-emerald-300 dark:from-green-800 dark:to-emerald-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float"></div>
            <div class="absolute top-40 right-10 w-72 h-72 bg-gradient-to-br from-teal-200 to-cyan-300 dark:from-teal-800 dark:to-cyan-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-40 left-1/2 w-72 h-72 bg-gradient-to-br from-emerald-200 to-green-300 dark:from-emerald-800 dark:to-green-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float" style="animation-delay: 4s;"></div>
        </div>

        <!-- Header Section -->
        <div class="relative z-20 pt-20 pb-10">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center space-x-2 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 px-6 py-3 rounded-full text-sm font-medium mb-6 theme-transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <span>Discover Wellness Habits</span>
                    </div>

                    <h1 class="text-4xl lg:text-6xl font-bold mb-6">
                        <span class="bg-gradient-to-r from-green-600 to-emerald-600 dark:from-green-400 dark:to-emerald-400 bg-clip-text text-transparent">Browse Available</span><br>
                        <span class="text-gray-900 dark:text-gray-100 theme-transition">Habits</span>
                    </h1>

                    <p class="text-xl text-gray-600 dark:text-gray-300 leading-relaxed mb-10 max-w-3xl mx-auto theme-transition">
                        Browse popular wellness habits created by our community and health experts. Add them to your routine with personalized targets that fit your lifestyle.
                    </p>

                    <!-- Quick Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12">
                        <a href="{{ route('habits.create') }}"
                           class="group bg-green-600 hover:bg-green-700 dark:bg-green-700 dark:hover:bg-green-600 text-white px-8 py-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            <span>Create Custom Habit</span>
                        </a>
                        <a href="{{ route('habits.index') }}"
                           class="group bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 text-green-700 dark:text-green-300 px-8 py-4 rounded-xl font-semibold transition-all duration-300 border-2 border-green-200 dark:border-green-700 hover:border-green-300 dark:hover:border-green-600 flex items-center space-x-2 theme-transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            <span>Back to My Habits</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="relative z-20 pb-20">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-8">

                @if($availableHabits->count() > 0)
                    @foreach($availableHabits as $categoryName => $habits)
                        <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 theme-transition">
                            <div class="p-8">
                                <div class="flex items-center mb-8">
                                    <div class="w-16 h-16 bg-gradient-to-br from-green-600 to-emerald-600 rounded-2xl flex items-center justify-center mr-4">
                                        <span class="text-2xl">
                                            {{ $categoryName === 'Fitness' ? '💪' : ($categoryName === 'Mental Health' ? '🧠' : ($categoryName === 'Nutrition' ? '🥗' : ($categoryName === 'Sleep' ? '😴' : ($categoryName === 'Productivity' ? '⚡' : ($categoryName === 'Learning' ? '📚' : ($categoryName === 'Social' ? '👥' : '⭐')))))) }}
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 theme-transition">{{ $categoryName }}</h3>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300 mt-2">
                                            {{ $habits->count() }} habits available
                                        </span>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    @foreach($habits as $habit)
                                        <div class="group bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/30 border border-green-100 dark:border-green-700 rounded-2xl p-6 hover:shadow-xl transition-all duration-300 theme-transition">

                                            <!-- Habit Header -->
                                            <div class="mb-6">
                                                <div class="w-12 h-12 bg-green-600 dark:bg-green-700 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                </div>
                                                <h4 class="font-bold text-gray-900 dark:text-gray-100 mb-3 text-lg">{{ $habit->name }}</h4>
                                                @if($habit->description)
                                                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ $habit->description }}</p>
                                                @endif
                                            </div>

                                            <!-- Habit Details -->
                                            <div class="space-y-3 mb-6">
                                                <div class="bg-white dark:bg-gray-800 rounded-lg p-3 flex justify-between items-center">
                                                    <span class="text-gray-600 dark:text-gray-400 text-sm font-medium">Frequency:</span>
                                                    <span class="font-semibold text-gray-900 dark:text-gray-100 text-sm">{{ ucfirst($habit->frequency) }}</span>
                                                </div>
                                                <div class="bg-white dark:bg-gray-800 rounded-lg p-3 flex justify-between items-center">
                                                    <span class="text-gray-600 dark:text-gray-400 text-sm font-medium">Suggested Target:</span>
                                                    <span class="font-semibold text-gray-900 dark:text-gray-100 text-sm">{{ $habit->target_value }} {{ $habit->unit }}</span>
                                                </div>
                                            </div>

                                            <!-- Add Habit Button -->
                                            <button class="add-habit-btn w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl"
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
                    <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 theme-transition">
                        <div class="p-16 text-center">
                            <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 rounded-3xl flex items-center justify-center mx-auto mb-8">
                                <div class="text-4xl">🔍</div>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">No Available Habits</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-8 max-w-md mx-auto">
                                Looks like you've already added all available habits or there are none created yet.
                            </p>
                            <a href="{{ route('habits.create') }}"
                               class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Create Your Own Habit
                            </a>
                        </div>
                    </div>
                @endif
            </div>
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
