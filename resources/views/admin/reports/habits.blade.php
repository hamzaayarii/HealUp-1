@extends('layouts.back')

@section('title', 'Habit Reports')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h4 mb-0">Habit Reports</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.reports.index') }}">Reports</a></li>
                    <li class="breadcrumb-item active">Habits</li>
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
    <div class="card shadow-sm mb-4">
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
                    <label for="category" class="form-label">Category</label>
                    <select name="category" id="category" class="form-select">
                        <option value="">All Categories</option>
                        @if(isset($categories))
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="sort" class="form-label">Sort By</label>
                    <select name="sort" id="sort" class="form-select">
                        <option value="completion_rate" {{ request('sort') == 'completion_rate' ? 'selected' : '' }}>Completion Rate</option>
                        <option value="users_count" {{ request('sort') == 'users_count' ? 'selected' : '' }}>User Count</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter me-1"></i>Apply Filters
                        </button>
                        <a href="{{ route('admin.reports.habits') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i>Clear
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Summary Stats -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="mb-0">{{ $habitStats->count() }}</h5>
                            <small>Total Habits</small>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-list fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="mb-0">{{ $habitStats->where('completion_rate', '>=', 70)->count() }}</h5>
                            <small>High Performance (70%+)</small>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-trophy fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="mb-0">{{ $habitStats->sum('user_habits_count') }}</h5>
                            <small>Total Adoptions</small>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-users fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="mb-0">{{ round($habitStats->avg('completion_rate'), 1) }}%</h5>
                            <small>Average Completion Rate</small>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-percentage fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Habit Performance Table -->
    <div class="card shadow-sm">
        <div class="card-header">
            <h6 class="mb-0">
                <i class="fas fa-chart-bar me-2"></i>Habit Performance Analysis
            </h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Habit</th>
                            <th>Category</th>
                            <th>Users</th>
                            <th>Total Attempts</th>
                            <th>Completed</th>
                            <th>Completion Rate</th>
                            <th>Difficulty</th>
                            <th>Points</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($habitStats as $habit)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($habit->icon)
                                            <div class="flex-shrink-0 me-2">
                                                <i class="{{ $habit->icon }}"
                                                   @if($habit->color) style="color: {{ $habit->color }}" @endif></i>
                                            </div>
                                        @endif
                                        <div class="flex-grow-1">
                                            <div class="fw-bold">{{ $habit->name }}</div>
                                            <small class="text-muted">{{ Str::limit($habit->description, 50) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($habit->category)
                                        <span class="badge bg-primary">{{ $habit->category->name }}</span>
                                    @else
                                        <span class="text-muted">No category</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $habit->user_habits_count }}</span>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $habit->total_attempts ?? 0 }}</span>
                                </td>
                                <td>
                                    <span class="text-success fw-bold">{{ $habit->completed_attempts ?? 0 }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 me-2">
                                            <div class="progress" style="height: 8px; width: 60px;">
                                                <div class="progress-bar
                                                    @if($habit->completion_rate >= 80) bg-success
                                                    @elseif($habit->completion_rate >= 60) bg-warning
                                                    @else bg-danger
                                                    @endif"
                                                     style="width: {{ $habit->completion_rate }}%"></div>
                                            </div>
                                        </div>
                                        <span class="fw-bold
                                            @if($habit->completion_rate >= 80) text-success
                                            @elseif($habit->completion_rate >= 60) text-warning
                                            @else text-danger
                                            @endif">
                                            {{ round($habit->completion_rate, 1) }}%
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge
                                        @if($habit->difficulty_level == 'easy') bg-success
                                        @elseif($habit->difficulty_level == 'medium') bg-warning
                                        @else bg-danger
                                        @endif">
                                        {{ ucfirst($habit->difficulty_level) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-primary fw-bold">{{ $habit->points_per_completion }}</span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.habits.show', $habit) }}"
                                           class="btn btn-outline-primary btn-sm" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.habits.users', $habit) }}"
                                           class="btn btn-outline-info btn-sm" title="View Users">
                                            <i class="fas fa-users"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-success btn-sm"
                                                onclick="viewTrends({{ $habit->id }})" title="View Trends">
                                            <i class="fas fa-chart-line"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Trends Modal -->
<div class="modal fade" id="trendsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Habit Trends</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="trendsContent">
                    <div class="text-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
function exportData(format) {
    const params = new URLSearchParams(window.location.search);
    params.set('format', format);
    params.set('type', 'habits');

    window.location.href = '{{ route("admin.reports.export") }}?' + params.toString();
}

function viewTrends(habitId) {
    const modal = new bootstrap.Modal(document.getElementById('trendsModal'));
    const content = document.getElementById('trendsContent');

    // Show loading
    content.innerHTML = `
        <div class="text-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    `;

    modal.show();

    // Simulate loading trend data
    setTimeout(() => {
        content.innerHTML = `
            <div class="text-center">
                <i class="fas fa-chart-line fa-3x text-muted mb-3"></i>
                <h5>Habit Trends Analysis</h5>
                <p class="text-muted">Detailed trend analysis would be implemented here.</p>
                <p class="text-muted">This would show completion patterns, user adoption over time, and performance metrics.</p>
                <canvas id="trendChart" height="100"></canvas>
            </div>
        `;

        // Create a sample trend chart
        const ctx = document.getElementById('trendChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [{
                    label: 'Completion Rate',
                    data: [65, 72, 68, 75],
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.1)',
                    tension: 0.1,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    }
                }
            }
        });
    }, 1000);
}
</script>
@endpush
