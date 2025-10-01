@extends('layouts.back')

@section('title', 'Reports & Analytics')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Reports & Analytics</h1>
            <p class="text-muted">System insights and performance metrics</p>
        </div>
        <div class="btn-group">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="fas fa-download me-2"></i>Export Data
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('admin.reports.export', ['type' => 'users', 'format' => 'csv']) }}">
                    <i class="fas fa-users me-2"></i>Users Data (CSV)
                </a></li>
                <li><a class="dropdown-item" href="{{ route('admin.reports.export', ['type' => 'habits', 'format' => 'csv']) }}">
                    <i class="fas fa-calendar-check me-2"></i>Habits Data (CSV)
                </a></li>
                <li><a class="dropdown-item" href="{{ route('admin.reports.export', ['type' => 'challenges', 'format' => 'csv']) }}">
                    <i class="fas fa-trophy me-2"></i>Challenges Data (CSV)
                </a></li>
            </ul>
        </div>
    </div>

    <!-- Overview Stats -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="stats-number">{{ $stats['total_users'] }}</div>
                        <div class="stats-label">Total Users</div>
                        <div class="stats-change text-success">
                            <i class="fas fa-arrow-up me-1"></i>+{{ $stats['active_users'] }} active
                        </div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="stats-number">{{ $stats['total_habits'] }}</div>
                        <div class="stats-label">Habit Templates</div>
                        <div class="stats-change">
                            Available for tracking
                        </div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card" style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="stats-number">{{ $stats['total_challenges'] }}</div>
                        <div class="stats-label">Total Challenges</div>
                        <div class="stats-change text-success">
                            {{ $stats['active_challenges'] }} active
                        </div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card" style="background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="stats-number">{{ number_format(($stats['active_users'] / max($stats['total_users'], 1)) * 100, 1) }}%</div>
                        <div class="stats-label">Engagement Rate</div>
                        <div class="stats-change">
                            Last 7 days activity
                        </div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- User Growth Chart -->
        <div class="col-lg-8 mb-4">
            <div class="admin-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-area me-2"></i>
                        User Growth (Last 30 Days)
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="userGrowthChart" height="100"></canvas>
                </div>
            </div>
        </div>

        <!-- Quick Report Links -->
        <div class="col-lg-4 mb-4">
            <div class="admin-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-tachometer-alt me-2"></i>
                        Quick Reports
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.reports.users') }}" class="btn btn-outline-primary">
                            <i class="fas fa-users me-2"></i>User Analytics
                        </a>
                        <a href="{{ route('admin.reports.habits') }}" class="btn btn-outline-success">
                            <i class="fas fa-calendar-check me-2"></i>Habit Performance
                        </a>
                        <a href="{{ route('admin.reports.challenges') }}" class="btn btn-outline-warning">
                            <i class="fas fa-trophy me-2"></i>Challenge Statistics
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Popular Habits -->
        <div class="col-lg-6 mb-4">
            <div class="admin-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-star me-2"></i>
                        Most Popular Habits
                    </h5>
                </div>
                <div class="card-body">
                    @forelse($popularHabits as $habit)
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            @if($habit->icon)
                                <i class="{{ $habit->icon }} me-2"></i>
                            @endif
                            <div>
                                <div class="fw-medium">{{ $habit->name }}</div>
                                <small class="text-muted">{{ $habit->category->name ?? 'Uncategorized' }}</small>
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold">{{ $habit->user_habits_count }}</div>
                            <small class="text-muted">users</small>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-muted">
                        <i class="fas fa-calendar-check fa-2x mb-2"></i>
                        <p>No habit data available</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Challenge Statistics -->
        <div class="col-lg-6 mb-4">
            <div class="admin-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-trophy me-2"></i>
                        Top Challenges
                    </h5>
                </div>
                <div class="card-body">
                    @forelse($challengeStats as $challenge)
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <div class="fw-medium">{{ $challenge->title }}</div>
                            <small class="text-muted">
                                {{ $challenge->category->name ?? 'Uncategorized' }} • {{ $challenge->duration_days }} days
                            </small>
                            <div class="mt-1">
                                <span class="badge bg-{{ $challenge->difficulty_level === 'easy' ? 'success' : ($challenge->difficulty_level === 'medium' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($challenge->difficulty_level) }}
                                </span>
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold">{{ $challenge->participations_count }}</div>
                            <small class="text-muted">participants</small>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-muted">
                        <i class="fas fa-trophy fa-2x mb-2"></i>
                        <p>No challenge data available</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// User Growth Chart
const ctx = document.getElementById('userGrowthChart').getContext('2d');
const userGrowthData = @json($userGrowth);

new Chart(ctx, {
    type: 'line',
    data: {
        labels: userGrowthData.map(item => new Date(item.date).toLocaleDateString()),
        datasets: [{
            label: 'New Users',
            data: userGrowthData.map(item => item.count),
            borderColor: 'rgb(16, 185, 129)',
            backgroundColor: 'rgba(16, 185, 129, 0.1)',
            borderWidth: 2,
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});
</script>
@endpush
