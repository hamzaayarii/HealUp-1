@props(['habit', 'progress' => null, 'showQuickActions' => true])

@php
    $isCompleted = $progress && $progress->completed;
    $progressValue = $progress ? $progress->value : 0;
    $progressPercentage = ($progressValue / $habit->target_value) * 100;
    $categoryIcon = match($habit->habit->category->name) {
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

<div class="border border-gray-200 dark:border-gray-700 rounded-xl p-6 hover:shadow-lg transition-all duration-200 {{ $isCompleted ? 'bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-700' : '' }}">

    <!-- Header -->
    <div class="flex items-start justify-between mb-4">
        <div class="flex items-center">
            <span class="text-3xl mr-3">{{ $categoryIcon }}</span>
            <div>
                <h4 class="font-semibold text-gray-900 dark:text-gray-100">{{ $habit->habit->name }}</h4>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $habit->habit->category->name }}</p>
            </div>
        </div>

        <!-- Status Badge -->
        @if($isCompleted)
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                ✓ Complete
            </span>
        @else
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                In Progress
            </span>
        @endif
    </div>

    <!-- Description -->
    @if($habit->habit->description)
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">{{ $habit->habit->description }}</p>
    @endif

    <!-- Progress -->
    <div class="mb-4">
        <div class="flex justify-between items-center mb-2">
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Progress</span>
            <span class="text-sm text-gray-500 dark:text-gray-400">
                {{ $progressValue }} / {{ $habit->target_value }} {{ $habit->habit->unit }}
            </span>
        </div>
        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
            <div class="bg-gradient-to-r {{ $isCompleted ? 'from-green-500 to-green-600' : 'from-blue-500 to-blue-600' }} h-2 rounded-full transition-all duration-500"
                 style="width: {{ min(100, $progressPercentage) }}%"></div>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div class="text-center">
            <div class="text-lg font-bold text-orange-600">{{ $habit->current_streak }}</div>
            <div class="text-xs text-gray-500 dark:text-gray-400">Current Streak</div>
        </div>
        <div class="text-center">
            <div class="text-lg font-bold text-purple-600">{{ $habit->longest_streak }}</div>
            <div class="text-xs text-gray-500 dark:text-gray-400">Best Streak</div>
        </div>
    </div>

    <!-- Quick Actions -->
    @if($showQuickActions)
        <div class="flex space-x-2">
            <a href="{{ route('habits.show', $habit) }}"
               class="flex-1 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium py-2 px-3 rounded-md text-center transition duration-200">
                View Details
            </a>

            @if(!$isCompleted)
                <button class="quick-log-habit-btn bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-3 rounded-md transition duration-200"
                        data-habit-id="{{ $habit->id }}"
                        data-habit-name="{{ $habit->habit->name }}"
                        data-target-value="{{ $habit->target_value }}"
                        data-unit="{{ $habit->habit->unit }}"
                        data-current-value="{{ $progressValue }}">
                    Log Progress
                </button>
            @endif
        </div>
    @endif
</div>
