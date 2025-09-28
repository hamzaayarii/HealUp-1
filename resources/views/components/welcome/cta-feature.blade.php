@props(['text'])

<div class="flex items-center space-x-2">
    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
    <span>{{ $text }}</span>
</div>
