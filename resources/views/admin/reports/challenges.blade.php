@extends('layouts.back')

@section('title', 'Challenge Reports')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h4 mb-0">Challenge Reports</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.reports.index') }}">Reports</a></li>
                    <li class="breadcrumb-item active">Challenges</li>
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
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">All Challenges</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active Only</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive Only</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="sort" class="form-label">Sort By</label>
                    <select name="sort" id="sort" class="form-select">
                        <option value="completion_rate" {{ request('sort') == 'completion_rate' ? 'selected' : '' }}>Completion Rate</option>
                        <option value="participants" {{ request('sort') == 'participants' ? 'selected' : '' }}>Participants</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter me-1"></i>Apply Filters
                        </button>
                        <a href="{{ route('admin.reports.challenges') }}" class="btn btn-outline-secondary">
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
                            <h5 class="mb-0">{{ $challengeStats->count() }}</h5>
                            <small>Total Challenges</small>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-trophy fa-2x opacity-75"></i>
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
                            <h5 class="mb-0">{{ $challengeStats->where('is_active', true)->count() }}</h5>
                            <small>Active Challenges</small>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-play fa-2x opacity-75"></i>
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
                            <h5 class="mb-0">{{ $challengeStats->sum('participations_count') }}</h5>
                            <small>Total Participants</small>
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
                            <h5 class="mb-0">{{ round($challengeStats->avg('completion_rate'), 1) }}%</h5>
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

    <!-- Challenge Performance Table -->
    <div class="admin-card shadow-sm">
        <div class="card-header">
            <h6 class="card-title mb-0">
                <i class="fas fa-chart-bar me-2"></i>Challenge Performance Analysis
            </h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="admin-table table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Challenge</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Duration</th>
                            <th>Participants</th>
                            <th>Completions</th>
                            <th>Completion Rate</th>
                            <th>Reward</th>
                            <th>Period</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($challengeStats as $challenge)
                            <tr>
                                <td>
                                    <div>
                                        <div class="fw-bold">{{ $challenge->title }}</div>
                                        <small class="text-muted">{{ Str::limit($challenge->description, 50) }}</small>
                                    </div>
                                </td>
                                <td>
                                    @if($challenge->category)
                                        <span class="badge bg-primary">{{ $challenge->category->name }}</span>
                                    @else
                                        <span class="text-muted">No category</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $challenge->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $challenge->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $challenge->duration }} days</span>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $challenge->period_participations ?? $challenge->participations_count }}</span>
                                </td>
                                <td>
                                    <span class="text-success fw-bold">{{ $challenge->period_completions ?? 0 }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 me-2">
                                            <div class="progress" style="height: 8px; width: 60px;">
                                                <div class="progress-bar
                                                    @if($challenge->completion_rate >= 80) bg-success
                                                    @elseif($challenge->completion_rate >= 60) bg-warning
                                                    @else bg-danger
                                                    @endif"
                                                     style="width: {{ $challenge->completion_rate }}%"></div>
                                            </div>
                                        </div>
                                        <span class="fw-bold
                                            @if($challenge->completion_rate >= 80) text-success
                                            @elseif($challenge->completion_rate >= 60) text-warning
                                            @else text-danger
                                            @endif">
                                            {{ round($challenge->completion_rate, 1) }}%
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-primary fw-bold">{{ $challenge->reward }}</span>
                                </td>
                                <td>
                                    @if($challenge->start_date && $challenge->end_date)
                                        <small class="text-muted">
                                            {{ $challenge->start_date->format('M d') }} -
                                            {{ $challenge->end_date->format('M d, Y') }}
                                        </small>
                                    @else
                                        <small class="text-muted">Not scheduled</small>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.challenges.show', $challenge) }}"
                                           class="btn btn-outline-primary btn-sm" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.challenges.participants', $challenge) }}"
                                           class="btn btn-outline-info btn-sm" title="View Participants">
                                            <i class="fas fa-users"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-success btn-sm"
                                                onclick="viewParticipationTrends({{ $challenge->id }})" title="View Trends">
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

    <!-- Top Performing Challenges -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="admin-card shadow-sm">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-medal me-2"></i>Top Performing Challenges
                    </h6>
                </div>
                <div class="card-body">
                    @foreach($challengeStats->sortByDesc('completion_rate')->take(5) as $index => $challenge)
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <span class="badge
                                    @if($index == 0) bg-warning
                                    @elseif($index == 1) bg-secondary
                                    @elseif($index == 2) bg-dark
                                    @else bg-light text-dark
                                    @endif">
                                    #{{ $index + 1 }}
                                </span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="fw-bold">{{ $challenge->title }}</div>
                                <small class="text-muted">{{ round($challenge->completion_rate, 1) }}% completion rate</small>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="badge bg-info">{{ $challenge->participations_count }} users</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="admin-card shadow-sm">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-fire me-2"></i>Most Popular Challenges
                    </h6>
                </div>
                <div class="card-body">
                    @foreach($challengeStats->sortByDesc('participations_count')->take(5) as $index => $challenge)
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <span class="badge
                                    @if($index == 0) bg-warning
                                    @elseif($index == 1) bg-secondary
                                    @elseif($index == 2) bg-dark
                                    @else bg-light text-dark
                                    @endif">
                                    #{{ $index + 1 }}
                                </span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="fw-bold">{{ $challenge->title }}</div>
                                <small class="text-muted">{{ $challenge->participations_count }} participants</small>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="badge bg-success">{{ round($challenge->completion_rate, 1) }}%</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Participation Trends Modal -->
<div class="modal fade" id="trendsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Challenge Participation Trends</h5>
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
    params.set('type', 'challenges');

    window.location.href = '{{ route("admin.reports.export") }}?' + params.toString();
}

function viewParticipationTrends(challengeId) {
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
                <h5>Challenge Participation Trends</h5>
                <p class="text-muted">Detailed participation analysis would be implemented here.</p>
                <p class="text-muted">This would show participation patterns, completion rates over time, and user engagement metrics.</p>
                <canvas id="participationChart" height="100"></canvas>
            </div>
        `;

        // Create a sample participation chart
        const ctx = document.getElementById('participationChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                datasets: [{
                    label: 'New Participants',
                    data: [12, 19, 8, 15],
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.1)',
                    tension: 0.1,
                    fill: false
                }, {
                    label: 'Completions',
                    data: [8, 15, 6, 12],
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132, 0.1)',
                    tension: 0.1,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
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
    }, 1000);
}
</script>
@endpush
