@extends('layouts.base')

@section('body_class', 'bg-gray-100')

@section('header')
    <!-- Jetstream Banner -->
    <x-banner />
@endsection

@section('navigation')
    @livewire('navigation-menu')
@endsection

@section('content')
    <!-- Page Header -->
    @if (isset($header))
        <div class="page-header bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </div>
    @endif

    <!-- Main Content Container -->
    <div class="main-content">
        {{ $slot }}
    </div>
@endsection
