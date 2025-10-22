@extends('layouts.back')

@section('title', 'User Management')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">User Management</h1>
            <p class="text-muted">Manage all users in the system</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-healup">
            <i class="fas fa-plus me-2"></i>Add New User
        </a>
    </div>

    <!-- Filters & Search -->
    <div class="admin-card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Search Users</label>
                    <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                           placeholder="Search by name or email...">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Filter by Role</label>
                    <select class="form-select" name="role">
                        <option value="">All Roles</option>
                        <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="professor" {{ request('role') === 'professor' ? 'selected' : '' }}>Professor</option>
                        <option value="student" {{ request('role') === 'student' ? 'selected' : '' }}>Student</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Sort By</label>
                    <select class="form-select" name="sort">
                        <option value="created_at" {{ request('sort') === 'created_at' ? 'selected' : '' }}>Date Joined</option>
                        <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Name</option>
                        <option value="email" {{ request('sort') === 'email' ? 'selected' : '' }}>Email</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-search me-1"></i>Filter
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
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
                        <div class="stats-number">{{ $users->total() }}</div>
                        <div class="stats-label">Total Users</div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card" style="background: linear-gradient(135deg, #3B82F6 0%, #1D4ED8 100%);">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="stats-number">{{ \App\Models\User::where('role', 'admin')->count() }}</div>
                        <div class="stats-label">Admins</div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card" style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="stats-number">{{ \App\Models\User::where('role', 'professor')->count() }}</div>
                        <div class="stats-label">Professors</div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card" style="background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="stats-number">{{ \App\Models\User::where('role', 'student')->count() }}</div>
                        <div class="stats-label">Students</div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="admin-card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-users me-2"></i>
                Users List
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ $user->profile_photo_url }}"
                                         alt="{{ $user->name }}"
                                         class="rounded-circle me-2"
                                         style="width: 40px; height: 40px;">
                                    <div>
                                        <strong class="d-block">{{ $user->name }}</strong>
                                        <small class="text-muted">ID: {{ $user->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="d-block">{{ $user->email }}</span>
                                @if($user->email_verified_at)
                                    <small class="text-success"><i class="fas fa-check-circle me-1"></i>Verified</small>
                                @else
                                    <small class="text-warning"><i class="fas fa-exclamation-circle me-1"></i>Unverified</small>
                                @endif
                            </td>
                            <td>
                                <span class="status-badge {{ $user->role === 'admin' ? 'status-active' : ($user->role === 'professor' ? 'status-warning' : 'status-info') }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td>
                                <span class="status-badge status-active">Active</span>
                            </td>
                            <td>
                                <span class="d-block">{{ $user->created_at->format('M d, Y') }}</span>
                                <small class="text-muted">{{ $user->created_at->format('h:i A') }}</small>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-outline-primary" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-outline-secondary" title="Edit User">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($user->id !== auth()->id())
                                    <button type="button" class="btn btn-outline-danger" title="Delete User"
                                            onclick="deleteUser({{ $user->id }}, '{{ $user->name }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                <p class="text-muted mb-0">No users found</p>
                                @if(request()->hasAny(['search', 'role']))
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-primary mt-2">
                                        <i class="fas fa-times me-1"></i>Clear Filters
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($users->hasPages())
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
                </div>
                {{ $users->links() }}
            </div>
        </div>
        @endif
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
                <p class="text-warning"><i class="fas fa-exclamation-triangle me-1"></i>This action cannot be undone.</p>
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

// Dynamic filtering
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('input[name="search"]');
    const roleSelect = document.querySelector('select[name="role"]');
    const sortSelect = document.querySelector('select[name="sort"]');
    const filterForm = document.querySelector('form');

    let filterTimeout;

    function applyFilters() {
        clearTimeout(filterTimeout);
        filterTimeout = setTimeout(() => {
            filterForm.submit();
        }, 500); // Wait 500ms after user stops typing
    }

    // Auto-submit on input change
    searchInput.addEventListener('input', applyFilters);
    roleSelect.addEventListener('change', function() {
        filterForm.submit();
    });
    sortSelect.addEventListener('change', function() {
        filterForm.submit();
    });

    // Real-time search highlighting
    const searchTerm = searchInput.value.toLowerCase();
    if (searchTerm.length > 0) {
        const tableRows = document.querySelectorAll('.admin-table tbody tr');
        tableRows.forEach(row => {
            const nameCell = row.querySelector('td:first-child');
            const emailCell = row.querySelector('td:nth-child(2)');

            if (nameCell && emailCell) {
                highlightText(nameCell, searchTerm);
                highlightText(emailCell, searchTerm);
            }
        });
    }
});

function highlightText(element, searchTerm) {
    const text = element.textContent;
    const regex = new RegExp(`(${searchTerm})`, 'gi');
    const highlightedText = text.replace(regex, '<mark>$1</mark>');

    if (text !== highlightedText) {
        element.innerHTML = highlightedText;
    }
}
</script>
@endpush
