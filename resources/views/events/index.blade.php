@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-green-700">Wellness Events</h1>
        <a href="{{ route('events.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">Create Event</a>
    </div>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    <div class="bg-white shadow rounded-lg p-6">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="py-2 px-4 text-left">Title</th>
                    <th class="py-2 px-4 text-left">Date</th>
                    <th class="py-2 px-4 text-left">Location</th>
                    <th class="py-2 px-4 text-left">Participants</th>
                    <th class="py-2 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr class="border-b">
                    <td class="py-2 px-4 text-left">{{ $event->title }}</td>
                    <td class="py-2 px-4 text-left">{{ $event->date }}</td>
                    <td class="py-2 px-4 text-left">{{ $event->location }}</td>
                    <td class="py-2 px-4 text-left">{{ $event->current_participants }}/{{ $event->max_participants }}</td>
                    <td class="py-2 px-4 flex gap-2">
                        <a href="{{ route('events.show', $event) }}" class="text-blue-600 hover:underline">View</a>
                        <a href="{{ route('events.edit', $event) }}" class="text-yellow-600 hover:underline">Edit</a>
                        <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('Delete this event?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $events->links() }}
        </div>
    </div>
</div>
@endsection
