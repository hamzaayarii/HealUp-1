@props(['percentage', 'color', 'label'])

@php
    $colorClasses = [
        'green' => 'stroke-green-600 dark:stroke-green-400 text-green-600 dark:text-green-400',
        'cyan' => 'stroke-cyan-600 dark:stroke-cyan-400 text-cyan-600 dark:text-cyan-400',
        'purple' => 'stroke-purple-600 dark:stroke-purple-400 text-purple-600 dark:text-purple-400'
    ];

    $strokeClass = $colorClasses[$color] ?? $colorClasses['green'];

    // Calculate stroke-dashoffset based on percentage
    $circumference = 175.92;
    $offset = $circumference - ($circumference * $percentage / 100);
@endphp

<div class="text-center">
    <div class="w-16 h-16 mx-auto mb-2 relative">
        <svg class="w-16 h-16 transform -rotate-90">
            <circle cx="32" cy="32" r="28" stroke="#e5e7eb" class="dark:stroke-gray-600" stroke-width="4" fill="none" />
            <circle cx="32" cy="32" r="28" class="{{ $strokeClass }}" stroke-width="4" fill="none"
                stroke-dasharray="{{ $circumference }}" stroke-dashoffset="{{ $offset }}" stroke-linecap="round" />
        </svg>
        <div class="absolute inset-0 flex items-center justify-center text-xs font-bold {{ $strokeClass }}">
            {{ $percentage }}%</div>
    </div>
    <p class="text-xs text-gray-600 dark:text-gray-400 theme-transition">{{ $label }}</p>
</div>