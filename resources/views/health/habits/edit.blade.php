<x-app-layout>
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
                        <a href="{{ route('habits.show', $userHabit) }}" class="inline-flex items-center text-gray-600 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 font-medium transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to Habit Details
                        </a>
                        <div class="hidden sm:block h-6 w-px bg-gray-300 dark:bg-gray-600"></div>
                        <h2 class="hidden sm:block text-lg font-bold text-gray-900 dark:text-gray-100">Edit Habit Settings</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content - Two Column Layout -->
        <div class="relative z-20 pb-12 pt-8">
            <div class="w-full px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto">
                    <div class="flex flex-col lg:flex-row gap-6">

                        <!-- Left Column (1/3) - Habit Info & Tips -->
                        <div class="lg:w-1/3 space-y-6">

                            <!-- Habit Overview Card -->
                            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-emerald-100 dark:border-emerald-700 overflow-hidden sticky top-24">
                                <div class="bg-gradient-to-r from-emerald-500 to-teal-600 p-6 text-white">
                                    <div class="w-16 h-16 bg-white/20 backdrop-blur-lg rounded-xl flex items-center justify-center mb-4">
                                        <span class="text-4xl">⚙️</span>
                                    </div>
                                    <h3 class="text-2xl font-bold mb-2">{{ $userHabit->habit->name }}</h3>
                                    <p class="text-emerald-100 text-sm">{{ $userHabit->habit->category->name }}</p>
                                </div>

                                <div class="p-6 space-y-4">
                                    <div>
                                        <h4 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2">Habit Details</h4>
                                        <div class="space-y-2 text-sm">
                                            <div class="flex justify-between">
                                                <span class="text-gray-600 dark:text-gray-400">Frequency:</span>
                                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ ucfirst($userHabit->habit->frequency) }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600 dark:text-gray-400">Unit:</span>
                                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ $userHabit->habit->unit }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600 dark:text-gray-400">Original Target:</span>
                                                <span class="font-medium text-gray-900 dark:text-gray-100">{{ $userHabit->habit->target_value }} {{ $userHabit->habit->unit }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    @if($userHabit->habit->description)
                                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                            <h4 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2">Description</h4>
                                            <p class="text-sm text-gray-700 dark:text-gray-300">{{ $userHabit->habit->description }}</p>
                                        </div>
                                    @endif

                                    <!-- Current Stats -->
                                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                        <h4 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-3">Current Stats</h4>
                                        <div class="grid grid-cols-3 gap-2">
                                            <div class="text-center p-3 bg-emerald-50 dark:bg-emerald-900/20 rounded-lg">
                                                <div class="text-xl font-bold text-emerald-600 dark:text-emerald-400">{{ $userHabit->current_streak }}</div>
                                                <div class="text-xs text-gray-600 dark:text-gray-400">Streak</div>
                                            </div>
                                            <div class="text-center p-3 bg-amber-50 dark:bg-amber-900/20 rounded-lg">
                                                <div class="text-xl font-bold text-amber-600 dark:text-amber-400">{{ $userHabit->longest_streak }}</div>
                                                <div class="text-xs text-gray-600 dark:text-gray-400">Best</div>
                                            </div>
                                            <div class="text-center p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                                                <div class="text-xl font-bold text-blue-600 dark:text-blue-400">{{ \Carbon\Carbon::parse($userHabit->started_at)->diffInDays(now()) }}</div>
                                                <div class="text-xs text-gray-600 dark:text-gray-400">Days</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tips Card -->
                                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                        <div class="bg-gradient-to-br from-yellow-50 to-amber-50 dark:from-yellow-900/20 dark:to-amber-900/20 rounded-xl p-4 border border-yellow-200 dark:border-yellow-700">
                                            <h4 class="text-sm font-bold text-yellow-900 dark:text-yellow-200 mb-2 flex items-center">
                                                <span class="text-lg mr-2">💡</span>
                                                Adjustment Tips
                                            </h4>
                                            <ul class="text-xs text-yellow-800 dark:text-yellow-300 space-y-1.5">
                                                <li>• <strong>Too Easy?</strong> Increase target by 10-20%</li>
                                                <li>• <strong>Too Hard?</strong> Lower to maintain consistency</li>
                                                <li>• <strong>Sweet Spot:</strong> 70-80% completion rate</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Right Column (2/3) - Edit Form -->
                        <div class="lg:w-2/3">
                            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-emerald-100 dark:border-emerald-700 overflow-hidden">
                                <div class="p-8">
                                    <form method="POST" action="{{ route('habits.update', $userHabit) }}" class="space-y-6">
                                        @csrf
                                        @method('PUT')

                                        <!-- Target Value Section -->
                                        <div class="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 rounded-xl p-6 border border-emerald-200 dark:border-emerald-700">
                                            <label for="target_value" class="block text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">
                                                🎯 Your Target Value
                                            </label>
                                            <div class="flex items-center space-x-3">
                                                <input type="number"
                                                       id="target_value"
                                                       name="target_value"
                                                       value="{{ old('target_value', $userHabit->target_value) }}"
                                                       step="0.1"
                                                       min="0"
                                                       class="flex-1 px-4 py-3 border-2 border-emerald-300 dark:border-emerald-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 dark:bg-gray-700 dark:text-gray-100 text-lg font-semibold"
                                                       placeholder="e.g., 8, 30, 10000"
                                                       required>
                                                <span class="text-lg font-semibold text-emerald-600 dark:text-emerald-400 bg-white dark:bg-gray-700 px-4 py-3 rounded-xl border-2 border-emerald-300 dark:border-emerald-600">{{ $userHabit->habit->unit }}</span>
                                            </div>

                                            <!-- Quick Adjustment Buttons -->
                                            <div class="flex space-x-2 mt-4">
                                                <button type="button" onclick="adjustTarget(-0.1)" class="flex-1 bg-red-100 hover:bg-red-200 dark:bg-red-900/30 dark:hover:bg-red-900/50 text-red-700 dark:text-red-300 px-3 py-2 rounded-lg font-medium text-sm transition-all">
                                                    -10%
                                                </button>
                                                <button type="button" onclick="adjustTarget(0.1)" class="flex-1 bg-emerald-100 hover:bg-emerald-200 dark:bg-emerald-900/30 dark:hover:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 px-3 py-2 rounded-lg font-medium text-sm transition-all">
                                                    +10%
                                                </button>
                                                <button type="button" onclick="adjustTarget(0.2)" class="flex-1 bg-blue-100 hover:bg-blue-200 dark:bg-blue-900/30 dark:hover:bg-blue-900/50 text-blue-700 dark:text-blue-300 px-3 py-2 rounded-lg font-medium text-sm transition-all">
                                                    +20%
                                                </button>
                                            </div>

                                            @error('target_value')
                                                <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                    </svg>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>

                                        <!-- Habit Status Section -->
                                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-6 border border-gray-200 dark:border-gray-600">
                                            <label class="block text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">
                                                📊 Habit Status
                                            </label>
                                            <div class="space-y-3">
                                                <label class="flex items-center p-4 border-2 rounded-xl cursor-pointer transition-all {{ old('is_active', $userHabit->is_active) ? 'border-emerald-500 bg-emerald-50 dark:bg-emerald-900/20' : 'border-gray-300 dark:border-gray-600 hover:border-emerald-300 dark:hover:border-emerald-700' }}">
                                                    <input type="radio"
                                                           id="active"
                                                           name="is_active"
                                                           value="1"
                                                           {{ old('is_active', $userHabit->is_active) ? 'checked' : '' }}
                                                           class="h-5 w-5 text-emerald-600 focus:ring-emerald-500 border-gray-300">
                                                    <div class="ml-4 flex-1">
                                                        <div class="font-bold text-gray-900 dark:text-gray-100 flex items-center">
                                                            <span class="text-xl mr-2">✅</span>
                                                            Active
                                                        </div>
                                                        <p class="text-sm text-gray-600 dark:text-gray-400">Continue tracking this habit daily</p>
                                                    </div>
                                                </label>

                                                <label class="flex items-center p-4 border-2 rounded-xl cursor-pointer transition-all {{ !old('is_active', $userHabit->is_active) ? 'border-amber-500 bg-amber-50 dark:bg-amber-900/20' : 'border-gray-300 dark:border-gray-600 hover:border-amber-300 dark:hover:border-amber-700' }}">
                                                    <input type="radio"
                                                           id="inactive"
                                                           name="is_active"
                                                           value="0"
                                                           {{ !old('is_active', $userHabit->is_active) ? 'checked' : '' }}
                                                           class="h-5 w-5 text-amber-600 focus:ring-amber-500 border-gray-300">
                                                    <div class="ml-4 flex-1">
                                                        <div class="font-bold text-gray-900 dark:text-gray-100 flex items-center">
                                                            <span class="text-xl mr-2">⏸️</span>
                                                            Inactive
                                                        </div>
                                                        <p class="text-sm text-gray-600 dark:text-gray-400">Pause tracking (progress history preserved)</p>
                                                    </div>
                                                </label>
                                            </div>
                                            @error('is_active')
                                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="flex flex-col sm:flex-row gap-3 pt-4">
                                            <button type="submit"
                                                    class="flex-1 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center justify-center space-x-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span>Update Habit</span>
                                            </button>
                                            <a href="{{ route('habits.show', $userHabit) }}"
                                               class="flex-1 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-bold py-4 px-6 rounded-xl text-center transition-all flex items-center justify-center space-x-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                                <span>Cancel</span>
                                            </a>
                                        </div>

                                        <!-- Danger Zone -->
                                        <div class="border-t-2 border-gray-200 dark:border-gray-700 pt-6 mt-6">
                                            <div class="bg-gradient-to-br from-red-50 to-orange-50 dark:from-red-900/20 dark:to-orange-900/20 border-2 border-red-200 dark:border-red-700 rounded-xl p-6">
                                                <h4 class="font-bold text-red-900 dark:text-red-200 mb-2 flex items-center text-lg">
                                                    <span class="text-2xl mr-2">⚠️</span>
                                                    Danger Zone
                                                </h4>
                                                <p class="text-sm text-red-800 dark:text-red-300 mb-4">
                                                    Deactivating this habit will stop daily tracking, but your progress history will be preserved.
                                                    You can reactivate it anytime.
                                                </p>
                                                <button type="button"
                                                        onclick="confirmDeactivate()"
                                                        class="bg-gradient-to-r from-red-600 to-orange-600 hover:from-red-700 hover:to-orange-700 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-md flex items-center space-x-2">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    <span>Deactivate Habit</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        function adjustTarget(percentage) {
            const targetInput = document.getElementById('target_value');
            const currentValue = parseFloat(targetInput.value) || 1;
            const newValue = Math.round((currentValue * (1 + percentage)) * 10) / 10;
            targetInput.value = newValue;

            // Add visual feedback
            targetInput.classList.add('ring-2', 'ring-yellow-400', 'dark:ring-yellow-500');
            setTimeout(() => {
                targetInput.classList.remove('ring-2', 'ring-yellow-400', 'dark:ring-yellow-500');
            }, 1000);
        }

        function confirmDeactivate() {
            if (confirm('Are you sure you want to deactivate this habit? Your progress history will be preserved and you can reactivate it later.')) {
                document.getElementById('inactive').checked = true;
                document.querySelector('form').submit();
            }
        }

        // Form validation enhancement
        document.querySelector('form').addEventListener('submit', function(e) {
            const targetValue = parseFloat(document.getElementById('target_value').value);

            if (targetValue <= 0) {
                e.preventDefault();
                alert('Target value must be greater than 0');
                document.getElementById('target_value').focus();
                return;
            }

            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalContent = submitBtn.innerHTML;
            submitBtn.innerHTML = `
                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Updating...</span>
            `;
            submitBtn.disabled = true;
        });
    </script>
</x-app-layout>
