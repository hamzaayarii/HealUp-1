@extends('layouts.back')
@section('title', 'Event Details')
@section('content')
<div class="container-fluid">
    <h1>Event Details</h1>
    <div class="card">
        <div class="card-body">
            <h3>{{ $event->title }}</h3>
            <p><strong>Date:</strong> {{ $event->date }}</p>
            <p><strong>Location:</strong> {{ $event->location }}</p>
            <p><strong>Category:</strong> {{ $event->category ? $event->category->name : '-' }}</p>
            <p><strong>Description:</strong> {{ $event->description }}</p>
            <p><strong>Max Participants:</strong> {{ $event->max_participants }}</p>
            <a href="{{ route('admin.events.participants', $event->id) }}" class="btn btn-primary mb-2">View Participants</a>
            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Back to Events</a>
        </div>
    </div>
</div>
@endsection
