@props([
    'size' => 'md',
    'buttonClasses' => '',
    'position' => 'inline' // inline, fixed, absolute
])

@php
$sizeClasses = [
    'sm' => 'w-8 h-8 text-sm',
    'md' => 'w-10 h-10 text-base',
    'lg' => 'w-12 h-12 text-lg',
];

$positionClasses = [
    'inline' => '',
    'fixed' => 'fixed top-4 right-4 z-50',
    'absolute' => 'absolute top-4 right-4',
];

$baseClasses = 'relative inline-flex items-center justify-center rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200 ease-in-out';

$combinedClasses = $baseClasses . ' ' . ($sizeClasses[$size] ?? $sizeClasses['md']) . ' ' . ($positionClasses[$position] ?? '') . ' ' . $buttonClasses;
@endphp

<div x-data="themeToggle()" class="{{ $positionClasses[$position] ?? '' }}">
    <button
        @click="toggleTheme()"
        :aria-label="isDarkMode ? 'Switch to light mode' : 'Switch to dark mode'"
        :title="isDarkMode ? 'Switch to light mode' : 'Switch to dark mode'"
        class="{{ $combinedClasses }}"
        type="button"
    >
        <!-- Sun Icon (Light Mode) -->
        <svg
            x-show="!isDarkMode"
            x-transition:enter="transition-all duration-300 ease-in-out"
            x-transition:enter-start="opacity-0 rotate-90 scale-50"
            x-transition:enter-end="opacity-100 rotate-0 scale-100"
            x-transition:leave="transition-all duration-300 ease-in-out"
            x-transition:leave-start="opacity-100 rotate-0 scale-100"
            x-transition:leave-end="opacity-0 rotate-90 scale-50"
            class="absolute inset-0 m-auto w-5 h-5"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <circle cx="12" cy="12" r="5"/>
            <path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/>
        </svg>

        <!-- Moon Icon (Dark Mode) -->
        <svg
            x-show="isDarkMode"
            x-transition:enter="transition-all duration-300 ease-in-out"
            x-transition:enter-start="opacity-0 rotate-90 scale-50"
            x-transition:enter-end="opacity-100 rotate-0 scale-100"
            x-transition:leave="transition-all duration-300 ease-in-out"
            x-transition:leave-start="opacity-100 rotate-0 scale-100"
            x-transition:leave-end="opacity-0 rotate-90 scale-50"
            class="absolute inset-0 m-auto w-5 h-5"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
        </svg>

        <!-- Loading Spinner (during transition) -->
        <svg
            x-show="isLoading"
            class="absolute inset-0 m-auto w-4 h-4 animate-spin"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
        </svg>
    </button>
</div>

<script>
function themeToggle() {
    return {
        isDarkMode: {{ $isDarkMode ? 'true' : 'false' }},
        isLoading: false,

        init() {
            // Set initial theme class
            this.updateThemeClass();

            // Listen for theme changes from other components
            window.addEventListener('theme-changed', (event) => {
                this.isDarkMode = event.detail.isDarkMode;
                this.updateThemeClass();
            });
        },

        async toggleTheme() {
            this.isLoading = true;

            try {
                const response = await fetch('{{ route("theme.toggle") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    this.isDarkMode = data.isDarkMode;
                    this.updateThemeClass();

                    // Dispatch event for other components
                    window.dispatchEvent(new CustomEvent('theme-changed', {
                        detail: {
                            isDarkMode: this.isDarkMode,
                            theme: data.theme
                        }
                    }));

                    // Show success message
                    this.showNotification(`Switched to ${data.theme} mode`);
                } else {
                    throw new Error('Failed to toggle theme');
                }
            } catch (error) {
                console.error('Theme toggle error:', error);
                this.showNotification('Failed to change theme', 'error');
            } finally {
                this.isLoading = false;
            }
        },

        updateThemeClass() {
            const html = document.documentElement;
            if (this.isDarkMode) {
                html.classList.add('dark');
            } else {
                html.classList.remove('dark');
            }
        },

        showNotification(message, type = 'success') {
            // Create a simple notification
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-4 py-2 rounded-md text-sm font-medium transition-all duration-300 ${
                type === 'error'
                    ? 'bg-red-500 text-white'
                    : 'bg-green-500 text-white'
            }`;
            notification.textContent = message;

            document.body.appendChild(notification);

            // Remove after 3 seconds
            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }
    }
}
</script>
