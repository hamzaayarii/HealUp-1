@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-blue-700">➕ Nouveau Repas</h1>
        <a href="{{ route('repas.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded">Retour à la liste</a>
    </div>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('repas.store') }}" method="POST" id="repasForm">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Nom du repas -->
                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom du repas *</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom') }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                           placeholder="Ex: Déjeuner du midi" required>
                </div>

                <!-- Type de repas -->
                <div>
                    <label for="type_repas" class="block text-sm font-medium text-gray-700">Type de repas *</label>
                    <select name="type_repas" id="type_repas" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        <option value="">Sélectionner un type</option>
                        <option value="petit-dejeuner" {{ old('type_repas') == 'petit-dejeuner' ? 'selected' : '' }}>🌅 Petit-déjeuner</option>
                        <option value="dejeuner" {{ old('type_repas') == 'dejeuner' ? 'selected' : '' }}>☀️ Déjeuner</option>
                        <option value="diner" {{ old('type_repas') == 'diner' ? 'selected' : '' }}>🌙 Dîner</option>
                        <option value="collation" {{ old('type_repas') == 'collation' ? 'selected' : '' }}>🍴 Collation</option>
                    </select>
                </div>

                <!-- Date de consommation -->
                <div class="md:col-span-2">
                    <label for="date_consommation" class="block text-sm font-medium text-gray-700">Date de consommation *</label>
                    <input type="datetime-local" name="date_consommation" id="date_consommation" 
                           value="{{ old('date_consommation', now()->format('Y-m-d\TH:i')) }}" 
                           class="mt-1 block w-full md:w-1/2 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                </div>
            </div>

            <!-- Sélection des ingrédients -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">🥕 Ingrédients du repas</h3>
                <div id="ingredients-container">
                    <!-- Template pour un ingrédient -->
                    <div class="ingredient-item bg-gray-50 p-4 rounded-lg mb-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Ingrédient *</label>
                                <select name="ingredients[0][id]" class="ingredient-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    <option value="">Choisir un ingrédient</option>
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
                                <label class="block text-sm font-medium text-gray-700">Quantité (g) *</label>
                                <input type="number" name="ingredients[0][quantite]" 
                                       class="quantite-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                                       min="1" max="2000" step="1" placeholder="100" required>
                            </div>
                            <div>
                                <button type="button" class="remove-ingredient bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                                    🗑️ Supprimer
                                </button>
                            </div>
                        </div>
                        <div class="mt-2 p-2 bg-blue-50 rounded text-sm ingredient-preview">
                            <span class="calories-preview">Sélectionnez un ingrédient</span>
                        </div>
                    </div>
                </div>
                
                <button type="button" id="add-ingredient" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
                    ➕ Ajouter un ingrédient
                </button>
            </div>

            <!-- Résumé nutritionnel -->
            <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">📊 Résumé nutritionnel</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-600" id="total-calories">0</div>
                        <div class="text-sm text-gray-600">Calories</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-red-600" id="total-proteines">0</div>
                        <div class="text-sm text-gray-600">Protéines (g)</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-yellow-600" id="total-glucides">0</div>
                        <div class="text-sm text-gray-600">Glucides (g)</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-purple-600" id="total-lipides">0</div>
                        <div class="text-sm text-gray-600">Lipides (g)</div>
                    </div>
                </div>
            </div>

            <!-- Boutons -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('repas.index') }}" 
                   class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                    💾 Créer le repas
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let ingredientIndex = 1;
    
    // Ajouter un ingrédient
    document.getElementById('add-ingredient').addEventListener('click', function() {
        const container = document.getElementById('ingredients-container');
        const newItem = container.querySelector('.ingredient-item').cloneNode(true);
        
        // Mettre à jour les noms des champs
        newItem.querySelectorAll('select, input').forEach(function(element) {
            if (element.name) {
                element.name = element.name.replace('[0]', '[' + ingredientIndex + ']');
                element.value = '';
            }
        });
        
        container.appendChild(newItem);
        ingredientIndex++;
        updateRemoveButtons();
    });
    
    // Supprimer un ingrédient
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-ingredient')) {
            if (document.querySelectorAll('.ingredient-item').length > 1) {
                e.target.closest('.ingredient-item').remove();
                updateTotals();
            }
        }
    });
    
    // Mettre à jour les boutons de suppression
    function updateRemoveButtons() {
        const items = document.querySelectorAll('.ingredient-item');
        items.forEach(function(item, index) {
            const button = item.querySelector('.remove-ingredient');
            button.style.display = items.length > 1 ? 'block' : 'none';
        });
    }
    
    // Calculer les totaux
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
                
                preview.innerHTML = `${quantite}g: ${Math.round(calories)} kcal, ${proteines.toFixed(1)}g prot., ${glucides.toFixed(1)}g gluc., ${lipides.toFixed(1)}g lip.`;
            } else {
                preview.innerHTML = 'Sélectionnez un ingrédient et une quantité';
            }
        });
        
        document.getElementById('total-calories').textContent = Math.round(totalCalories);
        document.getElementById('total-proteines').textContent = totalProteines.toFixed(1);
        document.getElementById('total-glucides').textContent = totalGlucides.toFixed(1);
        document.getElementById('total-lipides').textContent = totalLipides.toFixed(1);
    }
    
    // Écouter les changements
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
