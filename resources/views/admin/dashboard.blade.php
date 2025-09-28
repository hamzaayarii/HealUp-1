@extends('layouts.back')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="admin-card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h2>
                            <p class="text-muted mb-0">
                                Here's what's happening with HealUp today. Manage your platform effectively.
                            </p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="float-animation">
                                <img src="{{ asset('images/logos/healup.svg') }}" alt="HealUp" class="img-fluid" style="max-width: 80px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card d-flex align-items-center">
                <div class="flex-grow-1">
                    <div class="stats-number">{{ \App\Models\User::count() }}</div>
                    <div class="stats-label">Total Users</div>
                </div>
                <div class="stats-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card d-flex align-items-center" style="background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);">
                <div class="flex-grow-1">
                    <div class="stats-number">{{ \App\Models\Habit::count() }}</div>
                    <div class="stats-label">Active Habits</div>
                </div>
                <div class="stats-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card d-flex align-items-center" style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);">
                <div class="flex-grow-1">
                    <div class="stats-number">{{ \App\Models\Challenge::count() }}</div>
                    <div class="stats-label">Challenges</div>
                </div>
                <div class="stats-icon">
                    <i class="fas fa-trophy"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card d-flex align-items-center" style="background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);">
                <div class="flex-grow-1">
                    <div class="stats-number">{{ \App\Models\Team::count() }}</div>
                    <div class="stats-label">Teams</div>
                </div>
                <div class="stats-icon">
                    <i class="fas fa-users-cog"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <div class="col-lg-8 mb-4">
            <div class="admin-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-line me-2"></i>
                        User Registration Trend
                    </h5>
                </div>
                <div class="card-body">
                    <div style="height: 300px;">
                        <canvas id="usersChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="admin-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-pie me-2"></i>
                        User Activity
                    </h5>
                </div>
                <div class="card-body">
                    <div style="height: 300px;">
                        <canvas id="activityChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity and Quick Actions -->
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="admin-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-clock me-2"></i>
                        Recent Users
                    </h5>
                    <button class="btn btn-healup btn-sm" disabled title="Coming Soon">
                        View All <i class="fas fa-arrow-right ms-1"></i>
                    </button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Joined</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(\App\Models\User::latest()->take(5)->get() as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $user->profile_photo_url }}"
                                                 alt="{{ $user->name }}"
                                                 class="rounded-circle me-2"
                                                 style="width: 32px; height: 32px;">
                                            <strong>{{ $user->name }}</strong>
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <span class="status-badge status-active">Active</span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button class="btn btn-outline-primary" title="View">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-outline-secondary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-outline-danger" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">No users found</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="admin-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt me-2"></i>
                        Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button class="btn btn-healup" disabled title="Coming Soon">
                            <i class="fas fa-user-plus me-2"></i>Add New User
                        </button>
                        <button class="btn btn-outline-primary" disabled title="Coming Soon">
                            <i class="fas fa-trophy me-2"></i>Create Challenge
                        </button>
                        <button class="btn btn-outline-secondary" disabled title="Coming Soon">
                            <i class="fas fa-plus me-2"></i>Add Habit Template
                        </button>
                        <button class="btn btn-outline-info" disabled title="Coming Soon">
                            <i class="fas fa-chart-bar me-2"></i>View Reports
                        </button>
                    </div>
                </div>
            </div>

            <div class="admin-card mt-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        System Info
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="text-center">
                                <div class="text-success fw-bold fs-4">{{ number_format(disk_free_space('/') / 1024 / 1024 / 1024, 1) }}GB</div>
                                <small class="text-muted">Free Space</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <div class="text-info fw-bold fs-4">{{ PHP_VERSION }}</div>
                                <small class="text-muted">PHP Version</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <div class="text-warning fw-bold fs-4">{{ app()->version() }}</div>
                                <small class="text-muted">Laravel</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <div class="text-primary fw-bold fs-4">{{ round(memory_get_usage() / 1024 / 1024, 1) }}MB</div>
                                <small class="text-muted">Memory Usage</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize charts with sample data
    const usersCtx = document.getElementById('usersChart');
    if (usersCtx) {
        new Chart(usersCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'New Users',
                    data: [12, 19, 15, 25, 22, 30],
                    borderColor: '#10B981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4,
                    fill: true
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
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }

    const activityCtx = document.getElementById('activityChart');
    if (activityCtx) {
        new Chart(activityCtx, {
            type: 'doughnut',
            data: {
                labels: ['Active', 'Inactive', 'Pending'],
                datasets: [{
                    data: [65, 25, 10],
                    backgroundColor: ['#10B981', '#EF4444', '#F59E0B'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                }
            }
        });
    }
});
</script>
@endpush
