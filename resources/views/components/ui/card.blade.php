{{-- Card Component --}}
@props([
    'padding' => 'default', // none, sm, default, lg
    'shadow' => 'default', // none, sm, default, lg, xl
    'rounded' => 'default', // sm, default, lg, xl
    'border' => true,
    'hover' => false,
    'header' => null,
    'footer' => null
])

@php
    $paddingClasses = [
        'none' => '',
        'sm' => 'p-4',
        'default' => 'p-6',
        'lg' => 'p-8'
    ];

    $shadowClasses = [
        'none' => '',
        'sm' => 'shadow-sm',
        'default' => 'shadow',
        'lg' => 'shadow-lg',
        'xl' => 'shadow-xl'
    ];

    $roundedClasses = [
        'sm' => 'rounded',
        'default' => 'rounded-lg',
        'lg' => 'rounded-xl',
        'xl' => 'rounded-2xl'
    ];

    $classes = [
        'bg-white dark:bg-gray-800',
        $paddingClasses[$padding],
        $shadowClasses[$shadow],
        $roundedClasses[$rounded]
    ];

    if ($border) {
        $classes[] = 'border border-gray-200 dark:border-gray-700';
    }

    if ($hover) {
        $classes[] = 'hover:shadow-lg transition-shadow duration-200';
    }

    $classes = implode(' ', array_filter($classes));
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    @if($header)
        <div class="border-b border-gray-200 dark:border-gray-700 {{ $padding !== 'none' ? '-m-6 mb-6 p-6' : 'pb-4 mb-4' }}">
            {{ $header }}
        </div>
    @endif

    <div class="{{ $header || $footer ? '' : '' }}">
        {{ $slot }}
    </div>

    @if($footer)
        <div class="border-t border-gray-200 dark:border-gray-700 {{ $padding !== 'none' ? '-m-6 mt-6 p-6' : 'pt-4 mt-4' }}">
            {{ $footer }}
        </div>
    @endif
</div>
