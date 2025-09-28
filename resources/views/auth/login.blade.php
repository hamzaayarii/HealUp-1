<x-guest-layout>
    <x-auth.modern-card title="Welcome back" subtitle="Sign in to your HealUp account">
        <!-- Validation Errors -->
        <x-validation-errors class="mb-6" />

        <!-- Status Message -->
        @session('status')
            <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg theme-transition">
                <p class="text-sm font-medium text-green-600 dark:text-green-400">{{ $value }}</p>
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Field -->
            <x-auth.form-input
                label="Email Address"
                name="email"
                type="email"
                icon="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
                placeholder="Enter your email"
            />

            <!-- Password Field -->
            <x-auth.form-input
                label="Password"
                name="password"
                type="password"
                icon="password"
                required
                autocomplete="current-password"
                placeholder="Enter your password"
            />

            <!-- Remember Me -->
            <x-auth.checkbox
                name="remember"
                label="Remember me for 30 days"
            />

            <!-- Submit Button -->
            <x-auth.button full-width>
                Sign In
            </x-auth.button>

            <!-- Additional Links -->
            <div class="flex items-center justify-between text-sm">
                @if (Route::has('password.request'))
                    <x-auth.link href="{{ route('password.request') }}">
                        Forgot your password?
                    </x-auth.link>
                @endif

                <x-auth.link href="{{ route('register') }}" variant="muted">
                    Don't have an account? <span class="text-green-600 dark:text-green-400">Sign up</span>
                </x-auth.link>
            </div>
        </form>
    </x-auth.modern-card>
</x-guest-layout>
