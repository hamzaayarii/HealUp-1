@props([
    'showDetails' => false,
    'class' => ''
])

<div {{ $attributes->merge(['class' => 'theme-status p-3 bg-gray-100 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 theme-transition ' . $class]) }}>
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-2">
            <div class="w-3 h-3 rounded-full {{ $isDarkMode ? 'bg-blue-500' : 'bg-yellow-500' }}"></div>
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ $isDarkMode ? 'Dark' : 'Light' }} Mode
            </span>
        </div>

        <x-theme.toggle size="sm" />
    </div>

    @if($showDetails)
        <div class="mt-2 pt-2 border-t border-gray-200 dark:border-gray-700">
            <div class="text-xs text-gray-500 dark:text-gray-400 space-y-1">
                <div>Current Theme: <span class="font-mono">{{ $currentTheme }}</span></div>
                <div>Dark Mode: <span class="font-mono">{{ $isDarkMode ? 'true' : 'false' }}</span></div>
                <div>Theme Classes: <span class="font-mono">{{ json_encode(array_keys(app('theme')->getThemeClasses())) }}</span></div>
            </div>
        </div>
    @endif
</div>
