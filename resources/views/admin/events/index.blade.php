@extends('layouts.back')
@section('title', 'Manage Events')
@section('content')
<div class="container-fluid">
    <h1>Events</h1>
    <a href="{{ route('admin.events.create') }}" class="btn btn-primary mb-3">Create Event</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Location</th>
                <th>Category</th>
                <th>Description</th>
                <th>Max Participants</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->date }}</td>
                    <td>{{ $event->location }}</td>
                    <td>{{ $event->category ? $event->category->name : '-' }}</td>
                    <td>{{ Str::limit($event->description, 50) }}</td>
                    <td>{{ $event->max_participants }}</td>
                    <td>
                        <a href="{{ route('admin.events.participants', $event->id) }}" class="btn btn-sm btn-info">Participants</a>
                        <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this event?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $events->links() }}
</div>
@endsection
