<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <title>@yield('title', config('app.name', 'HealUp'))</title>
    <meta name="description" content="@yield('description', 'HealUp - Your Health Management Platform')">
    <meta name="keywords" content="@yield('keywords', 'health, medical, healthcare')">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', config('app.name'))">
    <meta property="og:description" content="@yield('og_description', 'HealUp - Your Health Management Platform')">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('twitter_title', config('app.name'))">
    <meta property="twitter:description"
        content="@yield('twitter_description', 'HealUp - Your Health Management Platform')">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @stack('styles')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Additional Head Content -->
    @stack('head')
</head>

<body class="font-sans antialiased h-full @yield('body_class', 'bg-gray-50')" data-page="@yield('page_identifier')"
    data-section="@yield('section_identifier')">

    <!-- Skip to main content for accessibility -->
    <a href="#main-content"
        class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-blue-600 text-white px-4 py-2 rounded-md z-50">
        Skip to main content
    </a>

    <!-- Page Structure -->
    <div class="min-h-full flex flex-col">
        <!-- Header Section -->
        @hasSection('header')
            <header role="banner" class="@yield('header_class', '')">
                @yield('header')
            </header>
        @endif

        <!-- Navigation Section -->
        @hasSection('navigation')
            <nav role="navigation" aria-label="Main navigation" class="@yield('nav_class', '')">
                @yield('navigation')
            </nav>
        @endif

        <!-- Breadcrumb Section -->
        @hasSection('breadcrumb')
            <nav aria-label="Breadcrumb" class="@yield('breadcrumb_class', 'px-4 py-2')">
                @yield('breadcrumb')
            </nav>
        @endif

        <!-- Main Content Area -->
        <main id="main-content" role="main" class="flex-1 @yield('main_class', 'flex flex-col')"
            aria-label="Main content">

            <!-- Flash Messages -->
            @if(session('status') || session('success') || session('error') || session('warning'))
                <div class="flash-messages" role="alert" aria-live="polite">
                    <x-ui.flash-messages />
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')

            <!-- Additional Content Slots -->
            @hasSection('additional_content')
                @yield('additional_content')
            @endif
        </main>

        <!-- Sidebar Section (if needed) -->
        @hasSection('sidebar')
            <aside role="complementary" aria-label="Sidebar" class="@yield('sidebar_class', '')">
                @yield('sidebar')
            </aside>
        @endif

        <!-- Footer Section -->
        @hasSection('footer')
            <footer role="contentinfo" class="@yield('footer_class', 'mt-auto')">
                @yield('footer')
            </footer>
        @endif
    </div>

    <!-- Modals Area -->
    @stack('modals')

    <!-- Scripts -->
    @livewireScripts
    @stack('scripts')

    <!-- Additional Body Content -->
    @stack('body')
</body>

</html>
