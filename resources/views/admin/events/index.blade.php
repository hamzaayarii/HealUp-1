@extends('layouts.back')
@section('title', 'Manage Events')
@section('content')
<div class="container-fluid">
    <h1>Events</h1>
    <form method="GET" action="{{ route('admin.events.index') }}" class="mb-3 d-flex" style="gap: 10px;">
        <input type="text" name="search" class="form-control" placeholder="Search by Title" value="{{ request('search') }}" style="max-width: 300px;">
    <select name="sort" class="form-control" style="min-width: 140px;">
            <option value="date" {{ (request('sort', $sort ?? 'date') == 'date') ? 'selected' : '' }}>Date</option>
            <option value="category" {{ (request('sort', $sort ?? '') == 'category') ? 'selected' : '' }}>Category</option>
        </select>
    <select name="direction" class="form-control" style="min-width: 140px;">
            <option value="desc" {{ (request('direction', $direction ?? 'desc') == 'desc') ? 'selected' : '' }}>Descending</option>
            <option value="asc" {{ (request('direction', $direction ?? '') == 'asc') ? 'selected' : '' }}>Ascending</option>
        </select>
        <button type="submit" class="btn btn-outline-primary">Search</button>
        <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">Reset</a>
    </form>
    <a href="{{ route('admin.events.create') }}" class="btn btn-primary mb-3">Create Event</a>
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
                        <a href="{{ route('admin.events.show', $event) }}" class="btn btn-sm btn-primary">View</a>
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
