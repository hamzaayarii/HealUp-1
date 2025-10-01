@extends('layouts.back')

@section('title', 'Edit User')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Edit User</h1>
            <p class="text-muted">Update user information and settings</p>
        </div>
        <div class="btn-group">
            <a href="{{ route('admin.users.show', $user) }}" class="btn btn-outline-primary">
                <i class="fas fa-eye me-2"></i>View Profile
            </a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Users
            </a>
        </div>
    </div>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-lg-8">
                <!-- User Information -->
                <div class="admin-card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-user me-2"></i>
                            User Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Full Name *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">User Role *</label>
                            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                <option value="student" {{ old('role', $user->role) === 'student' ? 'selected' : '' }}>Student</option>
                                <option value="professor" {{ old('role', $user->role) === 'professor' ? 'selected' : '' }}>Professor</option>
                                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <strong>Student:</strong> Basic user access •
                                <strong>Professor:</strong> Content management •
                                <strong>Admin:</strong> Full system access
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Password Update -->
                <div class="admin-card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-key me-2"></i>
                            Password Update
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Leave password fields empty to keep the current password
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       id="password" name="password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Minimum 8 characters</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control"
                                       id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-end gap-2 mb-4">
                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                    <button type="submit" class="btn btn-healup">
                        <i class="fas fa-save me-2"></i>Update User
                    </button>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Current Profile -->
                <div class="admin-card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-user-circle me-2"></i>
                            Current Profile
                        </h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ $user->profile_photo_url }}"
                             alt="{{ $user->name }}"
                             class="rounded-circle mb-3"
                             style="width: 100px; height: 100px; object-fit: cover;">

                        <h6 class="mb-1" id="preview-name">{{ $user->name }}</h6>
                        <p class="text-muted mb-2" id="preview-email">{{ $user->email }}</p>

                        <span class="status-badge {{ $user->role === 'admin' ? 'status-active' : ($user->role === 'professor' ? 'status-warning' : 'status-info') }}"
                              id="preview-role">
                            {{ ucfirst($user->role) }}
                        </span>

                        <div class="mt-3 text-muted small">
                            <div class="mb-1">
                                <i class="fas fa-calendar me-2"></i>
                                Joined {{ $user->created_at->format('M d, Y') }}
                            </div>
                            @if($user->email_verified_at)
                            <div class="text-success">
                                <i class="fas fa-check-circle me-2"></i>
                                Email Verified
                            </div>
                            @else
                            <div class="text-warning">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                Email Not Verified
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- User Statistics -->
                <div class="admin-card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-chart-bar me-2"></i>
                            User Statistics
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-6">
                                <div class="text-center p-2 bg-light rounded">
                                    <div class="fw-bold text-primary">{{ $user->habits->count() }}</div>
                                    <small class="text-muted">Habits</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center p-2 bg-light rounded">
                                    <div class="fw-bold text-success">{{ $user->challenges->count() }}</div>
                                    <small class="text-muted">Challenges</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center p-2 bg-light rounded">
                                    <div class="fw-bold text-warning">{{ $user->posts->count() }}</div>
                                    <small class="text-muted">Posts</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center p-2 bg-light rounded">
                                    <div class="fw-bold text-info">{{ $user->comments->count() }}</div>
                                    <small class="text-muted">Comments</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Safety Notice -->
                <div class="admin-card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-shield-alt me-2"></i>
                            Safety Notice
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="bg-warning bg-opacity-10 p-3 rounded">
                            <h6 class="fw-bold text-warning mb-2">Important</h6>
                            <ul class="mb-0 small text-muted">
                                <li class="mb-1">Changing user role affects their system permissions</li>
                                <li class="mb-1">Email changes may require re-verification</li>
                                <li class="mb-0">Password changes will log the user out</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
// Live preview updates
document.getElementById('name').addEventListener('input', function() {
    document.getElementById('preview-name').textContent = this.value || '{{ $user->name }}';
});

document.getElementById('email').addEventListener('input', function() {
    document.getElementById('preview-email').textContent = this.value || '{{ $user->email }}';
});

document.getElementById('role').addEventListener('change', function() {
    const badge = document.getElementById('preview-role');
    const value = this.value;
    badge.textContent = value.charAt(0).toUpperCase() + value.slice(1);

    // Update badge color based on role
    badge.className = `status-badge ${value === 'admin' ? 'status-active' : (value === 'professor' ? 'status-warning' : 'status-info')}`;
});

// Password strength validation
document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const confirmField = document.getElementById('password_confirmation');

    if (password.length > 0 && password.length < 8) {
        this.classList.add('is-invalid');
    } else {
        this.classList.remove('is-invalid');
    }
});

document.getElementById('password_confirmation').addEventListener('input', function() {
    const password = document.getElementById('password').value;
    const confirm = this.value;

    if (confirm.length > 0 && password !== confirm) {
        this.classList.add('is-invalid');
    } else {
        this.classList.remove('is-invalid');
    }
});
</script>
@endpush
