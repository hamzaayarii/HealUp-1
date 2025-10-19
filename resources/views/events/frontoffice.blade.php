<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Wellness Events') }}
        </h2>
    </x-slot>

    <div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="GET" action="" class="mb-4 flex flex-row gap-2 items-center">
            <input type="text" name="search" value="{{ request('search', $search ?? '') }}" placeholder="Search events..." class="border-gray-300 dark:bg-gray-700 dark:text-gray-100 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">
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
                <a href="{{ route('events.frontoffice') }}" class="ml-2 text-sm text-gray-500 dark:text-gray-300 underline">Clear</a>
            @endif
        </form>
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Location</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider w-64">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($events as $event)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                        <a href="{{ route('events.show', $event) }}" class="text-blue-600 hover:underline dark:text-blue-400">
                                            {{ $event->title }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ \Carbon\Carbon::parse($event->date)->format('M j, Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $event->category ? $event->category->name : '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $event->location }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex flex-row gap-2 items-center">
                                            @php
                                                $alreadyRegistered = $event->users->contains(auth()->id());
                                            @endphp
                                            @if($alreadyRegistered)
                                                <button class="bg-gray-400 text-white font-semibold py-1 px-3 rounded cursor-not-allowed" disabled>Already Registered</button>
                                            @else
                                                <form action="{{ route('events.register', $event) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-1 px-3 rounded transition duration-200">Register</button>
                                                </form>
                                            @endif
                                            @if(auth()->user()->isProfessor())
                                                <a href="{{ route('events.participants', $event) }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-1 px-3 rounded transition duration-200">View Participants</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if($events->isEmpty())
                        <div class="text-center py-8">
                            <div class="text-gray-500 dark:text-gray-400">
                                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No events</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">No wellness events are currently available.</p>
                            </div>
                        </div>
                    @endif
                    <div class="mt-4">
                        {{ $events->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
