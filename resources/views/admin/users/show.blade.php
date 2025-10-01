@extends('layouts.back')

@section('title', 'User Details')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">User Details</h1>
            <p class="text-muted">View and manage user information</p>
        </div>
        <div class="btn-group">
            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">
                <i class="fas fa-edit me-2"></i>Edit User
            </a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Users
            </a>
        </div>
    </div>

    <div class="row">
        <!-- User Profile Card -->
        <div class="col-lg-4 mb-4">
            <div class="admin-card text-center">
                <div class="card-body">
                    <img src="{{ $user->profile_photo_url }}"
                         alt="{{ $user->name }}"
                         class="rounded-circle mb-3"
                         style="width: 120px; height: 120px; object-fit: cover;">

                    <h4 class="mb-1">{{ $user->name }}</h4>
                    <p class="text-muted mb-3">{{ $user->email }}</p>

                    <div class="d-flex justify-content-center gap-2 mb-3">
                        <span class="status-badge {{ $user->role === 'admin' ? 'status-active' : ($user->role === 'professor' ? 'status-warning' : 'status-info') }}">
                            {{ ucfirst($user->role) }}
                        </span>
                        @if($user->email_verified_at)
                            <span class="status-badge status-active">Verified</span>
                        @else
                            <span class="status-badge status-inactive">Unverified</span>
                        @endif
                    </div>

                    <div class="text-muted small">
                        <div class="mb-1">
                            <i class="fas fa-calendar me-2"></i>
                            Joined {{ $user->created_at->format('M d, Y') }}
                        </div>
                        <div class="mb-1">
                            <i class="fas fa-clock me-2"></i>
                            Last updated {{ $user->updated_at->diffForHumans() }}
                        </div>
                        @if($user->email_verified_at)
                        <div>
                            <i class="fas fa-check-circle me-2"></i>
                            Verified {{ $user->email_verified_at->format('M d, Y') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="admin-card mt-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-cogs me-2"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit me-2"></i>Edit Profile
                        </a>
                        @if(!$user->email_verified_at)
                        <button class="btn btn-outline-success" onclick="verifyEmail({{ $user->id }})">
                            <i class="fas fa-check me-2"></i>Verify Email
                        </button>
                        @endif
                        @if($user->id !== auth()->id())
                        <button class="btn btn-outline-warning" onclick="resetPassword({{ $user->id }})">
                            <i class="fas fa-key me-2"></i>Reset Password
                        </button>
                        <button class="btn btn-outline-danger" onclick="deleteUser({{ $user->id }}, '{{ $user->name }}')">
                            <i class="fas fa-trash me-2"></i>Delete User
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- User Activity & Stats -->
        <div class="col-lg-8">
            <!-- Activity Stats -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="stats-card">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="stats-number">{{ $user->habits->count() }}</div>
                                <div class="stats-label">Habits</div>
                            </div>
                            <div class="stats-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card" style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="stats-number">{{ $user->challenges->count() }}</div>
                                <div class="stats-label">Challenges</div>
                            </div>
                            <div class="stats-icon">
                                <i class="fas fa-trophy"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card" style="background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="stats-number">{{ $user->posts->count() }}</div>
                                <div class="stats-label">Posts</div>
                            </div>
                            <div class="stats-icon">
                                <i class="fas fa-newspaper"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="stats-number">{{ $user->comments->count() }}</div>
                                <div class="stats-label">Comments</div>
                            </div>
                            <div class="stats-icon">
                                <i class="fas fa-comments"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="admin-card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-activity me-2"></i>Recent Activity
                    </h5>
                </div>
                <div class="card-body">
                    @if($user->habits->count() > 0)
                    <h6 class="mb-3">Recent Habits</h6>
                    <div class="row">
                        @foreach($user->habits->take(4) as $habit)
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center p-2 bg-light rounded">
                                @if($habit->icon)
                                    <i class="{{ $habit->icon }} me-2"></i>
                                @endif
                                <div class="flex-grow-1">
                                    <div class="fw-medium">{{ $habit->name }}</div>
                                    <small class="text-muted">{{ $habit->frequency }}</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    @if($user->challenges->count() > 0)
                    <h6 class="mt-4 mb-3">Active Challenges</h6>
                    <div class="row">
                        @foreach($user->challenges->take(2) as $challenge)
                        <div class="col-md-6 mb-3">
                            <div class="p-3 bg-light rounded">
                                <div class="fw-medium">{{ $challenge->title }}</div>
                                <small class="text-muted">{{ $challenge->duration_days }} days • {{ $challenge->points_reward }} points</small>
                                <div class="mt-2">
                                    <span class="badge bg-{{ $challenge->difficulty_level === 'easy' ? 'success' : ($challenge->difficulty_level === 'medium' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($challenge->difficulty_level) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    @if($user->habits->count() === 0 && $user->challenges->count() === 0)
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-chart-line fa-3x mb-3"></i>
                        <p>No activity data available</p>
                        <small>User hasn't started any habits or challenges yet</small>
                    </div>
                    @endif
                </div>
            </div>

            <!-- User Posts -->
            @if($user->posts->count() > 0)
            <div class="admin-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-newspaper me-2"></i>Recent Posts
                    </h5>
                </div>
                <div class="card-body">
                    @foreach($user->posts->take(3) as $post)
                    <div class="d-flex mb-3 pb-3 border-bottom">
                        <div class="flex-grow-1">
                            <h6 class="mb-1">{{ $post->title }}</h6>
                            <p class="text-muted small mb-2">{{ Str::limit($post->content, 100) }}</p>
                            <div class="d-flex align-items-center text-muted small">
                                <i class="fas fa-calendar me-1"></i>
                                {{ $post->created_at->format('M d, Y') }}
                                <span class="mx-2">•</span>
                                <i class="fas fa-comments me-1"></i>
                                {{ $post->comments->count() }} comments
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
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
                <p>Are you sure you want to delete user <strong id="userName"></strong>?</p>
                <p class="text-warning"><i class="fas fa-exclamation-triangle me-1"></i>This action cannot be undone and will remove all user data.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete User</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function deleteUser(userId, userName) {
    document.getElementById('userName').textContent = userName;
    document.getElementById('deleteForm').action = `/admin/users/${userId}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

function verifyEmail(userId) {
    // Implementation for email verification
    alert('Email verification functionality will be implemented');
}

function resetPassword(userId) {
    // Implementation for password reset
    alert('Password reset functionality will be implemented');
}
</script>
@endpush
