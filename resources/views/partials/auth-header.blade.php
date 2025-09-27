<!-- Auth Header - Simple header for login/register pages -->
<header class="absolute top-0 left-0 right-0 z-50 bg-transparent">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div
			class="flex justify-between items-center h-16">
			<!-- Logo Section -->
			<div class="flex items-center">
				<a href="{{ route('welcome') }}" class="flex items-center space-x-3 text-white hover:text-gray-200 transition-colors">
					<div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
						<svg class="w-5 h-5 text-gray-800" fill="currentColor" viewbox="0 0 24 24">
							<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
						</svg>
					</div>
					<span class="text-lg font-bold hidden sm:block">HealUp</span>
				</a>
			</div>

			<!-- Right Section -->
			<div
				class="flex items-center space-x-4">
				<!-- Theme Toggle -->
				<div class="theme-toggle-container">
					<x-theme.toggle size="sm"/>
				</div>

				<!-- Back to Home -->
				<a href="{{ route('welcome') }}" class="text-white/80 hover:text-white text-sm font-medium transition-colors flex items-center space-x-1">
					<svg class="w-4 h-4" fill="currentColor" viewbox="0 0 20 20">
						<path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
					</svg>
					<span class="hidden sm:block">Back to Home</span>
				</a>
			</div>
		</div>
	</div>
</header>

