@extends('layouts.back')

@section('title', 'Ingredients Management')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">🥗 Ingredients Database</h1>
            <p class="text-muted">Manage nutritional ingredients and their information</p>
        </div>
        <a href="{{ route('admin.nutrition.ingredients.create') }}" class="btn btn-healup">
            <i class="fas fa-plus me-2"></i>Add New Ingredient
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
                        <div class="stats-label">Total Ingredients</div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-apple-alt"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%);">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="stats-number">{{ $stats['categories'] }}</div>
                        <div class="stats-label">Categories</div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-layer-group"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card" style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <div class="stats-number">{{ $stats['most_used']->first()->repas_ingredients_count ?? 0 }}</div>
                        <div class="stats-label">Most Used Count</div>
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
                        <div class="stats-number">{{ $stats['recent']->count() }}</div>
                        <div class="stats-label">Recently Added</div>
                    </div>
                    <div class="stats-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Category Distribution -->
    @if($stats['by_category']->count() > 0)
    <div class="admin-card mb-4">
        <div class="card-body">
            <h5 class="mb-3"><i class="fas fa-chart-pie me-2"></i>Ingredients by Category</h5>
            <div class="row">
                @foreach($stats['by_category'] as $cat)
                <div class="col-md-3 mb-3">
                    <div class="badge bg-primary bg-gradient p-3 w-100">
                        <div class="text-white fw-bold">{{ ucfirst($cat->categorie) }}</div>
                        <div class="text-white-50">{{ $cat->count }} ingredients</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Filters & Search -->
    <div class="admin-card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Search Ingredients</label>
                    <input type="text" class="form-control" name="search" value="{{ request('search') }}"
                           placeholder="Search by name or category...">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Filter by Category</label>
                    <select class="form-select" name="categorie">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ request('categorie') === $category ? 'selected' : '' }}>
                                {{ ucfirst($category) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Sort By</label>
                    <select class="form-select" name="sort">
                        <option value="created_at" {{ request('sort') === 'created_at' ? 'selected' : '' }}>Recently Added</option>
                        <option value="nom" {{ request('sort') === 'nom' ? 'selected' : '' }}>Name</option>
                        <option value="calories_pour_100g" {{ request('sort') === 'calories_pour_100g' ? 'selected' : '' }}>Calories</option>
                        <option value="categorie" {{ request('sort') === 'categorie' ? 'selected' : '' }}>Category</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-search me-1"></i>Filter
                    </button>
                    <a href="{{ route('admin.nutrition.ingredients.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i>Clear
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Ingredients Table -->
    <div class="admin-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Calories/100g</th>
                            <th>Proteins</th>
                            <th>Carbs</th>
                            <th>Fats</th>
                            <th>Usage Count</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ingredients as $ingredient)
                        <tr>
                            <td class="text-muted">#{{ $ingredient->id }}</td>
                            <td>
                                <strong>{{ $ingredient->nom }}</strong>
                                @if($ingredient->image)
                                    <i class="fas fa-image text-success ms-1" title="Has image"></i>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-primary bg-gradient">
                                    {{ $ingredient->getCategorieEmoji() }} {{ ucfirst($ingredient->categorie) }}
                                </span>
                            </td>
                            <td><strong>{{ round($ingredient->calories_pour_100g) }}</strong> kcal</td>
                            <td>{{ round($ingredient->proteines_pour_100g, 1) }}g</td>
                            <td>{{ round($ingredient->glucides_pour_100g, 1) }}g</td>
                            <td>{{ round($ingredient->lipides_pour_100g, 1) }}g</td>
                            <td>
                                <span class="badge bg-info">
                                    {{ $ingredient->repas_ingredients_count }} meals
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.nutrition.ingredients.show', $ingredient) }}" 
                                       class="btn btn-sm btn-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.nutrition.ingredients.edit', $ingredient) }}" 
                                       class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.nutrition.ingredients.destroy', $ingredient) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this ingredient?');">
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
                            <td colspan="9" class="text-center text-muted py-4">
                                <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                No ingredients found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $ingredients->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
