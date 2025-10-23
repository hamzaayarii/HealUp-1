@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-green-50 dark:from-gray-900 dark:to-gray-800 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-green-500 bg-clip-text text-transparent">
                ✏️ Edit Ingredient
            </h1>
            <div class="flex space-x-2">
                <a href="{{ route('ingredients.index') }}" 
                   class="px-4 py-2 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-700 font-semibold rounded-xl transition shadow-sm">
                    Back
                </a>
                <a href="{{ route('ingredients.show', $ingredient) }}" 
                   class="px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold rounded-xl shadow-sm transition">
                    View
                </a>
            </div>
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
            <form action="{{ route('ingredients.update', $ingredient) }}" method="POST" novalidate>
                @csrf
                @method('PUT')
                
                <!-- Basic Information -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4 flex items-center">
                        <span class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-2">
                            <span class="text-white text-sm">📝</span>
                        </span>
                        Basic Information
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label for="nom" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Ingredient Name *
                            </label>
                            <input type="text" 
                                   name="nom" 
                                   id="nom" 
                                   value="{{ old('nom', $ingredient->nom) }}"
                                   class="w-full rounded-xl border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white transition" 
                                   required>
                        </div>

                        <div>
                            <label for="categorie" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Category *
                            </label>
                            <select name="categorie" 
                                    id="categorie" 
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white transition" 
                                    required>
                                <option value="">Select a category</option>
                                <option value="fruits" {{ old('categorie', $ingredient->categorie) == 'fruits' ? 'selected' : '' }}>🍎 Fruits</option>
                                <option value="legumes" {{ old('categorie', $ingredient->categorie) == 'legumes' ? 'selected' : '' }}>🥕 Vegetables</option>
                                <option value="cereales" {{ old('categorie', $ingredient->categorie) == 'cereales' ? 'selected' : '' }}>🌾 Grains</option>
                                <option value="viandes" {{ old('categorie', $ingredient->categorie) == 'viandes' ? 'selected' : '' }}>🍖 Meats</option>
                                <option value="produits-laitiers" {{ old('categorie', $ingredient->categorie) == 'produits-laitiers' ? 'selected' : '' }}>🥛 Dairy</option>
                                <option value="poissons" {{ old('categorie', $ingredient->categorie) == 'poissons' ? 'selected' : '' }}>🐟 Fish</option>
                                <option value="autres" {{ old('categorie', $ingredient->categorie) == 'autres' ? 'selected' : '' }}>📦 Other</option>
                            </select>
                        </div>

                        <div>
                            <label for="calories_pour_100g" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Calories (per 100g) *
                            </label>
                            <input type="number" 
                                   name="calories_pour_100g" 
                                   id="calories_pour_100g" 
                                   value="{{ old('calories_pour_100g', $ingredient->calories_pour_100g) }}"
                                   step="0.01"
                                   min="0"
                                   class="w-full rounded-xl border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white transition" 
                                   required>
                        </div>
                    </div>
                </div>

                <!-- Macronutrients -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4 flex items-center">
                        <span class="w-8 h-8 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center mr-2">
                            <span class="text-white text-sm">🥗</span>
                        </span>
                        Macronutrients (per 100g)
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="proteines_pour_100g" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Proteins (g) *
                            </label>
                            <input type="number" 
                                   name="proteines_pour_100g" 
                                   id="proteines_pour_100g" 
                                   value="{{ old('proteines_pour_100g', $ingredient->proteines_pour_100g) }}"
                                   step="0.01"
                                   min="0"
                                   class="w-full rounded-xl border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white transition" 
                                   required>
                        </div>

                        <div>
                            <label for="glucides_pour_100g" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Carbohydrates (g) *
                            </label>
                            <input type="number" 
                                   name="glucides_pour_100g" 
                                   id="glucides_pour_100g" 
                                   value="{{ old('glucides_pour_100g', $ingredient->glucides_pour_100g) }}"
                                   step="0.01"
                                   min="0"
                                   class="w-full rounded-xl border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white transition" 
                                   required>
                        </div>

                        <div>
                            <label for="lipides_pour_100g" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Fats (g) *
                            </label>
                            <input type="number" 
                                   name="lipides_pour_100g" 
                                   id="lipides_pour_100g" 
                                   value="{{ old('lipides_pour_100g', $ingredient->lipides_pour_100g) }}"
                                   step="0.01"
                                   min="0"
                                   class="w-full rounded-xl border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white transition" 
                                   required>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('ingredients.index') }}" 
                       class="px-6 py-3 bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-700 rounded-xl font-semibold shadow-sm transition">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-xl font-semibold shadow-lg transition transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                        </svg>
                        Update Ingredient
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
