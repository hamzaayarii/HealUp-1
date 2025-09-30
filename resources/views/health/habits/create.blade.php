<x-app-layout>
    <!-- Create New Habit Hero Section -->
    <div class="relative min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-900 dark:to-blue-900/20 theme-transition overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-20 left-10 w-72 h-72 bg-gradient-to-br from-blue-200 to-purple-300 dark:from-blue-800 dark:to-purple-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float"></div>
            <div class="absolute top-40 right-10 w-72 h-72 bg-gradient-to-br from-purple-200 to-indigo-300 dark:from-purple-800 dark:to-indigo-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-40 left-1/2 w-72 h-72 bg-gradient-to-br from-indigo-200 to-blue-300 dark:from-indigo-800 dark:to-blue-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float" style="animation-delay: 4s;"></div>
        </div>

        <!-- Header Section -->
        <div class="relative z-20 pt-20 pb-10">
            <div class="max-w-4xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center space-x-2 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 px-6 py-3 rounded-full text-sm font-medium mb-6 theme-transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        <span>Create New Wellness Habit</span>
                    </div>

                    <h1 class="text-4xl lg:text-5xl font-bold mb-6">
                        <span class="bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-400 dark:to-purple-400 bg-clip-text text-transparent">Create Your</span><br>
                        <span class="text-gray-900 dark:text-gray-100 theme-transition">New Habit</span>
                    </h1>

                    <p class="text-xl text-gray-600 dark:text-gray-300 leading-relaxed mb-8 max-w-2xl mx-auto theme-transition">
                        Define a new wellness habit to track your progress and build consistency in your daily routine.
                    </p>

                    <!-- Back Button -->
                    <div class="mb-8">
                        <a href="{{ route('habits.index') }}"
                           class="inline-flex items-center bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 text-blue-700 dark:text-blue-300 px-6 py-3 rounded-xl font-semibold transition-all duration-300 border-2 border-blue-200 dark:border-blue-700 hover:border-blue-300 dark:hover:border-blue-600 theme-transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to Habits
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="relative z-20 pb-20">
            <div class="max-w-2xl mx-auto px-6 lg:px-8">
                <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 theme-transition">
                    <div class="p-10">
                        <div class="text-center mb-10">
                            <div class="w-20 h-20 bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                                <div class="text-3xl">🎯</div>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-3">Habit Details</h3>
                            <p class="text-gray-600 dark:text-gray-400">Fill in the information below to create your personalized habit.</p>
                        </div>

                        <form method="POST" action="{{ route('habits.store') }}" class="space-y-8">
                            @csrf

                            <!-- Habit Name -->
                            <div class="bg-gradient-to-r from-blue-50 to-purple-50 dark:from-blue-900/20 dark:to-purple-900/20 rounded-2xl p-6 theme-transition">
                                <label for="name" class="block text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Habit Name *
                                    </span>
                                </label>
                                <input type="text"
                                       id="name"
                                       name="name"
                                       value="{{ old('name') }}"
                                       class="w-full px-4 py-4 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700 dark:text-gray-100 text-lg transition-all theme-transition"
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
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-2xl p-6 theme-transition">
                                <label for="category_id" class="block text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                                        </svg>
                                        Category *
                                    </span>
                                </label>
                                <select id="category_id"
                                        name="category_id"
                                        class="w-full px-4 py-4 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 bg-white dark:bg-gray-700 dark:text-gray-100 text-lg transition-all theme-transition"
                                    required>
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Description
                            </label>
                            <textarea id="description"
                                      name="description"
                                      rows="3"
                                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-100"
                                      placeholder="Describe what this habit involves and why it's important to you">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Frequency -->
                        <div>
                            <label for="frequency" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Frequency *
                            </label>
                            <select id="frequency"
                                    name="frequency"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-100"
                                    required>
                                <option value="">Select frequency</option>
                                <option value="daily" {{ old('frequency') == 'daily' ? 'selected' : '' }}>Daily</option>
                                <option value="weekly" {{ old('frequency') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                <option value="monthly" {{ old('frequency') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                            </select>
                            @error('frequency')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Target Value and Unit -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="target_value" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Target Value *
                                </label>
                                <input type="number"
                                       id="target_value"
                                       name="target_value"
                                       value="{{ old('target_value') }}"
                                       step="0.1"
                                       min="0"
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-100"
                                       placeholder="e.g., 8, 30, 10000"
                                       required>
                                @error('target_value')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="unit" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Unit *
                                </label>
                                <input type="text"
                                       id="unit"
                                       name="unit"
                                       value="{{ old('unit') }}"
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-100"
                                       placeholder="e.g., glasses, minutes, steps"
                                       required>
                                @error('unit')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Popular Habit Examples -->
                        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4">
                            <h4 class="font-medium text-blue-900 dark:text-blue-200 mb-2">💡 Popular Habit Examples</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm text-blue-800 dark:text-blue-300">
                                <div class="habit-example cursor-pointer hover:bg-blue-100 dark:hover:bg-blue-800/30 p-2 rounded"
                                     data-name="Drink Water"
                                     data-category="Nutrition"
                                     data-target="8"
                                     data-unit="glasses"
                                     data-description="Stay hydrated throughout the day">
                                    💧 Drink 8 glasses of water daily
                                </div>
                                <div class="habit-example cursor-pointer hover:bg-blue-100 dark:hover:bg-blue-800/30 p-2 rounded"
                                     data-name="Morning Exercise"
                                     data-category="Fitness"
                                     data-target="30"
                                     data-unit="minutes"
                                     data-description="Start the day with physical activity">
                                    💪 Exercise for 30 minutes daily
                                </div>
                                <div class="habit-example cursor-pointer hover:bg-blue-100 dark:hover:bg-blue-800/30 p-2 rounded"
                                     data-name="Read Books"
                                     data-category="Learning"
                                     data-target="20"
                                     data-unit="pages"
                                     data-description="Read to expand knowledge and relax">
                                    📚 Read 20 pages daily
                                </div>
                                <div class="habit-example cursor-pointer hover:bg-blue-100 dark:hover:bg-blue-800/30 p-2 rounded"
                                     data-name="Meditation"
                                     data-category="Mental Health"
                                     data-target="10"
                                     data-unit="minutes"
                                     data-description="Practice mindfulness and reduce stress">
                                    🧘 Meditate for 10 minutes daily
                                </div>
                                <div class="habit-example cursor-pointer hover:bg-blue-100 dark:hover:bg-blue-800/30 p-2 rounded"
                                     data-name="Walk Steps"
                                     data-category="Fitness"
                                     data-target="10000"
                                     data-unit="steps"
                                     data-description="Maintain daily physical activity">
                                    🚶 Walk 10,000 steps daily
                                </div>
                                <div class="habit-example cursor-pointer hover:bg-blue-100 dark:hover:bg-blue-800/30 p-2 rounded"
                                     data-name="Sleep Quality"
                                     data-category="Sleep"
                                     data-target="8"
                                     data-unit="hours"
                                     data-description="Get adequate rest for recovery">
                                    😴 Sleep 8 hours daily
                                </div>
                            </div>
                            <p class="text-xs text-blue-600 dark:text-blue-400 mt-2">Click on any example to auto-fill the form</p>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex space-x-4">
                            <button type="submit"
                                    class="flex-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Create Habit
                            </button>
                            <a href="{{ route('habits.index') }}"
                               class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-3 px-6 rounded-lg text-center transition duration-200">
                                Cancel
                            </a>
                        </div>
                        </form>
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
