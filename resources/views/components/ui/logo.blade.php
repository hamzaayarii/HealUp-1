{{-- Logo Component --}}
@props([
    'class' => 'h-8 w-auto'
])

<div {{ $attributes->merge(['class' => $class]) }}>
    {{-- SVG Logo or Image --}}
    <svg viewBox="0 0 100 100"
         fill="currentColor"
         class="w-full h-full text-blue-600"
         aria-label="{{ config('app.name') }} Logo">
        {{-- Simple Healthcare Cross Logo --}}
        <rect x="35" y="10" width="30" height="80" rx="15" ry="15" fill="currentColor"/>
        <rect x="10" y="35" width="80" height="30" rx="15" ry="15" fill="currentColor"/>
        {{-- Add your custom logo SVG here when ready --}}
    </svg>

    {{-- Alternative: Use image when you have one --}}
    {{-- <img src="{{ asset('images/logo.svg') }}"
         alt="{{ config('app.name') }} Logo"
         class="w-full h-full"> --}}
</div>
