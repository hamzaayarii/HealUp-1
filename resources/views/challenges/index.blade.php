<x-app-layout>
    <div class="container">
        <h1>Liste des Défis</h1>
        @if(auth()->user()->isAdmin())
            <a href="{{ route('challenges.create') }}" class="btn btn-success mb-3">Ajouter un défi</a>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Objectif</th>
                    <th>Durée</th>
                    <th>Dates</th>
                    <th>Récompense</th>
                    <th>Actif</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($challenges as $challenge)
                <tr>
                    <td>{{ $challenge->title }}</td>
                    <td>{{ $challenge->objectif }}</td>
                    <td>{{ $challenge->duration }}</td>
                    <td>{{ $challenge->start_date }} - {{ $challenge->end_date }}</td>
                    <td>{{ $challenge->reward }}</td>
                    <td>{{ $challenge->is_active ? 'Oui' : 'Non' }}</td>
                    <td>
                        <a href="{{ route('challenges.edit', $challenge) }}" class="btn btn-primary btn-sm">Éditer</a>
                        <form action="{{ route('challenges.destroy', $challenge) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce défi ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $challenges->links() }}
    </div>
</x-app-layout>