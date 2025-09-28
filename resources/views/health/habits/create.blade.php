<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Create New Habit') }}
            </h2>
            <a href="{{ route('habits.index') }}"
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                Back to Habits
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl rounded-xl">
                <div class="p-8">
                    <div class="text-center mb-8">
                        <div class="text-6xl mb-4">🎯</div>
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Create a New Habit</h3>
                        <p class="text-gray-600 dark:text-gray-400">Define a new wellness habit to track your progress and build consistency.</p>
                    </div>

                    <form method="POST" action="{{ route('habits.store') }}" class="space-y-6">
                        @csrf

                        <!-- Habit Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Habit Name *
                            </label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ old('name') }}"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-100"
                                   placeholder="e.g., Drink water, Morning exercise, Read books"
                                   required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Category *
                            </label>
                            <select id="category_id"
                                    name="category_id"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-gray-100"
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
