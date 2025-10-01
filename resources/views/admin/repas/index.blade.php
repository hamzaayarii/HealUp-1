@extends('layouts.back')

@section('title', 'Meals Management')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">🍽️ Meals Management</h1>
            <p class="text-muted">Manage all user meals and nutrition tracking</p>
        </div>
        <a href="{{ route('admin.nutrition.repas.create') }}" class="btn btn-healup">
            <i class="fas fa-plus me-2"></i>Add New Meal
        </a>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stats-card">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="stats-number">{{ $stats['total'] }}</div>
                        <div class="stats-label">Total Meals</div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="stats-number">{{ $stats['today'] }}</div>
                        <div class="stats-label">Today</div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card" style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="stats-number">{{ $stats['avg_calories'] }}</div>
                        <div class="stats-label">Avg Calories</div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-fire"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card" style="background: linear-gradient(135deg, #8B5CF6 0%, #6D28D9 100%);">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="stats-number">{{ $stats['active_users'] }}</div>
                        <div class="stats-label">Active Users</div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters & Search -->
    <div class="admin-card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Search Meals</label>
                    <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                           placeholder="Search by name or user...">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Meal Type</label>
                    <select class="form-select" name="type_repas">
                        <option value="">All Types</option>
                        <option value="petit-dejeuner" {{ request('type_repas') === 'petit-dejeuner' ? 'selected' : '' }}>Breakfast</option>
                        <option value="dejeuner" {{ request('type_repas') === 'dejeuner' ? 'selected' : '' }}>Lunch</option>
                        <option value="diner" {{ request('type_repas') === 'diner' ? 'selected' : '' }}>Dinner</option>
                        <option value="collation" {{ request('type_repas') === 'collation' ? 'selected' : '' }}>Snack</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">User</label>
                    <select class="form-select" name="user_id">
                        <option value="">All Users</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">From Date</label>
                    <input type="date" class="form-control" name="date_from" value="{{ request('date_from') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">To Date</label>
                    <input type="date" class="form-control" name="date_to" value="{{ request('date_to') }}">
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Meals Table -->
    <div class="admin-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Meal Name</th>
                            <th>User</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Calories</th>
                            <th>Ingredients</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($repas as $repas_item)
                        <tr>
                            <td class="text-muted">#{{ $repas_item->id }}</td>
                            <td><strong>{{ $repas_item->nom }}</strong></td>
                            <td>
                                <a href="{{ route('admin.users.show', $repas_item->user_id) }}">
                                    {{ $repas_item->user->name ?? 'N/A' }}
                                </a>
                            </td>
                            <td>
                                @php
                                    $badgeColor = match($repas_item->type_repas) {
                                        'petit-dejeuner' => 'warning',
                                        'dejeuner' => 'primary',
                                        'diner' => 'info',
                                        'collation' => 'secondary',
                                        default => 'secondary'
                                    };
                                @endphp
                                <span class="badge bg-{{ $badgeColor }}">
                                    {{ ucfirst(str_replace('-', ' ', $repas_item->type_repas)) }}
                                </span>
                            </td>
                            <td>{{ $repas_item->date_consommation->format('M d, Y') }}</td>
                            <td><strong>{{ round($repas_item->calories_total) }}</strong> kcal</td>
                            <td>
                                <span class="badge bg-success">
                                    {{ $repas_item->repasIngredients->count() }} items
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.nutrition.repas.show', $repas_item) }}" 
                                       class="btn btn-sm btn-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.nutrition.repas.edit', $repas_item) }}" 
                                       class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.nutrition.repas.destroy', $repas_item) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Delete this meal?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                No meals found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $repas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
