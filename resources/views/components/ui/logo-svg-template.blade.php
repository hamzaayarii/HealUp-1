{{-- Custom SVG Logo Template --}}
@props([
    'class' => 'h-8 w-auto',
    'type' => 'full' // 'full', 'icon', 'text'
])

<div {{ $attributes->merge(['class' => $class]) }}>
    @if($type === 'icon')
        {{-- Icon version - simple mark --}}
        <svg viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
            {{-- Medical Cross with HealUp styling --}}
            <circle cx="30" cy="30" r="28" fill="currentColor" class="text-primary-600 dark:text-primary-400" fill-opacity="0.1"/>
            <rect x="26" y="15" width="8" height="30" rx="4" fill="currentColor" class="text-primary-600 dark:text-primary-400"/>
            <rect x="15" y="26" width="30" height="8" rx="4" fill="currentColor" class="text-primary-600 dark:text-primary-400"/>
            {{-- Heart symbol in center --}}
            <path d="M30 25c-2-3-6-3-6 0s4 6 6 8c2-2 6-5 6-8s-4-3-6 0z" fill="currentColor" class="text-red-500"/>
        </svg>
    @elseif($type === 'text')
        {{-- Text-only version --}}
        <div class="flex items-center space-x-2">
            {{-- Small icon --}}
            <svg viewBox="0 0 24 24" fill="none" class="w-6 h-6">
                <rect x="10" y="6" width="4" height="12" rx="2" fill="currentColor" class="text-primary-600 dark:text-primary-400"/>
                <rect x="6" y="10" width="12" height="4" rx="2" fill="currentColor" class="text-primary-600 dark:text-primary-400"/>
                <path d="M12 10c-1-1.5-3-1.5-3 0s2 3 3 4c1-1 3-2.5 3-4s-2-1.5-3 0z" fill="currentColor" class="text-red-500"/>
            </svg>
            {{-- Text --}}
            <span class="font-bold text-xl text-gray-900 dark:text-gray-100 tracking-tight">
                Heal<span class="text-primary-600 dark:text-primary-400">Up</span>
            </span>
        </div>
    @else
        {{-- Full logo with text and icon --}}
        <div class="flex items-center space-x-3">
            {{-- Logo Mark --}}
            <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-8 h-8">
                <circle cx="20" cy="20" r="18" fill="currentColor" class="text-primary-600 dark:text-primary-400" fill-opacity="0.1"/>
                <rect x="17" y="10" width="6" height="20" rx="3" fill="currentColor" class="text-primary-600 dark:text-primary-400"/>
                <rect x="10" y="17" width="20" height="6" rx="3" fill="currentColor" class="text-primary-600 dark:text-primary-400"/>
                <path d="M20 17c-1.5-2-4-2-4 0s3 4 4 5c1-1 4-3 4-5s-2.5-2-4 0z" fill="currentColor" class="text-red-500"/>
            </svg>
            {{-- Logo Text --}}
            <div class="flex flex-col">
                <span class="font-bold text-lg text-gray-900 dark:text-gray-100 leading-tight tracking-tight">
                    Heal<span class="text-primary-600 dark:text-primary-400">Up</span>
                </span>
                <span class="text-xs text-gray-500 dark:text-gray-400 leading-none">
                    Healthcare Platform
                </span>
            </div>
        </div>
    @endif
</div>
