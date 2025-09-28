@props(['title', 'subtitle' => null])

<div
	class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-50 to-green-50 dark:from-gray-900 dark:to-gray-800 py-12 px-4 sm:px-6 lg:px-8 theme-transition">
	<!-- Background Elements -->
	<div class="absolute inset-0 overflow-hidden pointer-events-none">
		<div class="absolute top-20 left-10 w-72 h-72 bg-gradient-to-br from-green-200 to-emerald-300 dark:from-green-800 dark:to-emerald-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-30 animate-float pointer-events-none"></div>
		<div class="absolute bottom-20 right-10 w-96 h-96 bg-gradient-to-br from-teal-200 to-cyan-300 dark:from-teal-800 dark:to-cyan-700 rounded-full mix-blend-multiply dark:mix-blend-overlay filter blur-xl opacity-30 animate-float pointer-events-none" style="animation-delay: 2s;"></div>
	</div>

	<div
		class="max-w-md w-full relative z-10">
		<!-- Logo Section -->
		<div class="text-center mb-8">
			<a href="{{ route('welcome') }}" class="inline-block">
				<img src="{{ asset('images/logos/healup.svg') }}" alt="HealUp Logo" class="h-12 w-auto mx-auto mb-4">
			</a>
			<h2 class="text-3xl font-bold text-gray-900 dark:text-white theme-transition">{{ $title }}</h2>
			@if($subtitle)
                <p class="mt-2 text-gray-600 dark:text-gray-400 theme-transition">{{ $subtitle }}</p>
            @endif
		</div>

		<!-- Card -->
		<div
			class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl p-8 border border-gray-200 dark:border-gray-700 theme-transition">{{ $slot }}
		</div>
	</div>
</div>

