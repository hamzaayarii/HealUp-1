<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Habit') }} - {{ $userHabit->habit->name }}
            </h2>
            <a href="{{ route('habits.show', $userHabit) }}"
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                Back to Habit
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                <div class="p-8">
                    <div class="text-center mb-8">
                        <div class="text-6xl mb-4">⚙️</div>
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Edit Habit Settings</h3>
                        <p class="text-gray-600 dark:text-gray-400">Adjust your habit's target value and activation status.</p>
                    </div>

                    <form method="POST" action="{{ route('habits.update', $userHabit) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Habit Information (Read-only) -->
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                            <h4 class="font-medium text-gray-900 dark:text-gray-100 mb-3">Habit Information</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-gray-600 dark:text-gray-400">Name:</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-100 ml-2">{{ $userHabit->habit->name }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-600 dark:text-gray-400">Category:</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-100 ml-2">{{ $userHabit->habit->category->name }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-600 dark:text-gray-400">Frequency:</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-100 ml-2">{{ ucfirst($userHabit->habit->frequency) }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-600 dark:text-gray-400">Unit:</span>
                                    <span class="font-medium text-gray-900 dark:text-gray-100 ml-2">{{ $userHabit->habit->unit }}</span>
                                </div>
                            </div>
                            @if($userHabit->habit->description)
                                <div class="mt-3">
                                    <span class="text-gray-600 dark:text-gray-400">Description:</span>
                                    <p class="text-gray-900 dark:text-gray-100 mt-1">{{ $userHabit->habit->description }}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Editable Fields -->

                        <!-- Target Value -->
                        <div>
                            <label for="target_value" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Your Target Value *
                            </label>
                            <div class="flex items-center space-x-2">
                                <input type="number"
                                       id="target_value"
                                       name="target_value"
                                       value="{{ old('target_value', $userHabit->target_value) }}"
                                       step="0.1"
                                       min="0"
                                       class="flex-1 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-100"
                                       placeholder="e.g., 8, 30, 10000"
                                       required>
                                <span class="text-gray-500 dark:text-gray-400">{{ $userHabit->habit->unit }}</span>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Original habit target: {{ $userHabit->habit->target_value }} {{ $userHabit->habit->unit }}
                            </p>
                            @error('target_value')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Habit Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                                Habit Status
                            </label>
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <input type="radio"
                                           id="active"
                                           name="is_active"
                                           value="1"
                                           {{ old('is_active', $userHabit->is_active) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-gray-600">
                                    <label for="active" class="ml-3 text-sm text-gray-700 dark:text-gray-300">
                                        <span class="font-medium">Active</span> - Continue tracking this habit daily
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio"
                                           id="inactive"
                                           name="is_active"
                                           value="0"
                                           {{ !old('is_active', $userHabit->is_active) ? 'checked' : '' }}
                                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-gray-600">
                                    <label for="inactive" class="ml-3 text-sm text-gray-700 dark:text-gray-300">
                                        <span class="font-medium">Inactive</span> - Pause tracking (progress history preserved)
                                    </label>
                                </div>
                            </div>
                            @error('is_active')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Current Stats Display -->
                        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4">
                            <h4 class="font-medium text-blue-900 dark:text-blue-200 mb-2">📊 Current Performance</h4>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                                <div class="text-center">
                                    <div class="text-lg font-bold text-blue-600">{{ $userHabit->current_streak }}</div>
                                    <div class="text-blue-800 dark:text-blue-300">Current Streak</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-lg font-bold text-purple-600">{{ $userHabit->longest_streak }}</div>
                                    <div class="text-blue-800 dark:text-blue-300">Best Streak</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-lg font-bold text-green-600">{{ \Carbon\Carbon::parse($userHabit->started_at)->diffInDays(now()) }}</div>
                                    <div class="text-blue-800 dark:text-blue-300">Days Active</div>
                                </div>
                            </div>
                        </div>

                        <!-- Target Value Suggestions -->
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 rounded-lg p-4">
                            <h4 class="font-medium text-yellow-900 dark:text-yellow-200 mb-2">💡 Adjustment Tips</h4>
                            <div class="text-sm text-yellow-800 dark:text-yellow-300 space-y-1">
                                <p>• <strong>Too Easy?</strong> Increase your target gradually (10-20% increments)</p>
                                <p>• <strong>Too Hard?</strong> Lower your target to maintain consistency</p>
                                <p>• <strong>Sweet Spot:</strong> Aim for 70-80% completion rate for sustainable growth</p>
                                <p>• <strong>Life Changes?</strong> Adjust targets based on your current circumstances</p>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex space-x-4">
                            <button type="submit"
                                    class="flex-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Update Habit
                            </button>
                            <a href="{{ route('habits.show', $userHabit) }}"
                               class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-3 px-6 rounded-lg text-center transition duration-200">
                                Cancel
                            </a>
                        </div>

                        <!-- Danger Zone -->
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700 rounded-lg p-4">
                                <h4 class="font-medium text-red-900 dark:text-red-200 mb-2">⚠️ Danger Zone</h4>
                                <p class="text-sm text-red-800 dark:text-red-300 mb-3">
                                    Deactivating this habit will stop daily tracking, but your progress history will be preserved.
                                    You can reactivate it anytime.
                                </p>
                                <button type="button"
                                        onclick="confirmDeactivate()"
                                        class="bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200">
                                    Deactivate Habit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-adjust target value based on suggestions
            const targetInput = document.getElementById('target_value');
            const currentValue = parseFloat(targetInput.value);

            // Add quick adjustment buttons
            const adjustmentButtons = document.createElement('div');
            adjustmentButtons.className = 'flex space-x-2 mt-2';
            adjustmentButtons.innerHTML = `
                <button type="button" onclick="adjustTarget(-0.1)" class="text-xs bg-red-100 hover:bg-red-200 text-red-700 px-2 py-1 rounded">-10%</button>
                <button type="button" onclick="adjustTarget(0.1)" class="text-xs bg-green-100 hover:bg-green-200 text-green-700 px-2 py-1 rounded">+10%</button>
                <button type="button" onclick="adjustTarget(0.2)" class="text-xs bg-blue-100 hover:bg-blue-200 text-blue-700 px-2 py-1 rounded">+20%</button>
            `;

            targetInput.parentNode.appendChild(adjustmentButtons);

            // Form validation enhancement
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const targetValue = parseFloat(targetInput.value);

                if (targetValue <= 0) {
                    e.preventDefault();
                    alert('Target value must be greater than 0');
                    targetInput.focus();
                    return;
                }

                // Show loading state
                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.textContent = 'Updating...';
                submitBtn.disabled = true;
            });
        });

        function adjustTarget(percentage) {
            const targetInput = document.getElementById('target_value');
            const currentValue = parseFloat(targetInput.value) || 1;
            const newValue = Math.round((currentValue * (1 + percentage)) * 10) / 10;
            targetInput.value = newValue;

            // Add visual feedback
            targetInput.classList.add('bg-yellow-50', 'dark:bg-yellow-900/20');
            setTimeout(() => {
                targetInput.classList.remove('bg-yellow-50', 'dark:bg-yellow-900/20');
            }, 1000);
        }

        function confirmDeactivate() {
            if (confirm('Are you sure you want to deactivate this habit? Your progress history will be preserved and you can reactivate it later.')) {
                // Set inactive and submit form
                document.getElementById('inactive').checked = true;
                document.querySelector('form').submit();
            }
        }
    </script>
    @endpush
</x-app-layout>
