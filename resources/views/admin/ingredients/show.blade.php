@extends('layouts.back')

@section('title', 'Ingredient Details - ' . $ingredient->nom)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">{{ $ingredient->getCategorieEmoji() }} {{ $ingredient->nom }}</h1>
            <p class="text-muted">Ingredient Details & Usage Statistics</p>
        </div>
        <div class="btn-group">
            <a href="{{ route('admin.nutrition.ingredients.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to List
            </a>
            <a href="{{ route('admin.nutrition.ingredients.edit', $ingredient) }}" class="btn btn-warning">
                <i class="fas fa-edit me-2"></i>Edit
            </a>
            <form action="{{ route('admin.nutrition.ingredients.destroy', $ingredient) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Are you sure you want to delete this ingredient?');">
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
        <!-- Basic Information -->
        <div class="col-lg-8">
            <div class="admin-card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>Basic Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Name:</strong>
                            <p class="text-muted">{{ $ingredient->nom }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Category:</strong>
                            <p>
                                <span class="badge bg-primary bg-gradient">
                                    {{ $ingredient->getCategorieEmoji() }} {{ ucfirst($ingredient->categorie) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    @if($ingredient->image)
                    <div class="mb-3">
                        <strong>Image:</strong>
                        <div class="mt-2">
                            <img src="{{ Storage::url($ingredient->image) }}" alt="{{ $ingredient->nom }}" 
                                 class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    </div>
                    @endif

                    @if($ingredient->allergenes && count($ingredient->allergenes) > 0)
                    <div class="mb-3">
                        <strong>Allergens:</strong>
                        <p>
                            @foreach($ingredient->allergenes as $allergen)
                                <span class="badge bg-warning text-dark">{{ $allergen }}</span>
                            @endforeach
                        </p>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <strong>Created:</strong>
                            <p class="text-muted">{{ $ingredient->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Last Updated:</strong>
                            <p class="text-muted">{{ $ingredient->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nutritional Information -->
            <div class="admin-card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Nutritional Information (per 100g)
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <div class="text-center p-3 bg-primary bg-opacity-10 rounded">
                                <i class="fas fa-fire text-primary fs-3"></i>
                                <h4 class="mt-2 mb-0">{{ round($ingredient->calories_pour_100g) }}</h4>
                                <small class="text-muted">Calories (kcal)</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center p-3 bg-success bg-opacity-10 rounded">
                                <i class="fas fa-drumstick-bite text-success fs-3"></i>
                                <h4 class="mt-2 mb-0">{{ round($ingredient->proteines_pour_100g, 1) }}g</h4>
                                <small class="text-muted">Proteins</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center p-3 bg-warning bg-opacity-10 rounded">
                                <i class="fas fa-bread-slice text-warning fs-3"></i>
                                <h4 class="mt-2 mb-0">{{ round($ingredient->glucides_pour_100g, 1) }}g</h4>
                                <small class="text-muted">Carbs</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center p-3 bg-danger bg-opacity-10 rounded">
                                <i class="fas fa-bacon text-danger fs-3"></i>
                                <h4 class="mt-2 mb-0">{{ round($ingredient->lipides_pour_100g, 1) }}g</h4>
                                <small class="text-muted">Fats</small>
                            </div>
                        </div>
                    </div>

                    @if($ingredient->fibres_pour_100g)
                    <div class="mt-3 text-center">
                        <span class="badge bg-info">Fibers: {{ round($ingredient->fibres_pour_100g, 1) }}g</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Recent Usage -->
            @if($repasUsage->count() > 0)
            <div class="admin-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-utensils me-2"></i>Recent Usage in Meals
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Meal Name</th>
                                    <th>User</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($repasUsage as $repas)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.nutrition.repas.show', $repas) }}">
                                            {{ $repas->nom }}
                                        </a>
                                    </td>
                                    <td>{{ $repas->user->name ?? 'N/A' }}</td>
                                    <td>{{ $repas->date_consommation->format('M d, Y') }}</td>
                                    <td>
                                        <span class="badge bg-secondary">{{ ucfirst($repas->type_repas) }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Statistics Sidebar -->
        <div class="col-lg-4">
            <!-- Usage Stats -->
            <div class="admin-card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-pie me-2"></i>Usage Statistics
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                        <span>Total Usage</span>
                        <strong class="fs-4">{{ $usageStats['total_usage'] }}</strong>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                        <span>Total Quantity</span>
                        <strong class="fs-5">{{ round($usageStats['total_quantity']) }}g</strong>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                        <span>Avg Quantity</span>
                        <strong class="fs-5">{{ round($usageStats['avg_quantity']) }}g</strong>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Unique Users</span>
                        <strong class="fs-5">{{ $usageStats['users_count'] }}</strong>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="admin-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt me-2"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.nutrition.ingredients.edit', $ingredient) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit Ingredient
                        </a>
                        <a href="{{ route('admin.nutrition.repas.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Create Meal with This
                        </a>
                        <form action="{{ route('admin.nutrition.ingredients.destroy', $ingredient) }}" method="POST"
                              onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-trash me-2"></i>Delete Ingredient
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
