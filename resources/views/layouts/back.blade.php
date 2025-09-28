<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ request()->cookie('theme', 'light') === 'dark' ? 'dark' : '' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="font-sans antialiased">
    <!-- Sidebar -->
    <nav class="admin-sidebar" id="adminSidebar">
        <!-- Sidebar Header -->
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <img src="{{ asset('images/logos/healup.svg') }}" alt="HealUp" class="w-8 h-8">
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
                    <a class="nav-link {{ request()->routeIs('admin.challenges.*') ? 'active' : '' }}" href="{{ route('admin.challenges.index') }}" data-tooltip="Challenges">
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
                <!-- Theme Toggle -->
                <button class="btn btn-link text-decoration-none me-3" id="themeToggle" title="Toggle Dark Mode">
                    <i class="fas fa-moon fa-lg"></i>
                </button>

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
                        <li><a class="dropdown-item" href="{{ route('profile.show') }}">
                            <i class="fas fa-user me-2"></i>Profile
                        </a></li>
                        <li><a class="dropdown-item" href="{{ route('dashboard') }}">
                            <i class="fas fa-home me-2"></i>Main Site
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

    @stack('scripts')
</body>
</html>
