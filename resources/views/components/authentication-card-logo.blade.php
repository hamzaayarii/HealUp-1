<a href="/" class="theme-transition block">
    {{-- Authentication page logo - use uploaded image if available --}}
    @if(file_exists(public_path('images/logos/healup-logo-light.svg')) || file_exists(public_path('images/logos/healup-logo-light.png')))
        {{-- Use uploaded logo images --}}
        <div class="w-32 h-16 mx-auto">
            @if(file_exists(public_path('images/logos/healup-logo-light.svg')))
                <img src="{{ asset('images/logos/healup-logo-light.svg') }}" alt="{{ config('app.name') }} Logo"
                    class="w-full h-full object-contain dark:hidden theme-transition">
            @elseif(file_exists(public_path('images/logos/healup-logo-light.png')))
                <img src="{{ asset('images/logos/healup-logo-light.png') }}" alt="{{ config('app.name') }} Logo"
                    class="w-full h-full object-contain dark:hidden theme-transition">
            @endif

            @if(file_exists(public_path('images/logos/healup-logo-dark.svg')))
                <img src="{{ asset('images/logos/healup-logo-dark.svg') }}" alt="{{ config('app.name') }} Logo"
                    class="w-full h-full object-contain hidden dark:block theme-transition">
            @elseif(file_exists(public_path('images/logos/healup-logo-dark.png')))
                <img src="{{ asset('images/logos/healup-logo-dark.png') }}" alt="{{ config('app.name') }} Logo"
                    class="w-full h-full object-contain hidden dark:block theme-transition">
            @else
                {{-- Use light logo with invert for dark mode --}}
                @if(file_exists(public_path('images/logos/healup-logo-light.svg')))
                    <img src="{{ asset('images/logos/healup-logo-light.svg') }}" alt="{{ config('app.name') }} Logo"
                        class="w-full h-full object-contain hidden dark:block theme-transition filter brightness-0 invert">
                @elseif(file_exists(public_path('images/logos/healup-logo-light.png')))
                    <img src="{{ asset('images/logos/healup-logo-light.png') }}" alt="{{ config('app.name') }} Logo"
                        class="w-full h-full object-contain hidden dark:block theme-transition filter brightness-0 invert">
                @endif
            @endif
        </div>
    @else
        {{-- Fallback styled version --}}
        <div class="flex flex-col items-center space-y-2">
            {{-- Large medical icon --}}
            <svg viewBox="0 0 48 48" fill="none" class="w-16 h-16">
                <circle cx="24" cy="24" r="22" fill="currentColor" class="text-primary-600 dark:text-primary-400"
                    fill-opacity="0.1" />
                <rect x="20" y="12" width="8" height="24" rx="4" fill="currentColor"
                    class="text-primary-600 dark:text-primary-400" />
                <rect x="12" y="20" width="24" height="8" rx="4" fill="currentColor"
                    class="text-primary-600 dark:text-primary-400" />
                <circle cx="24" cy="24" r="3" fill="currentColor" class="text-red-500" />
            </svg>
            {{-- Large text logo --}}
            <div class="text-center">
                <div class="font-bold text-2xl text-gray-900 dark:text-gray-100 tracking-tight">
                    Heal<span class="text-primary-600 dark:text-primary-400">Up</span>
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-400">
                    Healthcare Platform
                </div>
            </div>
        </div>
    @endif
</a>
