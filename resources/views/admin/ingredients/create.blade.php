@extends('layouts.back')

@section('title', 'Add New Ingredient')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">🥗 Add New Ingredient</h1>
            <p class="text-muted">Add a new ingredient to the database</p>
        </div>
        <a href="{{ route('admin.nutrition.ingredients.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Ingredients
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Ingredient Form -->
            <div class="admin-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Ingredient Information
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.nutrition.ingredients.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="nom" class="form-label">Ingredient Name *</label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror"
                                       id="nom" name="nom" value="{{ old('nom') }}" required>
                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="categorie" class="form-label">Category *</label>
                                <select class="form-select @error('categorie') is-invalid @enderror" 
                                        id="categorie" name="categorie" required>
                                    <option value="">Select Category</option>
                                    <option value="fruits" {{ old('categorie') === 'fruits' ? 'selected' : '' }}>🍎 Fruits</option>
                                    <option value="legumes" {{ old('categorie') === 'legumes' ? 'selected' : '' }}>🥕 Légumes</option>
                                    <option value="cereales" {{ old('categorie') === 'cereales' ? 'selected' : '' }}>🌾 Céréales</option>
                                    <option value="legumineuses" {{ old('categorie') === 'legumineuses' ? 'selected' : '' }}>🫘 Légumineuses</option>
                                    <option value="viandes" {{ old('categorie') === 'viandes' ? 'selected' : '' }}>🥩 Viandes</option>
                                    <option value="poissons" {{ old('categorie') === 'poissons' ? 'selected' : '' }}>🐟 Poissons</option>
                                    <option value="produits-laitiers" {{ old('categorie') === 'produits-laitiers' ? 'selected' : '' }}>🥛 Produits Laitiers</option>
                                    <option value="oeufs" {{ old('categorie') === 'oeufs' ? 'selected' : '' }}>🥚 Oeufs</option>
                                    <option value="noix-graines" {{ old('categorie') === 'noix-graines' ? 'selected' : '' }}>🌰 Noix & Graines</option>
                                    <option value="huiles-graisses" {{ old('categorie') === 'huiles-graisses' ? 'selected' : '' }}>🫒 Huiles & Graisses</option>
                                    <option value="boissons" {{ old('categorie') === 'boissons' ? 'selected' : '' }}>🥤 Boissons</option>
                                    <option value="autres" {{ old('categorie') === 'autres' ? 'selected' : '' }}>📦 Autres</option>
                                </select>
                                @error('categorie')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="alert alert-info mb-4">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Note:</strong> All nutritional values are per 100g of the ingredient
                        </div>

                        <!-- Nutritional Information -->
                        <h6 class="mb-3 text-primary"><i class="fas fa-chart-bar me-2"></i>Nutritional Information (per 100g)</h6>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="calories_pour_100g" class="form-label">Calories (kcal) *</label>
                                <input type="number" step="0.01" class="form-control @error('calories_pour_100g') is-invalid @enderror"
                                       id="calories_pour_100g" name="calories_pour_100g" value="{{ old('calories_pour_100g') }}" required>
                                @error('calories_pour_100g')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="proteines_pour_100g" class="form-label">Proteins (g) *</label>
                                <input type="number" step="0.01" class="form-control @error('proteines_pour_100g') is-invalid @enderror"
                                       id="proteines_pour_100g" name="proteines_pour_100g" value="{{ old('proteines_pour_100g') }}" required>
                                @error('proteines_pour_100g')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="glucides_pour_100g" class="form-label">Carbohydrates (g) *</label>
                                <input type="number" step="0.01" class="form-control @error('glucides_pour_100g') is-invalid @enderror"
                                       id="glucides_pour_100g" name="glucides_pour_100g" value="{{ old('glucides_pour_100g') }}" required>
                                @error('glucides_pour_100g')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="lipides_pour_100g" class="form-label">Fats (g) *</label>
                                <input type="number" step="0.01" class="form-control @error('lipides_pour_100g') is-invalid @enderror"
                                       id="lipides_pour_100g" name="lipides_pour_100g" value="{{ old('lipides_pour_100g') }}" required>
                                @error('lipides_pour_100g')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="fibres_pour_100g" class="form-label">Fibers (g)</label>
                            <input type="number" step="0.01" class="form-control @error('fibres_pour_100g') is-invalid @enderror"
                                   id="fibres_pour_100g" name="fibres_pour_100g" value="{{ old('fibres_pour_100g') }}">
                            @error('fibres_pour_100g')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Optional</div>
                        </div>

                        <div class="mb-3">
                            <label for="allergenes" class="form-label">Allergens</label>
                            <input type="text" class="form-control @error('allergenes') is-invalid @enderror"
                                   id="allergenes" name="allergenes" value="{{ old('allergenes') }}"
                                   placeholder="e.g., gluten, lactose, nuts (comma-separated)">
                            @error('allergenes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Enter allergens separated by commas</div>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="form-label">Ingredient Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Optional. Accepted formats: JPG, PNG, GIF. Max 2MB</div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-healup">
                                <i class="fas fa-save me-2"></i>Create Ingredient
                            </button>
                            <a href="{{ route('admin.nutrition.ingredients.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Help Card -->
            <div class="admin-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-question-circle me-2"></i>
                        Help & Tips
                    </h5>
                </div>
                <div class="card-body">
                    <h6 class="text-primary">Category Guidelines:</h6>
                    <ul class="small">
                        <li><strong>Fruits:</strong> Apples, bananas, oranges, etc.</li>
                        <li><strong>Légumes:</strong> Carrots, broccoli, lettuce, etc.</li>
                        <li><strong>Céréales:</strong> Rice, wheat, oats, etc.</li>
                        <li><strong>Viandes:</strong> Beef, chicken, pork, etc.</li>
                        <li><strong>Poissons:</strong> Salmon, tuna, cod, etc.</li>
                    </ul>

                    <h6 class="text-primary mt-3">Nutritional Values:</h6>
                    <p class="small mb-0">
                        All nutritional values should be provided per 100g of the ingredient.
                        Use decimal points for precision (e.g., 5.25g).
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
