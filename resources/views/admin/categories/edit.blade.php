@extends('layouts.back')
@section('title', 'Edit Category')
@section('content')
<div class="container-fluid">
    <h1>Edit Category</h1>
    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}">
            @if ($errors->has('name'))
                <span style="color: red;">{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $category->description) }}</textarea>
            @if ($errors->has('description'))
                <span style="color: red;">{{ $errors->first('description') }}</span>
            @endif
        </div>
        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
            <label for="is_active" class="form-check-label">Active</label>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
