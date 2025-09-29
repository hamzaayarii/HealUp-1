{{-- Modern Footer Component for HealUp Dashboard --}}
<footer class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-lg border-t border-emerald-100/60 dark:border-emerald-800/30 mt-auto theme-transition">
    <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">

            {{-- Left Section: Logo and App Info --}}
            <div class="flex items-center space-x-3">
                <div class="relative group">
                    <x-application-mark class="h-8 w-8 group-hover:scale-105 transform transition-transform duration-200" />
                    <div class="absolute -inset-1 bg-gradient-to-r from-emerald-500 to-blue-500 rounded-full opacity-0 group-hover:opacity-10 blur transition-opacity duration-300"></div>
                </div>
                <div>
                    <div class="text-sm font-bold bg-gradient-to-r from-emerald-600 to-blue-600 dark:from-emerald-400 dark:to-blue-400 bg-clip-text text-transparent">
                        HealUp
                    </div>
                    <div class="text-xs text-gray-500 dark:text-gray-400 -mt-0.5">
                        Your Health & Wellness Platform
                    </div>
                </div>
            </div>

            {{-- Right Section: Copyright and Status --}}
            <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-4">
                {{-- Status Indicator --}}
                <div class="hidden sm:flex items-center space-x-2 text-xs text-gray-500 dark:text-gray-400">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span>All Systems Operational</span>
                </div>

                {{-- Copyright --}}
                <div class="text-xs text-gray-500 dark:text-gray-400 theme-transition flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/>
                    </svg>
                    © {{ date('Y') }} HealUp. All rights reserved.
                </div>
            </div>
        </div>

        {{-- Bottom Accent Border --}}
        <div class="mt-4 pt-3 border-t border-gray-200/60 dark:border-gray-700/60">
            <div class="h-0.5 bg-gradient-to-r from-emerald-500 via-blue-500 to-purple-500 rounded-full opacity-30"></div>
        </div>
    </div>
</footer>
