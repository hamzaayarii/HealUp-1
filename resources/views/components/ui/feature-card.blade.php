{{-- Feature Card Component --}}
@props([
    'icon' => null,
    'title' => null,
    'description' => null,
    'iconColor' => 'primary', // primary, secondary, success, warning, danger, info
    'href' => null,
    'animate' => true
])

@php
    $iconColorClasses = [
        'primary' => 'bg-primary-100 dark:bg-primary-900 text-primary-600 dark:text-primary-400',
        'secondary' => 'bg-gray-100 dark:bg-gray-900 text-gray-600 dark:text-gray-400',
        'success' => 'bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-400',
        'warning' => 'bg-yellow-100 dark:bg-yellow-900 text-yellow-600 dark:text-yellow-400',
        'danger' => 'bg-red-100 dark:bg-red-900 text-red-600 dark:text-red-400',
        'info' => 'bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400'
    ];

    $cardClasses = 'bg-gray-50 dark:bg-gray-800 rounded-xl p-8 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200';
    if ($animate) {
        $cardClasses .= ' group';
    }
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $cardClasses]) }}>
        <div class="space-y-4">
            @if($icon)
                <div class="w-12 h-12 {{ $iconColorClasses[$iconColor] }} rounded-lg flex items-center justify-center mb-6 {{ $animate ? 'group-hover:scale-110 transition-transform duration-200' : '' }}">
                    {!! $icon !!}
                </div>
            @endif

            @if($title)
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ $title }}</h3>
            @endif

            @if($description)
                <p class="text-gray-600 dark:text-gray-300">{{ $description }}</p>
            @endif

            {{ $slot }}
        </div>
    </a>
@else
    <div {{ $attributes->merge(['class' => $cardClasses]) }}>
        <div class="space-y-4">
            @if($icon)
                <div class="w-12 h-12 {{ $iconColorClasses[$iconColor] }} rounded-lg flex items-center justify-center mb-6 {{ $animate ? 'group-hover:scale-110 transition-transform duration-200' : '' }}">
                    {!! $icon !!}
                </div>
            @endif

            @if($title)
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">{{ $title }}</h3>
            @endif

            @if($description)
                <p class="text-gray-600 dark:text-gray-300">{{ $description }}</p>
            @endif

            {{ $slot }}
        </div>
    </div>
@endif
