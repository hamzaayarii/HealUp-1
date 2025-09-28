<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $event->title }}
            </h2>
            <a href="{{ route('events.index') }}"
               class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                ← Back to Events
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Date</h3>
                            <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ \Carbon\Carbon::parse($event->date)->format('l, F j, Y') }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Location</h3>
                            <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $event->location }}</p>
                        </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Category</h3>
                                <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">{{ $event->category ? $event->category->name : '-' }}</p>
                            </div>
                        <div class="md:col-span-2">
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Description</h3>
                            <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $event->description ?: 'No description provided.' }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Participants</h3>
                            <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    {{ $event->current_participants }} / {{ $event->max_participants }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="{{ route('events.edit', $event) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                            Edit Event
                        </a>
                        <form action="{{ route('events.destroy', $event) }}" method="POST" class="inline" onsubmit="return confirm('Delete this event?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                                Delete Event
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
