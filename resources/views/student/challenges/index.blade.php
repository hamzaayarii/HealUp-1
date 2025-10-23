<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Student Challenges') }}
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    Discover and participate in wellness challenges
                </p>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ route('student.calendar.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-200 dark:hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ __('Calendar') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
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
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Available Challenges</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $challengeStats['available'] }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">In Progress</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $challengeStats['in_progress'] }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0a9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Completed</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $challengeStats['completed'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Recommandations IA -->
            @if($recommendedChallenges->count() > 0)
            <div class="bg-gradient-to-r from-purple-50 to-blue-50 dark:from-purple-900 dark:to-blue-900 border border-purple-200 dark:border-purple-700 rounded-lg mb-8">
                <div class="px-6 py-4 border-b border-purple-200 dark:border-purple-700">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            Recommandations Intelligentes
                            <span class="ml-2 bg-purple-100 dark:bg-purple-800 text-purple-800 dark:text-purple-200 text-xs px-2 py-1 rounded-full">
                                🤖 IA
                            </span>
                        </h3>
                        <div class="flex items-center text-sm text-purple-600 dark:text-purple-400">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $recommendationExplanation }}
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($recommendedChallenges as $challenge)
                        <div class="bg-white dark:bg-gray-800 border-2 border-purple-200 dark:border-purple-700 rounded-lg p-6 hover:shadow-lg transition duration-200 relative transform hover:-translate-y-1">
                            <!-- Badge Recommandé -->
                            <div class="absolute -top-2 -right-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white text-xs px-3 py-1 rounded-full shadow-lg">
                                ⭐ Recommandé
                            </div>
                            
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white pr-4">
                                    {{ $challenge->title }}
                                </h3>
                                <span class="bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 text-xs px-2 py-1 rounded-full whitespace-nowrap">
                                    {{ $challenge->current_participants_count }} participants
                                </span>
                            </div>
                            
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-3">
                                {{ $challenge->description }}
                            </p>
                            
                            <div class="space-y-3 mb-4">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500 dark:text-gray-400 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Durée:
                                    </span>
                                    <span class="text-gray-900 dark:text-white font-medium">{{ $challenge->duration }} jours</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500 dark:text-gray-400 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                        </svg>
                                        Récompense:
                                    </span>
                                    <span class="text-gray-900 dark:text-white font-medium">{{ $challenge->reward }} points</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500 dark:text-gray-400 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        Date fin:
                                    </span>
                                    <span class="text-gray-900 dark:text-white font-medium {{ $challenge->end_date->diffInDays(now()) <= 3 ? 'text-red-600 dark:text-red-400' : '' }}">
                                        {{ $challenge->end_date->format('M j, Y') }}
                                        @if($challenge->end_date->diffInDays(now()) <= 3)
                                            ⚡
                                        @endif
                                    </span>
                                </div>
                            </div>
                            
                            <div class="flex justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-700">
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    Par {{ $challenge->creator->name ?? 'Inconnu' }}
                                </span>
                                <form action="{{ route('student.challenges.join', $challenge) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200 flex items-center shadow-lg">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        Rejoindre
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <!-- Explication IA -->
                    <div class="mt-4 p-4 bg-purple-50 dark:bg-purple-900 rounded-lg border border-purple-200 dark:border-purple-700">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-purple-100 dark:bg-purple-800 rounded-full flex items-center justify-center">
                                    <span class="text-purple-600 dark:text-purple-300 text-sm">AI</span>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-purple-700 dark:text-purple-300">
                                    <strong>Comment ça marche ?</strong> Notre IA analyse votre historique de défis, votre taux de réussite et vos préférences pour vous suggérer les défis les plus adaptés à votre profil.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Search and Filters -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg mb-6">
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
                        
                        <div class="flex-1">
                            <label for="duration" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Max Duration (days)
                            </label>
                            <select name="duration" id="duration" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Any Duration</option>
                                <option value="7" {{ request('duration') == '7' ? 'selected' : '' }}>7 days</option>
                                <option value="14" {{ request('duration') == '14' ? 'selected' : '' }}>14 days</option>
                                <option value="30" {{ request('duration') == '30' ? 'selected' : '' }}>30 days</option>
                                <option value="60" {{ request('duration') == '60' ? 'selected' : '' }}>60 days</option>
                            </select>
                        </div>
                        
                        <div class="flex-1">
                            <label for="reward" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Min Reward Points
                            </label>
                            <input type="number" 
                                   name="reward" 
                                   id="reward"
                                   value="{{ request('reward') }}"
                                   placeholder="Min points"
                                   class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        
                        <div class="flex items-end space-x-2">
                            <button type="submit" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition duration-200">
                                Search
                            </button>
                            <a href="{{ route('student.challenges.index') }}" 
                               class="bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-300 px-6 py-2 rounded-lg font-medium transition duration-200 hover:bg-gray-400 dark:hover:bg-gray-500">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Défis en Cours -->
            @if($currentChallenges->count() > 0)
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg mb-8">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        My Current Challenges
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($currentChallenges as $participation)
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-6 hover:shadow-md transition duration-200">
                            <div class="flex justify-between items-start mb-3">
                                <h4 class="font-semibold text-gray-900 dark:text-white text-lg">
                                    {{ $participation->challenge->title }}
                                </h4>
                                <div class="flex items-center space-x-2">
                                    <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs px-2 py-1 rounded-full font-medium">
                                        {{ $participation->current_progress }}%
                                    </span>
                                    @if($participation->challenge->end_date->diffInDays(now()) <= 3)
                                        <span class="bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 text-xs px-2 py-1 rounded-full font-medium">
                                            Ends soon!
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">
                                {{ Str::limit($participation->challenge->description, 120) }}
                            </p>
                            
                            <!-- Progress Bar -->
                            <div class="mb-4">
                                <div class="flex justify-between text-sm text-gray-500 dark:text-gray-400 mb-1">
                                    <span>Progress</span>
                                    <span>{{ $participation->current_progress }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                                    <div class="bg-blue-600 h-3 rounded-full transition-all duration-500" 
                                         style="width: {{ $participation->current_progress }}%"></div>
                                </div>
                            </div>
                            
                            <div class="flex justify-between items-center text-sm text-gray-500 dark:text-gray-400 mb-4">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span>Ends: {{ $participation->challenge->end_date->format('M j, Y') }}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                    </svg>
                                    <span>{{ $participation->challenge->reward }} points</span>
                                </div>
                            </div>
                            
                            <!-- Section de Progression -->
                            <div class="flex justify-between items-center">
                                <div class="flex-1">
                                    <div class="flex justify-between text-sm text-gray-500 dark:text-gray-400 mb-1">
                                        <span>Progression via Check-ins</span>
                                        <span>{{ $participation->current_progress }}% ({{ $participation->checkin_count }}/{{ $participation->challenge->duration }} jours)</span>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                        <div class="bg-green-600 h-2 rounded-full transition-all duration-500" 
                                             style="width: {{ $participation->current_progress }}%"></div>
                                    </div>
                                </div>
                                <div class="ml-4 flex space-x-2">
                                    <a href="{{ route('student.calendar.index') }}" 
                                       class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm font-medium transition duration-200 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        Calendar
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Défis Disponibles -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                        Available Challenges
                        <span class="ml-2 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs px-2 py-1 rounded-full">
                            {{ $availableChallenges->total() }}
                        </span>
                    </h3>
                </div>
                <div class="p-6">
                    @if($availableChallenges->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($availableChallenges as $challenge)
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-6 hover:shadow-md transition duration-200 relative">
                                <!-- Highlight if ending soon -->
                                @if($challenge->end_date->diffInDays(now()) <= 3)
                                    <div class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                                        Ending soon!
                                    </div>
                                @endif
                                
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white pr-4">
                                        {{ $challenge->title }}
                                    </h3>
                                    <span class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs px-2 py-1 rounded-full whitespace-nowrap">
                                        {{ $challenge->current_participants_count }} participants
                                    </span>
                                </div>
                                
                                <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-3">
                                    {{ $challenge->description }}
                                </p>
                                
                                <div class="space-y-3 mb-4">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500 dark:text-gray-400 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Duration:
                                        </span>
                                        <span class="text-gray-900 dark:text-white font-medium">{{ $challenge->duration }} days</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500 dark:text-gray-400 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                            </svg>
                                            Reward:
                                        </span>
                                        <span class="text-gray-900 dark:text-white font-medium">{{ $challenge->reward }} points</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500 dark:text-gray-400 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            End date:
                                        </span>
                                        <span class="text-gray-900 dark:text-white font-medium {{ $challenge->end_date->diffInDays(now()) <= 3 ? 'text-red-600 dark:text-red-400' : '' }}">
                                            {{ $challenge->end_date->format('M j, Y') }}
                                            @if($challenge->end_date->diffInDays(now()) <= 3)
                                                ⚡
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="flex justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-700">
                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                        By {{ $challenge->creator->name ?? 'Unknown' }}
                                    </span>
                                    <form action="{{ route('student.challenges.join', $challenge) }}" method="POST">
                                        @csrf
                                        <button type="submit" 
                                                class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200 flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                            Join Challenge
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $availableChallenges->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No challenges available</h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-4">
                                All current challenges have been joined or have ended.
                            </p>
                            <p class="text-sm text-gray-400 dark:text-gray-500">
                                Check back later for new challenges!
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>