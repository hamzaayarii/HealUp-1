@props(['color', 'activity', 'points'])

@php
    $colorClasses = [
        'green' => 'bg-green-50 dark:bg-green-900/20 bg-green-500 dark:bg-green-400 text-green-600 dark:text-green-400',
        'blue' => 'bg-blue-50 dark:bg-blue-900/20 bg-blue-500 dark:bg-blue-400 text-blue-600 dark:text-blue-400',
        'purple' => 'bg-purple-50 dark:bg-purple-900/20 bg-purple-500 dark:bg-purple-400 text-purple-600 dark:text-purple-400'
    ];

    $classes = explode(' ', $colorClasses[$color] ?? $colorClasses['green']);
    $bgClass = $classes[0] . ' ' . $classes[1];
    $dotClass = $classes[2] . ' ' . $classes[3];
    $textClass = $classes[4] . ' ' . $classes[5];
@endphp

<div class="flex items-center justify-between p-2 {{ $bgClass }} rounded-lg theme-transition">
    <div class="flex items-center space-x-2">
        <div class="w-2 h-2 {{ $dotClass }} rounded-full"></div>
        <span class="text-sm text-gray-700 dark:text-gray-300">{{ $activity }}</span>
    </div>
    <span class="text-xs {{ $textClass }} font-medium">+{{ $points }} pts</span>
</div>