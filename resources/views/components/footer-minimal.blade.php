{{-- Minimal Dashboard Footer Component for HealUp --}}
<footer class="bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 mt-auto theme-transition">
    <div class="max-w-7xl mx-auto px-4 py-3 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-center sm:text-left">
            {{-- App Name with subtle styling --}}
            <div class="flex items-center justify-center sm:justify-start space-x-2 mb-1 sm:mb-0">
                <span class="text-sm font-semibold text-gray-600 dark:text-gray-400 theme-transition">
                    HealUp
                </span>
            </div>

            {{-- Copyright --}}
            <div class="text-xs text-gray-500 dark:text-gray-500 theme-transition">
                © {{ date('Y') }} HealUp
            </div>
        </div>
    </div>
</footer>
