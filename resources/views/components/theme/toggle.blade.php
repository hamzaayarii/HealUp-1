@props([
    'size' => 'md',
    'buttonClasses' => '',
    'position' => 'inline' // inline, fixed, absolute
])

@php
// Modern Omegle-style toggle switch sizing
$sizeClasses = [
    'sm' => 'w-12 h-6',
    'md' => 'w-14 h-7',
    'lg' => 'w-16 h-8',
];

$positionClasses = [
    'inline' => '',
    'fixed' => 'fixed top-4 right-4 z-50',
    'absolute' => 'absolute top-4 right-4',
];
@endphp

<div x-data="themeToggle()" class="{{ $positionClasses[$position] ?? '' }}">
    <!-- Modern Toggle Switch Container -->
    <button
        @click="toggleTheme()"
        :aria-label="isDarkMode ? 'Switch to light mode' : 'Switch to dark mode'"
        :title="isDarkMode ? 'Switch to light mode' : 'Switch to dark mode'"
        class="relative inline-flex {{ $sizeClasses[$size] ?? $sizeClasses['md'] }} items-center rounded-full border-2 transition-all duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 {{ $buttonClasses }}"
        :class="{
            'bg-blue-500 border-blue-500': isDarkMode,
            'bg-gray-200 dark:bg-gray-700 border-gray-300 dark:border-gray-600': !isDarkMode
        }"
        type="button"
    >
        <!-- Toggle Knob -->
        <span
            class="inline-block w-5 h-5 rounded-full shadow-lg transition-all duration-300 ease-in-out transform flex items-center justify-center"
            :class="{
                'translate-x-7': isDarkMode && '{{ $size }}' === 'md',
                'translate-x-6': isDarkMode && '{{ $size }}' === 'sm',
                'translate-x-8': isDarkMode && '{{ $size }}' === 'lg',
                'translate-x-1': !isDarkMode
            }"
        >
            <!-- Sun Icon (Light Mode) -->
            <svg
                x-show="!isDarkMode"
                x-transition:enter="transition-all duration-300 ease-in-out"
                x-transition:enter-start="opacity-0 rotate-180 scale-0"
                x-transition:enter-end="opacity-100 rotate-0 scale-100"
                x-transition:leave="transition-all duration-200 ease-in-out"
                x-transition:leave-start="opacity-100 rotate-0 scale-100"
                x-transition:leave-end="opacity-0 rotate-180 scale-0"
                class="w-5 h-5 text-yellow-500"
                fill="currentColor"
                viewBox="0 0 20 20"
            >
                <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"/>
            </svg>

            <!-- Moon Icon (Dark Mode) -->
            <svg
                x-show="isDarkMode"
                x-transition:enter="transition-all duration-300 ease-in-out"
                x-transition:enter-start="opacity-0 rotate-180 scale-0"
                x-transition:enter-end="opacity-100 rotate-0 scale-100"
                x-transition:leave="transition-all duration-200 ease-in-out"
                x-transition:leave-start="opacity-100 rotate-0 scale-100"
                x-transition:leave-end="opacity-0 rotate-180 scale-0"
                class="w-5 h-5 text-blue-200"
                fill="currentColor"
                viewBox="0 0 20 20"
            >
                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
            </svg>

            <!-- Loading Spinner (during transition) -->
            <svg
                x-show="isLoading"
                class="w-3 h-3 animate-spin text-gray-400"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
            </svg>
        </span>
    </button>
</div>

<script>
function themeToggle() {
    return {
        isDarkMode: {{ $isDarkMode ? 'true' : 'false' }},
        isLoading: false,

        init() {
            console.log('Theme toggle initialized, isDarkMode:', this.isDarkMode);

            // Set initial theme class
            this.updateThemeClass();

            // Listen for theme changes from other components
            window.addEventListener('theme-changed', (event) => {
                console.log('Theme changed event received:', event.detail);
                this.isDarkMode = event.detail.isDarkMode;
                this.updateThemeClass();
            });

            // Add click event as fallback if Alpine.js fails
            const button = this.$el.querySelector('button');
            if (button) {
                button.addEventListener('click', (e) => {
                    if (!e.detail || e.detail === 1) { // Avoid duplicate calls
                        console.log('Fallback click handler triggered');
                    }
                });
            }
        },

        async toggleTheme() {
            console.log('Toggle theme clicked, current isDarkMode:', this.isDarkMode);
            this.isLoading = true;

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                console.log('CSRF Token found:', !!csrfToken);

                const response = await fetch('{{ route("theme.toggle") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    console.log('Theme toggle response:', data);

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
                    console.error('Theme toggle failed with status:', response.status);
                    throw new Error('Failed to toggle theme');
                }
            } catch (error) {
                console.error('Theme toggle error:', error);

                // Fallback: Toggle theme locally if server request fails
                this.isDarkMode = !this.isDarkMode;
                this.updateThemeClass();

                this.showNotification('Theme changed locally (server error)', 'error');
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
