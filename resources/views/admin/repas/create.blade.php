@extends('layouts.back')

@section('title', 'Add New Meal')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">🍽️ Add New Meal</h1>
            <p class="text-muted">Create a new meal entry for a user</p>
        </div>
        <a href="{{ route('admin.nutrition.repas.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Meals
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Errors:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('admin.nutrition.repas.store') }}" method="POST" id="repasForm">
        @csrf
        
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
                                <label for="user_id" class="form-label">User *</label>
                                <select class="form-select" id="user_id" name="user_id" required>
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="nom" class="form-label">Meal Name *</label>
                                <input type="text" class="form-control" id="nom" name="nom" 
                                       value="{{ old('nom') }}" placeholder="e.g., Breakfast with eggs" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="type_repas" class="form-label">Meal Type *</label>
                                <select class="form-select" id="type_repas" name="type_repas" required>
                                    <option value="">Select Type</option>
                                    <option value="petit-dejeuner" {{ old('type_repas') == 'petit-dejeuner' ? 'selected' : '' }}>🌅 Breakfast</option>
                                    <option value="dejeuner" {{ old('type_repas') == 'dejeuner' ? 'selected' : '' }}>☀️ Lunch</option>
                                    <option value="diner" {{ old('type_repas') == 'diner' ? 'selected' : '' }}>🌙 Dinner</option>
                                    <option value="collation" {{ old('type_repas') == 'collation' ? 'selected' : '' }}>🍴 Snack</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="date_consommation" class="form-label">Consumption Date *</label>
                                <input type="datetime-local" class="form-control" id="date_consommation" 
                                       name="date_consommation" value="{{ old('date_consommation', now()->format('Y-m-d\TH:i')) }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ingredients -->
                <div class="admin-card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-carrot me-2"></i>Ingredients
                        </h5>
                        <button type="button" id="add-ingredient" class="btn btn-sm btn-success">
                            <i class="fas fa-plus me-1"></i>Add Ingredient
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="ingredients-container">
                            <!-- Initial ingredient row -->
                            <div class="ingredient-item border rounded p-3 mb-3 bg-light">
                                <div class="row align-items-end">
                                    <div class="col-md-6">
                                        <label class="form-label">Ingredient *</label>
                                        <select name="ingredients[0][id]" class="form-select ingredient-select" required>
                                            <option value="">Choose an ingredient</option>
                                            @foreach($ingredients as $ingredient)
                                                <option value="{{ $ingredient->id }}" 
                                                        data-calories="{{ $ingredient->calories_pour_100g }}"
                                                        data-proteines="{{ $ingredient->proteines_pour_100g }}"
                                                        data-glucides="{{ $ingredient->glucides_pour_100g }}"
                                                        data-lipides="{{ $ingredient->lipides_pour_100g }}">
                                                    {{ $ingredient->nom }} ({{ round($ingredient->calories_pour_100g) }} kcal/100g)
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Quantity (g) *</label>
                                        <input type="number" name="ingredients[0][quantite]" 
                                               class="form-control quantite-input" min="1" max="2000" 
                                               placeholder="100" required>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger w-100 remove-ingredient">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="mt-2 p-2 bg-white rounded border ingredient-preview">
                                    <small class="text-muted">Select an ingredient and quantity</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Nutritional Summary -->
                <div class="admin-card mb-4 sticky-top" style="top: 20px;">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-chart-bar me-2"></i>Nutritional Summary
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="text-center p-3 bg-primary bg-opacity-10 rounded">
                                    <div class="fs-3 fw-bold text-primary" id="total-calories">0</div>
                                    <small class="text-muted">Calories</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center p-3 bg-success bg-opacity-10 rounded">
                                    <div class="fs-3 fw-bold text-success" id="total-proteines">0</div>
                                    <small class="text-muted">Proteins (g)</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center p-3 bg-warning bg-opacity-10 rounded">
                                    <div class="fs-3 fw-bold text-warning" id="total-glucides">0</div>
                                    <small class="text-muted">Carbs (g)</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center p-3 bg-danger bg-opacity-10 rounded">
                                    <div class="fs-3 fw-bold text-danger" id="total-lipides">0</div>
                                    <small class="text-muted">Fats (g)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="admin-card">
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-healup">
                                <i class="fas fa-save me-2"></i>Create Meal
                            </button>
                            <a href="{{ route('admin.nutrition.repas.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let ingredientIndex = 1;
    
    // Add ingredient
    document.getElementById('add-ingredient').addEventListener('click', function() {
        const container = document.getElementById('ingredients-container');
        const newItem = document.querySelector('.ingredient-item').cloneNode(true);
        
        // Update name attributes
        newItem.querySelectorAll('[name]').forEach(input => {
            const name = input.getAttribute('name');
            input.setAttribute('name', name.replace(/\[\d+\]/, `[${ingredientIndex}]`));
            input.value = '';
        });
        
        // Clear preview
        newItem.querySelector('.ingredient-preview').innerHTML = '<small class="text-muted">Select an ingredient and quantity</small>';
        
        container.appendChild(newItem);
        ingredientIndex++;
        
        // Attach event listeners
        attachIngredientListeners(newItem);
    });
    
    // Remove ingredient
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-ingredient')) {
            const items = document.querySelectorAll('.ingredient-item');
            if (items.length > 1) {
                e.target.closest('.ingredient-item').remove();
                calculateNutrition();
            } else {
                alert('You must have at least one ingredient!');
            }
        }
    });
    
    // Attach listeners to initial ingredient
    attachIngredientListeners(document.querySelector('.ingredient-item'));
    
    function attachIngredientListeners(item) {
        const select = item.querySelector('.ingredient-select');
        const quantityInput = item.querySelector('.quantite-input');
        
        select.addEventListener('change', function() {
            updateIngredientPreview(item);
            calculateNutrition();
        });
        
        quantityInput.addEventListener('input', function() {
            updateIngredientPreview(item);
            calculateNutrition();
        });
    }
    
    function updateIngredientPreview(item) {
        const select = item.querySelector('.ingredient-select');
        const quantityInput = item.querySelector('.quantite-input');
        const preview = item.querySelector('.ingredient-preview');
        
        const option = select.options[select.selectedIndex];
        const quantity = parseFloat(quantityInput.value) || 0;
        
        if (option.value && quantity > 0) {
            const factor = quantity / 100;
            const calories = parseFloat(option.dataset.calories) * factor;
            const proteines = parseFloat(option.dataset.proteines) * factor;
            const glucides = parseFloat(option.dataset.glucides) * factor;
            const lipides = parseFloat(option.dataset.lipides) * factor;
            
            preview.innerHTML = `
                <small class="text-muted">
                    <strong>${quantity}g:</strong> 
                    ${Math.round(calories)} kcal | 
                    P: ${proteines.toFixed(1)}g | 
                    C: ${glucides.toFixed(1)}g | 
                    F: ${lipides.toFixed(1)}g
                </small>
            `;
        } else {
            preview.innerHTML = '<small class="text-muted">Select an ingredient and quantity</small>';
        }
    }
    
    function calculateNutrition() {
        let totalCalories = 0;
        let totalProteines = 0;
        let totalGlucides = 0;
        let totalLipides = 0;
        
        document.querySelectorAll('.ingredient-item').forEach(item => {
            const select = item.querySelector('.ingredient-select');
            const quantityInput = item.querySelector('.quantite-input');
            const option = select.options[select.selectedIndex];
            const quantity = parseFloat(quantityInput.value) || 0;
            
            if (option.value && quantity > 0) {
                const factor = quantity / 100;
                totalCalories += parseFloat(option.dataset.calories) * factor;
                totalProteines += parseFloat(option.dataset.proteines) * factor;
                totalGlucides += parseFloat(option.dataset.glucides) * factor;
                totalLipides += parseFloat(option.dataset.lipides) * factor;
            }
        });
        
        document.getElementById('total-calories').textContent = Math.round(totalCalories);
        document.getElementById('total-proteines').textContent = totalProteines.toFixed(1);
        document.getElementById('total-glucides').textContent = totalGlucides.toFixed(1);
        document.getElementById('total-lipides').textContent = totalLipides.toFixed(1);
    }
});
</script>
@endsection
