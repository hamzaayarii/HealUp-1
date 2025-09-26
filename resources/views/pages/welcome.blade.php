<x-guest-layout>
    {{-- Hero Section --}}
    <section
        class="hero-section bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-800 dark:to-gray-900 py-20 theme-transition">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                {{-- Hero Content --}}
                <h1 class="text-4xl md:text-6xl font-bold text-gray-900 dark:text-gray-100 mb-6 theme-transition">
                    Modern Healthcare
                    <span class="text-primary-600 dark:text-primary-400">Made Simple</span>
                </h1>

                <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto theme-transition">
                    Streamline your practice with our comprehensive healthcare platform.
                    Manage patients, appointments, and medical records with enterprise-grade security.
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <x-ui.button variant="primary" size="lg" href="{{ route('register') }}" class="min-w-[200px]">
                        Start Free Trial
                    </x-ui.button>

                    <x-ui.button variant="outline" size="lg" href="{{ route('login') }}" class="min-w-[200px]">
                        Sign In
                    </x-ui.button>
                </div>

                {{-- Trust Indicators --}}
                <div class="mt-12 text-center">
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 theme-transition">Trusted by healthcare
                        professionals worldwide</p>
                    <div class="flex items-center justify-center space-x-8 text-gray-400 dark:text-gray-500">
                        <div class="flex items-center space-x-2">
                            <x-ui.icon name="shield-check" class="w-5 h-5" />
                            <span class="text-sm">HIPAA Compliant</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <x-ui.icon name="lock" class="w-5 h-5" />
                            <span class="text-sm">Bank-Level Security</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <x-ui.icon name="globe" class="w-5 h-5" />
                            <span class="text-sm">99.9% Uptime</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section id="features" class="features-section py-20 bg-white dark:bg-gray-900 theme-transition">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Section Header --}}
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-gray-100 mb-4 theme-transition">
                    Everything you need to run your practice
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto theme-transition">
                    Comprehensive tools designed specifically for healthcare professionals,
                    with the security and reliability you demand.
                </p>
            </div>

            {{-- Features Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Feature 1 --}}
                <div
                    class="feature-card bg-white p-6 rounded-lg border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="feature-icon w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <x-ui.icon name="users" class="w-6 h-6 text-blue-600" />
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Patient Management</h3>
                    <p class="text-gray-600">
                        Comprehensive patient profiles with medical history, appointments, and secure communication
                        tools.
                    </p>
                </div>

                {{-- Feature 2 --}}
                <div
                    class="feature-card bg-white p-6 rounded-lg border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="feature-icon w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <x-ui.icon name="calendar" class="w-6 h-6 text-green-600" />
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Smart Scheduling</h3>
                    <p class="text-gray-600">
                        Intelligent appointment scheduling with automated reminders and calendar synchronization.
                    </p>
                </div>

                {{-- Feature 3 --}}
                <div
                    class="feature-card bg-white p-6 rounded-lg border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="feature-icon w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                        <x-ui.icon name="chart-bar" class="w-6 h-6 text-purple-600" />
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Analytics & Reports</h3>
                    <p class="text-gray-600">
                        Detailed insights and customizable reports to help you make data-driven decisions.
                    </p>
                </div>

                {{-- Feature 4 --}}
                <div
                    class="feature-card bg-white p-6 rounded-lg border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="feature-icon w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                        <x-ui.icon name="shield-check" class="w-6 h-6 text-red-600" />
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Enterprise Security</h3>
                    <p class="text-gray-600">
                        HIPAA-compliant platform with end-to-end encryption and advanced access controls.
                    </p>
                </div>

                {{-- Feature 5 --}}
                <div
                    class="feature-card bg-white p-6 rounded-lg border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="feature-icon w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mb-4">
                        <x-ui.icon name="mobile" class="w-6 h-6 text-yellow-600" />
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Mobile Access</h3>
                    <p class="text-gray-600">
                        Access your practice data anywhere with our responsive web platform and mobile apps.
                    </p>
                </div>

                {{-- Feature 6 --}}
                <div
                    class="feature-card bg-white p-6 rounded-lg border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="feature-icon w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                        <x-ui.icon name="integration" class="w-6 h-6 text-indigo-600" />
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Seamless Integration</h3>
                    <p class="text-gray-600">
                        Connect with existing healthcare systems and third-party tools through our robust API.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="cta-section bg-blue-600 py-16">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Ready to transform your practice?
            </h2>
            <p class="text-xl text-blue-100 mb-8">
                Join thousands of healthcare professionals who trust HealUp with their practice management.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <x-ui.button variant="white" size="lg" href="{{ route('register') }}"
                    class="bg-white text-blue-600 hover:bg-gray-50">
                    Start Your Free Trial
                </x-ui.button>

                <x-ui.button variant="outline" size="lg" href="#contact"
                    class="border-white text-white hover:bg-white hover:text-blue-600">
                    Contact Sales
                </x-ui.button>
            </div>

            <p class="text-sm text-blue-200 mt-6">
                No credit card required • 30-day free trial • Cancel anytime
            </p>
        </div>
    </section>

    @push('scripts')
        <script>
            // Smooth scrolling for anchor links
            document.addEventListener('DOMContentLoaded', function () {
                const links = document.querySelectorAll('a[href^="#"]');
                links.forEach(link => {
                    link.addEventListener('click', function (e) {
                        e.preventDefault();
                        const target = document.querySelector(this.getAttribute('href'));
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
</x-guest-layout>
