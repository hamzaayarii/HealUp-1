@extends('layouts.back')

@section('title', 'View Advice')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2 class="mb-0">View Advice</h2>
            <a href="{{ route('admin.advices.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Back to Advices
            </a>
        </div>
    </div>

    <div class="admin-card">
        <div class="card-body">
            <h4 class="mb-3">{{ $advice->title }}</h4>
            <p><strong>Source:</strong> {{ ucfirst($advice->source) }}</p>
            <p><strong>Content:</strong></p>
            <div class="p-3 bg-light border rounded mb-3">
                {!! nl2br(e($advice->content)) !!}
            </div>
            <p><strong>Status:</strong> 
                @if($advice->is_read)
                    <span class="status-badge status-active">Read</span>
                @else
                    <span class="status-badge status-pending">Unread</span>
                @endif
            </p>
            <p><strong>Created At:</strong> {{ $advice->created_at->format('M d, Y H:i') }}</p>
            <p><strong>Advisor:</strong> {{ $advice->advisor ? $advice->advisor->name : '-' }}</p>
            <p><strong>User:</strong> {{ $advice->user ? $advice->user->name : '-' }}</p>
        </div>
    </div>
</div>
@endsection
