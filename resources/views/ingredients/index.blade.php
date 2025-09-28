@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-green-700">🍃 Mes Ingrédients</h1>
        <a href="{{ route('ingredients.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">+ Nouvel Ingrédient</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white shadow rounded-lg p-6 text-center">
            <h3 class="text-lg font-semibold text-gray-700">Total</h3>
            <p class="text-3xl font-bold text-indigo-600">{{ $ingredients->total() ?? 0 }}</p>
        </div>
        <div class="bg-white shadow rounded-lg p-6 text-center">
            <h3 class="text-lg font-semibold text-gray-700">🍎 Fruits</h3>
            <p class="text-3xl font-bold text-green-600">{{ \App\Models\Ingredient::where('categorie', 'fruits')->count() }}</p>
        </div>
        <div class="bg-white shadow rounded-lg p-6 text-center">
            <h3 class="text-lg font-semibold text-gray-700">🥕 Légumes</h3>
            <p class="text-3xl font-bold text-orange-600">{{ \App\Models\Ingredient::where('categorie', 'legumes')->count() }}</p>
        </div>
        <div class="bg-white shadow rounded-lg p-6 text-center">
            <h3 class="text-lg font-semibold text-gray-700">🌾 Céréales</h3>
            <p class="text-3xl font-bold text-yellow-600">{{ \App\Models\Ingredient::where('categorie', 'cereales')->count() }}</p>
        </div>
    </div>

    <!-- Liste des ingrédients -->
    <div class="bg-white shadow rounded-lg p-6">
        @if($ingredients->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($ingredients as $ingredient)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-lg font-semibold text-gray-800">
                                @if($ingredient->categorie == 'fruits') 🍎
                                @elseif($ingredient->categorie == 'legumes') 🥕
                                @elseif($ingredient->categorie == 'cereales') 🌾
                                @elseif($ingredient->categorie == 'viandes') 🥩
                                @elseif($ingredient->categorie == 'poissons') 🐟
                                @else 📦
                                @endif
                                {{ $ingredient->nom }}
                            </h3>
                            <span class="text-sm text-gray-500 capitalize">{{ $ingredient->categorie }}</span>
                        </div>
                        
                        <div class="text-sm text-gray-600 mb-3">
                            <p><strong>{{ $ingredient->calories_pour_100g }}</strong> kcal/100g</p>
                            <p>Protéines: <strong>{{ $ingredient->proteines_pour_100g }}g</strong></p>
                            <p>Glucides: <strong>{{ $ingredient->glucides_pour_100g }}g</strong></p>
                            <p>Lipides: <strong>{{ $ingredient->lipides_pour_100g }}g</strong></p>
                        </div>
                        
                        <div class="flex gap-2">
                            <a href="{{ route('ingredients.show', $ingredient) }}" class="text-blue-600 hover:underline">Voir</a>
                            <a href="{{ route('ingredients.edit', $ingredient) }}" class="text-yellow-600 hover:underline">Éditer</a>
                            <form action="{{ route('ingredients.destroy', $ingredient) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer cet ingrédient ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-6">
                {{ $ingredients->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">📦</div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun ingrédient</h3>
                <p class="text-gray-500 mb-4">Commencez par ajouter vos premiers ingrédients à votre base de données.</p>
                <a href="{{ route('ingredients.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">Créer mon premier ingrédient</a>
            </div>
        @endif
    </div>
</div>
@endsection