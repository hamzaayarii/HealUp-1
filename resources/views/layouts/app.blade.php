@extends('layouts.base')

@section('body_class', 'bg-gray-100 dark:bg-gray-900')

@section('header')
    <!-- Jetstream Banner -->
    <x-banner />
@endsection

@section('navigation')
    @include('navigation-menu')
@endsection

@section('content')
    <!-- Page Header -->
    @if (isset($header))
        <div class="page-header bg-white dark:bg-gray-800 shadow theme-transition">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="text-gray-900 dark:text-gray-100 theme-transition">
                    {{ $header }}
                </div>
            </div>
        </div>
    @endif

    <!-- Main Content Container -->
    <div class="main-content theme-transition">
        @if(isset($slot))
            {{ $slot }}
        @else
            @yield('content')
        @endif
    </div>
@endsection

@section('footer')
    <x-footer />
@endsection
