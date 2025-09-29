<nav x-data="{ open: false }" class="bg-white/95 dark:bg-gray-900/95 backdrop-blur-xl border-b border-emerald-100/60 dark:border-emerald-800/30 shadow-md sticky top-0 z-50 theme-transition">
    <!-- Primary Navigation Menu -->
    <div class="max-w-full px-2 sm:px-4 lg:px-6">
        <div class="flex h-18 justify-between">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center group pl-0 sm:pl-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                        <div class="relative">
                            <x-application-mark class="block h-10 w-auto group-hover:scale-105 transition-transform duration-200" />
                            <div class="absolute -inset-1 bg-gradient-to-r from-emerald-500 to-blue-500 rounded-full opacity-0 group-hover:opacity-20 blur transition-opacity duration-300"></div>
                        </div>
                        <div class="hidden md:block">
                            <div class="text-xl font-bold bg-gradient-to-r from-emerald-600 to-blue-600 dark:from-emerald-400 dark:to-blue-400 bg-clip-text text-transparent">
                                HealUp
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 -mt-1">Health & Wellness</div>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:ml-24 sm:flex sm:items-center sm:space-x-6">
                    <!-- Dashboard Link -->
                          <a href="{{ route('dashboard') }}"
                              class="inline-flex items-center h-10 px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900
                              {{ request()->routeIs('dashboard') || request()->routeIs('health.dashboard')
                                 ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800'
                                 : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-100' }}">
                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7" rx="1"></rect>
                            <rect x="14" y="3" width="7" height="7" rx="1"></rect>
                            <rect x="14" y="14" width="7" height="7" rx="1"></rect>
                            <rect x="3" y="14" width="7" height="7" rx="1"></rect>
                        </svg>
                        {{ __('Dashboard') }}
                    </a>

                    <div class="h-6 border-l border-gray-200 dark:border-gray-700 mx-3"></div>

                    <!-- Health Tracking Dropdown -->
                    <div class="relative" x-data="{ open: false }">
            <button @click="open = !open"
                class="inline-flex items-center h-10 px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900
                                {{ request()->routeIs('habits.*') || request()->routeIs('progress.*') || request()->routeIs('health.reports.*')
                                   ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800'
                                   : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-100' }}">
                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 2v5h5"></path>
                                <path d="M21 6v14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h11l6 3z"></path>
                                <path d="M8 11h8"></path>
                                <path d="M8 15h4"></path>
                            </svg>
                            <span>Health Tracker</span>
                            <svg class="ml-2 h-4 w-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open"
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                             class="absolute left-0 mt-2 w-64 rounded-xl shadow-lg bg-white/95 dark:bg-gray-800/95 backdrop-blur-lg ring-1 ring-gray-200 dark:ring-gray-700 divide-y divide-gray-100 dark:divide-gray-700 z-50 overflow-hidden theme-transition">
                            <div class="py-1">
                                <a href="{{ route('habits.index') }}"
                                   class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 theme-transition {{ request()->routeIs('habits.*') ? 'bg-gray-50 dark:bg-gray-700 text-indigo-600 dark:text-indigo-400' : '' }}">
                                    <span class="mr-3">🎯</span>
                                    My Habits
                                </a>
                                <a href="{{ route('progress.index') }}"
                                   class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 theme-transition {{ request()->routeIs('progress.*') ? 'bg-gray-50 dark:bg-gray-700 text-indigo-600 dark:text-indigo-400' : '' }}">
                                    <span class="mr-3">📊</span>
                                    Daily Progress
                                </a>
                                <a href="{{ route('health.reports.index') }}"
                                   class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 theme-transition {{ request()->routeIs('health.reports.*') ? 'bg-gray-50 dark:bg-gray-700 text-indigo-600 dark:text-indigo-400' : '' }}">
                                    <span class="mr-3">📈</span>
                                    Health Reports
                                </a>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('habits.create') }}"
                                   class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 theme-transition">
                                    <span class="mr-3">➕</span>
                                    Create New Habit
                                </a>
                                <a href="{{ route('habits.available') }}"
                                   class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 theme-transition">
                                    <span class="mr-3">🌟</span>
                                    Browse Habits
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="h-6 border-l border-gray-200 dark:border-gray-700 mx-3"></div>

                    <!-- Wellness Events (Front Office) Link -->
                          <a href="{{ route('events.frontoffice') }}"
                              class="inline-flex items-center h-10 px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900
                              {{ request()->routeIs('events.frontoffice')
                                 ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800'
                                 : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-100' }}">
                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                            <path d="M8 14h.01"></path>
                            <path d="M12 14h.01"></path>
                            <path d="M16 14h.01"></path>
                            <path d="M8 18h.01"></path>
                            <path d="M12 18h.01"></path>
                            <path d="M16 18h.01"></path>
                        </svg>
                        {{ __('Wellness Events') }}
                    </a>

                    <div class="h-6 border-l border-gray-200 dark:border-gray-700 mx-3"></div>

                    <!-- Categories Link -->
                          <a href="{{ route('categories.index') }}"
                              class="inline-flex items-center h-10 px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900
                              {{ request()->routeIs('categories.*')
                                 ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800'
                                 : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-100' }}">
                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2Z"></path>
                        </svg>
                        {{ __('Categories') }}
                    </a>

                    <div class="h-6 border-l border-gray-200 dark:border-gray-700 mx-3"></div>

                    <!-- Advices Link -->
                          <a href="{{ route('advices.index') }}"
                              class="inline-flex items-center h-10 px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900
                              {{ request()->routeIs('advices.*')
                                 ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800'
                                 : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-100' }}">
                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M12 16v-4"></path>
                            <path d="M12 8h.01"></path>
                        </svg>
                        {{ __('Advices') }}
                    </a>

                    <div class="h-6 border-l border-gray-200 dark:border-gray-700 mx-3"></div>

                    <!-- Nutrition Dropdown -->
                    <div class="relative" x-data="{ open: false }">
            <button @click="open = !open"
                class="inline-flex items-center h-10 px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900
                                {{ request()->routeIs('ingredients.*') || request()->routeIs('repas.*')
                                   ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800'
                                   : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-gray-100' }}">
                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2a9 9 0 0 0-9 9c0 4 3.5 7 6 8.5 1.5.9 3 .5 3 .5s1.5.4 3-.5c2.5-1.5 6-4.5 6-8.5a9 9 0 0 0-9-9Z"></path>
                                <path d="M13 13v-3h3V7h-3V4h-2v3H8v3h3v3Z"></path>
                            </svg>
                            <span>Nutrition</span>
                            <svg class="ml-2 h-4 w-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open"
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                             class="absolute left-0 mt-2 w-64 rounded-xl shadow-lg bg-white/95 dark:bg-gray-800/95 backdrop-blur-lg ring-1 ring-gray-200 dark:ring-gray-700 divide-y divide-gray-100 dark:divide-gray-700 z-50 overflow-hidden theme-transition">
                            <div class="py-1">
                                <a href="{{ route('ingredients.index') }}"
                                   class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 theme-transition {{ request()->routeIs('ingredients.*') ? 'bg-gray-50 dark:bg-gray-700 text-indigo-600 dark:text-indigo-400' : '' }}">
                                    <span class="mr-3">🥕</span>
                                    Ingredients
                                </a>
                                <a href="{{ route('repas.index') }}"
                                   class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 theme-transition {{ request()->routeIs('repas.*') ? 'bg-gray-50 dark:bg-gray-700 text-indigo-600 dark:text-indigo-400' : '' }}">
                                    <span class="mr-3">🍽️</span>
                                    Meals (Repas)
                                </a>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('ingredients.create') }}"
                                   class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 theme-transition">
                                    <span class="mr-3">➕</span>
                                    Add Ingredient
                                </a>
                                <a href="{{ route('repas.create') }}"
                                   class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 theme-transition">
                                    <span class="mr-3">🍳</span>
                                    Create Meal
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-auto">
                <!-- Search Input -->
                <div class="relative hidden lg:block mr-8">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" placeholder="Search..." class="block w-64 pl-10 pr-3 py-2 border border-gray-200 dark:border-gray-700 rounded-lg leading-5 bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-300 placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:bg-white dark:focus:bg-gray-900 focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm transition">
                </div>



                <!-- Notifications -->
                <div class="ml-8 flow-root">
                    <a href="#" class="group -m-2 p-2 flex items-center relative">
                        <svg class="h-6 w-6 flex-shrink-0 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                        <span class="absolute top-0 right-0 block h-2.5 w-2.5 rounded-full bg-emerald-500 ring-2 ring-white dark:ring-gray-900"></span>
                    </a>
                </div>

                <div class="h-6 border-l border-gray-200 dark:border-gray-700 mx-4"></div>

                <!-- Theme Toggle -->
                <div class="theme-toggle-container ml-4 flex items-center">
                    <x-theme.toggle size="sm"/>
                </div>

                <div class="h-6 border-l border-gray-200 dark:border-gray-700 mx-4"></div>

                <!-- Settings Dropdown -->
                <div class="relative ml-2">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition-all duration-200">
                                    <img class="h-9 w-9 rounded-full object-cover ring-2 ring-white dark:ring-gray-800" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    <svg class="ml-2 h-4 w-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            @else
                                <button type="button" class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition-all duration-200">
                                    <div class="h-9 w-9 rounded-full bg-gradient-to-r from-emerald-500 to-blue-500 flex items-center justify-center text-white font-medium text-sm">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <svg class="ml-2 h-4 w-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            @if (Auth::user()->isAdmin())
                                <x-dropdown-link href="{{ route('admin.profile') }}">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('admin.dashboard') }}" class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ __('Admin Dashboard') }}
                                </x-dropdown-link>
                            @else
                                <x-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                            @endif

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-200"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Mobile Theme Toggle and Hamburger -->
            <div class="flex items-center space-x-3 sm:hidden">
                <!-- Mobile Theme Toggle -->
                <div class="theme-toggle-container">
                    <x-theme.toggle size="sm"/>
                </div>

                <!-- Hamburger -->
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition-all duration-200">
                    <svg class="h-6 w-6" :class="open ? 'hidden' : 'block'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg class="h-6 w-6" :class="open ? 'block' : 'hidden'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white/95 dark:bg-gray-900/95 backdrop-blur-lg border-t border-emerald-100/60 dark:border-emerald-800/30 theme-transition">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <!-- Health Tracker Mobile Navigation -->
            <div class="border-t border-gray-200 dark:border-gray-700 mt-2 pt-2 theme-transition">
                <div class="block px-4 py-2 text-xs text-gray-400 dark:text-gray-500 uppercase tracking-wide theme-transition">
                    Health Tracker
                </div>
                <x-responsive-nav-link href="{{ route('habits.index') }}" :active="request()->routeIs('habits.*')">
                    🎯 My Habits
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('progress.index') }}" :active="request()->routeIs('progress.*')">
                    📊 Daily Progress
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('health.reports.index') }}" :active="request()->routeIs('health.reports.*')">
                    📈 Health Reports
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('habits.create') }}">
                    ➕ Create New Habit
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('habits.available') }}">
                    🌟 Browse Habits
                </x-responsive-nav-link>
            </div>

            <!-- Wellness Events (Front Office) Navigation -->
            <x-responsive-nav-link href="{{ route('events.frontoffice') }}" :active="request()->routeIs('events.frontoffice')">
                {{ __('Wellness Events') }}
            </x-responsive-nav-link>
            <!-- Categories Navigation -->
            <x-responsive-nav-link href="{{ route('categories.index') }}" :active="request()->routeIs('categories.*')">
                {{ __('Categories') }}
            </x-responsive-nav-link>

            <!-- Nutrition Mobile Navigation -->
                        <!-- Nutrition Mobile Navigation -->
            <div class="border-t border-gray-200 dark:border-gray-700 mt-2 pt-2 theme-transition">
                <div class="block px-4 py-2 text-xs text-gray-400 dark:text-gray-500 uppercase tracking-wide theme-transition">
                    Nutrition
                </div>
                <x-responsive-nav-link href="{{ route('ingredients.index') }}" :active="request()->routeIs('ingredients.*')">
                    🥕 Ingredients
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('repas.index') }}" :active="request()->routeIs('repas.*')">
                    🍽️ Meals (Repas)
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('ingredients.create') }}">
                    ➕ Add Ingredient
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('repas.create') }}">
                    🍳 Create Meal
                </x-responsive-nav-link>
            </div>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-700 theme-transition">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 me-3">
                        <img class="size-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200 theme-transition">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500 dark:text-gray-400 theme-transition">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                @if (Auth::user()->isAdmin())
                    <x-responsive-nav-link href="{{ route('admin.profile') }}" :active="request()->routeIs('admin.profile')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')" class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ __('Admin Dashboard') }}
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                @endif

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}"
                                   @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>
                    @endcan

                    <!-- Team Switcher -->
                    @if (Auth::user()->allTeams()->count() > 1)
                        <div class="border-t border-gray-200 dark:border-gray-700 theme-transition"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400 dark:text-gray-500 theme-transition">
                            {{ __('Switch Teams') }}
                        </div>

                        @foreach (Auth::user()->allTeams() as $team)
                            <x-switchable-team :team="$team" component="responsive-nav-link" />
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
</nav>
