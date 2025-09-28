@push('styles')
<link rel="stylesheet" href="{{ asset('css/challenges.css') }}">
@endpush

<x-app-layout>
    <div class="bg-animated"></div>
    <div class="container">
        <!-- Hero Section -->
        <div class="hero">
            <h1 class="hero-title">🏆 Défis & Gamification</h1>
            <p class="hero-subtitle">
                Transformez votre bien-être en aventure inspirante ! Relevez des défis motivants, débloquez des achievements et progressez avec vos collègues étudiants et enseignants dans une ambiance bienveillante.
            </p>
        </div>

        <!-- Statistiques -->
        <div class="stats-grid">
            <x-stat-card type="active" icon="fire" :number="$userStats['active_challenges'] ?? 0" label="Défis Actifs"/>
            <x-stat-card type="completed" icon="trophy" :number="$userStats['completed_challenges'] ?? 0" label="Défis Complétés"/>
            <x-stat-card type="badges" icon="medal" :number="$userStats['badges_earned'] ?? 0" label="Badges Gagnés"/>
            <x-stat-card type="rank" icon="crown" :number="'#' . ($userStats['global_rank'] ?? '-')" label="Classement Global"/>
        </div>

        <!-- Mes Défis Actifs -->
        <div class="section">
            <div class="section-header">
                <h2 class="section-title">🎯 Mes Défis en Cours</h2>
                <a href="" class="btn-secondary">Voir tous mes défis</a>
            </div>
            <div class="challenges-grid">
            </div>
        </div>

        
</x-app-layout>