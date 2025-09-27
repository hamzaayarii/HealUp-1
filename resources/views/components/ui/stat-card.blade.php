{{-- Statistics Card Component --}}
@props([
    'value' => 0,
    'label' => null,
    'icon' => null,
    'color' => 'primary', // primary, secondary, success, warning, danger, info
    'animate' => true,
    'suffix' => '',
    'prefix' => ''
])

@php
    $colorClasses = [
        'primary' => 'text-primary-600 dark:text-primary-400',
        'secondary' => 'text-gray-600 dark:text-gray-400',
        'success' => 'text-green-600 dark:text-green-400',
        'warning' => 'text-yellow-600 dark:text-yellow-400',
        'danger' => 'text-red-600 dark:text-red-400',
        'info' => 'text-blue-600 dark:text-blue-400'
    ];

    $iconColorClasses = [
        'primary' => 'bg-primary-100 dark:bg-primary-900 text-primary-600 dark:text-primary-400',
        'secondary' => 'bg-gray-100 dark:bg-gray-900 text-gray-600 dark:text-gray-400',
        'success' => 'bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-400',
        'warning' => 'bg-yellow-100 dark:bg-yellow-900 text-yellow-600 dark:text-yellow-400',
        'danger' => 'bg-red-100 dark:bg-red-900 text-red-600 dark:text-red-400',
        'info' => 'bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400'
    ];
@endphp

<div {{ $attributes->merge(['class' => 'text-center']) }}>
    @if($icon)
        <div class="w-16 h-16 {{ $iconColorClasses[$color] }} rounded-full flex items-center justify-center mx-auto mb-4">
            {!! $icon !!}
        </div>
    @endif

    <div class="mb-2">
        <span class="text-4xl font-bold {{ $colorClasses[$color] }}"
              @if($animate)
              x-data="{ displayed: 0, target: {{ $value }} }"
              x-init="$nextTick(() => {
                  let start = 0;
                  let duration = 2000;
                  let startTime = null;

                  function animate(currentTime) {
                      if (startTime === null) startTime = currentTime;
                      let progress = (currentTime - startTime) / duration;

                      if (progress < 1) {
                          displayed = Math.floor(start + (target - start) * progress);
                          requestAnimationFrame(animate);
                      } else {
                          displayed = target;
                      }
                  }

                  requestAnimationFrame(animate);
              })"
              x-text="'{{ $prefix }}' + displayed.toLocaleString() + '{{ $suffix }}'"
              @else
              >{{ $prefix }}{{ number_format($value) }}{{ $suffix }}</span>
              @endif
    </div>

    @if($label)
        <p class="text-gray-600 dark:text-gray-300 font-medium">{{ $label }}</p>
    @endif

    {{ $slot }}
</div>
