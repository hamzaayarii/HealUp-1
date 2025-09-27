<!-- Main Application Header -->
<header class="app-header bg-white shadow-sm border-b border-gray-200" role="banner">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div
			class="flex justify-between items-center h-16">

			<!-- Logo Section -->
			<div class="header-logo flex items-center">
				<a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
					<x-ui.logo variant="full" size="md"/>
					<span class="text-xl font-bold text-gray-900">{{ config('app.name') }}</span>
				</a>
			</div>

			<!-- Main Navigation (Desktop) -->
			<div class="header-nav hidden md:flex items-center space-x-8">
				@auth
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>
                    <!-- Add more nav items as needed -->
                @endauth
			</div>

			<!-- User Menu Section -->
			<div class="header-user-menu flex items-center space-x-4">
				@auth
                    <!-- Notifications (if implemented) -->
                    <x-ui.notification-bell/>

                    <!-- User Dropdown -->
                    <x-ui.user-dropdown/>
                @else
                    <!-- Guest Actions -->
                    <div class="guest-actions flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 font-medium">
                            Sign in
                        </a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md font-medium hover:bg-blue-700">
                            Get started
                        </a>
                    </div>
                @endauth

				<!-- Mobile Menu Toggle -->
				<div class="mobile-menu-toggle md:hidden">
					<x-ui.mobile-menu-button/>
				</div>
			</div>
		</div>
	</div>

	<!-- Mobile Navigation Menu -->
	<div class="mobile-nav md:hidden" id="mobile-menu" style="display: none;">
		<div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t border-gray-200">
			@auth
                <a href="{{ route('dashboard') }}" class="mobile-nav-link block px-3 py-2 text-gray-700 hover:bg-gray-50">
                    Dashboard
                </a>
                <a href="{{ route('profile.show') }}" class="mobile-nav-link block px-3 py-2 text-gray-700 hover:bg-gray-50">
                    Profile
                </a>
                <!-- Logout Form -->
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="mobile-nav-link block w-full text-left px-3 py-2 text-gray-700 hover:bg-gray-50">
                        Sign out
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="mobile-nav-link block px-3 py-2 text-gray-700 hover:bg-gray-50">
                    Sign in
                </a>
                <a href="{{ route('register') }}" class="mobile-nav-link block px-3 py-2 text-gray-700 hover:bg-gray-50">
                    Register
                </a>
            @endauth
		</div>
	</div>
</header>

<!-- Add mobile menu toggle functionality -->
@push
    ('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.querySelector('[data-mobile-menu-toggle]');
    const mobileMenu = document.getElementById('mobile-menu');

    if (toggleButton && mobileMenu) {
    toggleButton.addEventListener('click', function () {
    const isHidden = mobileMenu.style.display === 'none';
    mobileMenu.style.display = isHidden ? 'block' : 'none';

    // Update ARIA attributes for accessibility
    toggleButton.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
    });
    }
    });
    </script>
@endpush

