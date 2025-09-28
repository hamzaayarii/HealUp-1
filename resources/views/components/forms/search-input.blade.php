{{-- Search Input Component --}}
@props([
    'name' => 'search',
    'id' => 'search',
    'placeholder' => 'Search...',
    'value' => '',
    'size' => 'md',
    'showButton' => false
])

@php
    $sizeClasses = [
        'sm' => 'px-3 py-2 text-sm',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-4 py-3 text-base'
    ];

    $inputClasses = 'block w-full pl-10 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500';
    $inputClasses .= ' ' . ($sizeClasses[$size] ?? $sizeClasses['md']);

    if ($showButton) {
        $inputClasses .= ' pr-12';
    }
@endphp

<div class="search-input-container relative">
    {{-- Search Icon --}}
    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <x-ui.icon name="search" class="w-5 h-5 text-gray-400" />
    </div>

    {{-- Search Input --}}
    <input type="search"
           name="{{ $name }}"
           id="{{ $id }}"
           value="{{ old($name, $value) }}"
           placeholder="{{ $placeholder }}"
           {{ $attributes->merge(['class' => $inputClasses]) }}
           autocomplete="off" />

    {{-- Search Button (Optional) --}}
    @if($showButton)
        <div class="absolute inset-y-0 right-0 flex items-center">
            <button type="submit"
                    class="h-full px-4 text-gray-400 hover:text-gray-600 focus:outline-none focus:text-gray-600">
                <span class="sr-only">Search</span>
                <x-ui.icon name="search" class="w-5 h-5" />
            </button>
        </div>
    @endif
</div>
