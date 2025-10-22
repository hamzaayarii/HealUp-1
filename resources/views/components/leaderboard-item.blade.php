<div class="leaderboard-item {{ $highlight ? 'bg-highlight' : '' }}">
    <div class="rank-badge rank-{{ $rank }}">
        {{ $rank }}
    </div>
    <div class="user-info">
        <div class="user-name">
            {{ $name }}
            @if($isCurrentUser)
                <span class="text-primary">(Vous)</span>
            @endif
        </div>
        <div class="user-faculty">{{ $faculty }}</div>
    </div>
    <div class="user-points">{{ $points }} pts</div>
</div>