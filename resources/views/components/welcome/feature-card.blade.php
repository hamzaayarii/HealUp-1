@props(['icon', 'title', 'description', 'gradient', 'iconBg', 'border', 'features'])

@php
    $icons = [
        'check-circle' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
        'fire' => 'M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z',
        'lightbulb' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z',
        'users' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
        'chart-bar' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
        'shield-check' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'
    ];

    $iconPath = $icons[$icon] ?? $icons['check-circle'];
@endphp

<div
    class="group bg-gradient-to-br {{ $gradient }} p-8 rounded-2xl hover:shadow-xl transition-all duration-300 border {{ $border }} theme-transition">
    <div
        class="w-12 h-12 {{ $iconBg }} rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconPath }}"></path>
        </svg>
    </div>
    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-3 theme-transition">{{ $title }}</h3>
    <p class="text-gray-600 dark:text-gray-300 mb-4 theme-transition">{{ $description }}</p>
    <ul class="text-sm text-gray-500 dark:text-gray-400 space-y-1 theme-transition">
        @foreach($features as $feature)
            <li>• {{ $feature }}</li>
        @endforeach
    </ul>
</div>