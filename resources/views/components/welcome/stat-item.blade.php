@props(['percentage', 'color', 'label'])

@php
    $colorClasses = [
        'green' => 'text-green-600 dark:text-green-400',
        'blue' => 'text-blue-600 dark:text-blue-400',
        'purple' => 'text-purple-600 dark:text-purple-400',
        'teal' => 'text-teal-600 dark:text-teal-400'
    ];

    $textColor = $colorClasses[$color] ?? $colorClasses['green'];
@endphp

<div class="text-center">
    <div class="text-4xl font-bold {{ $textColor }} mb-2">{{ $percentage }}%</div>
    <div class="text-sm text-gray-600 dark:text-gray-400 theme-transition">{{ $label }}</div>
</div>