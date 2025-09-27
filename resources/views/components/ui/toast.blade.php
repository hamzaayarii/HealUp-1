{{-- Toast Notification Component --}}
@props([
    'type' => 'info', // success, info, warning, danger
    'title' => null,
    'message' => null,
    'timeout' => 5000,
    'persistent' => false,
    'icon' => null
])

@php
    $typeClasses = [
        'success' => 'bg-green-50 border-green-400 text-green-800 dark:bg-green-900 dark:border-green-600 dark:text-green-200',
        'info' => 'bg-blue-50 border-blue-400 text-blue-800 dark:bg-blue-900 dark:border-blue-600 dark:text-blue-200',
        'warning' => 'bg-yellow-50 border-yellow-400 text-yellow-800 dark:bg-yellow-900 dark:border-yellow-600 dark:text-yellow-200',
        'danger' => 'bg-red-50 border-red-400 text-red-800 dark:bg-red-900 dark:border-red-600 dark:text-red-200'
    ];

    $iconClasses = [
        'success' => 'text-green-400 dark:text-green-300',
        'info' => 'text-blue-400 dark:text-blue-300',
        'warning' => 'text-yellow-400 dark:text-yellow-300',
        'danger' => 'text-red-400 dark:text-red-300'
    ];

    $defaultIcons = [
        'success' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>',
        'info' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>',
        'warning' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>',
        'danger' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>'
    ];
@endphp

<div {{ $attributes->merge(['class' => 'max-w-sm w-full border-l-4 rounded-lg shadow-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden ' . $typeClasses[$type]]) }}
     x-data="{
         show: true,
         timeout: {{ $persistent ? 'null' : $timeout }}
     }"
     x-init="
         if (timeout) {
             setTimeout(() => show = false, timeout)
         }
     "
     x-show="show"
     x-transition:enter="transform ease-out duration-300 transition"
     x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
     x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
     x-transition:leave="transition ease-in duration-100"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0">

    <div class="p-4">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                @if($icon)
                    <div class="{{ $iconClasses[$type] }}">
                        {!! $icon !!}
                    </div>
                @else
                    <div class="{{ $iconClasses[$type] }}">
                        {!! $defaultIcons[$type] !!}
                    </div>
                @endif
            </div>

            <div class="ml-3 w-0 flex-1">
                @if($title)
                    <p class="text-sm font-medium">{{ $title }}</p>
                @endif

                @if($message)
                    <p class="text-sm {{ $title ? 'mt-1' : '' }}">{{ $message }}</p>
                @endif

                @if($slot->isNotEmpty())
                    <div class="text-sm {{ $title || $message ? 'mt-1' : '' }}">
                        {{ $slot }}
                    </div>
                @endif
            </div>

            <div class="ml-4 flex-shrink-0 flex">
                <button @click="show = false"
                        class="inline-flex rounded-md hover:bg-black hover:bg-opacity-10 focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors p-1.5">
                    <span class="sr-only">Close</span>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
