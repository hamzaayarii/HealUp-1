@extends('layouts.base')

@section('body_class', 'bg-gray-50')
@section('page_identifier', 'auth')

@section('content')
    <!-- Auth Layout Container -->
    <div class="auth-container min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="auth-wrapper max-w-md w-full space-y-8">

            <!-- Auth Header -->
            <div class="auth-header text-center">
                @hasSection('auth_header')
                    @yield('auth_header')
                @else
                    <!-- Default Auth Header -->
                    <div class="auth-logo">
                        <a href="{{ route('welcome') }}" class="inline-block">
                            <x-ui.logo variant="full" size="lg" />
                        </a>
                    </div>
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                        @yield('auth_title', 'Welcome back')
                    </h2>
                    @hasSection('auth_subtitle')
                        <p class="mt-2 text-sm text-gray-600">
                            @yield('auth_subtitle')
                        </p>
                    @endif
                @endif
            </div>

            <!-- Auth Content -->
            <div class="auth-content">
                @yield('auth_content')
            </div>

            <!-- Auth Footer -->
            @hasSection('auth_footer')
                <div class="auth-footer text-center">
                    @yield('auth_footer')
                </div>
            @endif

            <!-- Additional Auth Actions -->
            @hasSection('auth_actions')
                <div class="auth-actions space-y-4">
                    @yield('auth_actions')
                </div>
            @endif
        </div>
    </div>
@endsection

@section('footer')
    <!-- Minimal footer for auth pages -->
    <div class="auth-page-footer bg-white border-t border-gray-200 py-8">
        <div class="max-w-md mx-auto px-4 text-center">
            <p class="text-sm text-gray-500">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </p>
            <div class="mt-2 space-x-4">
                <a href="#" class="text-sm text-gray-500 hover:text-gray-700">Privacy Policy</a>
                <a href="#" class="text-sm text-gray-500 hover:text-gray-700">Terms of Service</a>
                <a href="#" class="text-sm text-gray-500 hover:text-gray-700">Support</a>
            </div>
        </div>
    </div>
@endsection
