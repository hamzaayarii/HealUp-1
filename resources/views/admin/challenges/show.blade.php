@extends('layouts.back')

@section            <div class="admin-card shadow-sm mb-4">
                <div class="card-header d-flex justify-content-between align-items-ce            <div class="admin-card shadow-sm">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Statistics
                    </h6>
                </div>
                    <h6 cla            <div class="admin-card shadow-sm mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-cogs me-2"></i>Quick Actions
                    </h6>
                </div>rd-title mb-0">
                        <i class="fas fa-trophy me-2"></i>Challenge Details
                    </h6>le', 'Challenge Details - ' . $challenge->title)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h4 mb-0">Challenge Details</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.challenges.index') }}">Challenges</a></li>
                    <li class="breadcrumb-item active">{{ Str::limit($challenge->title, 30) }}</li>
                </ol>
            </nav>
        </div>
        <div class="btn-group">
            <a href="{{ route('admin.challenges.edit', $challenge) }}" class="btn btn-primary">
                <i class="fas fa-edit me-2"></i>Edit Challenge
            </a>
            <a href="{{ route('admin.challenges.participants', $challenge) }}" class="btn btn-info">
                <i class="fas fa-users me-2"></i>View Participants ({{ $challenge->participations->count() }})
            </a>
            <button type="button" class="btn btn-outline-danger" onclick="confirmDelete()">
                <i class="fas fa-trash me-2"></i>Delete
            </button>
        </div>
    </div>

    <div class="row">
        <!-- Main Challenge Info -->
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">
                        <i class="fas fa-trophy me-2"></i>Challenge Information
                    </h6>
                    <div>
                        @if($challenge->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $challenge->title }}</h5>
                    <p class="card-text">{{ $challenge->description }}</p>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h6 class="text-muted">Challenge Details</h6>
                            <ul class="list-unstyled">
                                <li><strong>Duration:</strong> {{ $challenge->duration }} days</li>
                                @if($challenge->objectif)
                                    <li class="mt-2"><strong>Objective:</strong> {{ $challenge->objectif }}</li>
                                @endif
                                <li class="mt-2"><strong>Reward:</strong>
                                    <span class="badge bg-success">
                                        <i class="fas fa-star me-1"></i>{{ $challenge->reward }}
                                    </span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Challenge Timeline</h6>
                            <ul class="list-unstyled">
                                <li><strong>Created:</strong> {{ $challenge->created_at->format('M d, Y') }}</li>
                                <li class="mt-2"><strong>Updated:</strong> {{ $challenge->updated_at->format('M d, Y') }}</li>
                                @if($challenge->start_date)
                                    <li class="mt-2"><strong>Start Date:</strong> {{ $challenge->start_date->format('M d, Y') }}</li>
                                @endif
                                @if($challenge->end_date)
                                    <li class="mt-2"><strong>End Date:</strong> {{ $challenge->end_date->format('M d, Y') }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Participants Overview -->
            <div class="admin-card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-users me-2"></i>Recent Participants
                    </h6>
                    <a href="{{ route('admin.challenges.participants', $challenge) }}" class="btn btn-sm btn-outline-primary">
                        View All
                    </a>
                </div>
                <div class="card-body">
                    @if($challenge->participations->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>Participant</th>
                                        <th>Progress</th>
                                        <th>Status</th>
                                        <th>Joined</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($challenge->participations->take(5) as $participation)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-2">
                                                        @if($participation->user->profile_photo_url)
                                                            <img src="{{ $participation->user->profile_photo_url }}"
                                                                 alt="{{ $participation->user->name }}"
                                                                 class="rounded-circle" width="30" height="30">
                                                        @else
                                                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                                                                 style="width: 30px; height: 30px; font-size: 12px;">
                                                                {{ strtoupper(substr($participation->user->name, 0, 1)) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <span>{{ $participation->user->name }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="progress me-2" style="width: 80px; height: 6px;">
                                                        <div class="progress-bar" role="progressbar"
                                                             style="width: {{ $participation->current_progress }}%"></div>
                                                    </div>
                                                    <small>{{ $participation->current_progress }}%</small>
                                                </div>
                                            </td>
                                            <td>
                                                @if($participation->completed)
                                                    <span class="badge bg-success">Completed</span>
                                                @else
                                                    <span class="badge bg-warning">In Progress</span>
                                                @endif
                                            </td>
                                            <td>
                                                <small>{{ $participation->joined_at->format('M d') }}</small>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-users text-muted" style="font-size: 2rem;"></i>
                            <p class="text-muted mt-2 mb-0">No participants yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Stats Sidebar -->
        <div class="col-md-4">
            <!-- Quick Stats -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Challenge Statistics
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-12 mb-3">
                            <div class="stats-item">
                                <div class="stats-number text-primary">{{ $challenge->participations->count() }}</div>
                                <div class="stats-label text-muted">Total Participants</div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="stats-item">
                                <div class="stats-number text-success">{{ $challenge->participations->where('completed', true)->count() }}</div>
                                <div class="stats-label text-muted">Completed</div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="stats-item">
                                <div class="stats-number text-warning">{{ $challenge->participations->where('completed', false)->count() }}</div>
                                <div class="stats-label text-muted">In Progress</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="stats-item">
                                <div class="stats-number text-info">
                                    {{ $challenge->participations->count() > 0 ? round(($challenge->participations->where('completed', true)->count() / $challenge->participations->count()) * 100, 1) : 0 }}%
                                </div>
                                <div class="stats-label text-muted">Completion Rate</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-cogs me-2"></i>Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <form action="{{ route('admin.challenges.toggle-status', $challenge) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-{{ $challenge->is_active ? 'warning' : 'success' }} w-100">
                                <i class="fas fa-{{ $challenge->is_active ? 'pause' : 'play' }} me-2"></i>
                                {{ $challenge->is_active ? 'Deactivate' : 'Activate' }} Challenge
                            </button>
                        </form>

                        <a href="{{ route('admin.challenges.edit', $challenge) }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit me-2"></i>Edit Challenge
                        </a>

                        <a href="{{ route('admin.challenges.participants', $challenge) }}" class="btn btn-outline-info">
                            <i class="fas fa-users me-2"></i>Manage Participants
                        </a>

                        <button type="button" class="btn btn-outline-danger" onclick="confirmDelete()">
                            <i class="fas fa-trash me-2"></i>Delete Challenge
                        </button>
                    </div>
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
                <h5 class="modal-title">Delete Challenge</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this challenge? This action cannot be undone.</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    This will also remove all associated participations and data.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.challenges.destroy', $challenge) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Challenge</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete() {
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>

<style>
.stats-item {
    padding: 10px 0;
}

.stats-number {
    font-size: 1.5rem;
    font-weight: bold;
    line-height: 1;
}

.stats-label {
    font-size: 0.8rem;
    margin-top: 5px;
}

.avatar-sm img,
.avatar-sm div {
    object-fit: cover;
}
</style>
@endsection
