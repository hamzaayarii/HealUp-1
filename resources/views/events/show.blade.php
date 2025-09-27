@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="bg-white shadow rounded-lg p-6 max-w-xl mx-auto">
        <h1 class="text-3xl font-bold text-green-700 mb-4">{{ $event->title }}</h1>
        <div class="mb-2 text-gray-700"><strong>Date:</strong> {{ $event->date }}</div>
        <div class="mb-2 text-gray-700"><strong>Location:</strong> {{ $event->location }}</div>
        <div class="mb-2 text-gray-700"><strong>Description:</strong> {{ $event->description }}</div>
        <div class="mb-2 text-gray-700"><strong>Participants:</strong> {{ $event->current_participants }} / {{ $event->max_participants }}</div>
        <div class="flex justify-end mt-6">
            <a href="{{ route('events.edit', $event) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded mr-2">Edit</a>
            <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('Delete this event?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">Delete</button>
            </form>
        </div>
        <div class="mt-4">
            <a href="{{ route('events.index') }}" class="text-green-700 hover:underline">&larr; Back to Events</a>
        </div>
    </div>
</div>
@endsection
