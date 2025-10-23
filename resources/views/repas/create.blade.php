@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-green-50 dark:from-gray-900 dark:to-gray-800 py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-green-500 bg-clip-text text-transparent">
                ➕ New Meal
            </h1>
            <a href="{{ route('repas.index') }}" 
               class="px-4 py-2 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-700 font-semibold rounded-xl transition shadow-sm">
                Back to List
            </a>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div class="bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-xl mb-4 shadow">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-6 border border-gray-100 dark:border-gray-700">
            <form action="{{ route('repas.store') }}" method="POST" id="repasForm" novalidate>
                @csrf
                
                <!-- Meal Basic Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Meal Name -->
                    <div>
                        <label for="nom" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Meal Name *
                        </label>
                        <input type="text" 
                               name="nom" 
                               id="nom" 
                               value="{{ old('nom') }}" 
                               class="w-full rounded-xl border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white transition @error('nom') border-red-500 @enderror" 
                               placeholder="e.g., Lunch with chicken" 
                               {{ old('nom') ? '' : 'required' }}>
                    </div>

                    <!-- Meal Type -->
                    <div>
                        <label for="type_repas" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Meal Type *
                        </label>
                        <select name="type_repas" 
                                id="type_repas" 
                                class="w-full rounded-xl border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white transition @error('type_repas') border-red-500 @enderror" 
                                {{ old('type_repas') ? '' : 'required' }}>
                            <option value="">Select a type</option>
                            <option value="petit-dejeuner" {{ old('type_repas') == 'petit-dejeuner' ? 'selected' : '' }}>🌅 Breakfast</option>
                            <option value="dejeuner" {{ old('type_repas') == 'dejeuner' ? 'selected' : '' }}>☀️ Lunch</option>
                            <option value="diner" {{ old('type_repas') == 'diner' ? 'selected' : '' }}>🌙 Dinner</option>
                            <option value="collation" {{ old('type_repas') == 'collation' ? 'selected' : '' }}>🍴 Snack</option>
                        </select>
                    </div>

                    <!-- Consumption Date -->
                    <div class="md:col-span-2">
                        <label for="date_consommation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Consumption Date *
                        </label>
                        <input type="datetime-local" 
                               name="date_consommation" 
                               id="date_consommation" 
                               value="{{ old('date_consommation', now()->format('Y-m-d\TH:i')) }}" 
                               class="w-full md:w-1/2 rounded-xl border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white transition @error('date_consommation') border-red-500 @enderror" 
                               {{ old('date_consommation') ? '' : 'required' }}>
                    </div>
                </div>

                <!-- Ingredients Section -->
                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                        <span class="w-8 h-8 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center mr-2">
                            <span class="text-white text-sm">🥕</span>
                        </span>
                        Meal Ingredients
                    </h3>
                    
                    <div id="ingredients-container">
                        <!-- Initial Ingredient Item -->
                        <div class="ingredient-item bg-gradient-to-r from-blue-50 to-green-50 dark:from-gray-700 dark:to-gray-700 p-4 rounded-xl mb-4 border border-gray-200 dark:border-gray-600 shadow-sm">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Ingredient *
                                    </label>
                                    <select name="ingredients[0][id]" 
                                            class="ingredient-select w-full rounded-xl border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white transition @error('ingredients.0.id') border-red-500 @enderror" 
                                            {{ old('ingredients.0.id') ? '' : 'required' }}>
                                        <option value="">Choose an ingredient</option>
                                        @foreach($ingredients as $ingredient)
                                            <option value="{{ $ingredient->id }}" 
                                                    data-calories="{{ $ingredient->calories_pour_100g }}"
                                                    data-proteines="{{ $ingredient->proteines_pour_100g }}"
                                                    data-glucides="{{ $ingredient->glucides_pour_100g }}"
                                                    data-lipides="{{ $ingredient->lipides_pour_100g }}">
                                                {{ $ingredient->nom }} ({{ $ingredient->calories_pour_100g }} kcal/100g)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Quantity (g) *
                                    </label>
                                    <input type="number" 
                                           name="ingredients[0][quantite]" 
                                           class="quantite-input w-full rounded-xl border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white transition @error('ingredients.0.quantite') border-red-500 @enderror" 
                                           min="1" 
                                           max="2000" 
                                           step="1" 
                                           placeholder="100" 
                                           {{ old('ingredients.0.quantite') ? '' : 'required' }}>
                                </div>
                                <div>
                                    <button type="button" 
                                            class="remove-ingredient w-full px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-xl font-semibold transition shadow-sm">
                                        🗑️ Remove
                                    </button>
                                </div>
                            </div>
                            <div class="mt-2 p-3 bg-white dark:bg-gray-800 rounded-lg text-sm ingredient-preview border border-blue-200 dark:border-gray-600">
                                <span class="calories-preview text-gray-600 dark:text-gray-400">Select an ingredient</span>
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" 
                            id="add-ingredient" 
                            class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold rounded-xl shadow-lg transition transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Add Ingredient
                    </button>
                </div>

                <!-- Nutritional Summary -->
                <div class="mb-6 p-6 bg-gradient-to-r from-blue-50 to-green-50 dark:from-gray-700 dark:to-gray-700 rounded-xl border border-gray-200 dark:border-gray-600 shadow-sm">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                        <span class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-2">
                            <span class="text-white text-sm">📊</span>
                        </span>
                        Nutritional Summary
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="text-center bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm">
                            <div class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-blue-500 bg-clip-text text-transparent" id="total-calories">0</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Calories</div>
                        </div>
                        <div class="text-center bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm">
                            <div class="text-3xl font-bold text-red-600 dark:text-red-400" id="total-proteines">0</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Proteins (g)</div>
                        </div>
                        <div class="text-center bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm">
                            <div class="text-3xl font-bold text-yellow-600 dark:text-yellow-400" id="total-glucides">0</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Carbs (g)</div>
                        </div>
                        <div class="text-center bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm">
                            <div class="text-3xl font-bold text-purple-600 dark:text-purple-400" id="total-lipides">0</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Fats (g)</div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('repas.index') }}" 
                       class="px-6 py-3 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-700 rounded-xl font-semibold shadow-sm transition">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-xl font-semibold shadow-lg transition transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                        </svg>
                        Create Meal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let ingredientIndex = 1;
    
    // Add ingredient
    document.getElementById('add-ingredient').addEventListener('click', function() {
        const container = document.getElementById('ingredients-container');
        const newItem = container.querySelector('.ingredient-item').cloneNode(true);
        
        // Update field names
        newItem.querySelectorAll('select, input').forEach(function(element) {
            if (element.name) {
                element.name = element.name.replace('[0]', '[' + ingredientIndex + ']');
                element.value = '';
            }
        });
        
        // Reset preview
        newItem.querySelector('.calories-preview').textContent = 'Select an ingredient';
        
        container.appendChild(newItem);
        ingredientIndex++;
        updateRemoveButtons();
    });
    
    // Remove ingredient
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-ingredient') || e.target.closest('.remove-ingredient')) {
            if (document.querySelectorAll('.ingredient-item').length > 1) {
                e.target.closest('.ingredient-item').remove();
                updateTotals();
                updateRemoveButtons();
            } else {
                alert('You must have at least one ingredient');
            }
        }
    });
    
    // Update remove buttons visibility
    function updateRemoveButtons() {
        const items = document.querySelectorAll('.ingredient-item');
        items.forEach(function(item) {
            const button = item.querySelector('.remove-ingredient');
            button.style.display = items.length > 1 ? 'block' : 'none';
        });
    }
    
    // Calculate totals
    function updateTotals() {
        let totalCalories = 0;
        let totalProteines = 0;
        let totalGlucides = 0;
        let totalLipides = 0;
        
        document.querySelectorAll('.ingredient-item').forEach(function(item) {
            const select = item.querySelector('.ingredient-select');
            const quantiteInput = item.querySelector('.quantite-input');
            const preview = item.querySelector('.ingredient-preview .calories-preview');
            
            if (select.value && quantiteInput.value) {
                const option = select.selectedOptions[0];
                const quantite = parseFloat(quantiteInput.value) || 0;
                const facteur = quantite / 100;
                
                const calories = parseFloat(option.dataset.calories) * facteur;
                const proteines = parseFloat(option.dataset.proteines) * facteur;
                const glucides = parseFloat(option.dataset.glucides) * facteur;
                const lipides = parseFloat(option.dataset.lipides) * facteur;
                
                totalCalories += calories;
                totalProteines += proteines;
                totalGlucides += glucides;
                totalLipides += lipides;
                
                preview.innerHTML = `<strong>${quantite}g:</strong> ${Math.round(calories)} kcal, ${proteines.toFixed(1)}g protein, ${glucides.toFixed(1)}g carbs, ${lipides.toFixed(1)}g fats`;
                preview.classList.remove('text-gray-600');
                preview.classList.add('text-gray-900', 'dark:text-white');
            } else {
                preview.innerHTML = 'Select an ingredient and quantity';
                preview.classList.remove('text-gray-900', 'dark:text-white');
                preview.classList.add('text-gray-600', 'dark:text-gray-400');
            }
        });
        
        document.getElementById('total-calories').textContent = Math.round(totalCalories);
        document.getElementById('total-proteines').textContent = totalProteines.toFixed(1);
        document.getElementById('total-glucides').textContent = totalGlucides.toFixed(1);
        document.getElementById('total-lipides').textContent = totalLipides.toFixed(1);
    }
    
    // Listen to changes
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('ingredient-select') || e.target.classList.contains('quantite-input')) {
            updateTotals();
        }
    });
    
    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('quantite-input')) {
            updateTotals();
        }
    });
    
    updateRemoveButtons();
});
</script>
@endsection
