{{-- Badge Component --}}
@props([
    'variant' => 'primary', // primary, secondary, success, warning, danger, info
    'size' => 'md', // xs, sm, md, lg
    'rounded' => 'md', // sm, md, lg, full
    'icon' => null,
    'removable' => false
])

@php
    $variantClasses = [
        'primary' => 'bg-primary-100 text-primary-800 border-primary-200 dark:bg-primary-900 dark:text-primary-200 dark:border-primary-800',
        'secondary' => 'bg-gray-100 text-gray-800 border-gray-200 dark:bg-gray-800 dark:text-gray-200 dark:border-gray-700',
        'success' => 'bg-green-100 text-green-800 border-green-200 dark:bg-green-900 dark:text-green-200 dark:border-green-800',
        'warning' => 'bg-yellow-100 text-yellow-800 border-yellow-200 dark:bg-yellow-900 dark:text-yellow-200 dark:border-yellow-800',
        'danger' => 'bg-red-100 text-red-800 border-red-200 dark:bg-red-900 dark:text-red-200 dark:border-red-800',
        'info' => 'bg-blue-100 text-blue-800 border-blue-200 dark:bg-blue-900 dark:text-blue-200 dark:border-blue-800'
    ];

    $sizeClasses = [
        'xs' => 'px-2 py-0.5 text-xs',
        'sm' => 'px-2.5 py-0.5 text-sm',
        'md' => 'px-3 py-1 text-sm',
        'lg' => 'px-4 py-2 text-base'
    ];

    $roundedClasses = [
        'sm' => 'rounded',
        'md' => 'rounded-md',
        'lg' => 'rounded-lg',
        'full' => 'rounded-full'
    ];

    $classes = implode(' ', [
        'inline-flex items-center gap-1.5 font-medium border',
        $variantClasses[$variant],
        $sizeClasses[$size],
        $roundedClasses[$rounded]
    ]);
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    @if($icon)
        <span class="w-4 h-4 flex-shrink-0">
            {!! $icon !!}
        </span>
    @endif

    <span>{{ $slot }}</span>

    @if($removable)
        <button type="button"
                class="ml-1 -mr-1 flex-shrink-0 hover:bg-black hover:bg-opacity-10 rounded-full p-0.5 transition-colors">
            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    @endif
</span>
