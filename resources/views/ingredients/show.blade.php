@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-green-700">
            @if($ingredient->categorie == 'fruits') 🍎
            @elseif($ingredient->categorie == 'legumes') 🥕
            @elseif($ingredient->categorie == 'cereales') 🌾
            @elseif($ingredient->categorie == 'viandes') 🥩
            @elseif($ingredient->categorie == 'poissons') 🐟
            @elseif($ingredient->categorie == 'laitiers') 🥛
            @else 📦
            @endif
            {{ $ingredient->nom }}
        </h1>
        <div class="flex space-x-2">
            <a href="{{ route('ingredients.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded">Retour</a>
            <a href="{{ route('ingredients.edit', $ingredient) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded">✏️ Modifier</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Image et infos de base -->
        <div class="lg:col-span-1">
            <div class="bg-white shadow rounded-lg p-6">
                @if($ingredient->image)
                    <img src="{{ asset('storage/ingredients/' . $ingredient->image) }}" 
                         alt="{{ $ingredient->nom }}" 
                         class="w-full h-64 object-cover rounded-lg mb-4">
                @else
                    <div class="w-full h-64 bg-gray-200 rounded-lg mb-4 flex items-center justify-center">
                        <span class="text-6xl">
                            @if($ingredient->categorie == 'fruits') 🍎
                            @elseif($ingredient->categorie == 'legumes') 🥕
                            @elseif($ingredient->categorie == 'cereales') 🌾
                            @elseif($ingredient->categorie == 'viandes') 🥩
                            @elseif($ingredient->categorie == 'poissons') 🐟
                            @elseif($ingredient->categorie == 'laitiers') 🥛
                            @else 📦
                            @endif
                        </span>
                    </div>
                @endif

                <div class="text-center">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $ingredient->nom }}</h2>
                    <span class="inline-block bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full capitalize">
                        {{ $ingredient->categorie }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Informations nutritionnelles -->
        <div class="lg:col-span-2">
            <div class="bg-white shadow rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">📊 Valeurs nutritionnelles (pour 100g)</h3>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center p-4 bg-blue-50 rounded-lg">
                        <div class="text-2xl font-bold text-blue-600">{{ $ingredient->calories_pour_100g }}</div>
                        <div class="text-sm text-gray-600">Calories</div>
                        <div class="text-xs text-gray-500">kcal</div>
                    </div>
                    
                    <div class="text-center p-4 bg-red-50 rounded-lg">
                        <div class="text-2xl font-bold text-red-600">{{ $ingredient->proteines_pour_100g }}</div>
                        <div class="text-sm text-gray-600">Protéines</div>
                        <div class="text-xs text-gray-500">grammes</div>
                    </div>
                    
                    <div class="text-center p-4 bg-yellow-50 rounded-lg">
                        <div class="text-2xl font-bold text-yellow-600">{{ $ingredient->glucides_pour_100g }}</div>
                        <div class="text-sm text-gray-600">Glucides</div>
                        <div class="text-xs text-gray-500">grammes</div>
                    </div>
                    
                    <div class="text-center p-4 bg-purple-50 rounded-lg">
                        <div class="text-2xl font-bold text-purple-600">{{ $ingredient->lipides_pour_100g }}</div>
                        <div class="text-sm text-gray-600">Lipides</div>
                        <div class="text-xs text-gray-500">grammes</div>
                    </div>
                </div>
            </div>

            <!-- Description et allergènes -->
            @if($ingredient->description || $ingredient->allergenes)
            <div class="bg-white shadow rounded-lg p-6">
                @if($ingredient->description)
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">📝 Description</h3>
                        <p class="text-gray-600">{{ $ingredient->description }}</p>
                    </div>
                @endif

                @if($ingredient->allergenes)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">⚠️ Allergènes</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $ingredient->allergenes) as $allergene)
                                <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded">{{ trim($allergene) }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            @endif
        </div>
    </div>

    <!-- Actions -->
    <div class="mt-8 flex justify-center space-x-4">
        <a href="{{ route('ingredients.edit', $ingredient) }}" 
           class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-6 rounded">
            ✏️ Modifier cet ingrédient
        </a>
        <form action="{{ route('ingredients.destroy', $ingredient) }}" method="POST" class="inline" 
              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet ingrédient ?')">
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
