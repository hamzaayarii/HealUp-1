{{-- User Dropdown Component --}}
@props([
    'user' => null
])

@php
    $user = $user ?? auth()->user();
@endphp

@if($user)
<div class="user-dropdown relative" x-data="{ open: false }">
    {{-- Dropdown Trigger --}}
    <button type="button"
            class="user-dropdown-trigger flex items-center space-x-3 p-2 rounded-md hover:bg-gray-100 transition-colors"
            @click="open = !open"
            @click.away="open = false"
            :aria-expanded="open"
            aria-haspopup="true">

        {{-- User Avatar --}}
        <div class="user-avatar">
            @if($user->profile_photo_path)
                <img src="{{ $user->profile_photo_url }}"
                     alt="{{ $user->name }}"
                     class="w-8 h-8 rounded-full object-cover">
            @else
                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                    <span class="text-sm font-medium text-gray-700">
                        {{ substr($user->name, 0, 1) }}
                    </span>
                </div>
            @endif
        </div>

        {{-- User Info (Desktop) --}}
        <div class="user-info hidden md:block text-left">
            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
            <div class="text-xs text-gray-500 truncate">{{ $user->email }}</div>
        </div>

        {{-- Dropdown Arrow --}}
        <x-ui.icon name="chevron-down"
                   class="w-4 h-4 text-gray-400 transition-transform"
                   :class="{ 'rotate-180': open }" />
    </button>

    {{-- Dropdown Menu --}}
    <div x-show="open"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         class="user-dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-50"
         role="menu"
         aria-orientation="vertical">

        <div class="py-1">
            {{-- Profile Link --}}
            <a href="{{ route('profile.show') }}"
               class="dropdown-item flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
               role="menuitem">
                <x-ui.icon name="user" class="w-4 h-4 mr-3 text-gray-400" />
                Your Profile
            </a>

            {{-- Settings Link --}}
            <a href="{{ route('profile.show') }}"
               class="dropdown-item flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
               role="menuitem">
                <x-ui.icon name="cog" class="w-4 h-4 mr-3 text-gray-400" />
                Settings
            </a>

            {{-- Teams (if enabled) --}}
            @if(Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <div class="border-t border-gray-100"></div>
                <div class="px-4 py-2">
                    <p class="text-xs text-gray-400 uppercase tracking-wide">Teams</p>
                </div>

                {{-- Current Team --}}
                @if(auth()->user()->currentTeam)
                    <a href="{{ route('teams.show', auth()->user()->currentTeam) }}"
                       class="dropdown-item flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                       role="menuitem">
                        <x-ui.icon name="users" class="w-4 h-4 mr-3 text-gray-400" />
                        {{ auth()->user()->currentTeam->name }}
                    </a>
                @endif

                {{-- Team Management --}}
                <a href="{{ route('teams.create') }}"
                   class="dropdown-item flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                   role="menuitem">
                    <x-ui.icon name="plus" class="w-4 h-4 mr-3 text-gray-400" />
                    Create Team
                </a>
            @endif

            {{-- Divider --}}
            <div class="border-t border-gray-100"></div>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="dropdown-item flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 text-left"
                        role="menuitem">
                    <x-ui.icon name="logout" class="w-4 h-4 mr-3 text-gray-400" />
                    Sign out
                </button>
            </form>
        </div>
    </div>
</div>
@endif

{{-- Add Alpine.js if not already included --}}
@once
    @push('scripts')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endpush
@endonce
