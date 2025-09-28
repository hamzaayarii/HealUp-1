{{-- Logo Component with Theme Support --}}
@props([
    'variant' => 'full', // 'full', 'icon', 'text'
    'size' => 'md', // 'sm', 'md', 'lg', 'xl'
    'class' => ''
])

@php
    $sizeClasses = [
        'sm' => 'h-8 w-auto',
        'md' => 'h-12 w-auto',
        'lg' => 'h-14 w-auto',
        'xl' => 'h-20 w-auto'
    ];
    $baseClass = $sizeClasses[$size] ?? $sizeClasses['md'];
@endphp

<div {{ $attributes->merge(['class' => $baseClass . ' ' . $class]) }}>
    @if($variant === 'icon')
        {{-- Icon Logo for small spaces --}}
        <img src="{{ asset('images/logos/healup-icon.svg') }}"
             alt="{{ config('app.name') }} Icon"
             class="w-full h-full object-contain dark:hidden">
        <img src="{{ asset('images/logos/healup-icon-dark.svg') }}"
             alt="{{ config('app.name') }} Icon"
             class="w-full h-full object-contain hidden dark:block">
    @elseif($variant === 'text')
        {{-- Text-only logo --}}
        <span class="font-bold text-xl text-gray-900 dark:text-gray-100">
            {{ config('app.name') }}
        </span>
    @else
        {{-- Full Logo with image files --}}
        @if(file_exists(public_path('images/logos/healup-logo-light.svg')) || file_exists(public_path('images/logos/healup-logo-light.png')))
            {{-- Use uploaded logo images --}}
            @if(file_exists(public_path('images/logos/healup-logo-light.svg')))
                <img src="{{ asset('images/logos/healup.svg') }}"
                     alt="{{ config('app.name') }} Logo"
                     class="w-full h-full object-contain dark:hidden theme-transition">
            @elseif(file_exists(public_path('images/logos/healup-logo-light.png')))
                <img src="{{ asset('images/logos/healup-logo-light.png') }}"
                     alt="{{ config('app.name') }} Logo"
                     class="w-full h-full object-contain dark:hidden theme-transition">
            @endif

            @if(file_exists(public_path('images/logos/healup-logo-dark.svg')))
                <img src="{{ asset('images/logos/healup.svg') }}"
                     alt="{{ config('app.name') }} Logo"
                     class="w-full h-full object-contain hidden dark:block theme-transition">
            @elseif(file_exists(public_path('images/logos/healup-logo-dark.png')))
                <img src="{{ asset('images/logos/healup-logo-dark.png') }}"
                     alt="{{ config('app.name') }} Logo"
                     class="w-full h-full object-contain hidden dark:block theme-transition">
            @else
                {{-- Use light logo for dark mode if dark version doesn't exist --}}
                @if(file_exists(public_path('images/logos/healup-logo-light.svg')))
                    <img src="{{ asset('images/logos/healup-logo-light.svg') }}"
                         alt="{{ config('app.name') }} Logo"
                         class="w-full h-full object-contain hidden dark:block theme-transition filter brightness-0 invert">
                @elseif(file_exists(public_path('images/logos/healup-logo-light.png')))
                    <img src="{{ asset('images/logos/healup-logo-light.png') }}"
                         alt="{{ config('app.name') }} Logo"
                         class="w-full h-full object-contain hidden dark:block theme-transition filter brightness-0 invert">
                @endif
            @endif
        @else
            {{-- Fallback to styled text/SVG if no images exist --}}
            <div class="flex items-center space-x-2">
                {{-- Medical Icon --}}
                <svg viewBox="0 0 24 24" fill="none" class="w-6 h-6">
                    <rect x="10" y="6" width="4" height="12" rx="2" fill="currentColor" class="text-primary-600 dark:text-primary-400"/>
                    <rect x="6" y="10" width="12" height="4" rx="2" fill="currentColor" class="text-primary-600 dark:text-primary-400"/>
                    <circle cx="12" cy="12" r="1.5" fill="currentColor" class="text-red-500"/>
                </svg>
                {{-- Text Logo --}}
                <span class="font-bold text-lg text-gray-900 dark:text-gray-100 tracking-tight">
                    Heal<span class="text-primary-600 dark:text-primary-400">Up</span>
                </span>
            </div>
        @endif
    @endif
</div>
