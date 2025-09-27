@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-blue-700">🍽️ Mes Repas</h1>
        <a href="{{ route('repas.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">+ Nouveau Repas</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white shadow rounded-lg p-6 text-center">
            <h3 class="text-lg font-semibold text-gray-700">Total Repas</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $repas->total() ?? 0 }}</p>
        </div>
        <div class="bg-white shadow rounded-lg p-6 text-center">
            <h3 class="text-lg font-semibold text-gray-700">🌅 Petit-déjeuners</h3>
            <p class="text-3xl font-bold text-yellow-600">{{ $repas->where('type_repas', 'petit-dejeuner')->count() }}</p>
        </div>
        <div class="bg-white shadow rounded-lg p-6 text-center">
            <h3 class="text-lg font-semibold text-gray-700">☀️ Déjeuners</h3>
            <p class="text-3xl font-bold text-orange-600">{{ $repas->where('type_repas', 'dejeuner')->count() }}</p>
        </div>
        <div class="bg-white shadow rounded-lg p-6 text-center">
            <h3 class="text-lg font-semibold text-gray-700">🌙 Dîners</h3>
            <p class="text-3xl font-bold text-purple-600">{{ $repas->where('type_repas', 'diner')->count() }}</p>
        </div>
    </div>

    <!-- Liste des repas -->
    <div class="bg-white shadow rounded-lg">
        @if($repas->count() > 0)
            <div class="p-6">
                <div class="grid gap-6">
                    @foreach($repas as $repas_item)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">
                                        @if($repas_item->type_repas == 'petit-dejeuner') 🌅
                                        @elseif($repas_item->type_repas == 'dejeuner') ☀️
                                        @elseif($repas_item->type_repas == 'diner') 🌙
                                        @else 🍴
                                        @endif
                                        {{ $repas_item->nom }}
                                    </h3>
                                    <p class="text-sm text-gray-600">
                                        {{ $repas_item->date_consommation->format('d/m/Y à H:i') }}
                                    </p>
                                </div>
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded capitalize">
                                    {{ str_replace('-', ' ', $repas_item->type_repas) }}
                                </span>
                            </div>
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-3">
                                <div class="text-center">
                                    <div class="text-lg font-bold text-blue-600">{{ round($repas_item->calories_total) }}</div>
                                    <div class="text-xs text-gray-500">kcal</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-lg font-bold text-red-600">{{ round($repas_item->proteines_total, 1) }}g</div>
                                    <div class="text-xs text-gray-500">protéines</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-lg font-bold text-yellow-600">{{ round($repas_item->glucides_total, 1) }}g</div>
                                    <div class="text-xs text-gray-500">glucides</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-lg font-bold text-purple-600">{{ round($repas_item->lipides_total, 1) }}g</div>
                                    <div class="text-xs text-gray-500">lipides</div>
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <p class="text-sm text-gray-600">
                                    Ingrédients ({{ $repas_item->ingredients->count() }}):
                                    @foreach($repas_item->ingredients->take(3) as $ingredient)
                                        <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs">{{ $ingredient->nom }}</span>
                                    @endforeach
                                    @if($repas_item->ingredients->count() > 3)
                                        <span class="text-gray-500">...</span>
                                    @endif
                                </p>
                                
                                <div class="flex space-x-2">
                                    <a href="{{ route('repas.show', $repas_item) }}" class="text-blue-600 hover:underline text-sm">Voir</a>
                                    <a href="{{ route('repas.edit', $repas_item) }}" class="text-yellow-600 hover:underline text-sm">Éditer</a>
                                    <form action="{{ route('repas.destroy', $repas_item) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ce repas ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline text-sm">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-6">{{ $repas->links() }}</div>
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-gray-400 text-6xl mb-4">🍽️</div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Aucun repas</h3>
                <p class="text-gray-500 mb-4">Commencez par enregistrer vos premiers repas.</p>
                <a href="{{ route('repas.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">Créer mon premier repas</a>
            </div>
        @endif
    </div>
</div>
@endsection
