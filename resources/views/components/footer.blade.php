{{-- Modern Footer Component for HealUp Dashboard --}}
<footer class="bg-white/95 dark:bg-gray-900/95 backdrop-blur-xl border-t border-emerald-100/60 dark:border-emerald-800/30 shadow-md mt-auto theme-transition">
    <div class="max-w-full px-4 py-5 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">

            {{-- Left Section: Logo and App Info --}}
            <div class="flex items-center space-x-3">
                <div class="relative group">
                    <x-application-mark class="h-8 w-8 group-hover:scale-105 transform transition-transform duration-200" />
                    <div class="absolute -inset-1 bg-gradient-to-r from-emerald-500 to-blue-500 rounded-full opacity-0 group-hover:opacity-20 blur transition-opacity duration-300"></div>
                </div>
                <div>
                    <div class="text-sm font-bold bg-gradient-to-r from-emerald-600 to-blue-600 dark:from-emerald-400 dark:to-blue-400 bg-clip-text text-transparent">
                        HealUp
                    </div>
                    <div class="text-xs text-gray-500 dark:text-gray-400 -mt-0.5">
                        Health & Wellness Platform
                    </div>
                </div>
            </div>

            {{-- Center Links --}}
            <div class="hidden md:flex items-center space-x-6 text-sm text-gray-600 dark:text-gray-300">
                <a href="#" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">About</a>
                <a href="#" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">Privacy</a>
                <a href="#" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">Terms</a>
                <a href="#" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">Contact</a>
            </div>

            {{-- Right Section: Status and Copyright --}}
            <div class="flex items-center space-x-4">
                {{-- Status Indicator --}}
                <div class="flex items-center space-x-2 text-xs text-gray-500 dark:text-gray-400">
                    <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                    <span>All Systems Operational</span>
                </div>

                {{-- Copyright --}}
                <div class="text-xs text-gray-500 dark:text-gray-400 theme-transition">
                    © {{ date('Y') }} HealUp
                </div>
            </div>
        </div>
    </div>
</footer>
