<!-- Guest Header - Simpler version for non-authenticated pages -->
<header class="guest-header bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 theme-transition" role="banner">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div
			class="flex justify-between items-center h-16">

			<!-- Logo Section -->
			<div class="header-logo">
				<a href="{{ route('welcome') }}" class="flex items-center space-x-3">
					<x-ui.logo variant="full" size="md"/>
					<span class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ config('app.name') }}</span>
				</a>
			</div>

			<!-- Navigation Links -->
			<div class="header-nav hidden sm:flex items-center space-x-6">
				<a href="{{ route('welcome') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 font-medium theme-transition">
					Home
				</a>
				<a href="#features" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 font-medium theme-transition">
					Features
				</a>
				<a href="#about" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 font-medium theme-transition">
					About
				</a>
				<a href="#contact" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 font-medium theme-transition">
					Contact
				</a>
			</div>

			<!-- Auth Actions -->
			<div
				class="header-actions flex items-center space-x-4">
				<!-- Theme Toggle -->
				<x-theme.toggle size="sm"/>

				<a href="{{ route('login') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 font-medium theme-transition">
					Sign in
				</a>
				<a href="{{ route('register') }}" class="bg-green-600 text-white px-4 py-2 rounded-md font-medium hover:bg-green-700 dark:bg-green-700 dark:hover:bg-green-600 transition-colors">
					Get started
				</a>

				<!-- Mobile Menu Toggle -->
				<div class="mobile-menu-toggle sm:hidden">
					<button type="button" data-mobile-menu-toggle aria-expanded="false" aria-controls="guest-mobile-menu" class="p-2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 theme-transition">
						<span class="sr-only">Open main menu</span>
						<x-ui.hamburger-icon/>
					</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Mobile Navigation -->
	<div class="guest-mobile-nav sm:hidden" id="guest-mobile-menu" style="display: none;">
		<div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t border-gray-200">
			<a href="{{ route('welcome') }}" class="block px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-md">
				Home
			</a>
			<a href="#features" class="block px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-md">
				Features
			</a>
			<a href="#about" class="block px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-md">
				About
			</a>
			<a href="#contact" class="block px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-md">
				Contact
			</a>
			<div class="border-t border-gray-200 mt-4 pt-4">
				<a href="{{ route('login') }}" class="block px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-md">
					Sign in
				</a>
				<a href="{{ route('register') }}" class="block px-3 py-2 bg-green-600 text-white hover:bg-green-700 rounded-md mt-2">
					Get started
				</a>
			</div>
		</div>
	</div>
</header>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.querySelector('[data-mobile-menu-toggle]');
    const mobileMenu = document.getElementById('guest-mobile-menu');

    if (toggleButton && mobileMenu) {
    toggleButton.addEventListener('click', function () {
    const isHidden = mobileMenu.style.display === 'none';
    mobileMenu.style.display = isHidden ? 'block' : 'none';
    toggleButton.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
    });
    }
    });
    </script>
@endpush

