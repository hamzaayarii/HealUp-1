<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('My Badges & Achievements') }}
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    Track your progress and earned badges
                </p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="text-right">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Earned Badges</p>
                    <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">
                        {{ $stats['earned_badges_count'] }}/{{ $stats['total_badges_count'] }}
                    </p>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900">
                            <span class="text-2xl">🏆</span>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Earned Badges</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['earned_badges_count'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900">
                            <span class="text-2xl">🎯</span>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500 dark:text-gray-400">In Progress</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total_badges_count'] - $stats['earned_badges_count'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                            <span class="text-2xl">⭐</span>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Total Points</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total_points'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900">
                            <span class="text-2xl">🔥</span>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Current Streak</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['current_streak'] }} days</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Badges Grid -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">All Badges</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($badgesData as $badgeItem)
                            @php
                                $badge = $badgeItem['badge'];
                                $isEarned = $badgeItem['is_earned'];
                                $progress = $badgeItem['progress'];
                            @endphp
                            
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-6 {{ $isEarned ? 'bg-gradient-to-br from-yellow-50 to-orange-50 dark:from-yellow-900/20 dark:to-orange-900/20' : 'bg-gray-50 dark:bg-gray-900/50' }}">
                                <div class="text-center">
                                    <!-- Badge Icon -->
                                    <div class="w-20 h-20 mx-auto mb-4 rounded-full {{ $isEarned ? 'bg-yellow-100 dark:bg-yellow-900 ring-4 ring-yellow-200 dark:ring-yellow-800' : 'bg-gray-200 dark:bg-gray-700 grayscale' }} flex items-center justify-center text-3xl">
                                        {{ $badge->icon }}
                                    </div>
                                    
                                    <!-- Badge Name -->
                                    <h4 class="font-semibold text-gray-900 dark:text-white mb-2 {{ $isEarned ? 'text-yellow-700 dark:text-yellow-300' : '' }}">
                                        {{ $badge->name }}
                                        @if($isEarned)
                                            <span class="ml-2 text-yellow-500">✓</span>
                                        @endif
                                    </h4>
                                    
                                    <!-- Badge Description -->
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                                        {{ $badge->description }}
                                    </p>
                                    
                                    <!-- Points Required -->
                                    @if($badge->required_points > 0)
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mb-3">
                                            {{ $badge->required_points }} points required
                                        </div>
                                    @endif
                                    
                                    <!-- Progress for Unearned Badges -->
                                    @if(!$isEarned && $progress)
                                        <div class="space-y-2">
                                            @foreach($progress as $criterion => $data)
                                                <div>
                                                    <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400 mb-1">
                                                        <span>{{ str_replace('_', ' ', ucfirst($criterion)) }}</span>
                                                        <span>{{ $data['current'] }}/{{ $data['target'] }}</span>
                                                    </div>
                                                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                                        <div class="bg-blue-600 h-2 rounded-full transition-all duration-500" 
                                                             style="width: {{ $data['percentage'] }}%"></div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    
                                    
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>