@extends('layouts.back')

@section('title', 'Edit Advice')

@section('content')
<div class="container-fluid">
    <div class="admin-card">
        <div class="card-body">
            <h4 class="mb-4">Edit Advice</h4>

            <form action="{{ route('admin.advices.update', $advice) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $advice->title }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Content</label>
                    <textarea name="content" rows="5" class="form-control" required>{{ $advice->content }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">For User</label>
                    <select name="user_id" class="form-select" required>
                        @foreach(\App\Models\User::all() as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Source</label>
                    <select name="source" class="form-select" required>
                        <option value="AI">AI</option>
                        <option value="professor">Professor</option>
                        <option value="system">System</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Is Read</label>
                    <select name="is_read" class="form-select">
                        <option value="0">Unread</option>
                        <option value="1">Read</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="new" {{ $advice->status=='new'?'selected':'' }}>New</option>
                        <option value="seen" {{ $advice->status=='seen'?'selected':'' }}>Seen</option>
                        <option value="archived" {{ $advice->status=='archived'?'selected':'' }}>Archived</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-healup">Update</button>
                <a href="{{ route('admin.advices.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
