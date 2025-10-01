<x-app-layout>
    <!-- Create New Habit - Full Width Professional Design -->
    <div class="relative min-h-screen bg-gradient-to-br from-emerald-50 via-white to-teal-50 dark:from-gray-900 dark:via-gray-900 dark:to-emerald-900/20 theme-transition overflow-hidden">
        <!-- Background Floating Bubbles - Fast Green Theme -->
        <div class="absolute inset-0 z-0">
            <!-- Large Green Bubbles -->
            <div class="absolute top-20 left-10 w-80 h-80 bg-gradient-to-br from-emerald-200 to-teal-300 dark:from-emerald-800 dark:to-teal-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float-fast"></div>
            <div class="absolute top-40 right-10 w-72 h-72 bg-gradient-to-br from-green-200 to-emerald-300 dark:from-green-800 dark:to-emerald-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float-fast" style="animation-delay: 0.5s;"></div>
            <div class="absolute bottom-40 left-1/2 w-72 h-72 bg-gradient-to-br from-teal-200 to-cyan-300 dark:from-teal-800 dark:to-cyan-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float-fast" style="animation-delay: 1s;"></div>

            <!-- Medium Green Bubbles -->
            <div class="absolute top-1/3 left-1/4 w-64 h-64 bg-gradient-to-br from-lime-200 to-emerald-300 dark:from-lime-800 dark:to-emerald-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-60 animate-float-fast" style="animation-delay: 0.3s;"></div>
            <div class="absolute bottom-1/4 right-1/4 w-56 h-56 bg-gradient-to-br from-emerald-200 to-green-300 dark:from-emerald-800 dark:to-green-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-60 animate-float-fast" style="animation-delay: 0.8s;"></div>
            <div class="absolute top-1/2 right-1/3 w-60 h-60 bg-gradient-to-br from-teal-200 to-emerald-300 dark:from-teal-800 dark:to-emerald-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-60 animate-float-fast" style="animation-delay: 1.2s;"></div>

            <!-- Small Green Bubbles -->
            <div class="absolute top-60 right-1/4 w-40 h-40 bg-gradient-to-br from-green-200 to-teal-300 dark:from-green-800 dark:to-teal-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-lg opacity-50 animate-float-fast" style="animation-delay: 0.2s;"></div>
            <div class="absolute bottom-60 left-20 w-48 h-48 bg-gradient-to-br from-emerald-200 to-lime-300 dark:from-emerald-800 dark:to-lime-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-lg opacity-50 animate-float-fast" style="animation-delay: 0.6s;"></div>
            <div class="absolute top-1/4 left-1/2 w-36 h-36 bg-gradient-to-br from-teal-200 to-green-300 dark:from-teal-800 dark:to-green-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-lg opacity-50 animate-float-fast" style="animation-delay: 1s;"></div>
            <div class="absolute bottom-1/3 right-40 w-44 h-44 bg-gradient-to-br from-lime-200 to-teal-300 dark:from-lime-800 dark:to-teal-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-lg opacity-50 animate-float-fast" style="animation-delay: 1.4s;"></div>
            <div class="absolute top-80 left-1/3 w-52 h-52 bg-gradient-to-br from-emerald-200 to-cyan-300 dark:from-emerald-800 dark:to-cyan-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-lg opacity-50 animate-float-fast" style="animation-delay: 0.4s;"></div>
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
                            Back to Habits
                        </a>
                        <div class="hidden sm:block h-6 w-px bg-gray-300 dark:bg-gray-600"></div>
                        <div class="hidden sm:flex items-center space-x-2">
                            <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center">
                                <span class="text-lg">🎯</span>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100">Create New Habit</h2>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 bg-emerald-50 dark:bg-emerald-900/20 px-4 py-2 rounded-lg">
                        <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                        <span class="text-sm font-medium text-emerald-700 dark:text-emerald-300">Step 1 of 1</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content - Two Column Layout -->
        <div class="relative z-20 w-full px-4 sm:px-6 lg:px-8 py-8">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <!-- Left Column - Motivational Content (1/3) -->
                    <div class="lg:col-span-1 space-y-6">
                        <!-- Motivational Welcome Card -->
                        <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl p-8 text-white shadow-2xl">
                            <div class="flex items-center justify-center mb-6">
                                <div class="w-20 h-20 bg-white/20 backdrop-blur-lg rounded-2xl flex items-center justify-center shadow-lg">
                                    <span class="text-4xl">🎯</span>
                                </div>
                            </div>
                            <h3 class="text-2xl font-bold mb-4 text-center">Start Your Journey</h3>
                            <p class="text-emerald-50 text-center leading-relaxed">Every great achievement starts with a small habit. Create your personalized wellness routine today!</p>
                            <div class="mt-6 pt-6 border-t border-white/20">
                                <div class="flex items-center justify-center space-x-2 text-emerald-50">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                    <span class="font-semibold">You're in good company!</span>
                                </div>
                            </div>
                        </div>

                        <!-- Pro Tips Section -->
                        <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-xl border border-emerald-200 dark:border-emerald-700">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-gray-900 dark:text-gray-100 text-lg">Pro Tips</h4>
                            </div>
                            <ul class="space-y-3">
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">Start with achievable goals</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">Be specific with your targets</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">Track daily for best results</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">Consistency beats perfection</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Progress Preview Cards -->
                        <div class="bg-white dark:bg-gray-800 rounded-3xl p-6 shadow-xl border border-emerald-200 dark:border-emerald-700">
                            <h4 class="font-bold text-gray-900 dark:text-gray-100 mb-4">Your Progress Awaits</h4>
                            <div class="space-y-3">
                                <div class="bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 rounded-xl p-4 border border-emerald-200 dark:border-emerald-700">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Daily Streak</span>
                                        <span class="text-2xl">🔥</span>
                                    </div>
                                    <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">0 days</div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Start building your streak today!</p>
                                </div>
                                <div class="bg-gradient-to-r from-teal-50 to-cyan-50 dark:from-teal-900/20 dark:to-cyan-900/20 rounded-xl p-4 border border-teal-200 dark:border-teal-700">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Completion Rate</span>
                                        <span class="text-2xl">📊</span>
                                    </div>
                                    <div class="text-2xl font-bold text-teal-600 dark:text-teal-400">0%</div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Track your consistency</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Form (2/3) -->
                    <div class="lg:col-span-2">
                        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-emerald-200 dark:border-emerald-700">
                            <div class="p-8 sm:p-10">
                                <div class="mb-8">
                                    <h3 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-3">Create Your Habit</h3>
                                    <p class="text-gray-600 dark:text-gray-400">Fill in the details below to create your personalized wellness routine.</p>
                                </div>

                                <form method="POST" action="{{ route('habits.store') }}" class="space-y-6">
                            @csrf

                            <!-- Habit Name -->
                            <div>
                                <label for="name" class="block text-sm font-bold text-gray-900 dark:text-gray-100 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Habit Name *
                                    </span>
                                </label>
                                <input type="text"
                                       id="name"
                                       name="name"
                                       value="{{ old('name') }}"
                                       class="w-full px-5 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-gray-50 dark:bg-gray-700 dark:text-gray-100 text-base font-medium transition-all placeholder:text-gray-400"
                                       placeholder="e.g., Drink water, Morning exercise, Read books"
                                       required>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div>
                                <label for="category_id" class="block text-sm font-bold text-gray-900 dark:text-gray-100 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                                        </svg>
                                        Category *
                                    </span>
                                </label>
                                <select id="category_id"
                                        name="category_id"
                                        class="w-full px-5 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-gray-50 dark:bg-gray-700 dark:text-gray-100 text-base font-medium transition-all"
                                    required>
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-bold text-gray-900 dark:text-gray-100 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
                                    </svg>
                                    Description (Optional)
                                </span>
                            </label>
                            <textarea id="description"
                                      name="description"
                                      rows="4"
                                      class="w-full px-5 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-gray-50 dark:bg-gray-700 dark:text-gray-100 text-base transition-all placeholder:text-gray-400 resize-none"
                                      placeholder="Describe what this habit involves and why it's important to you">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Frequency -->
                        <div>
                            <label for="frequency" class="block text-sm font-bold text-gray-900 dark:text-gray-100 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                                    </svg>
                                    Frequency *
                                </span>
                            </label>
                            <select id="frequency"
                                    name="frequency"
                                    class="w-full px-5 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-gray-50 dark:bg-gray-700 dark:text-gray-100 text-base font-medium transition-all"
                                    required>
                                <option value="">Select frequency</option>
                                <option value="daily" {{ old('frequency') == 'daily' ? 'selected' : '' }}>Daily</option>
                                <option value="weekly" {{ old('frequency') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                <option value="monthly" {{ old('frequency') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                            </select>
                            @error('frequency')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Target Value and Unit -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="target_value" class="block text-sm font-bold text-gray-900 dark:text-gray-100 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                                        </svg>
                                        Target Value *
                                    </span>
                                </label>
                                <input type="number"
                                       id="target_value"
                                       name="target_value"
                                       value="{{ old('target_value') }}"
                                       step="0.1"
                                       min="0"
                                       class="w-full px-5 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-gray-50 dark:bg-gray-700 dark:text-gray-100 text-base font-medium transition-all placeholder:text-gray-400"
                                       placeholder="e.g., 8, 30, 10000"
                                       required>
                                @error('target_value')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="unit" class="block text-sm font-bold text-gray-900 dark:text-gray-100 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                                        </svg>
                                        Unit *
                                    </span>
                                </label>
                                <input type="text"
                                       id="unit"
                                       name="unit"
                                       value="{{ old('unit') }}"
                                       class="w-full px-5 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-gray-50 dark:bg-gray-700 dark:text-gray-100 text-base font-medium transition-all placeholder:text-gray-400"
                                       placeholder="e.g., glasses, minutes, steps"
                                       required>
                                @error('unit')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Popular Habit Examples -->
                        <div class="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 rounded-2xl p-6 border-2 border-emerald-100 dark:border-emerald-800">
                            <div class="flex items-center mb-4">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                </div>
                                <h4 class="font-bold text-gray-900 dark:text-gray-100">Quick Start Templates</h4>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Click any example to auto-fill the form</p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div class="habit-example group cursor-pointer bg-white dark:bg-gray-700 hover:bg-emerald-100 dark:hover:bg-emerald-800/30 p-4 rounded-xl border-2 border-transparent hover:border-emerald-300 dark:hover:border-emerald-600 transition-all duration-200"
                                     data-name="Drink Water"
                                     data-category="Nutrition"
                                     data-target="8"
                                     data-unit="glasses"
                                     data-description="Stay hydrated throughout the day">
                                    <div class="flex items-center">
                                        <div class="text-2xl mr-3">💧</div>
                                        <div>
                                            <div class="font-semibold text-gray-900 dark:text-gray-100 group-hover:text-emerald-700 dark:group-hover:text-emerald-300">Drink Water</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">8 glasses daily</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="habit-example group cursor-pointer bg-white dark:bg-gray-700 hover:bg-emerald-100 dark:hover:bg-emerald-800/30 p-4 rounded-xl border-2 border-transparent hover:border-emerald-300 dark:hover:border-emerald-600 transition-all duration-200"
                                     data-name="Morning Exercise"
                                     data-category="Fitness"
                                     data-target="30"
                                     data-unit="minutes"
                                     data-description="Start the day with physical activity">
                                    <div class="flex items-center">
                                        <div class="text-2xl mr-3">💪</div>
                                        <div>
                                            <div class="font-semibold text-gray-900 dark:text-gray-100 group-hover:text-emerald-700 dark:group-hover:text-emerald-300">Exercise</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">30 minutes daily</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="habit-example group cursor-pointer bg-white dark:bg-gray-700 hover:bg-emerald-100 dark:hover:bg-emerald-800/30 p-4 rounded-xl border-2 border-transparent hover:border-emerald-300 dark:hover:border-emerald-600 transition-all duration-200"
                                     data-name="Read Books"
                                     data-category="Learning"
                                     data-target="20"
                                     data-unit="pages"
                                     data-description="Read to expand knowledge and relax">
                                    <div class="flex items-center">
                                        <div class="text-2xl mr-3">📚</div>
                                        <div>
                                            <div class="font-semibold text-gray-900 dark:text-gray-100 group-hover:text-emerald-700 dark:group-hover:text-emerald-300">Read Books</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">20 pages daily</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="habit-example group cursor-pointer bg-white dark:bg-gray-700 hover:bg-teal-100 dark:hover:bg-teal-800/30 p-4 rounded-xl border-2 border-transparent hover:border-teal-300 dark:hover:border-teal-600 transition-all duration-200"
                                     data-name="Meditation"
                                     data-category="Mental Health"
                                     data-target="10"
                                     data-unit="minutes"
                                     data-description="Practice mindfulness and reduce stress">
                                    <div class="flex items-center">
                                        <div class="text-2xl mr-3">🧘</div>
                                        <div>
                                            <div class="font-semibold text-gray-900 dark:text-gray-100 group-hover:text-teal-700 dark:group-hover:text-teal-300">Meditation</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">10 minutes daily</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="habit-example group cursor-pointer bg-white dark:bg-gray-700 hover:bg-emerald-100 dark:hover:bg-emerald-800/30 p-4 rounded-xl border-2 border-transparent hover:border-emerald-300 dark:hover:border-emerald-600 transition-all duration-200"
                                     data-name="Walk Steps"
                                     data-category="Fitness"
                                     data-target="10000"
                                     data-unit="steps"
                                     data-description="Maintain daily physical activity">
                                    <div class="flex items-center">
                                        <div class="text-2xl mr-3">🚶</div>
                                        <div>
                                            <div class="font-semibold text-gray-900 dark:text-gray-100 group-hover:text-emerald-700 dark:group-hover:text-emerald-300">Walk Steps</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">10,000 steps daily</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="habit-example group cursor-pointer bg-white dark:bg-gray-700 hover:bg-teal-100 dark:hover:bg-teal-800/30 p-4 rounded-xl border-2 border-transparent hover:border-teal-300 dark:hover:border-teal-600 transition-all duration-200"
                                     data-name="Sleep Quality"
                                     data-category="Sleep"
                                     data-target="8"
                                     data-unit="hours"
                                     data-description="Get adequate rest for recovery">
                                    <div class="flex items-center">
                                        <div class="text-2xl mr-3">😴</div>
                                        <div>
                                            <div class="font-semibold text-gray-900 dark:text-gray-100 group-hover:text-teal-700 dark:group-hover:text-teal-300">Sleep Quality</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">8 hours daily</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-4">
                            <button type="submit"
                                    class="flex-1 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    Create Habit
                                </span>
                            </button>
                            <a href="{{ route('habits.index') }}"
                               class="flex-1 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 font-bold py-4 px-6 rounded-xl text-center transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                Cancel
                            </a>
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

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Category to ID mapping - you might want to get this from the server
            const categoryMapping = {
                @foreach($categories as $category)
                    '{{ $category->name }}': {{ $category->id }},
                @endforeach
            };

            // Handle habit example clicks
            document.querySelectorAll('.habit-example').forEach(example => {
                example.addEventListener('click', function() {
                    const name = this.dataset.name;
                    const category = this.dataset.category;
                    const target = this.dataset.target;
                    const unit = this.dataset.unit;
                    const description = this.dataset.description;

                    // Fill form fields
                    document.getElementById('name').value = name;
                    document.getElementById('target_value').value = target;
                    document.getElementById('unit').value = unit;
                    document.getElementById('description').value = description;
                    document.getElementById('frequency').value = 'daily';

                    // Set category if exists
                    if (categoryMapping[category]) {
                        document.getElementById('category_id').value = categoryMapping[category];
                    }

                    // Add visual feedback
                    this.classList.add('bg-blue-200', 'dark:bg-blue-700');
                    setTimeout(() => {
                        this.classList.remove('bg-blue-200', 'dark:bg-blue-700');
                    }, 1000);
                });
            });

            // Auto-suggest units based on common patterns
            const unitSuggestions = {
                'water': 'glasses',
                'exercise': 'minutes',
                'workout': 'minutes',
                'run': 'minutes',
                'walk': 'steps',
                'read': 'pages',
                'book': 'pages',
                'meditate': 'minutes',
                'meditation': 'minutes',
                'sleep': 'hours',
                'study': 'minutes',
                'practice': 'minutes'
            };

            document.getElementById('name').addEventListener('input', function() {
                const habitName = this.value.toLowerCase();
                const unitField = document.getElementById('unit');

                if (!unitField.value) { // Only suggest if unit is empty
                    for (const [keyword, unit] of Object.entries(unitSuggestions)) {
                        if (habitName.includes(keyword)) {
                            unitField.value = unit;
                            unitField.classList.add('bg-yellow-50', 'dark:bg-yellow-900/20');
                            setTimeout(() => {
                                unitField.classList.remove('bg-yellow-50', 'dark:bg-yellow-900/20');
                            }, 2000);
                            break;
                        }
                    }
                }
            });

            // Form validation enhancement
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const targetValue = parseFloat(document.getElementById('target_value').value);

                if (targetValue <= 0) {
                    e.preventDefault();
                    alert('Target value must be greater than 0');
                    document.getElementById('target_value').focus();
                    return;
                }

                // Show loading state
                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.textContent = 'Creating...';
                submitBtn.disabled = true;
            });
        });
    </script>
    @endpush
</x-app-layout>
