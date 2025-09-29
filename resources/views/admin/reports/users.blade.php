@extends('layouts.back')

@section('title', 'User Reports')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h4 mb-0">User Reports</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.reports.index') }}">Reports</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
            </nav>
        </div>
        <div class="btn-group">
            <button class="btn btn-outline-success dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="fas fa-download me-2"></i>Export
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#" onclick="exportData('csv')">Export as CSV</a></li>
                <li><a class="dropdown-item" href="#" onclick="exportData('excel')">Export as Excel</a></li>
                <li><a class="dropdown-item" href="#" onclick="exportData('pdf')">Export as PDF</a></li>
            </ul>
        </div>
    </div>

    <!-- Filters -->
    <div class="admin-card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-3">
                    <label for="period" class="form-label">Time Period</label>
                    <select name="period" id="period" class="form-select">
                        <option value="7" {{ request('period') == '7' ? 'selected' : '' }}>Last 7 days</option>
                        <option value="30" {{ request('period') == '30' ? 'selected' : '' }}>Last 30 days</option>
                        <option value="90" {{ request('period') == '90' ? 'selected' : '' }}>Last 3 months</option>
                        <option value="365" {{ request('period') == '365' ? 'selected' : '' }}>Last year</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="role" class="form-label">User Role</label>
                    <select name="role" id="role" class="form-select">
                        <option value="">All Roles</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">All Users</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter me-1"></i>Apply Filters
                        </button>
                        <a href="{{ route('admin.reports.users') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i>Clear
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <!-- Registration Chart -->
        <div class="col-md-8">
            <div class="admin-card shadow-sm mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-chart-line me-2"></i>User Registrations Over Time
                    </h6>
                </div>
                <div class="card-body">
                    <canvas id="registrationChart" height="100"></canvas>
                </div>
            </div>
        </div>

        <!-- Role Distribution -->
        <div class="col-md-4">
            <div class="admin-card shadow-sm mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-chart-pie me-2"></i>Role Distribution
                    </h6>
                </div>
                <div class="card-body">
                    <canvas id="roleChart" height="150"></canvas>
                    <div class="mt-3">
                        @foreach($roleDistribution as $role)
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-capitalize">{{ $role->role }}</span>
                                <span class="fw-bold">{{ $role->count }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Most Active Users -->
    <div class="admin-card shadow-sm">
        <div class="card-header">
            <h6 class="card-title mb-0">
                <i class="fas fa-trophy me-2"></i>Most Active Users
            </h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="admin-table table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Rank</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Habits</th>
                            <th>Challenges</th>
                            <th>Posts</th>
                            <th>Total Score</th>
                            <th>Joined</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activeUsers as $index => $user)
                            <tr>
                                <td>
                                    <span class="badge
                                        @if($index == 0) bg-warning
                                        @elseif($index == 1) bg-secondary
                                        @elseif($index == 2) bg-dark
                                        @else bg-light text-dark
                                        @endif">
                                        #{{ $index + 1 }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="{{ $user->profile_photo_url }}"
                                                 alt="{{ $user->name }}"
                                                 class="rounded-circle" width="32" height="32">
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <div class="fw-bold">{{ $user->name }}</div>
                                            <small class="text-muted text-capitalize">{{ $user->role }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge bg-primary">{{ $user->habits_count }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $user->challenges_count }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-success">{{ $user->posts_count }}</span>
                                </td>
                                <td>
                                    <span class="fw-bold text-primary">
                                        {{ $user->habits_count + $user->challenges_count + $user->posts_count }}
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted">{{ $user->created_at->format('M d, Y') }}</small>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Registration Chart
    const registrationCtx = document.getElementById('registrationChart').getContext('2d');
    const registrationData = @json($registrations);

    new Chart(registrationCtx, {
        type: 'line',
        data: {
            labels: registrationData.map(item => item.date),
            datasets: [{
                label: 'New Registrations',
                data: registrationData.map(item => item.count),
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.1)',
                tension: 0.1,
                fill: true
            }]
        },
        options: {
            responsive: true,
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

    // Role Distribution Chart
    const roleCtx = document.getElementById('roleChart').getContext('2d');
    const roleData = @json($roleDistribution);

    new Chart(roleCtx, {
        type: 'doughnut',
        data: {
            labels: roleData.map(item => item.role.charAt(0).toUpperCase() + item.role.slice(1)),
            datasets: [{
                data: roleData.map(item => item.count),
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
});

function exportData(format) {
    const params = new URLSearchParams(window.location.search);
    params.set('format', format);

    window.location.href = '{{ route("admin.reports.export") }}?' + params.toString();
}
</script>
@endpush
