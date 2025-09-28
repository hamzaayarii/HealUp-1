@extends('layouts.back')

@section('title', 'Challenge Management')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Challenge Management</h1>
            <p class="text-muted">Manage health and fitness challenges</p>
        </div>
        <a href="{{ route('admin.challenges.create') }}" class="btn btn-healup">
            <i class="fas fa-plus me-2"></i>Create Challenge
        </a>
    </div>

    <!-- Filters & Search -->
    <div class="admin-card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Search Challenges</label>
                    <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                           placeholder="Search by title or description...">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Filter by Category</label>
                    <select class="form-select" name="category">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status">
                        <option value="">All Status</option>
                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-search me-1"></i>Filter
                    </button>
                    <a href="{{ route('admin.challenges.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i>Clear
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="stats-number">{{ $challenges->total() }}</div>
                        <div class="stats-label">Total Challenges</div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="stats-number">{{ \App\Models\Challenge::where('is_active', true)->count() }}</div>
                        <div class="stats-label">Active</div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-play"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card" style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="stats-number">{{ \App\Models\Challenge::where('is_active', false)->count() }}</div>
                        <div class="stats-label">Inactive</div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-pause"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card" style="background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="stats-number">{{ \App\Models\Participation::count() }}</div>
                        <div class="stats-label">Participations</div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Challenges Grid -->
    <div class="row">
        @forelse($challenges as $challenge)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="admin-card h-100">
                <div class="card-header d-flex justify-content-between align-items-start">
                    <div class="flex-grow-1">
                        <h6 class="card-title mb-1">{{ $challenge->title }}</h6>
                        <small class="text-muted">{{ $challenge->category->name ?? 'Uncategorized' }}</small>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.challenges.show', $challenge) }}">
                                <i class="fas fa-eye me-2"></i>View Details
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.challenges.edit', $challenge) }}">
                                <i class="fas fa-edit me-2"></i>Edit
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.challenges.participants', $challenge) }}">
                                <i class="fas fa-users me-2"></i>Participants
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#" onclick="deleteChallenge({{ $challenge->id }}, '{{ $challenge->title }}')">
                                <i class="fas fa-trash me-2"></i>Delete
                            </a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text text-muted small">{{ Str::limit($challenge->description, 100) }}</p>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <div class="text-center p-2 bg-light rounded">
                                <div class="fw-bold text-primary">{{ $challenge->duration_days }}</div>
                                <small class="text-muted">Days</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-2 bg-light rounded">
                                <div class="fw-bold text-success">{{ $challenge->points_reward }}</div>
                                <small class="text-muted">Points</small>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <span class="status-badge {{ $challenge->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $challenge->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        <span class="badge bg-{{ $challenge->difficulty_level === 'easy' ? 'success' : ($challenge->difficulty_level === 'medium' ? 'warning' : 'danger') }}">
                            {{ ucfirst($challenge->difficulty_level) }}
                        </span>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            <i class="fas fa-users me-1"></i>{{ $challenge->participations_count ?? 0 }} participants
                        </small>
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-outline-{{ $challenge->is_active ? 'warning' : 'success' }}"
                                    onclick="toggleStatus({{ $challenge->id }})">
                                <i class="fas fa-{{ $challenge->is_active ? 'pause' : 'play' }}"></i>
                            </button>
                            <a href="{{ route('admin.challenges.show', $challenge) }}" class="btn btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="admin-card text-center py-5">
                <i class="fas fa-trophy fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No challenges found</h5>
                <p class="text-muted">Create your first challenge to get started</p>
                <a href="{{ route('admin.challenges.create') }}" class="btn btn-healup">
                    <i class="fas fa-plus me-2"></i>Create Challenge
                </a>
            </div>
        </div>
        @endforelse
    </div>

    @if($challenges->hasPages())
    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $challenges->links() }}
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
                <p>Are you sure you want to delete challenge <strong id="challengeName"></strong>?</p>
                <p class="text-warning"><i class="fas fa-exclamation-triangle me-1"></i>This action cannot be undone and will affect all participants.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Challenge</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function deleteChallenge(challengeId, challengeName) {
    document.getElementById('challengeName').textContent = challengeName;
    document.getElementById('deleteForm').action = `/admin/challenges/${challengeId}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

function toggleStatus(challengeId) {
    fetch(`/admin/challenges/${challengeId}/toggle-status`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endpush
