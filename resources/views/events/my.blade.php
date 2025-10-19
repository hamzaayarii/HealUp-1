<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Events') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <form method="GET" action="" class="mb-4 flex flex-row gap-2 items-center">
                <input type="text" name="search" value="{{ request('search', $search ?? '') }}" placeholder="Search my events..." class="border-gray-300 dark:bg-gray-700 dark:text-gray-100 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
                <select name="sort" class="bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100 rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition min-w-[140px]">
                    <option value="date" {{ (request('sort', $sort ?? 'date') == 'date') ? 'selected' : '' }}>Date</option>
                    <option value="category" {{ (request('sort', $sort ?? '') == 'category') ? 'selected' : '' }}>Category</option>
                </select>
                <select name="direction" class="bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100 rounded-lg px-4 py-2 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition min-w-[140px]">
                    <option value="asc" {{ (request('direction', $direction ?? 'asc') == 'asc') ? 'selected' : '' }}>Ascending</option>
                    <option value="desc" {{ (request('direction', $direction ?? '') == 'desc') ? 'selected' : '' }}>Descending</option>
                </select>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">Search</button>
                @if(request('search'))
                    <a href="{{ route('events.my') }}" class="ml-2 text-sm text-gray-500 dark:text-gray-300 underline">Clear</a>
                @endif
            </form>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Location</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($events as $event)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                        <a href="{{ route('events.show', $event) }}" class="text-blue-600 hover:underline dark:text-blue-400">
                                            {{ $event->title }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ \Carbon\Carbon::parse($event->date)->format('M j, Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $event->category ? $event->category->name : '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $event->location }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-2">
                                        <a href="{{ route('events.show', $event) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-1 px-3 rounded transition duration-200">View</a>
                                        <form action="{{ route('events.unregister', $event) }}" method="POST" onsubmit="return confirm('Are you sure you want to unregister from this event?');">
                                            @csrf
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-3 rounded transition duration-200">Unregister</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-8 text-gray-500 dark:text-gray-400">You are not registered for any events.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $events->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
