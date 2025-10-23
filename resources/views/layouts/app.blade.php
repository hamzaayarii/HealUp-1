@extends('layouts.base')

@section('body_class', 'bg-gray-100 dark:bg-gray-900')

@section('header')
    <!-- Jetstream Banner -->
     <!-- FullCalendar CSS -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>

<!-- Pour la version française -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/fr.min.js'></script>

<!-- Style personnalisé pour FullCalendar -->
<style>
.fc { 
    font-family: 'Inter', sans-serif;
}
.fc-event {
    border: none;
    border-radius: 8px;
    padding: 4px 8px;
    font-size: 0.875rem;
    cursor: pointer;
}
.fc-daygrid-event {
    white-space: normal;
}
.challenge-event {
    background: linear-gradient(135deg, #10b981, #059669);
    border-left: 4px solid #047857;
}
.checkin-event {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    border-left: 4px solid #b45309;
}
.progress-bar {
    height: 4px;
    background: #e5e7eb;
    border-radius: 2px;
    margin-top: 4px;
    overflow: hidden;
}
.progress-fill {
    height: 100%;
    background: #10b981;
    border-radius: 2px;
    transition: width 0.3s ease;
}
</style>
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
