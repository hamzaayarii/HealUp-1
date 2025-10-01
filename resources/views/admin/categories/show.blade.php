@extends('layouts.back')
@section('title', 'Category Details')
@section('content')
<div class="container-fluid">
    <h1>Category Details</h1>
    <div class="card">
        <div class="card-body">
            <h3>{{ $category->name }}</h3>
            <p><strong>Description:</strong> {{ $category->description }}</p>
            <p><strong>Active:</strong> {{ $category->is_active ? 'Yes' : 'No' }}</p>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back to Categories</a>
        </div>
    </div>
</div>
@endsection
