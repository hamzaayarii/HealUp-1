<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $isDarkMode ? 'dark' : '' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Theme configuration -->
    <meta name="theme-config" content="{{ json_encode(app('theme')->getThemeConfig()) }}">

    <title>{{ config('app.name', 'HealUp') }} - Admin Dashboard</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logos/healup.svg') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    <!-- Custom Admin Styles -->
    <link rel="stylesheet" href="{{ asset('admin/css/admin.css') }}">

    <!-- Theme Toggle Component Styles -->
    <style>
        /* Ensure theme toggle component works properly in admin */
        .theme-toggle-container {
            display: flex;
            align-items: center;
            z-index: 1000;
        }

        .theme-toggle-container button {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }

        .theme-toggle-container button:focus {
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5) !important;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js for admin dashboard -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')
</head>

<body class="font-sans antialiased" data-theme="{{ $currentTheme }}">
    <!-- Sidebar -->
    <nav class="admin-sidebar" id="adminSidebar">
        <!-- Sidebar Header -->
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <img src="{{ asset('images/logos/flavicon.png') }}" alt="HealUp" class="w-8 h-8">
            </div>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
                HealUp Admin
            </a>
        </div>

        <!-- Sidebar Navigation -->
        <div class="sidebar-nav">
            <ul class="nav flex-column">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                       href="{{ route('admin.dashboard') }}" data-tooltip="Dashboard">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Events Management -->
                <li class="nav-item">
                    <a href="{{ route('admin.events.index') }}" class="nav-link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}" data-tooltip="Events">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Events</span>
                    </a>
                </li>

                <!-- Categories Management -->
                <li class="nav-item">
                    <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" data-tooltip="Categories">
                        <i class="fas fa-list-alt"></i>
                        <span>Categories</span>
                    </a>
                </li>
                <!-- Users Management -->
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" data-tooltip="Users">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                </li>

                <!-- Health Data -->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-tooltip="Health Data (Coming Soon)">
                        <i class="fas fa-heartbeat"></i>
                        <span>Health Data</span>
                    </a>
                </li>

                <!-- Habits -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.habits.*') ? 'active' : '' }}" href="{{ route('admin.habits.index') }}" data-tooltip="Habits">
                        <i class="fas fa-calendar-check"></i>
                        <span>Habits</span>
                    </a>
                </li>

                <!-- Challenges -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.challenges.index') }}" data-tooltip="Challenges">
                        <i class="fas fa-trophy"></i>
                        <span>Challenges</span>
                    </a>
                </li>

                <!-- Teams -->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-tooltip="Teams (Coming Soon)">
                        <i class="fas fa-users-cog"></i>
                        <span>Teams</span>
                    </a>
                </li>

                <!-- Nutrition -->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-tooltip="Nutrition (Coming Soon)">
                        <i class="fas fa-apple-alt"></i>
                        <span>Nutrition</span>
                    </a>
                </li>

                <!-- Reports -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" href="{{ route('admin.reports.index') }}" data-tooltip="Reports">
                        <i class="fas fa-chart-bar"></i>
                        <span>Reports</span>
                    </a>
                </li>

                <!-- Advices -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.advices.*') ? 'active' : '' }}" href="{{ route('admin.advices.index') }}" data-tooltip="Advices">
                        <i class="fas fa-lightbulb"></i>
                        <span>Advices</span>
                    </a>
                </li>


                <!-- Settings -->
                <li class="nav-item">
                    <a class="nav-link" href="#" data-tooltip="Settings (Coming Soon)">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider my-3" style="border-color: rgba(255,255,255,0.2);">

                <!-- Profile Management -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}"
                       href="{{ route('admin.profile') }}" data-tooltip="Profile Settings">
                        <i class="fas fa-user-cog"></i>
                        <span>Profile Settings</span>
                    </a>
                </li>

                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start" data-tooltip="Logout">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="admin-content">
        <!-- Header -->
        <header class="admin-header">
            <div class="d-flex align-items-center">
                <!-- Sidebar Toggle (Desktop & Mobile) -->
                <button class="btn btn-link me-3" id="sidebarToggle" title="Toggle Sidebar">
                    <i class="fas fa-bars fa-lg"></i>
                </button>

                <!-- Page Title -->
                <h1 class="header-title">
                    @yield('title', 'Dashboard')
                </h1>
            </div>

            <!-- Header Actions -->
            <div class="header-actions">
                <!-- Modern Theme Toggle -->
                <div class="theme-toggle-container me-3">
                    <x-theme.toggle size="sm" />

                    <!-- Fallback Theme Toggle (hidden by default) -->
                    <button class="btn btn-outline-secondary btn-sm d-none" id="fallbackThemeToggle"
                            onclick="fallbackToggleTheme()" title="Toggle Theme (Fallback)">
                        <i class="fas fa-adjust"></i>
                    </button>
                </div>

                <!-- Notifications -->
                <div class="dropdown me-3">
                    <button class="btn btn-link text-decoration-none position-relative"
                            id="notificationsDropdown"
                            data-bs-toggle="dropdown">
                        <i class="fas fa-bell fa-lg"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><h6 class="dropdown-header">Notifications</h6></li>
                        <li><a class="dropdown-item" href="#">New user registered</a></li>
                        <li><a class="dropdown-item" href="#">Challenge completed</a></li>
                        <li><a class="dropdown-item" href="#">System update available</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-center" href="#">View all notifications</a></li>
                    </ul>
                </div>

                <!-- User Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-link text-decoration-none d-flex align-items-center"
                            id="userDropdown"
                            data-bs-toggle="dropdown">
                        <img src="{{ Auth::user()->profile_photo_url }}"
                             alt="{{ Auth::user()->name }}"
                             class="rounded-circle me-2"
                             style="width: 32px; height: 32px;">
                        <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
                        <i class="fas fa-chevron-down ms-2"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('admin.profile') }}">
                            <i class="fas fa-user me-2"></i>Profile
                        </a></li>

                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="p-4">
            <!-- Breadcrumb -->
            @if(!empty($breadcrumbs))
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    @foreach($breadcrumbs as $breadcrumb)
                        @if($loop->last)
                            <li class="breadcrumb-item active">{{ $breadcrumb['name'] }}</li>
                        @else
                            <li class="breadcrumb-item">
                                <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a>
                            </li>
                        @endif
                    @endforeach
                </ol>
            </nav>
            @endif

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery (for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <!-- Custom Admin JS -->
    <script src="{{ asset('admin/js/admin.js') }}"></script>

    <!-- Ensure Alpine.js components are properly initialized -->
    <script>
        document.addEventListener('alpine:init', () => {
            console.log('Alpine.js initialized in admin dashboard');
        });

        // Test if Alpine.js is working and show fallback if needed
        document.addEventListener('DOMContentLoaded', () => {
            console.log('DOM loaded');
            console.log('Alpine available:', typeof Alpine !== 'undefined');
            console.log('Theme toggle element:', document.querySelector('[x-data*="themeToggle"]'));
            console.log('CSRF token:', document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'));

            // Show fallback button if Alpine component doesn't initialize within 3 seconds
            setTimeout(() => {
                const alpineToggle = document.querySelector('[x-data*="themeToggle"]');
                const fallbackToggle = document.getElementById('fallbackThemeToggle');

                if (alpineToggle && !alpineToggle._x_dataStack && fallbackToggle) {
                    console.log('Alpine.js component not initialized, showing fallback');
                    fallbackToggle.classList.remove('d-none');
                }
            }, 3000);
        });

        // Fallback theme toggle function
        function fallbackToggleTheme() {
            console.log('Fallback theme toggle triggered');

            const html = document.documentElement;
            const isDark = html.classList.contains('dark');
            const newTheme = isDark ? 'light' : 'dark';

            // Toggle theme class immediately
            if (isDark) {
                html.classList.remove('dark');
            } else {
                html.classList.add('dark');
            }

            // Try to update server
            fetch('/theme/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log('Fallback theme toggle successful:', data);
            })
            .catch(error => {
                console.error('Fallback theme toggle error:', error);
            });
        }
    </script>

    @stack('scripts')
</body>
</html>
