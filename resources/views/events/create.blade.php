@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold text-green-700 mb-6">Create Wellness Event</h1>
    <div class="bg-white shadow rounded-lg p-6 max-w-lg mx-auto">
        <form action="{{ route('events.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Title</label>
                <input type="text" name="title" class="w-full border rounded px-3 py-2" value="{{ old('title') }}" required>
                @error('title')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Date</label>
                <input type="date" name="date" class="w-full border rounded px-3 py-2" value="{{ old('date') }}" required>
                @error('date')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Location</label>
                <input type="text" name="location" class="w-full border rounded px-3 py-2" value="{{ old('location') }}" required>
                @error('location')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Description</label>
                <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
                @error('description')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Max Participants</label>
                <input type="number" name="max_participants" class="w-full border rounded px-3 py-2" value="{{ old('max_participants') }}" min="1" required>
                @error('max_participants')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
            <div class="flex justify-end">
                <a href="{{ route('events.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded mr-2">Cancel</a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">Create</button>
            </div>
        </form>
    </div>
</div>
@endsection
