@extends('layouts.back')
@section('title', 'Event Participants')
@section('content')
<div class="container-fluid">
    <h1>Participants for: {{ $event->title }}</h1>
    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary mb-3">Back to Events</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Registered At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($participants as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->pivot->registered_at ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No participants registered for this event.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
