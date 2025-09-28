@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-green-700">➕ Nouvel Ingrédient</h1>
        <a href="{{ route('ingredients.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded">Retour à la liste</a>
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
        <form action="{{ route('ingredients.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nom -->
                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom de l'ingrédient *</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom') }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" required>
                </div>

                <!-- Catégorie -->
                <div>
                    <label for="categorie" class="block text-sm font-medium text-gray-700">Catégorie *</label>
                    <select name="categorie" id="categorie" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" required>
                        <option value="">Sélectionner une catégorie</option>
                        <option value="fruits" {{ old('categorie') == 'fruits' ? 'selected' : '' }}>🍎 Fruits</option>
                        <option value="legumes" {{ old('categorie') == 'legumes' ? 'selected' : '' }}>🥕 Légumes</option>
                        <option value="cereales" {{ old('categorie') == 'cereales' ? 'selected' : '' }}>🌾 Céréales</option>
                        <option value="viandes" {{ old('categorie') == 'viandes' ? 'selected' : '' }}>🥩 Viandes</option>
                        <option value="poissons" {{ old('categorie') == 'poissons' ? 'selected' : '' }}>🐟 Poissons</option>
                        <option value="laitiers" {{ old('categorie') == 'laitiers' ? 'selected' : '' }}>🥛 Produits laitiers</option>
                    </select>
                </div>

                <!-- Calories -->
                <div>
                    <label for="calories_pour_100g" class="block text-sm font-medium text-gray-700">Calories (pour 100g) *</label>
                    <input type="number" name="calories_pour_100g" id="calories_pour_100g" 
                           value="{{ old('calories_pour_100g') }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" 
                           min="0" step="0.1" required>
                </div>

                <!-- Protéines -->
                <div>
                    <label for="proteines_pour_100g" class="block text-sm font-medium text-gray-700">Protéines (g pour 100g) *</label>
                    <input type="number" name="proteines_pour_100g" id="proteines_pour_100g" 
                           value="{{ old('proteines_pour_100g') }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" 
                           min="0" step="0.1" required>
                </div>

                <!-- Glucides -->
                <div>
                    <label for="glucides_pour_100g" class="block text-sm font-medium text-gray-700">Glucides (g pour 100g) *</label>
                    <input type="number" name="glucides_pour_100g" id="glucides_pour_100g" 
                           value="{{ old('glucides_pour_100g') }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" 
                           min="0" step="0.1" required>
                </div>

                <!-- Lipides -->
                <div>
                    <label for="lipides_pour_100g" class="block text-sm font-medium text-gray-700">Lipides (g pour 100g) *</label>
                    <input type="number" name="lipides_pour_100g" id="lipides_pour_100g" 
                           value="{{ old('lipides_pour_100g') }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" 
                           min="0" step="0.1" required>
                </div>
            </div>

            <!-- Description -->
            <div class="mt-6">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="3" 
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">{{ old('description') }}</textarea>
            </div>

            <!-- Allergènes -->
            <div class="mt-6">
                <label for="allergenes" class="block text-sm font-medium text-gray-700">Allergènes</label>
                <input type="text" name="allergenes" id="allergenes" 
                       value="{{ old('allergenes') }}" 
                       placeholder="Ex: gluten, lactose, fruits à coque..."
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
            </div>

            <!-- Image -->
            <div class="mt-6">
                <label for="image" class="block text-sm font-medium text-gray-700">Image de l'ingrédient</label>
                <input type="file" name="image" id="image" accept="image/*" 
                       class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                <p class="text-sm text-gray-500 mt-1">JPG, PNG max 2MB</p>
            </div>

            <!-- Boutons -->
            <div class="flex justify-end space-x-4 mt-8">
                <a href="{{ route('ingredients.index') }}" 
                   class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                    💾 Créer l'ingrédient
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
