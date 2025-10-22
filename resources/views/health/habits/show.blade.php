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
                        <a href="{{ route('habits.index') }}" class="inline-flex items-center text-gray-600 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 font-medium transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to My Habits
                        </a>
                        <div class="hidden sm:block h-6 w-px bg-gray-300 dark:bg-gray-600"></div>
                        <div class="hidden sm:flex items-center space-x-2">
                            <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center">
                                <span class="text-lg">
                                    {{ $userHabit->habit->category->name === 'Fitness' ? '💪' : ($userHabit->habit->category->name === 'Mental Health' ? '🧠' : ($userHabit->habit->category->name === 'Nutrition' ? '🥗' : ($userHabit->habit->category->name === 'Sleep' ? '😴' : ($userHabit->habit->category->name === 'Productivity' ? '⚡' : ($userHabit->habit->category->name === 'Learning' ? '📚' : ($userHabit->habit->category->name === 'Social' ? '👥' : '⭐')))))) }}
                                </span>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ $userHabit->habit->name }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('habits.edit', $userHabit) }}" class="inline-flex items-center bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white px-4 py-2 rounded-xl font-semibold text-sm transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content - Two Column Layout -->
        <div class="relative z-20 pb-12 pt-8">
            <div class="w-full px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto">
                    <div class="flex flex-col lg:flex-row gap-6">

                        <!-- Left Column (1/3) - Habit Info & Quick Stats -->
                        <div class="lg:w-1/3 space-y-6">
                            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-emerald-100 dark:border-emerald-700 overflow-hidden sticky top-24">
                                <div class="bg-gradient-to-r from-emerald-500 to-teal-600 p-6 text-white">
                                    <div class="w-16 h-16 bg-white/20 backdrop-blur-lg rounded-xl flex items-center justify-center mb-4">
                                        <span class="text-4xl">
                                            {{ $userHabit->habit->category->name === 'Fitness' ? '💪' : ($userHabit->habit->category->name === 'Mental Health' ? '🧠' : ($userHabit->habit->category->name === 'Nutrition' ? '🥗' : ($userHabit->habit->category->name === 'Sleep' ? '😴' : ($userHabit->habit->category->name === 'Productivity' ? '⚡' : ($userHabit->habit->category->name === 'Learning' ? '📚' : ($userHabit->habit->category->name === 'Social' ? '👥' : '⭐')))))) }}
                                        </span>
                                    </div>
                                    <h3 class="text-2xl font-bold mb-2">{{ $userHabit->habit->name }}</h3>
                                    <p class="text-emerald-100 text-sm flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M7 7h10v3l4-4-4-4v3H5v6h2V7zm10 10H7v-3l-4 4 4 4v-3h12v-6h-2v4z"/>
                                        </svg>
                                        {{ $userHabit->habit->category->name }}
                                    </p>
                                </div>
                                <div class="p-6 space-y-4">
                                    @if($userHabit->habit->description)
                                        <div>
                                            <h4 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2">Description</h4>
                                            <p class="text-sm text-gray-700 dark:text-gray-300">{{ $userHabit->habit->description }}</p>
                                        </div>
                                    @endif

                                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                        <div class="flex items-center justify-between mb-3">
                                            <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Daily Target</span>
                                            <span class="text-lg font-bold text-emerald-600 dark:text-emerald-400">{{ $userHabit->target_value }} {{ $userHabit->habit->unit }}</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Started</span>
                                            <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ \Carbon\Carbon::parse($userHabit->started_at)->format('M j, Y') }}</span>
                                        </div>
                                    </div>

                                    <!-- Quick Actions -->
                                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700 space-y-2">
                                        <button onclick="confirmDeactivate()" class="w-full bg-gradient-to-r from-red-600 to-orange-600 hover:from-red-700 hover:to-orange-700 text-white font-bold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-md flex items-center justify-center space-x-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            <span>Deactivate Habit</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column (2/3) - Stats & Progress -->
                        <div class="lg:w-2/3 space-y-6">
                            <!-- Key Stats Grid -->
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-emerald-100 dark:border-emerald-700 p-4 text-center hover:shadow-xl transition-all duration-300">
                                    <div class="text-3xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent mb-1">{{ $stats['current_streak'] }}</div>
                                    <div class="text-xs text-gray-600 dark:text-gray-400 font-medium">🔥 Current Streak</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-500 mt-1">days</div>
                                </div>
                                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-amber-100 dark:border-amber-700 p-4 text-center hover:shadow-xl transition-all duration-300">
                                    <div class="text-3xl font-bold bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent mb-1">{{ $userHabit->longest_streak }}</div>
                                    <div class="text-xs text-gray-600 dark:text-gray-400 font-medium">🏆 Best Streak</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-500 mt-1">days</div>
                                </div>
                                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-teal-100 dark:border-teal-700 p-4 text-center hover:shadow-xl transition-all duration-300">
                                    <div class="text-3xl font-bold bg-gradient-to-r from-teal-600 to-cyan-600 bg-clip-text text-transparent mb-1">{{ $stats['completion_rate'] }}%</div>
                                    <div class="text-xs text-gray-600 dark:text-gray-400 font-medium">✅ Success Rate</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-500 mt-1">last 30 days</div>
                                </div>
                                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-purple-100 dark:border-purple-700 p-4 text-center hover:shadow-xl transition-all duration-300">
                                    <div class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-1">{{ $stats['total_completed'] }}</div>
                                    <div class="text-xs text-gray-600 dark:text-gray-400 font-medium">📊 Total Logs</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-500 mt-1">completions</div>
                                </div>
                            </div>

                            <!-- Additional Stats -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-emerald-100 dark:border-emerald-700 p-5">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="text-sm text-gray-600 dark:text-gray-400 font-medium mb-1">Average Performance</div>
                                            <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">{{ number_format($stats['average_value'], 1) }} {{ $userHabit->habit->unit }}</div>
                                        </div>
                                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-100 to-teal-100 dark:from-emerald-900/30 dark:to-teal-900/30 rounded-xl flex items-center justify-center">
                                            <span class="text-2xl">📈</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-emerald-100 dark:border-emerald-700 p-5">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="text-sm text-gray-600 dark:text-gray-400 font-medium mb-1">Days Active</div>
                                            <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">{{ \Carbon\Carbon::parse($userHabit->started_at)->diffInDays(now()) }}</div>
                                        </div>
                                        <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-indigo-100 dark:from-blue-900/30 dark:to-indigo-900/30 rounded-xl flex items-center justify-center">
                                            <span class="text-2xl">📅</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Recent Progress Section -->
                            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-emerald-100 dark:border-emerald-700 overflow-hidden">
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
                                                            <div class="text-sm text-gray-600 dark:text-gray-400">
                                                                {{ $progress->value }} {{ $userHabit->habit->unit }} / {{ $userHabit->target_value }} {{ $userHabit->habit->unit }}
                                                                ({{ number_format($progressPercentage, 1) }}%)
                                                            </div>
                                                            @if($progress->notes)
                                                                <div class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                                                    💭 {{ $progress->notes }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="w-32 bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                                            <div class="h-2.5 rounded-full {{ $progress->completed ? 'bg-green-600' : 'bg-yellow-500' }}" style="width: {{ min($progressPercentage, 100) }}%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-12">
                                            <div class="text-6xl mb-4">📊</div>
                                            <p class="text-gray-500 dark:text-gray-400">No progress recorded yet</p>
                                            <p class="text-sm text-gray-400 dark:text-gray-500">Start logging your habit to see progress here!</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Progress Chart Placeholder -->
                            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-emerald-100 dark:border-emerald-700 overflow-hidden">
                                <div class="p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-6">Progress Chart</h3>
                                    <div class="text-center py-12">
                                        <div class="text-6xl mb-4">📈</div>
                                        <p class="text-gray-500 dark:text-gray-400">Chart visualization coming soon!</p>
                                        <p class="text-sm text-gray-400 dark:text-gray-500">Track your habit progress over time with visual charts</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Deactivate Confirmation Modal -->
    <div id="confirmDeactivateModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-md w-full mx-4">
            <div class="p-6">
                <div class="flex items-center justify-center w-16 h-16 bg-red-100 dark:bg-red-900/30 rounded-full mx-auto mb-4">
                    <svg class="w-8 h-8 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 text-center mb-2">Deactivate Habit?</h3>
                <p class="text-gray-600 dark:text-gray-400 text-center mb-6">
                    Are you sure you want to deactivate this habit? Your progress will be saved, but the habit will be removed from your active list.
                </p>
                <div class="flex gap-3">
                    <button onclick="closeConfirmModal()" class="flex-1 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-bold py-3 px-4 rounded-xl transition-all">
                        Cancel
                    </button>
                    <form action="{{ route('habits.destroy', $userHabit) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-xl transition-all">
                            Yes, Deactivate
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDeactivate() {
            document.getElementById('confirmDeactivateModal').classList.remove('hidden');
        }

        function closeConfirmModal() {
            document.getElementById('confirmDeactivateModal').classList.add('hidden');
        }

        document.getElementById('confirmDeactivateModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeConfirmModal();
            }
        });
    </script>
</x-app-layout>
