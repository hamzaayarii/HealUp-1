<x-guest-layout>
    <!-- External CSS for floating bubbles -->
    <link rel="stylesheet" href="{{ asset('css/floating-bubbles.css') }}">

    <div class="scroll-smooth">
        <!-- Floating Bubbles Background Overlay -->
        <x-welcome.floating-bubbles />

        <!-- 403 Content Section -->
        <section class="relative min-h-screen flex items-center justify-center px-4 py-16 bg-gradient-to-b from-surface-50 to-surface-100 dark:from-surface-900 dark:to-surface-800 overflow-hidden">
            <div class="max-w-3xl mx-auto text-center z-10">
                <!-- Shield Animation -->
                <div class="relative mb-8">
                    <div class="inline-block relative">
                        <svg class="w-36 h-36 md:w-48 md:h-48 text-green-600 dark:text-green-500 animate-pulse" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-4xl md:text-5xl font-bold text-white dark:text-secondary-900">403</span>
                        </div>
                    </div>
                    <div class="absolute -top-6 -right-6 w-24 h-24 md:w-32 md:h-32 bg-gradient-to-br from-green-300 to-green-500 rounded-full opacity-20 dark:opacity-10 animate-blob"></div>
                    <div class="absolute -bottom-8 -left-8 w-24 h-24 md:w-32 md:h-32 bg-gradient-to-br from-green-400 to-green-600 rounded-full opacity-20 dark:opacity-10 animate-blob animation-delay-2000"></div>
                </div>

                <h1 class="text-4xl md:text-5xl font-bold mb-6 text-secondary-800 dark:text-secondary-100">Access Protected Area</h1>

                <p class="text-xl mb-8 text-secondary-600 dark:text-secondary-300">This healing space requires special permissions to enter.</p>

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

                <!-- Meditation Technique -->
                <div class="mt-16 p-6 bg-white dark:bg-secondary-800 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-4 text-secondary-700 dark:text-secondary-200">While you're here, try this breathing exercise:</h3>

                    <div class="relative mx-auto w-48 h-48 mb-6">
                        <div id="breathing-circle" class="absolute inset-0 bg-gradient-to-r from-green-300 to-green-500 dark:from-green-600 dark:to-green-800 rounded-full transform scale-75 opacity-75"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span id="breathing-text" class="text-lg font-medium text-white dark:text-white">Breathe In</span>
                        </div>
                    </div>

                    <p class="text-secondary-600 dark:text-secondary-300">Follow the circle's rhythm for a quick mindfulness moment</p>
                </div>
            </div>

            <!-- Decorative Elements -->
            <div class="absolute top-1/3 left-0 w-32 h-32 bg-green-200 dark:bg-green-800 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute bottom-1/3 right-0 w-32 h-32 bg-green-300 dark:bg-green-700 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        </section>

        <!-- Back to Top Button -->
        <x-welcome.back-to-top />

        @push('scripts')
            <script src="{{ asset('js/welcome-page.js') }}"></script>
            <script>
                // Animation for blob elements and breathing circle
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
                        @keyframes breathe {
                            0%, 100% {
                                transform: scale(0.75);
                            }
                            50% {
                                transform: scale(1);
                            }
                        }
                    `;
                    document.head.appendChild(style);

                    // Breathing animation
                    const breathingCircle = document.getElementById('breathing-circle');
                    const breathingText = document.getElementById('breathing-text');

                    if (breathingCircle && breathingText) {
                        let isBreathingIn = true;

                        const updateBreathing = () => {
                            breathingCircle.style.animation = isBreathingIn
                                ? 'breathe 4s ease-in-out infinite'
                                : 'breathe 4s ease-in-out infinite';
                            breathingText.innerText = isBreathingIn ? 'Breathe In' : 'Breathe Out';
                            isBreathingIn = !isBreathingIn;
                        };

                        updateBreathing();
                        setInterval(updateBreathing, 4000);
                    }
                });
            </script>
        @endpush
    </div>
</x-guest-layout>
