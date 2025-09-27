{{-- Progress Bar Component --}}
@props([
    'value' => 0,
    'max' => 100,
    'size' => 'md', // sm, md, lg
    'color' => 'primary', // primary, success, warning, danger, info
    'showLabel' => false,
    'label' => null,
    'animate' => true
])

@php
    $percentage = ($max > 0) ? ($value / $max) * 100 : 0;
    $percentage = min(100, max(0, $percentage));

    $sizeClasses = [
        'sm' => 'h-1',
        'md' => 'h-2',
        'lg' => 'h-3'
    ];

    $colorClasses = [
        'primary' => 'bg-primary-500',
        'success' => 'bg-green-500',
        'warning' => 'bg-yellow-500',
        'danger' => 'bg-red-500',
        'info' => 'bg-blue-500'
    ];
@endphp

<div {{ $attributes->merge(['class' => 'w-full']) }}>
    @if($showLabel || $label)
        <div class="flex justify-between items-center mb-2">
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ $label ?? 'Progress' }}
            </span>
            @if($showLabel)
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    {{ number_format($percentage, 1) }}%
                </span>
            @endif
        </div>
    @endif

    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full {{ $sizeClasses[$size] }}">
        <div
            class="{{ $colorClasses[$color] }} {{ $sizeClasses[$size] }} rounded-full {{ $animate ? 'transition-all duration-300 ease-out' : '' }}"
            style="width: {{ $percentage }}%"
            role="progressbar"
            aria-valuenow="{{ $value }}"
            aria-valuemin="0"
            aria-valuemax="{{ $max }}">
        </div>
    </div>
</div>
