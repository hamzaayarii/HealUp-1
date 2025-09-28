<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Debug Page
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Authentication Debug</h3>

                @auth
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <strong>✅ User is authenticated</strong><br>
                        <strong>Name:</strong> {{ Auth::user()->name }}<br>
                        <strong>Email:</strong> {{ Auth::user()->email }}<br>
                        <strong>Role:</strong> {{ Auth::user()->role ?? 'N/A' }}<br>
                        <strong>User ID:</strong> {{ Auth::user()->id }}
                    </div>
                @else
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <strong>❌ User is not authenticated</strong>
                    </div>
                @endauth

                <h3 class="text-lg font-semibold mb-4 mt-6">Layout Debug</h3>
                <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4">
                    <strong>✅ Layout is rendering properly</strong><br>
                    This content is showing inside the x-app-layout component.
                </div>

                <h3 class="text-lg font-semibold mb-4 mt-6">Environment Info</h3>
                <div class="bg-gray-100 border border-gray-400 text-gray-700 px-4 py-3 rounded mb-4">
                    <strong>App Name:</strong> {{ config('app.name') }}<br>
                    <strong>Environment:</strong> {{ config('app.env') }}<br>
                    <strong>Debug Mode:</strong> {{ config('app.debug') ? 'Enabled' : 'Disabled' }}<br>
                    <strong>Current Route:</strong> {{ request()->route()->getName() ?? 'No named route' }}<br>
                    <strong>Current URL:</strong> {{ request()->url() }}
                </div>

                <h3 class="text-lg font-semibold mb-4 mt-6">Quick Links</h3>
                <div class="space-x-2">
                    <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Login
                    </a>
                    <a href="{{ route('health.dashboard') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Health Dashboard
                    </a>
                    <a href="{{ route('habits.index') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                        My Habits
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
