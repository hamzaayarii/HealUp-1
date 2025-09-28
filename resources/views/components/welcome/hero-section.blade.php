<!-- Hero Section Component -->
<section
	class="relative min-h-screen flex items-center justify-center overflow-hidden">
	<!-- Background Elements -->
	<div class="absolute inset-0 z-0">
		<div class="absolute top-20 left-10 w-72 h-72 bg-gradient-to-br from-green-200 to-emerald-300 dark:from-green-800 dark:to-emerald-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float"></div>
		<div class="absolute top-40 right-10 w-72 h-72 bg-gradient-to-br from-teal-200 to-cyan-300 dark:from-teal-800 dark:to-cyan-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float" style="animation-delay: 2s;"></div>
		<div class="absolute bottom-40 left-1/2 w-72 h-72 bg-gradient-to-br from-blue-200 to-indigo-300 dark:from-blue-800 dark:to-indigo-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-70 animate-float" style="animation-delay: 4s;"></div>
	</div>

	<div
		class="relative z-20 max-w-7xl mx-auto px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
		<!-- Left Content -->
		<div
			class="text-center lg:text-left animate-fade-in-up">
			<!-- Badge -->
			<div class="inline-flex items-center space-x-2 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 px-4 py-2 rounded-full text-sm font-medium mb-8 theme-transition">
				<svg class="w-4 h-4" fill="currentColor" viewbox="0 0 24 24">
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
					<svg class="w-5 h-5" fill="none" stroke="currentColor" viewbox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
					</svg>
					<span>Start as Student</span>
					<svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewbox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
					</svg>
				</a>

				<a href="{{ route('register') }}" class="group bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 text-green-700 dark:text-green-300 px-8 py-4 rounded-xl font-semibold transition-all duration-300 border-2 border-green-200 dark:border-green-700 hover:border-green-300 dark:hover:border-green-600 flex items-center space-x-2 theme-transition">
					<svg class="w-5 h-5" fill="none" stroke="currentColor" viewbox="0 0 24 24">
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
		<x-welcome.dashboard-preview/>
	</div>
</section>

