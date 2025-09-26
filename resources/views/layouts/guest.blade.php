<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full {{ $isDarkMode ? 'dark' : '' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <title>{{ config('app.name', 'HealUp') }}</title>
    <meta name="description" content="HealUp - Your Health Management Platform">

    <!-- Theme configuration -->
    <meta name="theme-config" content="{{ json_encode(app('theme')->getThemeConfig()) }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <!-- Theme-aware styles -->
    <style>
        /* Smooth theme transitions */
        * {
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }

        /* Ensure proper theme switching */
        .theme-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans text-gray-900 dark:text-gray-100 antialiased bg-gray-50 dark:bg-gray-900 h-full theme-transition"
    data-theme="{{ $currentTheme }}">

    <!-- Skip to main content for accessibility -->
    <a href="#main-content"
        class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-blue-600 text-white px-4 py-2 rounded-md z-50">
        Skip to main content
    </a>

    <!-- Page Structure -->
    <div class="min-h-full flex flex-col">
        <!-- Header -->
        <header role="banner">
            @include('partials.guest-header')
        </header>

        <!-- Main Content Area -->
        <main id="main-content" role="main" class="flex-1 flex flex-col">
            <!-- Flash Messages -->
            @if(session('status') || session('success') || session('error') || session('warning'))
                <div class="flash-messages px-4 py-2" role="alert" aria-live="polite">
                    <x-ui.flash-messages />
                </div>
            @endif

            <!-- Guest Content -->
            <div class="guest-content flex-1">
                {{ $slot }}
            </div>
        </main>

        <!-- Footer -->
        <footer role="contentinfo" class="mt-auto">
            @include('partials.guest-footer')
        </footer>
    </div>

    <!-- Scripts -->
    @livewireScripts
    @stack('scripts')
</body>

</html>
