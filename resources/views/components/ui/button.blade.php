{{-- Button Component with Multiple Variants --}}
@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
    'disabled' => false,
    'loading' => false,
    'href' => null,
    'tag' => null
])
@php
    // Determine the tag to use
    $tag = $tag ?? ($href ? 'a' : 'button');

    // Base classes
    $baseClasses = 'inline-flex items-center justify-center font-medium rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';

    // Variant classes
    $variantClasses = [
        'primary' => 'bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500',
        'secondary' => 'bg-gray-600 text-white hover:bg-gray-700 focus:ring-gray-500',
        'outline' => 'border border-gray-300 bg-white text-gray-700 hover:bg-gray-50 focus:ring-blue-500',
        'ghost' => 'text-gray-700 hover:bg-gray-100 focus:ring-blue-500',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500',
        'success' => 'bg-green-600 text-white hover:bg-green-700 focus:ring-green-500',
        'warning' => 'bg-yellow-600 text-white hover:bg-yellow-700 focus:ring-yellow-500',
        'link' => 'text-blue-600 underline hover:text-blue-800 focus:ring-blue-500'
    ];

    // Size classes
    $sizeClasses = [
        'xs' => 'px-2 py-1 text-xs',
        'sm' => 'px-3 py-2 text-sm',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-6 py-3 text-base',
        'xl' => 'px-8 py-4 text-lg'
    ];

    $classes = $baseClasses . ' ' . ($variantClasses[$variant] ?? $variantClasses['primary']) . ' ' . ($sizeClasses[$size] ?? $sizeClasses['md']);
@endphp
@if($tag === 'a')
        <a href="{{ $href }}"
       {{ $attributes->merge(['class' => $classes]) }}
           @if($disabled) aria-disabled="true"@endif>
            @if($loading)
                <x-ui.loading-spinner class="w-4 h-4 mr-2" />
            @endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}"
            {{ $attributes->merge(['class' => $classes]) }}
            @if($disabled || $loading) disabled @endif>
        @if($loading)
            <x-ui.loading-spinner class="w-4 h-4 mr-2" />
        @endif
        {{ $slot }}
    </button>
@endif
