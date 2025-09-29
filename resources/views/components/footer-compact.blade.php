{{-- Compact Dashboard Footer Component for HealUp --}}
<footer class="bg-white/95 dark:bg-gray-900/95 backdrop-blur-xl border-t border-emerald-100/60 dark:border-emerald-800/30 shadow-sm mt-auto theme-transition">
    <div class="max-w-full mx-auto px-4 py-3 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 theme-transition">
            <div class="flex items-center space-x-2">
                <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></div>
                <span class="font-medium bg-gradient-to-r from-emerald-600 to-blue-600 dark:from-emerald-400 dark:to-blue-400 bg-clip-text text-transparent">HealUp</span>
            </div>
            <span>© {{ date('Y') }}</span>
        </div>
    </div>
</footer>
