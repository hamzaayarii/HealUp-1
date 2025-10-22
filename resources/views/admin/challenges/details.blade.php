<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Détails du Défi : {{ $challenge->title }}
            </h1>
            <a href="{{ route('admin.challenges.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                ⬅ Retour à la liste
            </a>
        </div>

        <!-- Challenge Info -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Informations générales</h2>
            <ul class="space-y-2 text-gray-700">
                <li><strong>Titre :</strong> {{ $challenge->title }}</li>
                <li><strong>Description :</strong> {{ $challenge->description ?? '—' }}</li>
                <li><strong>Objectif :</strong> {{ $challenge->objectif }}</li>
                <li><strong>Durée :</strong> {{ $challenge->duration }} jours</li>
                <li><strong>Récompense :</strong> {{ $challenge->reward }}</li>
                <li><strong>Date de début :</strong> {{ $challenge->start_date?->format('d/m/Y') }}</li>
                <li><strong>Date de fin :</strong> {{ $challenge->end_date?->format('d/m/Y') ?? 'Non définie' }}</li>
                <li><strong>Statut :</strong> 
                    @if($challenge->status === 'approved')
                        <span class="px-2 py-1 text-sm bg-green-100 text-green-800 rounded">✅ Approuvé</span>
                    @elseif($challenge->status === 'pending')
                        <span class="px-2 py-1 text-sm bg-yellow-100 text-yellow-800 rounded">⏳ En attente</span>
                    @else
                        <span class="px-2 py-1 text-sm bg-red-100 text-red-800 rounded">❌ Rejeté</span>
                    @endif
                </li>
                <li><strong>Créé par :</strong> {{ $challenge->creator->name ?? 'Inconnu' }}</li>
                @if($challenge->rejection_reason)
                    <li><strong>Raison du rejet :</strong> {{ $challenge->rejection_reason }}</li>
                @endif
            </ul>
        </div>

        <!-- Participants -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Participants</h2>

            @if($challenge->participations->isEmpty())
                <p class="text-gray-500">Aucun participant pour ce défi.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Utilisateur</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Progression</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Points</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dates</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($challenge->participations as $participation)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $participation->user->name ?? 'Utilisateur inconnu' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $participation->current_progress ?? 0 }} / {{ $challenge->objectif }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $participation->points_earned ?? 0 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($participation->completed)
                                            <span class="px-2 py-1 text-sm bg-green-100 text-green-800 rounded">✅ Terminé</span>
                                        @else
                                            <span class="px-2 py-1 text-sm bg-blue-100 text-blue-800 rounded">⏳ En cours</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div>Début : {{ $participation->joined_at?->format('d/m/Y') ?? '—' }}</div>
                                        <div>Fin : {{ $participation->completed_at?->format('d/m/Y') ?? '—' }}</div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
