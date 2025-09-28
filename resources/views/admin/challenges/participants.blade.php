@extends('layouts.back')

@section('title', 'Challenge Participants - ' . $challenge->title)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h4 mb-0">Challenge Participants</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.challenges.index') }}">Challenges</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.challenges.show', $challenge) }}">{{ Str::limit($challenge->title, 30) }}</a></li>
                    <li class="breadcrumb-item active">Participants</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.challenges.show', $challenge) }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i>Back to Challenge
        </a>
    </div>

    <!-- Challenge Info Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h5 class="card-title mb-2">{{ $challenge->title }}</h5>
                    <p class="text-muted mb-0">{{ Str::limit($challenge->description, 100) }}</p>
                </div>
                <div class="col-md-4 text-end">
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="fw-bold text-primary">{{ $challenge->participations->count() }}</div>
                            <small class="text-muted">Total</small>
                        </div>
                        <div class="col-4">
                            <div class="fw-bold text-success">{{ $challenge->participations->where('completed', true)->count() }}</div>
                            <small class="text-muted">Completed</small>
                        </div>
                        <div class="col-4">
                            <div class="fw-bold text-warning">{{ $challenge->participations->where('completed', false)->count() }}</div>
                            <small class="text-muted">In Progress</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Participants Table -->
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">
                <i class="fas fa-users me-2"></i>Challenge Participants
            </h6>
            <span class="badge bg-primary">{{ $challenge->participations->count() }} participants</span>
        </div>
        <div class="card-body p-0">
            @if($challenge->participations->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Participant</th>
                                <th>Status</th>
                                <th>Progress</th>
                                <th>Joined Date</th>
                                <th>Completed Date</th>
                                <th>Points Earned</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($participants as $participation)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-3">
                                                @if($participation->user->profile_photo_url)
                                                    <img src="{{ $participation->user->profile_photo_url }}"
                                                         alt="{{ $participation->user->name }}"
                                                         class="rounded-circle" width="40" height="40">
                                                @else
                                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                                                         style="width: 40px; height: 40px;">
                                                        {{ strtoupper(substr($participation->user->name, 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="fw-medium">{{ $participation->user->name }}</div>
                                                <small class="text-muted">{{ $participation->user->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($participation->completed)
                                            <span class="badge bg-success">
                                                <i class="fas fa-check me-1"></i>Completed
                                            </span>
                                        @else
                                            <span class="badge bg-warning">
                                                <i class="fas fa-clock me-1"></i>In Progress
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress me-2" style="width: 100px; height: 8px;">
                                                <div class="progress-bar" role="progressbar"
                                                     style="width: {{ $participation->current_progress }}%"
                                                     aria-valuenow="{{ $participation->current_progress }}"
                                                     aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="text-muted small">{{ $participation->current_progress }}%</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span title="{{ $participation->joined_at->format('F d, Y \a\t g:i A') }}">
                                            {{ $participation->joined_at->format('M d, Y') }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($participation->completed_at)
                                            <span title="{{ $participation->completed_at->format('F d, Y \a\t g:i A') }}">
                                                {{ $participation->completed_at->format('M d, Y') }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($participation->points_earned)
                                            <span class="badge bg-success">
                                                <i class="fas fa-star me-1"></i>{{ $participation->points_earned }}
                                            </span>
                                        @else
                                            <span class="text-muted">0</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.users.show', $participation->user) }}"
                                               class="btn btn-outline-primary" title="View User">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if(!$participation->completed)
                                                <button type="button" class="btn btn-outline-success"
                                                        onclick="markAsCompleted({{ $participation->id }})"
                                                        title="Mark as Completed">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $participants->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-users text-muted" style="font-size: 3rem;"></i>
                    <h6 class="mt-3 text-muted">No Participants Yet</h6>
                    <p class="text-muted">This challenge hasn't attracted any participants yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Mark as Completed Modal -->
<div class="modal fade" id="markCompletedModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mark as Completed</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to mark this participation as completed?</p>
                <div class="mb-3">
                    <label for="pointsEarned" class="form-label">Points to Award</label>
                    <input type="number" class="form-control" id="pointsEarned" min="0" max="1000" value="{{ $challenge->points_reward }}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="confirmComplete">Mark as Completed</button>
            </div>
        </div>
    </div>
</div>

<script>
let currentParticipationId = null;

function markAsCompleted(participationId) {
    currentParticipationId = participationId;
    new bootstrap.Modal(document.getElementById('markCompletedModal')).show();
}

document.getElementById('confirmComplete').addEventListener('click', function() {
    if (currentParticipationId) {
        // Here you would typically make an AJAX call to mark as completed
        // For now, we'll just reload the page
        window.location.reload();
    }
});
</script>
@endsection
