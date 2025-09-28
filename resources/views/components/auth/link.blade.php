@props(['href', 'variant' => 'default'])

@php
    $baseClasses = 'font-medium transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-md';

    $variantClasses = [
        'default' => 'text-green-600 hover:text-green-500 focus:ring-green-500 dark:text-green-400 dark:hover:text-green-300 dark:focus:ring-green-400',
        'muted' => 'text-gray-600 hover:text-gray-900 focus:ring-gray-500 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-gray-400'
    ];

    $classes = $baseClasses . ' ' . $variantClasses[$variant];
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>