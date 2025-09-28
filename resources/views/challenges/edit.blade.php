<x-app-layout>
    <div class="container">
        <h1>Modifier le Défi</h1>
        @if(auth()->user()->role === 'admin')
        <form action="{{ route('challenges.update', $challenge) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label>Titre</label>
                <input type="text" name="title" value="{{ old('title', $challenge->title) }}" required>
                @error('title') <div>{{ $message }}</div> @enderror
            </div>
            <div>
                <label>Description</label>
                <textarea name="description">{{ old('description', $challenge->description) }}</textarea>
            </div>
            <div>
                <label>Objectif</label>
                <input type="number" name="objectif" value="{{ old('objectif', $challenge->objectif) }}">
            </div>
            <div>
                <label>Durée (jours)</label>
                <input type="number" name="duration" value="{{ old('duration', $challenge->duration) }}">
            </div>
            <div>
                <label>Récompense</label>
                <input type="text" name="reward" value="{{ old('reward', $challenge->reward) }}">
            </div>
            <div>
                <label>Date de début</label>
                <input type="date" name="start_date" value="{{ old('start_date', $challenge->start_date?->format('Y-m-d')) }}">
            </div>
            <div>
                <label>Date de fin</label>
                <input type="date" name="end_date" value="{{ old('end_date', $challenge->end_date?->format('Y-m-d')) }}">
            </div>
            <div>
                <label>Actif ?</label>
                <input type="checkbox" name="is_active" value="1" {{ $challenge->is_active ? 'checked' : '' }}>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
        @endif
    </div>
</x-app-layout>