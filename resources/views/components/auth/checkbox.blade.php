@props(['label' => null, 'name', 'required' => false])

<div class="flex items-start">
	<div class="flex items-center h-5">
		<input id="{{ $name }}" name="{{ $name }}" type="checkbox" {{ $required ? 'required' : '' }} {{ $attributes->merge([
    'class' => 'h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 dark:border-gray-600 rounded bg-white dark:bg-gray-700 dark:checked:bg-green-600 dark:checked:border-green-600 theme-transition'
]) }}>
	</div>
	@if($label)
        <div class="ml-3">
            <label for="{{ $name }}" class="text-sm text-gray-700 dark:text-gray-300 theme-transition">
                {{ $label }}
                @if($required)<span class="text-red-500"> *</span>
                @endif
            </label>
        </div>
    @else
        <div
            class="ml-3">{{ $slot }}
        </div>
    @endif
</div>

