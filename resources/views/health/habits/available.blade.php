<x-app-layout>
    <!-- Browse Available Habits Hero Section -->
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
                        <a href="{{ route('habits.index') }}"
                           class="inline-flex items-center text-gray-600 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 font-medium transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to My Habits
                        </a>
                        <div class="hidden sm:block h-6 w-px bg-gray-300 dark:bg-gray-600"></div>
                        <div class="hidden sm:flex items-center space-x-2">
                            <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center">
                                <span class="text-lg">🌟</span>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100">Browse Habits</h2>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('habits.create') }}"
                           class="inline-flex items-center bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white px-4 py-2 rounded-xl font-semibold text-sm transition-all duration-300 transform hover:scale-105 shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Create Custom
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Title Section -->
        <div class="relative z-20 pt-8 pb-6">
            <div class="w-full px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto">
                    <div class="inline-flex items-center space-x-2 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 px-4 py-2 rounded-full text-sm font-medium mb-4">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <span>Discover Wellness Habits</span>
                    </div>
                    <h1 class="text-3xl lg:text-4xl font-bold mb-3">
                        <span class="bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-400 dark:to-teal-400 bg-clip-text text-transparent">Available Habits Collection</span>
                    </h1>
                    <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed max-w-3xl">
                        Browse wellness habits and add them to your routine with personalized targets.
                    </p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="relative z-20 pb-12 pt-6">
            <div class="w-full px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto space-y-6">
                @if($availableHabits->count() > 0)
                    @foreach($availableHabits as $categoryName => $habits)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-emerald-100 dark:border-emerald-700 theme-transition hover:shadow-xl transition-all duration-300">
                            <div class="p-6">
                                <div class="flex items-center mb-6">
                                    <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center mr-4 shadow-md">
                                        <span class="text-2xl">
                                            {{ $categoryName === 'Fitness' ? '💪' : ($categoryName === 'Mental Health' ? '🧠' : ($categoryName === 'Nutrition' ? '🥗' : ($categoryName === 'Sleep' ? '😴' : ($categoryName === 'Productivity' ? '⚡' : ($categoryName === 'Learning' ? '📚' : ($categoryName === 'Social' ? '👥' : '⭐')))))) }}
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 theme-transition">{{ $categoryName }}</h3>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300 mt-1">
                                            {{ $habits->count() }} available
                                        </span>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                                    @foreach($habits as $habit)
                                        <div class="group bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/30 border-2 border-emerald-200 dark:border-emerald-700 rounded-xl p-5 hover:shadow-xl hover:scale-[1.02] transition-all duration-300 theme-transition">

                                            <!-- Habit Header -->
                                            <div class="mb-4">
                                                <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform shadow-md">
                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                </div>
                                                <h4 class="font-bold text-gray-900 dark:text-gray-100 mb-2 text-base">{{ $habit->name }}</h4>
                                                @if($habit->description)
                                                    <p class="text-xs text-gray-600 dark:text-gray-400 line-clamp-2">{{ $habit->description }}</p>
                                                @endif
                                            </div>

                                            <!-- Habit Details -->
                                            <div class="space-y-2 mb-4">
                                                <div class="bg-white dark:bg-gray-800 rounded-lg p-2.5 flex justify-between items-center">
                                                    <span class="text-gray-600 dark:text-gray-400 text-xs font-medium">Frequency:</span>
                                                    <span class="font-semibold text-emerald-600 dark:text-emerald-400 text-xs">{{ ucfirst($habit->frequency) }}</span>
                                                </div>
                                                <div class="bg-white dark:bg-gray-800 rounded-lg p-2.5 flex justify-between items-center">
                                                    <span class="text-gray-600 dark:text-gray-400 text-xs font-medium">Target:</span>
                                                    <span class="font-semibold text-emerald-600 dark:text-emerald-400 text-xs">{{ $habit->target_value }} {{ $habit->unit }}</span>
                                                </div>
                                            </div>

                                            <!-- Add Habit Button -->
                                            <button class="add-habit-btn w-full bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold py-2.5 px-4 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg text-sm flex items-center justify-center space-x-2"
                                                    data-habit-id="{{ $habit->id }}"
                                                    data-habit-name="{{ $habit->name }}"
                                                    data-suggested-target="{{ $habit->target_value }}"
                                                    data-unit="{{ $habit->unit }}"
                                                    data-description="{{ $habit->description }}">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                                </svg>
                                                <span>Add to My Habits</span>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Empty State -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-emerald-100 dark:border-emerald-700 theme-transition">
                        <div class="p-12 text-center">
                            <div class="w-20 h-20 bg-gradient-to-br from-emerald-100 to-teal-100 dark:from-emerald-900/30 dark:to-teal-900/30 rounded-2xl flex items-center justify-center mx-auto mb-6">
                                <div class="text-4xl">🔍</div>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-3">No Available Habits</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-6 max-w-md mx-auto text-sm">
                                Looks like you've already added all available habits or there are none created yet.
                            </p>
                            <a href="{{ route('habits.create') }}"
                               class="inline-flex items-center bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
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
    </div>

    <!-- Enhanced Add Habit Modal -->
    <div id="addHabitModal" class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50 flex items-center justify-center">
        <div class="relative mx-auto p-8 w-full max-w-md">
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border-2 border-emerald-200 dark:border-emerald-700 transform transition-all">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-t-3xl p-6 mb-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-white/20 backdrop-blur-lg rounded-xl flex items-center justify-center">
                                <span class="text-2xl">✨</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white" id="modalHabitName">Add Habit</h3>
                                <p class="text-emerald-100 text-sm">Customize your goal</p>
                            </div>
                        </div>
                    </div>
                </div>

                <form id="addHabitForm" class="space-y-6 px-6 pb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-900 dark:text-gray-100 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
                            </svg>
                            Description
                        </label>
                        <p id="habitDescription" class="text-sm text-gray-600 dark:text-gray-400 bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/30 p-4 rounded-xl border border-emerald-200 dark:border-emerald-700"></p>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-900 dark:text-gray-100 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                            Your Target Value
                        </label>
                        <div class="flex items-center space-x-3">
                            <input type="number"
                                   id="targetValue"
                                   class="flex-1 px-5 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:bg-gray-700 dark:text-gray-100 text-lg font-semibold"
                                   placeholder="0"
                                   step="0.1"
                                   min="0"
                                   required>
                            <span id="targetUnit" class="text-lg font-semibold text-emerald-600 dark:text-emerald-400 min-w-[60px]"></span>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                            Suggested: <span id="suggestedTarget" class="font-bold text-emerald-600 dark:text-emerald-400"></span> <span id="suggestedUnit"></span>
                        </p>
                    </div>

                    <div class="bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/30 rounded-xl p-4 border border-emerald-200 dark:border-emerald-700">
                        <h4 class="font-bold text-emerald-900 dark:text-emerald-200 text-sm mb-2 flex items-center">
                            <span class="mr-2">💡</span>
                            Target Setting Tips
                        </h4>
                        <ul class="text-xs text-emerald-800 dark:text-emerald-300 space-y-1">
                            <li>• Start with achievable goals to build consistency</li>
                            <li>• You can always adjust your target later</li>
                            <li>• Aim for 70-80% completion rate</li>
                        </ul>
                    </div>

                    <div class="flex flex-col gap-3 pt-2">
                        <div class="flex gap-3">
                            <button type="button"
                                    id="useSuggestedBtn"
                                    class="flex-1 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Use Suggested</span>
                            </button>
                            <button type="submit"
                                    class="flex-1 bg-gradient-to-r from-teal-600 to-cyan-600 hover:from-teal-700 hover:to-cyan-700 text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                <span>Add Habit</span>
                            </button>
                        </div>
                        <button type="button"
                                id="cancelAddBtn"
                                class="w-full bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-semibold py-3 px-6 rounded-xl transition-all duration-200">
                            Cancel
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
                        const habitCard = document.querySelector(`[data-habit-id="${currentHabitId}"]`).closest('.group');
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
                notification.className = `fixed top-4 right-4 z-50 p-4 rounded-xl shadow-lg transition-all duration-300 ${
                    type === 'success' ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white' : 'bg-gradient-to-r from-red-600 to-orange-600 text-white'
                }`;
                notification.innerHTML = `
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="${type === 'success' ? 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z' : 'M6 18L18 6M6 6l12 12'}"/>
                        </svg>
                        <span class="font-semibold">${message}</span>
                    </div>
                `;

                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.remove();
                }, 4000);
            }odal.addEventListener('click', function(e) {
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
