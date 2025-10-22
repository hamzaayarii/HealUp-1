@extends('layouts.back')

@section('title', 'Profile Management')

@section('content')
<div class="container-fluid">
    <!-- Profile Management Integration -->
    <div class="row">
        <div class="col-12">
            <div class="admin-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-user-cog me-2"></i>
                        Profile Management
                    </h5>
                </div>
                <div class="card-body p-0">
                    <!-- Include Jetstream Profile Management -->
                    <div class="p-4">
                        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                                @livewire('profile.update-profile-information-form')

                                <x-section-border />
                            @endif

                            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                                <div class="mt-10 sm:mt-0">
                                    @livewire('profile.update-password-form')
                                </div>

                                <x-section-border />
                            @endif

                            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                                <div class="mt-10 sm:mt-0">
                                    @livewire('profile.two-factor-authentication-form')
                                </div>

                                <x-section-border />
                            @endif

                            <div class="mt-10 sm:mt-0">
                                @livewire('profile.logout-other-browser-sessions-form')
                            </div>

                            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                                <x-section-border />

                                <div class="mt-10 sm:mt-0">
                                    @livewire('profile.delete-user-form')
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Override some Jetstream styles to match admin theme */
    .max-w-7xl {
        max-width: 100% !important;
    }

    /* Dark theme adjustments for profile forms */
    .dark .bg-white {
        background-color: #1E293B !important;
    }

    .dark .text-gray-900 {
        color: #F1F5F9 !important;
    }

    .dark .text-gray-600 {
        color: #CBD5E1 !important;
    }

    .dark .border-gray-200 {
        border-color: rgba(255, 255, 255, 0.1) !important;
    }

    .dark input, .dark textarea, .dark select {
        background-color: #374151 !important;
        border-color: rgba(255, 255, 255, 0.1) !important;
        color: #F1F5F9 !important;
    }

    .dark input:focus, .dark textarea:focus, .dark select:focus {
        border-color: #10B981 !important;
        box-shadow: 0 0 0 1px #10B981 !important;
    }

    /* Style section borders for admin theme */
    .border-t {
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }

    .dark .border-t {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }
</style>
@endpush
