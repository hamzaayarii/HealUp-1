@extends('layouts.back')

@section('title', 'Users Progress - ' . $habit->name)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h4 mb-0">Users Progress - {{ $habit->name }}</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.habits.index') }}">Habits</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.habits.show', $habit) }}">{{ Str::limit($habit->name, 30) }}</a></li>
                    <li class="breadcrumb-item active">User Progress</li>
                </ol>
            </nav>
        </div>
        <div class="btn-group">
            <a href="{{ route('admin.habits.show', $habit) }}" class="btn btn-outline-primary">
                <i class="fas fa-eye me-2"></i>View Habit
            </a>
            <a href="{{ route('admin.habits.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-list me-2"></i>All Habits
            </a>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h5 class="mb-0">{{ $userHabits->total() }}</h5>
                            <small>Total Users</small>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-users fa-2x opacity-75"></i>
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
                            <h5 class="mb-0">{{ $userHabits->where('is_active', true)->count() }}</h5>
                            <small>Active Users</small>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-user-check fa-2x opacity-75"></i>
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
                            @php
                                $totalProgress = $userHabits->sum(function($userHabit) {
                                    return $userHabit->dailyProgress->count();
                                });
                            @endphp
                            <h5 class="mb-0">{{ $totalProgress }}</h5>
                            <small>Total Entries</small>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-chart-line fa-2x opacity-75"></i>
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
                            @php
                                $completedProgress = $userHabits->sum(function($userHabit) {
                                    return $userHabit->dailyProgress->where('completed', true)->count();
                                });
                                $completionRate = $totalProgress > 0 ? round(($completedProgress / $totalProgress) * 100, 1) : 0;
                            @endphp
                            <h5 class="mb-0">{{ $completionRate }}%</h5>
                            <small>Completion Rate</small>
                        </div>
                        <div class="flex-shrink-0">
                            <i class="fas fa-percentage fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users List -->
    <div class="card shadow-sm">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="mb-0">
                    <i class="fas fa-users me-2"></i>User Progress List
                </h6>
                <div class="btn-group btn-group-sm">
                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fas fa-filter me-1"></i>Filter
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?filter=all">All Users</a></li>
                        <li><a class="dropdown-item" href="?filter=active">Active Only</a></li>
                        <li><a class="dropdown-item" href="?filter=inactive">Inactive Only</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="?sort=recent">Most Recent</a></li>
                        <li><a class="dropdown-item" href="?sort=progress">Best Progress</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            @if($userHabits->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>User</th>
                                <th>Status</th>
                                <th>Progress</th>
                                <th>Streak</th>
                                <th>Completion Rate</th>
                                <th>Started</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($userHabits as $userHabit)
                                @php
                                    $totalEntries = $userHabit->dailyProgress->count();
                                    $completedEntries = $userHabit->dailyProgress->where('completed', true)->count();
                                    $userCompletionRate = $totalEntries > 0 ? round(($completedEntries / $totalEntries) * 100, 1) : 0;

                                    // Calculate current streak
                                    $currentStreak = 0;
                                    $recentProgress = $userHabit->dailyProgress()
                                        ->orderBy('date', 'desc')
                                        ->where('completed', true)
                                        ->limit(30)
                                        ->get();

                                    foreach($recentProgress as $progress) {
                                        if($progress->completed) {
                                            $currentStreak++;
                                        } else {
                                            break;
                                        }
                                    }
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <img src="{{ $userHabit->user->profile_photo_url }}"
                                                     alt="{{ $userHabit->user->name }}"
                                                     class="rounded-circle" width="32" height="32">
                                            </div>
                                            <div class="flex-grow-1 ms-2">
                                                <div class="fw-bold">{{ $userHabit->user->name }}</div>
                                                <small class="text-muted">{{ $userHabit->user->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge {{ $userHabit->is_active ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $userHabit->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 me-2">
                                                <div class="progress" style="height: 8px;">
                                                    <div class="progress-bar bg-success"
                                                         style="width: {{ $userCompletionRate }}%"></div>
                                                </div>
                                            </div>
                                            <small class="text-muted">{{ $completedEntries }}/{{ $totalEntries }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">
                                            {{ $currentStreak }} days
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-bold
                                            @if($userCompletionRate >= 80) text-success
                                            @elseif($userCompletionRate >= 60) text-warning
                                            @else text-danger
                                            @endif">
                                            {{ $userCompletionRate }}%
                                        </span>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $userHabit->created_at->format('M d, Y') }}</small>
                                        <br>
                                        <small class="text-muted">{{ $userHabit->created_at->diffForHumans() }}</small>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="btn btn-outline-primary btn-sm"
                                                    onclick="viewUserProgress({{ $userHabit->id }})"
                                                    title="View Progress">
                                                <i class="fas fa-chart-line"></i>
                                            </button>
                                            <a href="mailto:{{ $userHabit->user->email }}"
                                               class="btn btn-outline-info btn-sm" title="Send Email">
                                                <i class="fas fa-envelope"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($userHabits->hasPages())
                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted">
                                Showing {{ $userHabits->firstItem() }} to {{ $userHabits->lastItem() }}
                                of {{ $userHabits->total() }} results
                            </div>
                            {{ $userHabits->links() }}
                        </div>
                    </div>
                @endif
            @else
                <div class="text-center py-5">
                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No Users Yet</h5>
                    <p class="text-muted">No users have adopted this habit template yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- User Progress Modal -->
<div class="modal fade" id="userProgressModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User Progress Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="progressContent">
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
<script>
function viewUserProgress(userHabitId) {
    const modal = new bootstrap.Modal(document.getElementById('userProgressModal'));
    const content = document.getElementById('progressContent');

    // Show loading
    content.innerHTML = `
        <div class="text-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    `;

    modal.show();

    // Here you would normally fetch the user's progress data via AJAX
    // For now, show a placeholder message
    setTimeout(() => {
        content.innerHTML = `
            <div class="text-center">
                <i class="fas fa-chart-line fa-3x text-muted mb-3"></i>
                <h5>Progress Details</h5>
                <p class="text-muted">Detailed progress tracking would be implemented here.</p>
                <p class="text-muted">This would show daily progress, streaks, and completion patterns.</p>
            </div>
        `;
    }, 1000);
}
</script>
@endpush
