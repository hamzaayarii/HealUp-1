<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Challenges Overview') }}
        </h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
            View and monitor challenge participation
        </p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5-2a9 9 0 11-18 0a9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Challenges</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $challenges->total() }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Participants</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                                {{ $challenges->sum('participations_count') }}
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Active Challenges</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                                {{ $challenges->where('end_date', '>=', now())->count() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filters -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg mb-6">
                <div class="p-6">
                    <form method="GET" class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Search Challenges
                            </label>
                            <input type="text" 
                                   name="search" 
                                   id="search"
                                   value="{{ request('search') }}"
                                   placeholder="Search by title or description..."
                                   class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div class="flex items-end">
                            <button type="submit" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition duration-200">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Challenges Grid -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    @if(isset($recommended) && $recommended->count() > 0)
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Recommended for you</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                                @foreach($recommended as $r)
                                    <div class="recommend-card border border-gray-200 dark:border-gray-700 rounded-lg p-4 bg-white dark:bg-gray-800" data-challenge-id="{{ $r->id }}">
                                        <h4 class="text-sm font-medium text-gray-900 dark:text-white">{{ $r->title }}</h4>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2">{{ $r->description }}</p>
                                        <div class="mt-2 text-xs text-gray-600 dark:text-gray-300 flex justify-between">
                                            <span>{{ $r->duration }}d</span>
                                            <span>{{ $r->reward }} pts</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @push('scripts')
                        <script>
                            (function(){
                                // Only run if there are recommendation cards
                                const recRoot = document.querySelectorAll('.recommend-card');
                                if (!recRoot || recRoot.length === 0) return;

                                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                                // Post an impression event once
                                const challengeIds = Array.from(recRoot).map(el => el.dataset.challengeId);
                                fetch("{{ route('recommendations.event') }}", {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': token
                                    },
                                    body: JSON.stringify({
                                        type: 'impression',
                                        challenge_id: null,
                                        context: { recommended_ids: challengeIds }
                                    })
                                }).catch(()=>{});

                                // Click handler to record clicks
                                document.querySelectorAll('.recommend-card').forEach(el => {
                                    el.addEventListener('click', function(){
                                        const id = this.dataset.challengeId;
                                        fetch("{{ route('recommendations.event') }}", {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': token
                                            },
                                            body: JSON.stringify({
                                                type: 'click',
                                                challenge_id: id,
                                                context: { recommended_ids: challengeIds }
                                            })
                                        }).catch(()=>{});
                                    });
                                });
                            })();
                        </script>
                    @endpush
                    @if($challenges->count() > 0)
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">All Challenges </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($challenges as $challenge)
                                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-6 hover:shadow-md transition duration-200">
                                    <div class="flex justify-between items-start mb-4">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            {{ $challenge->title }}
                                        </h3>
                                        <span class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs px-2 py-1 rounded-full">
                                            {{ $challenge->participations_count }} participants
                                        </span>
                                    </div>
                                    
                                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-2">
                                        {{ $challenge->description }}
                                    </p>
                                    
                                    <div class="space-y-2 mb-4">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500 dark:text-gray-400">Duration:</span>
                                            <span class="text-gray-900 dark:text-white">{{ $challenge->duration }} days</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500 dark:text-gray-400">Reward:</span>
                                            <span class="text-gray-900 dark:text-white">{{ $challenge->reward }} points</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
    <span class="text-gray-500 dark:text-gray-400">Ends:</span>
    <span class="text-gray-900 dark:text-white">
        {{ $challenge->end_date ? $challenge->end_date->format('M j, Y') : 'No end date' }}
    </span>
</div>
                                    </div>
                                    
                                    <div class="flex justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-700">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                            Created by {{ $challenge->creator->name ?? 'Unknown' }}
                                        </span>
                                        <button class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm font-medium">
                                            View Details
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $challenges->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No challenges found</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                {{ request('search') ? 'Try adjusting your search criteria.' : 'No approved challenges available at the moment.' }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>