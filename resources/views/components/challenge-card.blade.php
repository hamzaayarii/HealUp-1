
<div class="challenge-card {{ $status ?? '' }}">
    <div class="challenge-header">
        <div>
            <h3 class="challenge-title">{{ $challenge->title }}</h3>
            <span class="challenge-type">{{ ucfirst($challenge->type) }}</span>
        </div>
    </div>
    <p class="challenge-description">{{ $challenge->description }}</p>
    {{ $slot }}
</div>