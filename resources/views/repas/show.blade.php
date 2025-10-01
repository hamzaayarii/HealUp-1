@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-green-50 dark:from-gray-900 dark:to-gray-800 py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('repas.index') }}" 
               class="inline-flex items-center text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Back to Meals List
            </a>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-6 bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Meal Header Card -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden mb-6 border border-gray-100 dark:border-gray-700">
            <div class="bg-gradient-to-r from-blue-500 to-green-500 p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-white">{{ $repas->nom ?? 'Unnamed Meal' }}</h1>
                        <p class="text-blue-100 mt-2">
                            @if($repas->type_repas == 'petit-dejeuner')
                                🌅 Breakfast
                            @elseif($repas->type_repas == 'dejeuner')
                                ☀️ Lunch
                            @elseif($repas->type_repas == 'diner')
                                🌙 Dinner
                            @else
                                🍴 {{ str_replace('-', ' ', ucfirst($repas->type_repas ?? 'Unknown')) }}
                            @endif
                        </p>
                        <p class="text-blue-100 text-sm mt-1">
                            {{ $repas->date_consommation ? $repas->date_consommation->format('l, F d, Y \a\t H:i') : 'No date set' }}
                        </p>
                    </div>
                    <div class="mt-4 md:mt-0 flex space-x-3">
                        <a href="{{ route('repas.edit', $repas) }}" 
                           class="inline-flex items-center px-4 py-2 bg-white hover:bg-gray-100 text-blue-600 font-semibold rounded-xl shadow-lg transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('repas.destroy', $repas) }}" 
                              method="POST" 
                              class="inline"
                              onsubmit="return confirm('Are you sure you want to delete this meal? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold rounded-xl shadow-lg transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Calories Summary -->
            <div class="bg-gradient-to-r from-blue-50 to-green-50 dark:bg-gray-700 p-6 border-b dark:border-gray-600">
                <div class="flex items-center justify-center">
                    <div class="text-center">
                        <p class="text-gray-600 dark:text-gray-400 text-sm uppercase tracking-wide mb-2">Total Calories</p>
                        <p class="text-5xl font-bold bg-gradient-to-r from-blue-600 to-green-500 bg-clip-text text-transparent">
                            {{ round($repas->calories_total ?? 0) }}
                        </p>
                        <p class="text-gray-600 dark:text-gray-400 text-lg mt-1">kcal</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ingredients List -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 border border-gray-100 dark:border-gray-700">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                <span class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mr-3">
                    <span class="text-white text-lg">🥗</span>
                </span>
                Ingredients Details
            </h2>

            @if($repas->repasIngredients && $repas->repasIngredients->count() > 0)
                <div class="space-y-4">
                    @foreach($repas->repasIngredients as $repasIngredient)
                        <div class="border dark:border-gray-700 rounded-xl p-5 hover:shadow-md transition bg-gradient-to-r from-blue-50 to-green-50 dark:bg-gray-700">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                <div class="flex-1">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        {{ $repasIngredient->ingredient->nom ?? 'Unknown' }}
                                    </h3>
                                    <p class="text-gray-600 dark:text-gray-400 mt-1">
                                        Quantity: {{ $repasIngredient->quantite ?? 0 }}g
                                    </p>
                                </div>
                                <div class="mt-4 md:mt-0 bg-white dark:bg-blue-900 rounded-xl p-3 text-center shadow-sm">
                                    <p class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-green-500 bg-clip-text text-transparent">
                                        {{ round($repasIngredient->calories ?? 0) }}
                                    </p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">kcal</p>
                                </div>
                            </div>

                            @if($repasIngredient->ingredient)
                                <div class="grid grid-cols-3 gap-4 mt-4 pt-4 border-t dark:border-gray-600">
                                    <div class="text-center">
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Proteins</p>
                                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                            {{ round(($repasIngredient->ingredient->proteines_pour_100g * $repasIngredient->quantite) / 100, 1) }}g
                                        </p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Carbs</p>
                                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                            {{ round(($repasIngredient->ingredient->glucides_pour_100g * $repasIngredient->quantite) / 100, 1) }}g
                                        </p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Fats</p>
                                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                            {{ round(($repasIngredient->ingredient->lipides_pour_100g * $repasIngredient->quantite) / 100, 1) }}g
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <p class="mt-4 text-gray-600 dark:text-gray-400 text-lg">No ingredients in this meal.</p>
                    <a href="{{ route('repas.edit', $repas) }}" 
                       class="mt-4 inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold rounded-xl shadow-lg transition">
                        Add Ingredients
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
