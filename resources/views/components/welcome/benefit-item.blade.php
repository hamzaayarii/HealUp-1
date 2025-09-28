@props(['title', 'description'])

<div class="flex items-start space-x-4">
    <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center flex-shrink-0 theme-transition">
        <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
        </svg>
    </div>
    <div>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2 theme-transition">{{ $title }}</h3>
        <p class="text-gray-600 dark:text-gray-300 theme-transition">{{ $description }}</p>
    </div>
</div>
