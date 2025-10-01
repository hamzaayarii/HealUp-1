@extends('layouts.back')

@section('title', 'Meal Details')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">🍽️ {{ $repas->nom }}</h1>
            <p class="text-muted">Meal Details & Nutritional Information</p>
        </div>
        <div class="btn-group">
            <a href="{{ route('admin.nutrition.repas.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to List
            </a>
            <a href="{{ route('admin.nutrition.repas.edit', $repas) }}" class="btn btn-warning">
                <i class="fas fa-edit me-2"></i>Edit
            </a>
            <form action="{{ route('admin.nutrition.repas.destroy', $repas) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Delete this meal?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash me-2"></i>Delete
                </button>
            </form>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <!-- Basic Information -->
            <div class="admin-card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Meal Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Meal Name:</strong>
                            <p class="text-muted">{{ $repas->nom }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Type:</strong>
                            <p>
                                @php
                                    $badgeColor = match($repas->type_repas) {
                                        'petit-dejeuner' => 'warning',
                                        'dejeuner' => 'primary',
                                        'diner' => 'info',
                                        'collation' => 'secondary',
                                        default => 'secondary'
                                    };
                                @endphp
                                <span class="badge bg-{{ $badgeColor }}">
                                    {{ ucfirst(str_replace('-', ' ', $repas->type_repas)) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>User:</strong>
                            <p>
                                <a href="{{ route('admin.users.show', $repas->user_id) }}">
                                    {{ $repas->user->name ?? 'N/A' }}
                                </a>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <strong>Consumption Date:</strong>
                            <p class="text-muted">{{ $repas->date_consommation->format('M d, Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Created:</strong>
                            <p class="text-muted">{{ $repas->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Last Updated:</strong>
                            <p class="text-muted">{{ $repas->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nutritional Breakdown -->
            <div class="admin-card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Nutritional Breakdown
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <div class="text-center p-3 bg-primary bg-opacity-10 rounded">
                                <i class="fas fa-fire text-primary fs-3"></i>
                                <h4 class="mt-2 mb-0">{{ round($nutritionBreakdown['calories']) }}</h4>
                                <small class="text-muted">Calories (kcal)</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center p-3 bg-success bg-opacity-10 rounded">
                                <i class="fas fa-drumstick-bite text-success fs-3"></i>
                                <h4 class="mt-2 mb-0">{{ round($nutritionBreakdown['proteines'], 1) }}g</h4>
                                <small class="text-muted">Proteins</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center p-3 bg-warning bg-opacity-10 rounded">
                                <i class="fas fa-bread-slice text-warning fs-3"></i>
                                <h4 class="mt-2 mb-0">{{ round($nutritionBreakdown['glucides'], 1) }}g</h4>
                                <small class="text-muted">Carbs</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center p-3 bg-danger bg-opacity-10 rounded">
                                <i class="fas fa-bacon text-danger fs-3"></i>
                                <h4 class="mt-2 mb-0">{{ round($nutritionBreakdown['lipides'], 1) }}g</h4>
                                <small class="text-muted">Fats</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ingredients List -->
            <div class="admin-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-list me-2"></i>Ingredients ({{ $nutritionBreakdown['ingredients_count'] }})
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Ingredient</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>Calories</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($repas->repasIngredients as $ri)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.nutrition.ingredients.show', $ri->ingredient) }}">
                                            {{ $ri->ingredient->nom }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">
                                            {{ $ri->ingredient->getCategorieEmoji() }} {{ ucfirst($ri->ingredient->categorie) }}
                                        </span>
                                    </td>
                                    <td><strong>{{ round($ri->quantite) }}g</strong></td>
                                    <td>{{ round($ri->calories_calculees) }} kcal</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="admin-card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt me-2"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.nutrition.repas.edit', $repas) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit Meal
                        </a>
                        <a href="{{ route('admin.users.show', $repas->user_id) }}" class="btn btn-primary">
                            <i class="fas fa-user me-2"></i>View User Profile
                        </a>
                        <form action="{{ route('admin.nutrition.repas.destroy', $repas) }}" method="POST"
                              onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-trash me-2"></i>Delete Meal
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
