<div class="p-6 space-y-4">
    <h2 class="text-xl font-bold text-gray-800">📌 {{ $challenge->title }}</h2>
    <p class="text-gray-600">{{ $challenge->description ?? '—' }}</p>

    <ul class="space-y-1 text-sm text-gray-700">
        <li><strong>Objectif :</strong> {{ $challenge->objectif }}</li>
        <li><strong>Durée :</strong> {{ $challenge->duration }} jours</li>
        <li><strong>Récompense :</strong> {{ $challenge->reward }}</li>
        <li><strong>Dates :</strong> {{ $challenge->start_date?->format('d/m/Y') }} - {{ $challenge->end_date?->format('d/m/Y') ?? '—' }}</li>
        <li><strong>Statut :</strong> {{ ucfirst($challenge->status) }}</li>
        <li><strong>Créateur :</strong> {{ $challenge->creator->name ?? 'Inconnu' }}</li>
    </ul>

    <h3 class="text-lg font-semibold mt-4">👥 Participants</h3>
    @if($challenge->participations->isEmpty())
        <p class="text-gray-500">Aucun participant.</p>
    @else
        <table class="w-full text-sm text-left border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-3 py-2">Utilisateur</th>
                    <th class="px-3 py-2">Progression</th>
                    <th class="px-3 py-2">Points</th>
                    <th class="px-3 py-2">Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach($challenge->participations as $p)
                    <tr class="border-t">
                        <td class="px-3 py-2">{{ $p->user->name ?? 'Inconnu' }}</td>
                        <td class="px-3 py-2">{{ $p->current_progress ?? 0 }} / {{ $challenge->objectif }}</td>
                        <td class="px-3 py-2">{{ $p->points_earned ?? 0 }}</td>
                        <td class="px-3 py-2">
                            @if($p->completed)
                                <span class="text-green-600 font-semibold">✅ Terminé</span>
                            @else
                                <span class="text-blue-600">⏳ En cours</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
