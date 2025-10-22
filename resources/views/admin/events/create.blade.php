@extends('layouts.back')
@section('title', 'Create Event')
@section('content')
<div class="container-fluid">
    <h1>Create Event</h1>
    <form action="{{ route('admin.events.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
            @if ($errors->has('title'))
                <span style="color: red;">{{ $errors->first('title') }}</span>
            @endif
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}">
            @if ($errors->has('date'))
                <span style="color: red;">{{ $errors->first('date') }}</span>
            @endif
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}">
            @if ($errors->has('location'))
                <span style="color: red;">{{ $errors->first('location') }}</span>
            @endif
        </div>
        <div class="mb-3">
            <label for="max_participants" class="form-label">Max Participants</label>
            <input type="number" name="max_participants" id="max_participants" class="form-control" min="1" value="{{ old('max_participants') }}">
            @if ($errors->has('max_participants'))
                <span style="color: red;">{{ $errors->first('max_participants') }}</span>
            @endif
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            @if ($errors->has('description'))
                <span style="color: red;">{{ $errors->first('description') }}</span>
            @endif
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id" class="form-control">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('category_id'))
                <span style="color: red;">{{ $errors->first('category_id') }}</span>
            @endif
            </select>
        </div>
        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
