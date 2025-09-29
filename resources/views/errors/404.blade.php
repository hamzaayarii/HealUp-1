<x-guest-layout>
    <!-- External CSS for floating bubbles -->
    <link rel="stylesheet" href="{{ asset('css/floating-bubbles.css') }}">

    <div class="scroll-smooth">
        <!-- Floating Bubbles Background Overlay -->
        <x-welcome.floating-bubbles />

        <!-- 404 Content Section -->
        <section class="relative min-h-screen flex items-center justify-center px-4 py-16 bg-gradient-to-b from-surface-50 to-surface-100 dark:from-surface-900 dark:to-surface-800 overflow-hidden">
            <div class="max-w-3xl mx-auto text-center z-10">
                <!-- Animated 404 Number -->
                <div class="relative mb-8">
                    <div class="text-[150px] md:text-[200px] font-bold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-green-600 animate-pulse">404</div>
                    <div class="absolute -top-6 -right-6 w-24 h-24 md:w-32 md:h-32 bg-gradient-to-br from-green-300 to-green-500 rounded-full opacity-20 dark:opacity-10 animate-blob"></div>
                    <div class="absolute -bottom-8 -left-8 w-24 h-24 md:w-32 md:h-32 bg-gradient-to-br from-green-400 to-green-600 rounded-full opacity-20 dark:opacity-10 animate-blob animation-delay-2000"></div>
                </div>

                <h1 class="text-4xl md:text-5xl font-bold mb-6 text-secondary-800 dark:text-secondary-100">Oops! Path to wellness not found</h1>

                <p class="text-xl mb-8 text-secondary-600 dark:text-secondary-300">The healing journey you're looking for seems to have wandered off.</p>

                <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4 justify-center">
                    <a href="{{ url('/') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Return Home
                    </a>
                    <button onclick="window.history.back()" class="inline-flex items-center px-6 py-3 border border-green-500 text-base font-medium rounded-md text-green-700 bg-white hover:bg-green-50 dark:bg-secondary-800 dark:text-green-300 dark:border-green-700 dark:hover:bg-secondary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Go Back
                    </button>
                </div>

                <!-- Health Tips -->
                <div class="mt-16 p-6 bg-white dark:bg-secondary-800 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-4 text-secondary-700 dark:text-secondary-200">While you're here, try a quick wellness tip:</h3>
                    <div class="flex flex-col md:flex-row items-center justify-center space-y-6 md:space-y-0 md:space-x-10">
                        <div class="flex flex-col items-center text-center">
                            <div class="w-16 h-16 flex items-center justify-center rounded-full bg-green-100 dark:bg-green-900 mb-3">
                                <svg class="w-8 h-8 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-secondary-600 dark:text-secondary-300">Take a 5-minute mindfulness break</p>
                        </div>

                        <div class="flex flex-col items-center text-center">
                            <div class="w-16 h-16 flex items-center justify-center rounded-full bg-green-100 dark:bg-green-900 mb-3">
                                <svg class="w-8 h-8 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-secondary-600 dark:text-secondary-300">Stretch your body and hydrate</p>
                        </div>

                        <div class="flex flex-col items-center text-center">
                            <div class="w-16 h-16 flex items-center justify-center rounded-full bg-green-100 dark:bg-green-900 mb-3">
                                <svg class="w-8 h-8 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <p class="text-secondary-600 dark:text-secondary-300">Practice gratitude for one thing today</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Decorative Elements -->
            <div class="absolute top-1/4 left-0 w-32 h-32 bg-green-200 dark:bg-green-800 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute bottom-1/4 right-0 w-32 h-32 bg-green-300 dark:bg-green-700 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        </section>

        <!-- Back to Top Button -->
        <x-welcome.back-to-top />

        @push('scripts')
            <script src="{{ asset('js/welcome-page.js') }}"></script>
            <script>
                // Animation for blob elements
                document.addEventListener('DOMContentLoaded', () => {
                    const style = document.createElement('style');
                    style.textContent = `
                        @keyframes blob {
                            0% {
                                transform: translate(0px, 0px) scale(1);
                            }
                            33% {
                                transform: translate(20px, -20px) scale(1.1);
                            }
                            66% {
                                transform: translate(-20px, 20px) scale(0.9);
                            }
                            100% {
                                transform: translate(0px, 0px) scale(1);
                            }
                        }
                        .animate-blob {
                            animation: blob 7s infinite;
                        }
                        .animation-delay-2000 {
                            animation-delay: 2s;
                        }
                    `;
                    document.head.appendChild(style);
                });
            </script>
        @endpush
    </div>
</x-guest-layout>
