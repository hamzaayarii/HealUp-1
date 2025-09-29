<x-guest-layout>
    <!-- External CSS for floating bubbles -->
    <link rel="stylesheet" href="{{ asset('css/floating-bubbles.css') }}">

    <div class="scroll-smooth">
        <!-- Floating Bubbles Background Overlay -->
        <x-welcome.floating-bubbles />

        <!-- Generic Error Content Section -->
        <section class="relative min-h-screen flex items-center justify-center px-4 py-16 bg-gradient-to-b from-surface-50 to-surface-100 dark:from-surface-900 dark:to-surface-800 overflow-hidden">
            <div class="max-w-3xl mx-auto text-center z-10">
                <!-- Error Code Display -->
                <div class="relative mb-8">
                    <div class="text-[150px] md:text-[200px] font-bold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-green-600 animate-pulse">{{ $exception->getStatusCode() ?? '500' }}</div>
                    <div class="absolute -top-6 -right-6 w-24 h-24 md:w-32 md:h-32 bg-gradient-to-br from-green-300 to-green-500 rounded-full opacity-20 dark:opacity-10 animate-blob"></div>
                    <div class="absolute -bottom-8 -left-8 w-24 h-24 md:w-32 md:h-32 bg-gradient-to-br from-green-400 to-green-600 rounded-full opacity-20 dark:opacity-10 animate-blob animation-delay-2000"></div>
                </div>

                <h1 class="text-4xl md:text-5xl font-bold mb-6 text-secondary-800 dark:text-secondary-100">{{ $exception->getMessage() ?: 'Something went wrong' }}</h1>

                <p class="text-xl mb-8 text-secondary-600 dark:text-secondary-300">We're working on getting this fixed as quickly as possible.</p>

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

                <!-- Wellness Quote -->
                <div class="mt-16 p-6 bg-white dark:bg-secondary-800 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold mb-4 text-secondary-700 dark:text-secondary-200">A moment of wellness wisdom:</h3>

                    <div class="relative p-4 border-l-4 border-green-500 bg-green-50 dark:bg-green-900/20 dark:border-green-700 mb-4">
                        <div class="text-left italic text-secondary-700 dark:text-secondary-300" id="wellness-quote">
                            "The greatest wealth is health." — Virgil
                        </div>
                    </div>

                    <button id="new-quote-btn" class="mt-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 dark:bg-green-900/30 dark:text-green-300 dark:hover:bg-green-900/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-300">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Another Quote
                    </button>
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

                    // Wellness quotes
                    const wellnessQuotes = [
                        '"The greatest wealth is health." — Virgil',
                        '"Health is not valued until sickness comes." — Thomas Fuller',
                        '"Take care of your body. It's the only place you have to live." — Jim Rohn',
                        '"Your body hears everything your mind says." — Naomi Judd',
                        '"The part can never be well unless the whole is well." — Plato',
                        '"Health is a state of complete harmony of the body, mind, and spirit." — B.K.S. Iyengar',
                        '"Happiness is the highest form of health." — Dalai Lama',
                        '"A healthy outside starts from the inside." — Robert Urich',
                        '"The first wealth is health." — Ralph Waldo Emerson',
                        '"To keep the body in good health is a duty... otherwise we shall not be able to keep our mind strong and clear." — Buddha'
                    ];

                    const quoteElement = document.getElementById('wellness-quote');
                    const quoteBtn = document.getElementById('new-quote-btn');

                    if (quoteElement && quoteBtn) {
                        quoteBtn.addEventListener('click', () => {
                            const currentQuote = quoteElement.innerText;
                            let newQuote = currentQuote;

                            // Make sure we get a different quote
                            while(newQuote === currentQuote) {
                                newQuote = wellnessQuotes[Math.floor(Math.random() * wellnessQuotes.length)];
                            }

                            // Fade out, change text, fade in
                            quoteElement.style.opacity = 0;
                            setTimeout(() => {
                                quoteElement.innerText = newQuote;
                                quoteElement.style.opacity = 1;
                            }, 300);
                        });

                        // Add transition for opacity
                        quoteElement.style.transition = 'opacity 0.3s ease-in-out';
                    }
                });
            </script>
        @endpush
    </div>
</x-guest-layout>
