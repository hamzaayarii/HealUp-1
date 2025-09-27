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
            <x-welcome.cta-feature text="Free to get started" />
            <x-welcome.cta-feature text="Privacy-focused platform" />
            <x-welcome.cta-feature text="Quick 5-minute setup" />
        </div>
    </div>
</section>
