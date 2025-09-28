<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-white to-blue-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 flex theme-transition">
        <!-- Left Side - Information Panel -->
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-green-100 to-green-50 dark:from-gray-800 dark:to-gray-900 flex-col justify-center px-12 theme-transition">
            <div class="max-w-md mx-auto">
                <!-- Logo and Title -->
                <div class="text-center mb-8">
                    <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Join SmartHealth</h1>
                    <p class="text-lg text-gray-600 dark:text-gray-300">Start your health journey today. Track activities, monitor progress, and achieve your wellness goals.</p>
                </div>

                <!-- Benefits List -->
                <div class="space-y-4 mb-8">
                    <div class="flex items-center space-x-3">
                        <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300 font-medium">Personalized health tracking</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300 font-medium">Smart reminders and insights</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300 font-medium">Goal setting and achievement</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300 font-medium">Free for students and teachers</span>
                    </div>
                </div>

                <!-- Trust Statistics -->
                <div class="bg-white dark:bg-gray-700 rounded-xl p-6 shadow-lg theme-transition">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 font-medium">Trusted by:</p>
                    <div class="flex items-center justify-center space-x-8">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400">500+</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Students</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400">50+</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Teachers</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Registration Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-12">
            <div class="w-full max-w-md">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 theme-transition">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Create Account</h2>
                        <p class="text-gray-600 dark:text-gray-400">Join thousands of users improving their health</p>
                    </div>

                    <!-- Validation Errors -->
                    <x-validation-errors class="mb-6" />

                    <form method="POST" action="{{ route('register') }}" class="space-y-6" x-data="{ userType: 'student' }">
                        @csrf

                        <!-- User Type Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Account Type</label>
                            <div class="grid grid-cols-2 gap-3">
                                <label class="cursor-pointer">
                                    <input type="radio" name="user_type" value="student" x-model="userType" class="sr-only">
                                    <div class="flex items-center justify-center px-4 py-3 border-2 rounded-lg transition-all"
                                         :class="userType === 'student' ? 'border-green-500 bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-300' : 'border-gray-200 dark:border-gray-600 hover:border-gray-300 dark:hover:border-gray-500 text-gray-700 dark:text-gray-300'">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                                        </svg>
                                        <span class="font-medium">Student</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="user_type" value="teacher" x-model="userType" class="sr-only">
                                    <div class="flex items-center justify-center px-4 py-3 border-2 rounded-lg transition-all"
                                         :class="userType === 'teacher' ? 'border-gray-500 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300' : 'border-gray-200 dark:border-gray-600 hover:border-gray-300 dark:hover:border-gray-500 text-gray-700 dark:text-gray-300'">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                                        </svg>
                                        <span class="font-medium">Teacher</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Name Field -->
                        <x-auth.form-input
                            label="Full Name"
                            name="name"
                            type="text"
                            icon="user"
                            :value="old('name')"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="Enter your full name"
                        />

                        <!-- Email Field -->
                        <x-auth.form-input
                            label="Email Address"
                            name="email"
                            type="email"
                            icon="email"
                            :value="old('email')"
                            required
                            autocomplete="username"
                            placeholder="your.email@example.com"
                        />

                        <!-- Password Field -->
                        <x-auth.form-input
                            label="Password"
                            name="password"
                            type="password"
                            icon="password"
                            required
                            autocomplete="new-password"
                            placeholder="Create a strong password"
                            help="Must be at least 8 characters"
                        />

                        <!-- Confirm Password Field -->
                        <x-auth.form-input
                            label="Confirm Password"
                            name="password_confirmation"
                            type="password"
                            icon="password"
                            required
                            autocomplete="new-password"
                            placeholder="Confirm your password"
                        />

                        <!-- Terms and Privacy Policy -->
                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <x-auth.checkbox name="terms" required>
                                <span class="text-sm text-gray-700 dark:text-gray-300">
                                    I agree to the
                                    <x-auth.link href="{{ route('terms.show') }}" target="_blank">Terms of Service</x-auth.link>
                                    and
                                    <x-auth.link href="{{ route('policy.show') }}" target="_blank">Privacy Policy</x-auth.link>
                                    <span class="text-red-500">*</span>
                                </span>
                            </x-auth.checkbox>
                        @endif

                        <!-- Submit Button -->
                        <x-auth.button full-width>
                            Create Account
                        </x-auth.button>

                        <!-- Login Link -->
                        <div class="text-center pt-4">
                            <x-auth.link href="{{ route('login') }}" variant="muted">
                                Already have an account? <span class="text-green-600 dark:text-green-400 font-medium">Sign in here</span>
                            </x-auth.link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
