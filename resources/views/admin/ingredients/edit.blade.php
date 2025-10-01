@extends('layouts.back')

@section('title', 'Edit Ingredient - ' . $ingredient->nom)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">✏️ Edit Ingredient</h1>
            <p class="text-muted">Update ingredient information</p>
        </div>
        <a href="{{ route('admin.nutrition.ingredients.show', $ingredient) }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Details
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="admin-card">
                <div class="card-body">
                    <form action="{{ route('admin.nutrition.ingredients.update', $ingredient) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="nom" class="form-label">Ingredient Name *</label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror"
                                       id="nom" name="nom" value="{{ old('nom', $ingredient->nom) }}" required>
                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="categorie" class="form-label">Category *</label>
                                <select class="form-select @error('categorie') is-invalid @enderror" id="categorie" name="categorie" required>
                                    <option value="fruits" {{ old('categorie', $ingredient->categorie) === 'fruits' ? 'selected' : '' }}>🍎 Fruits</option>
                                    <option value="legumes" {{ old('categorie', $ingredient->categorie) === 'legumes' ? 'selected' : '' }}>🥕 Légumes</option>
                                    <option value="cereales" {{ old('categorie', $ingredient->categorie) === 'cereales' ? 'selected' : '' }}>🌾 Céréales</option>
                                    <option value="legumineuses" {{ old('categorie', $ingredient->categorie) === 'legumineuses' ? 'selected' : '' }}>🫘 Légumineuses</option>
                                    <option value="viandes" {{ old('categorie', $ingredient->categorie) === 'viandes' ? 'selected' : '' }}>🥩 Viandes</option>
                                    <option value="poissons" {{ old('categorie', $ingredient->categorie) === 'poissons' ? 'selected' : '' }}>🐟 Poissons</option>
                                    <option value="produits-laitiers" {{ old('categorie', $ingredient->categorie) === 'produits-laitiers' ? 'selected' : '' }}>🥛 Produits Laitiers</option>
                                    <option value="oeufs" {{ old('categorie', $ingredient->categorie) === 'oeufs' ? 'selected' : '' }}>🥚 Oeufs</option>
                                    <option value="noix-graines" {{ old('categorie', $ingredient->categorie) === 'noix-graines' ? 'selected' : '' }}>🌰 Noix & Graines</option>
                                    <option value="huiles-graisses" {{ old('categorie', $ingredient->categorie) === 'huiles-graisses' ? 'selected' : '' }}>🫒 Huiles & Graisses</option>
                                    <option value="boissons" {{ old('categorie', $ingredient->categorie) === 'boissons' ? 'selected' : '' }}>🥤 Boissons</option>
                                    <option value="autres" {{ old('categorie', $ingredient->categorie) === 'autres' ? 'selected' : '' }}>📦 Autres</option>
                                </select>
                                @error('categorie')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <h6 class="mb-3 text-primary"><i class="fas fa-chart-bar me-2"></i>Nutritional Information (per 100g)</h6>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="calories_pour_100g" class="form-label">Calories (kcal) *</label>
                                <input type="number" step="0.01" class="form-control @error('calories_pour_100g') is-invalid @enderror"
                                       id="calories_pour_100g" name="calories_pour_100g" value="{{ old('calories_pour_100g', $ingredient->calories_pour_100g) }}" required>
                                @error('calories_pour_100g')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="proteines_pour_100g" class="form-label">Proteins (g) *</label>
                                <input type="number" step="0.01" class="form-control @error('proteines_pour_100g') is-invalid @enderror"
                                       id="proteines_pour_100g" name="proteines_pour_100g" value="{{ old('proteines_pour_100g', $ingredient->proteines_pour_100g) }}" required>
                                @error('proteines_pour_100g')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="glucides_pour_100g" class="form-label">Carbohydrates (g) *</label>
                                <input type="number" step="0.01" class="form-control @error('glucides_pour_100g') is-invalid @enderror"
                                       id="glucides_pour_100g" name="glucides_pour_100g" value="{{ old('glucides_pour_100g', $ingredient->glucides_pour_100g) }}" required>
                                @error('glucides_pour_100g')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="lipides_pour_100g" class="form-label">Fats (g) *</label>
                                <input type="number" step="0.01" class="form-control @error('lipides_pour_100g') is-invalid @enderror"
                                       id="lipides_pour_100g" name="lipides_pour_100g" value="{{ old('lipides_pour_100g', $ingredient->lipides_pour_100g) }}" required>
                                @error('lipides_pour_100g')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="fibres_pour_100g" class="form-label">Fibers (g)</label>
                            <input type="number" step="0.01" class="form-control @error('fibres_pour_100g') is-invalid @enderror"
                                   id="fibres_pour_100g" name="fibres_pour_100g" value="{{ old('fibres_pour_100g', $ingredient->fibres_pour_100g) }}">
                            @error('fibres_pour_100g')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="allergenes" class="form-label">Allergens</label>
                            <input type="text" class="form-control @error('allergenes') is-invalid @enderror"
                                   id="allergenes" name="allergenes" 
                                   value="{{ old('allergenes', is_array($ingredient->allergenes) ? implode(', ', $ingredient->allergenes) : '') }}"
                                   placeholder="e.g., gluten, lactose, nuts">
                            @error('allergenes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image" class="form-label">Ingredient Image</label>
                            @if($ingredient->image)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($ingredient->image) }}" alt="{{ $ingredient->nom }}" class="img-thumbnail" style="max-width: 150px;">
                                    <p class="text-muted small">Current image</p>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Leave empty to keep current image</div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-healup">
                                <i class="fas fa-save me-2"></i>Update Ingredient
                            </button>
                            <a href="{{ route('admin.nutrition.ingredients.show', $ingredient) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
