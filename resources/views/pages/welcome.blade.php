<x-guest-layout>
    <!-- External CSS for floating bubbles -->
    <link rel="stylesheet" href="{{ asset('css/floating-bubbles.css') }}">

    <div class="scroll-smooth">
        <!-- Floating Bubbles Background Overlay -->
        <div id="bubbles-container" class="bubbles-overlay">
            <!-- Bubbles will be dynamically generated here -->
        </div>

        <!-- Hero Section -->
        <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
            <!-- Background Elements -->
            <div class="absolute inset-0 z-0">
                <div class="absolute top-20 left-10 w-72 h-72 bg-gradient-to-br from-green-200 to-emerald-300 dark:from-green-800 dark:to-emerald-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float"></div>
                <div class="absolute top-40 right-10 w-72 h-72 bg-gradient-to-br from-teal-200 to-cyan-300 dark:from-teal-800 dark:to-cyan-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float" style="animation-delay: 2s;"></div>
                <div class="absolute bottom-40 left-1/2 w-72 h-72 bg-gradient-to-br from-blue-200 to-indigo-300 dark:from-blue-800 dark:to-indigo-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float" style="animation-delay: 4s;"></div>
            </div>

            <div class="relative z-20 max-w-7xl mx-auto px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="text-center lg:text-left animate-fade-in-up">
                    <!-- Badge -->
                    <div class="inline-flex items-center space-x-2 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 px-4 py-2 rounded-full text-sm font-medium mb-8 theme-transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                        <span>Wellness & Prevention Platform</span>
                    </div>

                    <!-- Main Heading -->
                    <h1 class="text-5xl lg:text-7xl font-extrabold leading-tight mb-8">
                        <span class="bg-gradient-to-r from-green-600 to-teal-600 dark:from-green-400 dark:to-teal-400 bg-clip-text text-transparent">HealUp</span><br>
                        <span class="text-gray-900 dark:text-gray-100 theme-transition">Your Wellness</span><br>
                        <span class="text-gray-600 dark:text-gray-400 text-3xl lg:text-4xl font-medium theme-transition">Journey Companion</span>
                    </h1>

                    <p class="text-xl text-gray-600 dark:text-gray-300 leading-relaxed mb-10 max-w-lg theme-transition">
                        Track daily habits, join wellness challenges, and build lasting health practices. Designed for students and teachers to foster a culture of preventive wellness.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row items-center gap-4 mb-8">
                        <a href="{{ route('register') }}" class="group bg-green-600 hover:bg-green-700 dark:bg-green-700 dark:hover:bg-green-600 text-white px-8 py-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>Start as Student</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>

                        <a href="{{ route('register') }}" class="group bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 text-green-700 dark:text-green-300 px-8 py-4 rounded-xl font-semibold transition-all duration-300 border-2 border-green-200 dark:border-green-700 hover:border-green-300 dark:hover:border-green-600 flex items-center space-x-2 theme-transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <span>Join as Teacher</span>
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="flex items-center justify-center lg:justify-start space-x-8 text-sm text-gray-500 dark:text-gray-400 theme-transition">
                        <div class="text-center">
                            <div class="font-bold text-green-600 dark:text-green-400 text-lg">24/7</div>
                            <div>Health Tracking</div>
                        </div>
                        <div class="text-center">
                            <div class="font-bold text-green-600 dark:text-green-400 text-lg">100%</div>
                            <div>Privacy Focused</div>
                        </div>
                        <div class="text-center">
                            <div class="font-bold text-green-600 dark:text-green-400 text-lg">∞</div>
                            <div>Habit Building</div>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Interactive Dashboard Preview -->
                <div class="relative animate-fade-in-up" style="animation-delay: 0.3s;">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl bg-white dark:bg-gray-800 p-6 border border-gray-200 dark:border-gray-700 theme-transition">
                        <!-- Mock Dashboard -->
                        <div class="space-y-4">
                            <!-- Header -->
                            <div class="flex items-center justify-between">
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200 theme-transition">Today's Wellness Overview</h3>
                                <div class="w-3 h-3 bg-green-400 dark:bg-green-500 rounded-full animate-pulse-slow"></div>
                            </div>

                            <!-- Progress Circles -->
                            <div class="grid grid-cols-3 gap-4">
                                <div class="text-center">
                                    <div class="w-16 h-16 mx-auto mb-2 relative">
                                        <svg class="w-16 h-16 transform -rotate-90">
                                            <circle cx="32" cy="32" r="28" stroke="#e5e7eb" class="dark:stroke-gray-600" stroke-width="4" fill="none"/>
                                            <circle cx="32" cy="32" r="28" stroke="#10b981" class="dark:stroke-green-400" stroke-width="4" fill="none"
                                                   stroke-dasharray="175.92" stroke-dashoffset="52.78" stroke-linecap="round"/>
                                        </svg>
                                        <div class="absolute inset-0 flex items-center justify-center text-xs font-bold text-green-600 dark:text-green-400">70%</div>
                                    </div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 theme-transition">Daily Steps</p>
                                </div>
                                <div class="text-center">
                                    <div class="w-16 h-16 mx-auto mb-2 relative">
                                        <svg class="w-16 h-16 transform -rotate-90">
                                            <circle cx="32" cy="32" r="28" stroke="#e5e7eb" class="dark:stroke-gray-600" stroke-width="4" fill="none"/>
                                            <circle cx="32" cy="32" r="28" stroke="#06b6d4" class="dark:stroke-cyan-400" stroke-width="4" fill="none"
                                                   stroke-dasharray="175.92" stroke-dashoffset="79.16" stroke-linecap="round"/>
                                        </svg>
                                        <div class="absolute inset-0 flex items-center justify-center text-xs font-bold text-cyan-600 dark:text-cyan-400">55%</div>
                                    </div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 theme-transition">Habits</p>
                                </div>
                                <div class="text-center">
                                    <div class="w-16 h-16 mx-auto mb-2 relative">
                                        <svg class="w-16 h-16 transform -rotate-90">
                                            <circle cx="32" cy="32" r="28" stroke="#e5e7eb" class="dark:stroke-gray-600" stroke-width="4" fill="none"/>
                                            <circle cx="32" cy="32" r="28" stroke="#8b5cf6" class="dark:stroke-purple-400" stroke-width="4" fill="none"
                                                   stroke-dasharray="175.92" stroke-dashoffset="35.18" stroke-linecap="round"/>
                                        </svg>
                                        <div class="absolute inset-0 flex items-center justify-center text-xs font-bold text-purple-600 dark:text-purple-400">80%</div>
                                    </div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 theme-transition">Challenges</p>
                                </div>
                            </div>

                            <!-- Activity List -->
                            <div class="space-y-2">
                                <div class="flex items-center justify-between p-2 bg-green-50 dark:bg-green-900/20 rounded-lg theme-transition">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 bg-green-500 dark:bg-green-400 rounded-full"></div>
                                        <span class="text-sm text-gray-700 dark:text-gray-300">Morning Walk Challenge</span>
                                    </div>
                                    <span class="text-xs text-green-600 dark:text-green-400 font-medium">+50 pts</span>
                                </div>
                                <div class="flex items-center justify-between p-2 bg-blue-50 dark:bg-blue-900/20 rounded-lg theme-transition">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 bg-blue-500 dark:bg-blue-400 rounded-full"></div>
                                        <span class="text-sm text-gray-700 dark:text-gray-300">Hydration Habit</span>
                                    </div>
                                    <span class="text-xs text-blue-600 dark:text-blue-400 font-medium">+30 pts</span>
                                </div>
                                <div class="flex items-center justify-between p-2 bg-purple-50 dark:bg-purple-900/20 rounded-lg theme-transition">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 bg-purple-500 dark:bg-purple-400 rounded-full"></div>
                                        <span class="text-sm text-gray-700 dark:text-gray-300">Meditation Session</span>
                                    </div>
                                    <span class="text-xs text-purple-600 dark:text-purple-400 font-medium">+25 pts</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Elements -->
                    <div class="absolute -top-4 -right-4 w-8 h-8 bg-green-400 dark:bg-green-500 rounded-full opacity-80 animate-float theme-transition"></div>
                    <div class="absolute -bottom-4 -left-4 w-6 h-6 bg-teal-400 dark:bg-teal-500 rounded-full opacity-80 animate-float theme-transition" style="animation-delay: 1s;"></div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="relative z-10 py-20 bg-white dark:bg-gray-900 theme-transition">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-4 theme-transition">Comprehensive Wellness Platform</h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto theme-transition">
                        Everything students and teachers need to build healthy habits, track progress, and create a culture of preventive wellness.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Habit Tracking -->
                    <div class="group bg-gradient-to-br from-green-50 to-emerald-100 dark:from-green-900/20 dark:to-emerald-900/30 p-8 rounded-2xl hover:shadow-xl transition-all duration-300 border border-green-100 dark:border-green-800 theme-transition">
                        <div class="w-12 h-12 bg-green-600 dark:bg-green-700 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-3 theme-transition">Daily Habit Tracking</h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4 theme-transition">Build and maintain healthy habits with daily progress tracking, streaks, and personalized categories.</p>
                        <ul class="text-sm text-gray-500 dark:text-gray-400 space-y-1 theme-transition">
                            <li>• Custom habit categories</li>
                            <li>• Daily progress logging</li>
                            <li>• Streak counting & rewards</li>
                        </ul>
                    </div>

                    <!-- Wellness Challenges -->
                    <div class="group bg-gradient-to-br from-blue-50 to-cyan-100 dark:from-blue-900/20 dark:to-cyan-900/30 p-8 rounded-2xl hover:shadow-xl transition-all duration-300 border border-blue-100 dark:border-blue-800 theme-transition">
                        <div class="w-12 h-12 bg-blue-600 dark:bg-blue-700 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-3 theme-transition">Wellness Challenges</h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4 theme-transition">Join group challenges with classmates and compete in healthy activities to stay motivated together.</p>
                        <ul class="text-sm text-gray-500 dark:text-gray-400 space-y-1 theme-transition">
                            <li>• Group challenges</li>
                            <li>• Leaderboards & rankings</li>
                            <li>• Team participation</li>
                        </ul>
                    </div>

                    <!-- AI-Powered Advice -->
                    <div class="group bg-gradient-to-br from-purple-50 to-indigo-100 dark:from-purple-900/20 dark:to-indigo-900/30 p-8 rounded-2xl hover:shadow-xl transition-all duration-300 border border-purple-100 dark:border-purple-800 theme-transition">
                        <div class="w-12 h-12 bg-purple-600 dark:bg-purple-700 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-3 theme-transition">Personalized Advice</h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4 theme-transition">Get personalized wellness advice from teachers or AI, with follow-up chat sessions for continuous support.</p>
                        <ul class="text-sm text-gray-500 dark:text-gray-400 space-y-1 theme-transition">
                            <li>• Teacher-generated advice</li>
                            <li>• AI wellness insights</li>
                            <li>• Follow-up chat sessions</li>
                        </ul>
                    </div>

                    <!-- Social Community -->
                    <div class="group bg-gradient-to-br from-amber-50 to-orange-100 dark:from-amber-900/20 dark:to-orange-900/30 p-8 rounded-2xl hover:shadow-xl transition-all duration-300 border border-amber-100 dark:border-amber-800 theme-transition">
                        <div class="w-12 h-12 bg-amber-600 dark:bg-amber-700 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-3 theme-transition">Social Community</h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4 theme-transition">Share wellness posts, comment on others' journeys, and build a supportive community around health.</p>
                        <ul class="text-sm text-gray-500 dark:text-gray-400 space-y-1 theme-transition">
                            <li>• Wellness posts & updates</li>
                            <li>• Community discussions</li>
                            <li>• Peer support network</li>
                        </ul>
                    </div>

                    <!-- Progress Analytics -->
                    <div class="group bg-gradient-to-br from-teal-50 to-green-100 dark:from-teal-900/20 dark:to-green-900/30 p-8 rounded-2xl hover:shadow-xl transition-all duration-300 border border-teal-100 dark:border-teal-800 theme-transition">
                        <div class="w-12 h-12 bg-teal-600 dark:bg-teal-700 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-3 theme-transition">Progress Analytics</h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4 theme-transition">Visualize your wellness journey with detailed analytics, trends, and achievement milestones.</p>
                        <ul class="text-sm text-gray-500 dark:text-gray-400 space-y-1 theme-transition">
                            <li>• Progress visualization</li>
                            <li>• Habit trend analysis</li>
                            <li>• Achievement tracking</li>
                        </ul>
                    </div>

                    <!-- Privacy & Security -->
                    <div class="group bg-gradient-to-br from-rose-50 to-pink-100 dark:from-rose-900/20 dark:to-pink-900/30 p-8 rounded-2xl hover:shadow-xl transition-all duration-300 border border-rose-100 dark:border-rose-800 theme-transition">
                        <div class="w-12 h-12 bg-rose-600 dark:bg-rose-700 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-3 theme-transition">Safe & Secure</h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4 theme-transition">Your wellness data is protected with role-based access, ensuring privacy between students and teachers.</p>
                        <ul class="text-sm text-gray-500 dark:text-gray-400 space-y-1 theme-transition">
                            <li>• Role-based permissions</li>
                            <li>• Data privacy controls</li>
                            <li>• Secure communication</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Choose HealUp Section -->
        <section id="about" class="relative z-10 py-20 bg-gradient-to-br from-gray-50 to-green-50 dark:from-gray-900 dark:to-gray-800 theme-transition">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <!-- Left Content -->
                    <div>
                        <h2 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-6 theme-transition">Why HealUp Matters</h2>
                        <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 theme-transition">
                            In today's fast-paced educational environment, fostering preventive wellness habits is essential. HealUp creates a supportive ecosystem where health becomes a shared journey.
                        </p>

                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center flex-shrink-0 theme-transition">
                                    <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2 theme-transition">Prevention-First Approach</h3>
                                    <p class="text-gray-600 dark:text-gray-300 theme-transition">Build sustainable wellness habits early through daily tracking and positive reinforcement.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center flex-shrink-0 theme-transition">
                                    <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7-293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2 theme-transition">Educational Community</h3>
                                    <p class="text-gray-600 dark:text-gray-300 theme-transition">Seamlessly integrate wellness into educational environments with teacher guidance and peer support.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center flex-shrink-0 theme-transition">
                                    <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2 theme-transition">Smart Insights & AI Support</h3>
                                    <p class="text-gray-600 dark:text-gray-300 theme-transition">Receive personalized wellness advice and insights powered by intelligent analytics.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center flex-shrink-0 theme-transition">
                                    <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2 theme-transition">Gamified Wellness Journey</h3>
                                    <p class="text-gray-600 dark:text-gray-300 theme-transition">Stay motivated through challenges, achievements, and friendly competition with peers.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Content - Stats -->
                    <div class="relative">
                        <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-2xl border border-gray-200 dark:border-gray-700 theme-transition">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-8 text-center theme-transition">Platform Impact</h3>

                            <div class="grid grid-cols-2 gap-6">
                                <div class="text-center">
                                    <div class="text-4xl font-bold text-green-600 dark:text-green-400 mb-2">85%</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400 theme-transition">Improved Wellness Habits</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-4xl font-bold text-blue-600 dark:text-blue-400 mb-2">72%</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400 theme-transition">Active Daily Engagement</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-4xl font-bold text-purple-600 dark:text-purple-400 mb-2">90%</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400 theme-transition">Challenge Completion Rate</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-4xl font-bold text-teal-600 dark:text-teal-400 mb-2">95%</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400 theme-transition">User Satisfaction</div>
                                </div>
                            </div>

                            <div class="mt-8 p-4 bg-green-50 dark:bg-green-900/20 rounded-xl theme-transition">
                                <div class="flex items-center space-x-2 text-green-700 dark:text-green-300 theme-transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="font-medium">Trusted by educational institutions worldwide</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="relative z-10 py-20 bg-gradient-to-r from-green-600 to-teal-600 dark:from-green-700 dark:to-teal-700 theme-transition">
            <div class="max-w-4xl mx-auto text-center px-6 lg:px-8">
                <h2 class="text-4xl font-bold text-white mb-6">
                    Ready to Start Your Wellness Journey?
                </h2>
                <p class="text-xl text-green-100 dark:text-green-200 mb-10 theme-transition">
                    Join the HealUp community and build sustainable wellness habits with students and teachers who care about preventive health.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('register') }}" class="group bg-white dark:bg-gray-800 text-green-600 dark:text-green-400 px-8 py-4 rounded-xl font-semibold hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center space-x-2 theme-transition">
                        <span>Start Your Journey</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>

                    <a href="{{ route('login') }}" class="text-white border-2 border-white hover:bg-white hover:text-green-600 dark:hover:bg-gray-800 dark:hover:text-green-400 px-8 py-4 rounded-xl font-semibold transition-all duration-300 theme-transition">
                        Sign In
                    </a>
                </div>

                <div class="mt-8 flex flex-col sm:flex-row items-center justify-center space-y-2 sm:space-y-0 sm:space-x-8 text-green-100 dark:text-green-200 text-sm theme-transition">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Free to get started</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Privacy-focused platform</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Quick 5-minute setup</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Back to Top Button -->
        <button id="backToTop" class="fixed bottom-8 right-8 bg-green-600 hover:bg-green-700 dark:bg-green-700 dark:hover:bg-green-600 text-white p-3 rounded-full shadow-lg transition-all duration-300 opacity-0 invisible theme-transition z-50">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
            </svg>
        </button>

        @push('scripts')


            <script>
                // Enhanced Floating Bubbles JavaScript
                class FloatingBubbles {
                    constructor() {
                        this.container = document.getElementById('bubbles-container');
                        this.bubbles = [];
                        this.mouseX = 0;
                        this.mouseY = 0;
                        this.isMouseMoving = false;
                        this.lastMouseMove = 0;
                        this.isDarkTheme = document.documentElement.classList.contains('dark');
                        this.isVisible = true;
                        this.performance = this.detectPerformance();

                        // Performance settings
                        this.maxBubbles = this.performance.high ? 25 : this.performance.medium ? 15 : 10;
                        this.creationInterval = this.performance.high ? 2000 : this.performance.medium ? 3000 : 4000;

                        this.init();
                    }

                    detectPerformance() {
                        const connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
                        const memory = navigator.deviceMemory || 4;
                        const cores = navigator.hardwareConcurrency || 2;

                        // Simple performance detection
                        const isHighPerf = memory >= 8 && cores >= 4 && (!connection || connection.effectiveType === '4g');
                        const isMediumPerf = memory >= 4 && cores >= 2 && (!connection || connection.effectiveType !== 'slow-2g');

                        return {
                            high: isHighPerf,
                            medium: isMediumPerf && !isHighPerf,
                            low: !isMediumPerf
                        };
                    }

                    init() {
                        // Respect user preferences first
                        this.respectMotionPreferences();

                        // Create initial bubbles
                        this.createInitialBubbles();

                        // Set up mouse tracking
                        this.setupMouseTracking();

                        // Set up touch support for mobile devices
                        this.setupTouchSupport();

                        // Set up theme change detection
                        this.setupThemeDetection();

                        // Start bubble generation interval
                        this.startBubbleGeneration();

                        // Clean up old bubbles periodically
                        this.startCleanup();

                        // Add window focus/blur handlers for performance
                        window.addEventListener('focus', () => {
                            this.isVisible = true;
                        });

                        window.addEventListener('blur', () => {
                            this.isVisible = false;
                        });
                    }

                    createInitialBubbles() {
                        const initialCount = window.innerWidth < 768 ? 8 : 12;
                        for (let i = 0; i < initialCount; i++) {
                            setTimeout(() => this.createBubble(), i * 500);
                        }
                    }

                    createBubble() {
                        const bubble = document.createElement('div');
                        bubble.className = 'bubble';

                        // Random size (responsive and performance-aware)
                        const size = this.getRandomSize();
                        bubble.style.width = size + 'px';
                        bubble.style.height = size + 'px';

                        // Random horizontal position with some margin
                        const margin = size / 2;
                        const x = margin + Math.random() * (window.innerWidth - size - margin * 2);
                        bubble.style.left = x + 'px';

                        // Start from bottom
                        bubble.style.bottom = '-' + size + 'px';

                        // Random animation duration (slower for larger bubbles)
                        const baseDuration = this.performance.high ? 12 : this.performance.medium ? 15 : 18;
                        const duration = size > 80 ?
                            baseDuration + Math.random() * 8 :
                            (baseDuration * 0.7) + Math.random() * 6;
                        bubble.style.animationDuration = duration + 's';

                        // Apply theme class
                        bubble.classList.add(this.isDarkTheme ? 'dark-theme' : 'light-theme');

                        // Special bubble types based on size and chance
                        const specialChance = Math.random();
                        if (size > 100 && specialChance < 0.15) {
                            bubble.classList.add('glow');
                        } else if (size > 80) {
                            bubble.classList.add('large');
                        }

                        // Add slight random rotation for variety
                        const rotation = Math.random() * 360;
                        bubble.style.transform = `rotate(${rotation}deg)`;

                        // Performance optimization: use transform3d for hardware acceleration
                        bubble.style.transform += ' translateZ(0)';

                        // Add to container and bubbles array
                        this.container.appendChild(bubble);
                        this.bubbles.push({
                            element: bubble,
                            x: x,
                            y: window.innerHeight + size,
                            size: size,
                            originalX: x,
                            repelStrength: size > 80 ? 180 : size > 60 ? 150 : 120,
                            isSpecial: bubble.classList.contains('glow'),
                            createdAt: Date.now()
                        });

                        // Start animation with slight delay for performance
                        requestAnimationFrame(() => {
                            bubble.classList.add('animate-float-up');
                        });

                        // Remove bubble after animation completes
                        setTimeout(() => {
                            this.removeBubble(bubble);
                        }, duration * 1000 + 1000);
                    }

                    getRandomSize() {
                        const screenWidth = window.innerWidth;
                        let minSize, maxSize;

                        if (screenWidth < 480) {
                            minSize = 20;
                            maxSize = 60;
                        } else if (screenWidth < 768) {
                            minSize = 30;
                            maxSize = 80;
                        } else {
                            minSize = 40;
                            maxSize = 120;
                        }

                        // Weighted towards smaller sizes
                        const rand = Math.random();
                        if (rand < 0.7) {
                            return minSize + Math.random() * (maxSize * 0.6 - minSize);
                        } else {
                            return maxSize * 0.6 + Math.random() * (maxSize * 0.4);
                        }
                    }

                    setupMouseTracking() {
                        let mouseTimeout;
                        let animationFrame;

                        // Throttled mouse move handler for better performance
                        const throttledMouseMove = this.throttle((e) => {
                            this.mouseX = e.clientX;
                            this.mouseY = e.clientY;
                            this.isMouseMoving = true;
                            this.lastMouseMove = Date.now();

                            // Clear existing timeout
                            clearTimeout(mouseTimeout);

                            // Update bubble positions with RAF for smooth animation
                            if (animationFrame) {
                                cancelAnimationFrame(animationFrame);
                            }
                            animationFrame = requestAnimationFrame(() => {
                                this.updateBubblePositions();
                            });

                            // Reset mouse moving flag after delay
                            mouseTimeout = setTimeout(() => {
                                this.isMouseMoving = false;
                                this.resetBubblePositions();
                            }, 800);
                        }, 16); // ~60fps

                        document.addEventListener('mousemove', throttledMouseMove);

                        // Pause bubble interaction when mouse leaves window
                        document.addEventListener('mouseleave', () => {
                            this.isMouseMoving = false;
                            this.resetBubblePositions();
                        });
                    }

                    throttle(func, wait) {
                        let timeout;
                        return function executedFunction(...args) {
                            const later = () => {
                                clearTimeout(timeout);
                                func.apply(this, args);
                            };
                            clearTimeout(timeout);
                            timeout = setTimeout(later, wait);
                        };
                    }

                    updateBubblePositions() {
                        if (!this.isMouseMoving) return;

                        // Use RAF for smooth animations
                        this.bubbles.forEach(bubbleData => {
                            const bubble = bubbleData.element;

                            // Skip if bubble is not visible (performance optimization)
                            const rect = bubble.getBoundingClientRect();
                            if (rect.bottom < 0 || rect.top > window.innerHeight) {
                                return;
                            }

                            const bubbleCenterX = rect.left + rect.width / 2;
                            const bubbleCenterY = rect.top + rect.height / 2;

                            const distance = Math.sqrt(
                                Math.pow(this.mouseX - bubbleCenterX, 2) +
                                Math.pow(this.mouseY - bubbleCenterY, 2)
                            );

                            if (distance < bubbleData.repelStrength) {
                                // Calculate repel direction with smoother easing
                                const angle = Math.atan2(
                                    bubbleCenterY - this.mouseY,
                                    bubbleCenterX - this.mouseX
                                );

                                const repelForce = (bubbleData.repelStrength - distance) / bubbleData.repelStrength;
                                const easing = 1 - Math.pow(1 - repelForce, 3); // Cubic easing

                                const maxOffset = bubbleData.isSpecial ? 80 : 60;
                                const offsetX = Math.cos(angle) * easing * maxOffset;
                                const offsetY = Math.sin(angle) * easing * maxOffset;

                                // Preserve original rotation and add repel transform
                                const currentRotation = bubble.style.transform.match(/rotate\([^)]+\)/)?.[0] || '';
                                bubble.style.transform = `${currentRotation} translate(${offsetX}px, ${offsetY}px) translateZ(0)`;
                                bubble.classList.add('mouse-repel');
                            } else {
                                // Restore original transform
                                const currentRotation = bubble.style.transform.match(/rotate\([^)]+\)/)?.[0] || '';
                                bubble.style.transform = `${currentRotation} translateZ(0)`;
                                bubble.classList.remove('mouse-repel');
                            }
                        });
                    }

                    resetBubblePositions() {
                        this.bubbles.forEach(bubbleData => {
                            const bubble = bubbleData.element;
                            bubble.style.transform = '';
                            bubble.classList.remove('mouse-repel');
                        });
                    }

                    setupThemeDetection() {
                        // Watch for theme changes
                        const observer = new MutationObserver((mutations) => {
                            mutations.forEach((mutation) => {
                                if (mutation.attributeName === 'class') {
                                    const wasDark = this.isDarkTheme;
                                    this.isDarkTheme = document.documentElement.classList.contains('dark');

                                    if (wasDark !== this.isDarkTheme) {
                                        this.updateBubbleThemes();
                                    }
                                }
                            });
                        });

                        observer.observe(document.documentElement, {
                            attributes: true,
                            attributeFilter: ['class']
                        });
                    }

                    updateBubbleThemes() {
                        this.bubbles.forEach(bubbleData => {
                            const bubble = bubbleData.element;
                            bubble.classList.remove('light-theme', 'dark-theme');
                            bubble.classList.add(this.isDarkTheme ? 'dark-theme' : 'light-theme');
                        });
                    }

                    startBubbleGeneration() {
                        // Performance-aware bubble generation
                        const generateBubble = () => {
                            if (!this.isVisible) return;

                            // Adjust max bubbles based on screen size and performance
                            const screenMultiplier = window.innerWidth < 768 ? 0.6 : window.innerWidth < 1024 ? 0.8 : 1;
                            const maxBubbles = Math.floor(this.maxBubbles * screenMultiplier);

                            if (this.bubbles.length < maxBubbles) {
                                this.createBubble();
                            }
                        };

                        // Initial bubbles
                        generateBubble();

                        // Set up generation interval
                        setInterval(generateBubble, this.creationInterval);

                        // Pause generation when tab is not visible
                        document.addEventListener('visibilitychange', () => {
                            this.isVisible = !document.hidden;
                            if (this.isVisible) {
                                // Resume with a few bubbles
                                setTimeout(() => {
                                    for (let i = 0; i < 3; i++) {
                                        setTimeout(generateBubble, i * 500);
                                    }
                                }, 1000);
                            }
                        });
                    }

                    startCleanup() {
                        setInterval(() => {
                            this.bubbles = this.bubbles.filter(bubbleData => {
                                if (!bubbleData.element.parentNode) {
                                    return false;
                                }
                                return true;
                            });
                        }, 5000);
                    }

                    removeBubble(bubbleElement) {
                        if (bubbleElement && bubbleElement.parentNode) {
                            bubbleElement.parentNode.removeChild(bubbleElement);
                        }

                        this.bubbles = this.bubbles.filter(
                            bubbleData => bubbleData.element !== bubbleElement
                        );
                    }

                    // Public method to pause/resume bubbles
                    toggleBubbles(pause = false) {
                        this.bubbles.forEach(bubbleData => {
                            const bubble = bubbleData.element;
                            if (pause) {
                                bubble.style.animationPlayState = 'paused';
                            } else {
                                bubble.style.animationPlayState = 'running';
                            }
                        });
                    }

                    // Touch device support
                    setupTouchSupport() {
                        if ('ontouchstart' in window) {
                            document.addEventListener('touchmove', (e) => {
                                if (e.touches.length === 1) {
                                    const touch = e.touches[0];
                                    this.mouseX = touch.clientX;
                                    this.mouseY = touch.clientY;
                                    this.isMouseMoving = true;

                                    requestAnimationFrame(() => {
                                        this.updateBubblePositions();
                                    });

                                    setTimeout(() => {
                                        this.isMouseMoving = false;
                                        this.resetBubblePositions();
                                    }, 1000);
                                }
                            }, { passive: true });
                        }
                    }

                    // Accessibility: respect user's motion preferences
                    respectMotionPreferences() {
                        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

                        const handleMotionPreference = (e) => {
                            if (e.matches) {
                                // Reduce animations for accessibility
                                this.maxBubbles = Math.floor(this.maxBubbles * 0.5);
                                this.creationInterval *= 2;
                                this.bubbles.forEach(bubbleData => {
                                    bubbleData.element.style.animationDuration = '30s';
                                });
                            }
                        };

                        prefersReducedMotion.addListener(handleMotionPreference);
                        handleMotionPreference(prefersReducedMotion);
                    }
                }

                // Initialize bubbles when DOM is loaded
                document.addEventListener('DOMContentLoaded', () => {
                    window.floatingBubbles = new FloatingBubbles();

                    // Load control panel for development
                    if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
                        const script = document.createElement('script');
                        script.src = '{{ asset("js/bubble-controls.js") }}';
                        document.head.appendChild(script);
                    }
                });

                // Handle window resize
                window.addEventListener('resize', () => {
                    if (window.floatingBubbles) {
                        // Recreate bubbles with new responsive sizes
                        setTimeout(() => {
                            window.floatingBubbles.bubbles.forEach(bubbleData => {
                                window.floatingBubbles.removeBubble(bubbleData.element);
                            });
                            window.floatingBubbles.createInitialBubbles();
                        }, 1000);
                    }
                });

                // Back to top button functionality
                const backToTop = document.getElementById('backToTop');

                // Show/hide back to top button based on scroll position
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 300) {
                        backToTop.classList.remove('opacity-0', 'invisible');
                    } else {
                        backToTop.classList.add('opacity-0', 'invisible');
                    }
                });

                // Scroll to top when button is clicked
                backToTop.addEventListener('click', () => {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });

                // Smooth scrolling for anchor links
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', function (e) {
                        e.preventDefault();
                        const target = document.querySelector(this.getAttribute('href'));
                        if (target) {
                            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }
                    });
                });

                // Intersection Observer for animations
                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                };

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('animate-fade-in-up');
                        }
                    });
                }, observerOptions);

                // Observe all feature cards and sections
                document.querySelectorAll('.group, [class*="animate-fade-in-up"]').forEach(element => {
                    observer.observe(element);
                });
            </script>
        @endpush
    </div>
</x-guest-layout>
