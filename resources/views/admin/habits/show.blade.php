@extends('layouts.back')

@section('title', 'Habit Details - ' . $habit->name)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h4 mb-0">Habit Details</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.habits.index') }}">Habits</a></li>
                    <li class="breadcrumb-item active">{{ Str::limit($habit->name, 30) }}</li>
                </ol>
            </nav>
        </div>
        <div class="btn-group">
            <a href="{{ route('admin.habits.edit', $habit) }}" class="btn btn-primary">
                <i class="fas fa-edit me-2"></i>Edit Habit
            </a>
            <a href="{{ route('admin.habits.users', $habit) }}" class="btn btn-info">
                <i class="fas fa-users me-2"></i>View Users
            </a>
            <a href="{{ route('admin.habits.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-list me-2"></i>All Habits
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Habit Information -->
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>Habit Information
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="mb-3">{{ $habit->name }}</h5>
                            <p class="text-muted">{{ $habit->description }}</p>

                            <div class="mb-3">
                                <strong>Category:</strong>
                                @if($habit->category)
                                    <span class="badge bg-primary">{{ $habit->category->name }}</span>
                                @else
                                    <span class="text-muted">No category</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <strong>Frequency:</strong>
                                <span class="badge bg-info">{{ ucfirst($habit->frequency) }}</span>
                            </div>

                            <div class="mb-3">
                                <strong>Difficulty Level:</strong>
                                <span class="badge
                                    @if($habit->difficulty_level == 'easy') bg-success
                                    @elseif($habit->difficulty_level == 'medium') bg-warning
                                    @else bg-danger
                                    @endif">
                                    {{ ucfirst($habit->difficulty_level) }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <strong>Points per Completion:</strong>
                                <span class="text-primary fw-bold">{{ $habit->points_per_completion }} points</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            @if($habit->icon)
                                <div class="text-center mb-3">
                                    <i class="{{ $habit->icon }} fa-3x"
                                       @if($habit->color) style="color: {{ $habit->color }}" @endif></i>
                                </div>
                            @endif

                            <div class="mb-3">
                                <strong>Created by:</strong>
                                <span>{{ $habit->user->name }}</span>
                            </div>

                            <div class="mb-3">
                                <strong>Created at:</strong>
                                <span>{{ $habit->created_at->format('M d, Y H:i') }}</span>
                            </div>

                            <div class="mb-3">
                                <strong>Last updated:</strong>
                                <span>{{ $habit->updated_at->format('M d, Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Habits Stats -->
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Usage Statistics
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <div class="border-end">
                                <h4 class="text-primary mb-1">{{ $habit->userHabits->count() }}</h4>
                                <small class="text-muted">Total Users</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="border-end">
                                <h4 class="text-success mb-1">{{ $habit->userHabits->where('is_active', true)->count() }}</h4>
                                <small class="text-muted">Active Users</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="border-end">
                                <h4 class="text-info mb-1">
                                    {{ $habit->userHabits->sum(function($userHabit) {
                                        return $userHabit->dailyProgress->where('completed', true)->count();
                                    }) }}
                                </h4>
                                <small class="text-muted">Total Completions</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h4 class="text-warning mb-1">
                                @php
                                    $totalProgress = $habit->userHabits->sum(function($userHabit) {
                                        return $userHabit->dailyProgress->count();
                                    });
                                    $completedProgress = $habit->userHabits->sum(function($userHabit) {
                                        return $userHabit->dailyProgress->where('completed', true)->count();
                                    });
                                    $completionRate = $totalProgress > 0 ? round(($completedProgress / $totalProgress) * 100, 1) : 0;
                                @endphp
                                {{ $completionRate }}%
                            </h4>
                            <small class="text-muted">Completion Rate</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <!-- Quick Actions -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-bolt me-2"></i>Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.habits.edit', $habit) }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit me-2"></i>Edit Habit
                        </a>
                        <a href="{{ route('admin.habits.users', $habit) }}" class="btn btn-outline-info">
                            <i class="fas fa-users me-2"></i>View Users ({{ $habit->userHabits->count() }})
                        </a>
                        <button type="button" class="btn btn-outline-danger" onclick="confirmDelete()">
                            <i class="fas fa-trash me-2"></i>Delete Habit
                        </button>
                    </div>
                </div>
            </div>

            <!-- Recent Users -->
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-users me-2"></i>Recent Users
                    </h6>
                </div>
                <div class="card-body">
                    @forelse($habit->userHabits->take(5) as $userHabit)
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <img src="{{ $userHabit->user->profile_photo_url }}"
                                     alt="{{ $userHabit->user->name }}"
                                     class="rounded-circle" width="40" height="40">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="fw-bold">{{ $userHabit->user->name }}</div>
                                <small class="text-muted">
                                    Started {{ $userHabit->created_at->diffForHumans() }}
                                </small>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="badge {{ $userHabit->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $userHabit->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted mb-0">No users have adopted this habit yet.</p>
                    @endforelse

                    @if($habit->userHabits->count() > 5)
                        <div class="text-center mt-3">
                            <a href="{{ route('admin.habits.users', $habit) }}" class="btn btn-sm btn-outline-primary">
                                View All {{ $habit->userHabits->count() }} Users
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this habit template?</p>
                <p class="text-danger"><strong>This action cannot be undone.</strong></p>
                <p>This will also affect {{ $habit->userHabits->count() }} users who have adopted this habit.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.habits.destroy', $habit) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Habit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete() {
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endpush
