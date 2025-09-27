{{-- Enhanced Form Input Component --}}
@props([
    'label' => null,
    'icon' => null,
    'error' => null,
    'helper' => null,
    'required' => false,
    'type' => 'text'
])

<div {{ $attributes->only('class') }}>
    @if($label)
        <label for="{{ $attributes->get('id') }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            {{ $label }}
            @if($required)
                <span class="text-red-500 ml-1">*</span>
            @endif
        </label>
    @endif

    <div class="relative">
        <input
            {{ $attributes->except(['class', 'label', 'icon', 'error', 'helper', 'required'])->merge([
                'type' => $type,
                'class' => 'block w-full px-4 py-3 text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200' . ($icon ? ' pr-12' : '') . ($error ? ' border-red-500 focus:ring-red-500 focus:border-red-500' : '')
            ]) }}
        />

        @if($icon)
            <div class="absolute right-3 top-3.5 text-gray-400">
                {!! $icon !!}
            </div>
        @endif
    </div>

    @if($helper && !$error)
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ $helper }}</p>
    @endif

    @if($error)
        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $error }}</p>
    @endif
</div>
