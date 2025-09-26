{{-- Input Component with Validation States --}}
@props([
    'type' => 'text',
    'name' => '',
    'id' => '',
    'label' => '',
    'placeholder' => '',
    'value' => '',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'error' => null,
    'helpText' => '',
    'icon' => null,
    'iconPosition' => 'left',
    'size' => 'md'
])

@php
    $inputId = $id ?: $name;
    $hasError = $error || $errors->has($name);
    $errorMessage = $error ?: $errors->first($name);

    // Size classes
    $sizeClasses = [
        'sm' => 'px-3 py-2 text-sm',
        'md' => 'px-3 py-2 text-sm',
        'lg' => 'px-4 py-3 text-base'
    ];

    // Base input classes
    $inputClasses = 'block w-full border rounded-md shadow-sm focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';
    $inputClasses .= ' ' . ($sizeClasses[$size] ?? $sizeClasses['md']);

    // State-based classes
    if ($hasError) {
        $inputClasses .= ' border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500';
    } else {
        $inputClasses .= ' border-gray-300 focus:border-blue-500 focus:ring-blue-500';
    }

    // Icon classes
    if ($icon) {
        if ($iconPosition === 'left') {
            $inputClasses .= ' pl-10';
        } else {
            $inputClasses .= ' pr-10';
        }
    }
@endphp

<div class="form-group">
    {{-- Label --}}
    @if($label)
        <label for="{{ $inputId }}"
               class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }}
            @if($required)
                <span class="text-red-500" aria-label="required">*</span>
            @endif
        </label>
    @endif

    {{-- Input Container --}}
    <div class="relative">
        {{-- Left Icon --}}
        @if($icon && $iconPosition === 'left')
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <x-ui.icon :name="$icon" class="w-5 h-5 text-gray-400" />
            </div>
        @endif

        {{-- Input Field --}}
        <input type="{{ $type }}"
               name="{{ $name }}"
               id="{{ $inputId }}"
               value="{{ old($name, $value) }}"
               placeholder="{{ $placeholder }}"
               {{ $attributes->merge(['class' => $inputClasses]) }}
               @if($required) required @endif
               @if($disabled) disabled @endif
               @if($readonly) readonly @endif
               @if($hasError) aria-invalid="true" aria-describedby="{{ $inputId }}-error" @endif
               @if($helpText) aria-describedby="{{ $inputId }}-help" @endif />

        {{-- Right Icon --}}
        @if($icon && $iconPosition === 'right')
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <x-ui.icon :name="$icon" class="w-5 h-5 text-gray-400" />
            </div>
        @endif

        {{-- Error Icon --}}
        @if($hasError)
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <x-ui.icon name="exclamation-circle" class="w-5 h-5 text-red-500" />
            </div>
        @endif
    </div>

    {{-- Help Text --}}
    @if($helpText && !$hasError)
        <p id="{{ $inputId }}-help" class="mt-1 text-sm text-gray-500">
            {{ $helpText }}
        </p>
    @endif

    {{-- Error Message --}}
    @if($hasError)
        <p id="{{ $inputId }}-error" class="mt-1 text-sm text-red-600" role="alert">
            {{ $errorMessage }}
        </p>
    @endif
</div>
