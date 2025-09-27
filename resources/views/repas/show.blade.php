@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-blue-700">
            @if($repas->type_repas == 'petit-dejeuner') 🌅
            @elseif($repas->type_repas == 'dejeuner') ☀️
            @elseif($repas->type_repas == 'diner') 🌙
            @else 🍴
            @endif
            {{ $repas->nom }}
        </h1>
        <div class="flex space-x-2">
            <a href="{{ route('repas.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded">Retour</a>
            <a href="{{ route('repas.edit', $repas) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded">✏️ Modifier</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Informations générales -->
        <div class="lg:col-span-1">
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">📋 Informations</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Type de repas</label>
                        <p class="text-lg capitalize">
                            @if($repas->type_repas == 'petit-dejeuner') 🌅 Petit-déjeuner
                            @elseif($repas->type_repas == 'dejeuner') ☀️ Déjeuner
                            @elseif($repas->type_repas == 'diner') 🌙 Dîner
                            @else 🍴 {{ str_replace('-', ' ', $repas->type_repas) }}
                            @endif
                        </p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Date de consommation</label>
                        <p class="text-lg">{{ $repas->date_consommation->format('d/m/Y à H:i') }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Créé par</label>
                        <p class="text-lg">{{ $repas->user->name }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Ajouté</label>
                        <p class="text-sm text-gray-500">{{ $repas->created_at->format('d/m/Y à H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Valeurs nutritionnelles -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">📊 Valeurs nutritionnelles</h3>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center p-3 bg-blue-50 rounded">
                        <span class="font-medium">Calories</span>
                        <span class="text-xl font-bold text-blue-600">{{ round($repas->calories_total) }} kcal</span>
                    </div>
                    
                    <div class="flex justify-between items-center p-3 bg-red-50 rounded">
                        <span class="font-medium">Protéines</span>
                        <span class="text-xl font-bold text-red-600">{{ round($repas->proteines_total, 1) }}g</span>
                    </div>
                    
                    <div class="flex justify-between items-center p-3 bg-yellow-50 rounded">
                        <span class="font-medium">Glucides</span>
                        <span class="text-xl font-bold text-yellow-600">{{ round($repas->glucides_total, 1) }}g</span>
                    </div>
                    
                    <div class="flex justify-between items-center p-3 bg-purple-50 rounded">
                        <span class="font-medium">Lipides</span>
                        <span class="text-xl font-bold text-purple-600">{{ round($repas->lipides_total, 1) }}g</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste des ingrédients -->
        <div class="lg:col-span-2">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">🥕 Ingrédients ({{ $repas->ingredients->count() }})</h3>
                
                @if($repas->ingredients->count() > 0)
                    <div class="space-y-4">
                        @foreach($repas->ingredients as $ingredient)
                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-800">
                                            @if($ingredient->categorie == 'fruits') 🍎
                                            @elseif($ingredient->categorie == 'legumes') 🥕
                                            @elseif($ingredient->categorie == 'cereales') 🌾
                                            @elseif($ingredient->categorie == 'viandes') 🥩
                                            @elseif($ingredient->categorie == 'poissons') 🐟
                                            @elseif($ingredient->categorie == 'laitiers') 🥛
                                            @else 📦
                                            @endif
                                            {{ $ingredient->nom }}
                                        </h4>
                                        <p class="text-sm text-gray-600 capitalize">{{ $ingredient->categorie }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-semibold text-blue-600">Quantité: <strong>{{ $ingredient->pivot->quantite ?? 0 }}g</strong></p>
                                        <p class="text-sm text-gray-500">{{ round($ingredient->pivot->calories_calculees ?? 0) }} kcal</p>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-3 pt-3 border-t border-gray-100">
                                    <div class="text-center">
                                        <div class="text-sm font-bold text-blue-600">{{ round(($ingredient->calories_pour_100g * ($ingredient->pivot->quantite ?? 0)) / 100) }}</div>
                                        <div class="text-xs text-gray-500">kcal</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-sm font-bold text-red-600">{{ round(($ingredient->proteines_pour_100g * ($ingredient->pivot->quantite ?? 0)) / 100, 1) }}g</div>
                                        <div class="text-xs text-gray-500">protéines</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-sm font-bold text-yellow-600">{{ round(($ingredient->glucides_pour_100g * ($ingredient->pivot->quantite ?? 0)) / 100, 1) }}g</div>
                                        <div class="text-xs text-gray-500">glucides</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-sm font-bold text-purple-600">{{ round(($ingredient->lipides_pour_100g * ($ingredient->pivot->quantite ?? 0)) / 100, 1) }}g</div>
                                        <div class="text-xs text-gray-500">lipides</div>
                                    </div>
                                </div>
                                
                                @if($ingredient->allergenes)
                                    <div class="mt-3 pt-3 border-t border-gray-100">
                                        <p class="text-sm text-gray-600 mb-1">⚠️ Allergènes:</p>
                                        <div class="flex flex-wrap gap-1">
                                            @foreach(explode(',', $ingredient->allergenes) as $allergene)
                                                <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded">{{ trim($allergene) }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="text-gray-400 text-4xl mb-2">🍽️</div>
                        <p class="text-gray-500">Aucun ingrédient dans ce repas.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="mt-8 flex justify-center space-x-4">
        <a href="{{ route('repas.edit', $repas) }}" 
           class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-6 rounded">
            ✏️ Modifier ce repas
        </a>
        <form action="{{ route('repas.destroy', $repas) }}" method="POST" class="inline" 
              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce repas ?')">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-6 rounded">
                🗑️ Supprimer
            </button>
        </form>
    </div>
</div>
@endsection
