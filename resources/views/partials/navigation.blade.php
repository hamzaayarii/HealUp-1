<!-- Main Application Navigation (if separate from header) -->
<nav class="app-navigation bg-white border-b border-gray-200" role="navigation" aria-label="Main navigation">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Primary Navigation -->
            <div class="primary-nav flex space-x-8">
                @auth
                            <a href="{{ route('dashboard') }}" class="nav-item flex items-center px-1 pt-1 border-b-2 text-sm font-medium
                                          {{ request()->routeIs('dashboard')
                    ? 'border-blue-500 text-gray-900'
                    : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                <x-ui.icon name="home" class="w-4 h-4 mr-2" />
                                Dashboard
                            </a>

                            <!-- Example additional nav items -->
                            <a href="#"
                                class="nav-item flex items-center px-1 pt-1 border-b-2 text-sm font-medium border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                <x-ui.icon name="users" class="w-4 h-4 mr-2" />
                                Patients
                            </a>

                            <a href="#"
                                class="nav-item flex items-center px-1 pt-1 border-b-2 text-sm font-medium border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                <x-ui.icon name="calendar" class="w-4 h-4 mr-2" />
                                Appointments
                            </a>

                            <a href="#"
                                class="nav-item flex items-center px-1 pt-1 border-b-2 text-sm font-medium border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                <x-ui.icon name="chart-bar" class="w-4 h-4 mr-2" />
                                Reports
                            </a>
                @endauth
            </div>

            <!-- Secondary Navigation -->
            <div class="secondary-nav flex items-center space-x-4">
                @auth
                    <!-- Quick Actions -->
                    <div class="quick-actions flex items-center space-x-2">
                        <x-ui.button variant="outline" size="sm" data-modal-target="quick-add-modal">
                            <x-ui.icon name="plus" class="w-4 h-4 mr-1" />
                            Quick Add
                        </x-ui.button>
                    </div>

                    <!-- Search -->
                    <div class="nav-search hidden lg:block">
                        <x-forms.search-input placeholder="Search patients, appointments..." class="w-64" />
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Navigation Overlay (if needed) -->
@auth
    <div class="mobile-nav-overlay hidden fixed inset-0 z-40 bg-black bg-opacity-25" id="mobile-nav-overlay"></div>

    <!-- Mobile Navigation Sidebar -->
    <div class="mobile-nav-sidebar fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out"
        id="mobile-nav-sidebar">
        <div class="p-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <span class="text-lg font-semibold text-gray-900">Menu</span>
                <button type="button" class="mobile-nav-close p-2 text-gray-400 hover:text-gray-600"
                    aria-label="Close navigation">
                    <x-ui.icon name="x" class="w-5 h-5" />
                </button>
            </div>
        </div>

        <nav class="mt-4 px-4">
            <div class="space-y-2">
                <a href="{{ route('dashboard') }}" class="mobile-nav-link flex items-center px-3 py-2 text-gray-700 rounded-md hover:bg-gray-100
                          {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700' : '' }}">
                    <x-ui.icon name="home" class="w-5 h-5 mr-3" />
                    Dashboard
                </a>

                <a href="#" class="mobile-nav-link flex items-center px-3 py-2 text-gray-700 rounded-md hover:bg-gray-100">
                    <x-ui.icon name="users" class="w-5 h-5 mr-3" />
                    Patients
                </a>

                <a href="#" class="mobile-nav-link flex items-center px-3 py-2 text-gray-700 rounded-md hover:bg-gray-100">
                    <x-ui.icon name="calendar" class="w-5 h-5 mr-3" />
                    Appointments
                </a>

                <a href="#" class="mobile-nav-link flex items-center px-3 py-2 text-gray-700 rounded-md hover:bg-gray-100">
                    <x-ui.icon name="chart-bar" class="w-5 h-5 mr-3" />
                    Reports
                </a>
            </div>
        </nav>
    </div>
@endauth

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mobileNavToggle = document.querySelector('[data-mobile-nav-toggle]');
            const mobileNavSidebar = document.getElementById('mobile-nav-sidebar');
            const mobileNavOverlay = document.getElementById('mobile-nav-overlay');
            const mobileNavClose = document.querySelector('.mobile-nav-close');

            function openMobileNav() {
                mobileNavSidebar?.classList.remove('-translate-x-full');
                mobileNavOverlay?.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeMobileNav() {
                mobileNavSidebar?.classList.add('-translate-x-full');
                mobileNavOverlay?.classList.add('hidden');
                document.body.style.overflow = '';
            }

            mobileNavToggle?.addEventListener('click', openMobileNav);
            mobileNavClose?.addEventListener('click', closeMobileNav);
            mobileNavOverlay?.addEventListener('click', closeMobileNav);

            // Close on escape key
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    closeMobileNav();
                }
            });
        });
    </script>
@endpush
