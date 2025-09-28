@extends('layouts.back')

@section('title', 'Habit Management')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Habit Management</h1>
            <p class="text-muted">Manage habit templates and tracking</p>
        </div>
        <a href="{{ route('admin.habits.create') }}" class="btn btn-healup">
            <i class="fas fa-plus me-2"></i>Add Habit Template
        </a>
    </div>

    <!-- Quick Stats -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="stats-number">{{ $habits->total() }}</div>
                        <div class="stats-label">Total Habits</div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="stats-number">{{ \App\Models\UserHabit::count() }}</div>
                        <div class="stats-label">Active Trackings</div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card" style="background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="stats-number">{{ \App\Models\DailyProgress::where('completed', true)->count() }}</div>
                        <div class="stats-label">Completions</div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card" style="background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="stats-number">{{ $categories->count() }}</div>
                        <div class="stats-label">Categories</div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-tags"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Habits Grid -->
    <div class="row">
        @forelse($habits as $habit)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="admin-card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        @if($habit->icon)
                            <i class="{{ $habit->icon }} me-2"></i>
                        @endif
                        <div>
                            <h6 class="card-title mb-0">{{ $habit->name }}</h6>
                            <small class="text-muted">{{ $habit->category->name ?? 'Uncategorized' }}</small>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.habits.show', $habit) }}">
                                <i class="fas fa-eye me-2"></i>View Details
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.habits.edit', $habit) }}">
                                <i class="fas fa-edit me-2"></i>Edit
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.habits.users', $habit) }}">
                                <i class="fas fa-users me-2"></i>User Progress
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#" onclick="deleteHabit({{ $habit->id }}, '{{ $habit->name }}')">
                                <i class="fas fa-trash me-2"></i>Delete
                            </a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text text-muted small">{{ Str::limit($habit->description, 100) }}</p>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <div class="text-center p-2 bg-light rounded">
                                <div class="fw-bold text-primary">{{ ucfirst($habit->frequency) }}</div>
                                <small class="text-muted">Frequency</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-2 bg-light rounded">
                                <div class="fw-bold text-success">{{ $habit->points_per_completion }}</div>
                                <small class="text-muted">Points</small>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-{{ $habit->difficulty_level === 'easy' ? 'success' : ($habit->difficulty_level === 'medium' ? 'warning' : 'danger') }}">
                            {{ ucfirst($habit->difficulty_level) }}
                        </span>
                        @if($habit->color)
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle me-2" style="width: 20px; height: 20px; background-color: {{ $habit->color }};"></div>
                                <small class="text-muted">{{ $habit->color }}</small>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            <i class="fas fa-users me-1"></i>{{ $habit->user_habits_count ?? 0 }} users tracking
                        </small>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('admin.habits.show', $habit) }}" class="btn btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.habits.edit', $habit) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="admin-card text-center py-5">
                <i class="fas fa-calendar-check fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No habit templates found</h5>
                <p class="text-muted">Create your first habit template to get started</p>
                <a href="{{ route('admin.habits.create') }}" class="btn btn-healup">
                    <i class="fas fa-plus me-2"></i>Add Habit Template
                </a>
            </div>
        </div>
        @endforelse
    </div>

    @if($habits->hasPages())
    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $habits->links() }}
    </div>
    @endif
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete habit template <strong id="habitName"></strong>?</p>
                <p class="text-warning"><i class="fas fa-exclamation-triangle me-1"></i>This will also remove all user progress for this habit.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
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
function deleteHabit(habitId, habitName) {
    document.getElementById('habitName').textContent = habitName;
    document.getElementById('deleteForm').action = `/admin/habits/${habitId}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endpush
