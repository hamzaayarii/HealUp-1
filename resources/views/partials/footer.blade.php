<!-- Main Application Footer -->
<footer class="app-footer bg-white border-t border-gray-200" role="contentinfo">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Footer Content Grid -->
        <div class="footer-grid grid grid-cols-1 md:grid-cols-4 gap-8">

            <!-- Company Info -->
            <div class="footer-company col-span-1 md:col-span-2">
                <div class="flex items-center space-x-3 mb-4">
                    <x-ui.logo variant="full" size="md" />
                    <span class="text-xl font-bold text-gray-900">{{ config('app.name') }}</span>
                </div>
                <p class="text-gray-600 mb-4">
                    Empowering healthcare professionals with modern, secure, and user-friendly solutions
                    to improve patient care and streamline medical workflows.
                </p>
                <!-- Social Links -->
                <div class="social-links flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-gray-600" aria-label="Twitter">
                        <x-ui.icon name="twitter" class="w-5 h-5" />
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-600" aria-label="LinkedIn">
                        <x-ui.icon name="linkedin" class="w-5 h-5" />
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-600" aria-label="GitHub">
                        <x-ui.icon name="github" class="w-5 h-5" />
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-links">
                <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">
                    Platform
                </h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 transition-colors">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-600 hover:text-gray-900 transition-colors">
                            Features
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-600 hover:text-gray-900 transition-colors">
                            API Docs
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-600 hover:text-gray-900 transition-colors">
                            System Status
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Support Links -->
            <div class="footer-support">
                <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">
                    Support
                </h3>
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="text-gray-600 hover:text-gray-900 transition-colors">
                            Help Center
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-600 hover:text-gray-900 transition-colors">
                            Contact Us
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-600 hover:text-gray-900 transition-colors">
                            Privacy Policy
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-600 hover:text-gray-900 transition-colors">
                            Terms of Service
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom mt-8 pt-8 border-t border-gray-200">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="footer-copyright text-gray-500 text-sm">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </div>

                <div class="footer-meta flex items-center space-x-6 mt-4 md:mt-0">
                    <!-- Version Info (for authenticated users) -->
                    @auth
                        <span class="text-xs text-gray-400">
                            v{{ config('app.version', '1.0.0') }}
                        </span>
                    @endauth

                    <!-- Language Selector (if multi-language) -->
                    <div class="language-selector">
                        <select class="text-sm text-gray-500 bg-transparent border-none focus:ring-0"
                            aria-label="Select language">
                            <option value="en">English</option>
                            <option value="fr">Français</option>
                            <option value="es">Español</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
