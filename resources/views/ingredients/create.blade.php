@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-green-50 dark:from-gray-900 dark:to-gray-800 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-green-500 bg-clip-text text-transparent">
                ➕ New Ingredient
            </h1>
            <a href="{{ route('ingredients.index') }}" 
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
            <form action="{{ route('ingredients.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Basic Information -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4 flex items-center">
                        <span class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-2">
                            <span class="text-white text-sm">📝</span>
                        </span>
                        Basic Information
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Name -->
                        <div class="md:col-span-2">
                            <label for="nom" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Ingredient Name *
                            </label>
                            <input type="text" 
                                   name="nom" 
                                   id="nom" 
                                   value="{{ old('nom') }}"
                                   class="w-full rounded-xl border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white transition" 
                                   placeholder="e.g., Chicken Breast" 
                                   required>
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="categorie" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Category *
                            </label>
                            <select name="categorie" 
                                    id="categorie" 
                                    class="w-full rounded-xl border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white transition" 
                                    required>
                                <option value="">Select a category</option>
                                <option value="fruits" {{ old('categorie') == 'fruits' ? 'selected' : '' }}>🍎 Fruits</option>
                                <option value="legumes" {{ old('categorie') == 'legumes' ? 'selected' : '' }}>🥕 Vegetables</option>
                                <option value="cereales" {{ old('categorie') == 'cereales' ? 'selected' : '' }}>🌾 Grains</option>
                                <option value="viandes" {{ old('categorie') == 'viandes' ? 'selected' : '' }}>🥩 Meats</option>
                                <option value="poissons" {{ old('categorie') == 'poissons' ? 'selected' : '' }}>🐟 Fish</option>
                                <option value="laitiers" {{ old('categorie') == 'laitiers' ? 'selected' : '' }}>🥛 Dairy Products</option>
                                <option value="autres" {{ old('categorie') == 'autres' ? 'selected' : '' }}>📦 Other</option>
                            </select>
                        </div>

                        <!-- Calories -->
                        <div>
                            <label for="calories_pour_100g" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Calories (per 100g) *
                            </label>
                            <input type="number" 
                                   name="calories_pour_100g" 
                                   id="calories_pour_100g" 
                                   value="{{ old('calories_pour_100g') }}"
                                   step="0.1"
                                   min="0"
                                   class="w-full rounded-xl border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white transition" 
                                   placeholder="165" 
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
                        <!-- Proteins -->
                        <div>
                            <label for="proteines_pour_100g" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Proteins (g) *
                            </label>
                            <input type="number" 
                                   name="proteines_pour_100g" 
                                   id="proteines_pour_100g" 
                                   value="{{ old('proteines_pour_100g') }}"
                                   step="0.1"
                                   min="0"
                                   class="w-full rounded-xl border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white transition" 
                                   placeholder="31.0" 
                                   required>
                        </div>

                        <!-- Carbohydrates -->
                        <div>
                            <label for="glucides_pour_100g" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Carbohydrates (g) *
                            </label>
                            <input type="number" 
                                   name="glucides_pour_100g" 
                                   id="glucides_pour_100g" 
                                   value="{{ old('glucides_pour_100g') }}"
                                   step="0.1"
                                   min="0"
                                   class="w-full rounded-xl border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white transition" 
                                   placeholder="0.0" 
                                   required>
                        </div>

                        <!-- Fats -->
                        <div>
                            <label for="lipides_pour_100g" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Fats (g) *
                            </label>
                            <input type="number" 
                                   name="lipides_pour_100g" 
                                   id="lipides_pour_100g" 
                                   value="{{ old('lipides_pour_100g') }}"
                                   step="0.1"
                                   min="0"
                                   class="w-full rounded-xl border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white transition" 
                                   placeholder="3.6" 
                                   required>
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4 flex items-center">
                        <span class="w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center mr-2">
                            <span class="text-white text-sm">📋</span>
                        </span>
                        Additional Details
                    </h2>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Description
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="3" 
                                  class="w-full rounded-xl border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white transition"
                                  placeholder="Add a brief description of the ingredient...">{{ old('description') }}</textarea>
                    </div>

                    <!-- Allergens -->
                    <div>
                        <label for="allergenes" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Allergens
                        </label>
                        <input type="text" 
                               name="allergenes" 
                               id="allergenes" 
                               value="{{ old('allergenes') }}" 
                               placeholder="e.g., gluten, lactose, nuts..."
                               class="w-full rounded-xl border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white transition">
                    </div>
                </div>

                <!-- Image Upload -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4 flex items-center">
                        <span class="w-8 h-8 bg-gradient-to-br from-pink-500 to-pink-600 rounded-lg flex items-center justify-center mr-2">
                            <span class="text-white text-sm">📷</span>
                        </span>
                        Ingredient Image
                    </h2>

                    <div class="flex items-center justify-center w-full">
                        <label for="image" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-xl cursor-pointer bg-gradient-to-br from-blue-50 to-green-50 dark:bg-gray-700 hover:bg-gradient-to-br hover:from-blue-100 hover:to-green-100 dark:hover:bg-gray-600 transition">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-12 h-12 mb-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                    <span class="font-semibold">Click to upload</span> or drag and drop
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    JPG, PNG or WEBP (MAX. 2MB)
                                </p>
                            </div>
                            <input type="file" 
                                   name="image" 
                                   id="image" 
                                   accept="image/*" 
                                   class="hidden">
                        </label>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                        Upload a high-quality image of the ingredient for better recognition
                    </p>
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
                        Create Ingredient
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Preview uploaded image
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const label = document.querySelector('label[for="image"]');
            label.innerHTML = `
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <img src="${e.target.result}" class="max-h-48 rounded-lg mb-3" alt="Preview">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        <span class="font-semibold">Click to change</span> or drag and drop
                    </p>
                </div>
            `;
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection
