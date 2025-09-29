{{-- Footer Component for HealUp Dashboard --}}
<footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 mt-auto theme-transition">
    <div class="max-w-7xl mx-auto px-4 py-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            {{-- Logo and App Name --}}
            <div class="flex items-center space-x-2 mb-2 sm:mb-0">
                <div class="flex-shrink-0">
                    <x-application-mark class="h-6 w-6" />
                </div>
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300 theme-transition">
                    HealUp
                </span>
            </div>

            {{-- Copyright --}}
            <div class="text-xs text-gray-500 dark:text-gray-400 theme-transition">
                © {{ date('Y') }} HealUp. All rights reserved.
            </div>
        </div>
    </div>
</footer>
