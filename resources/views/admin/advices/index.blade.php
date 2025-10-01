@extends('layouts.back')

@section('title', 'Manage Advices')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Advices</h2>
            <a href="{{ route('admin.advices.create') }}" class="btn btn-healup">
                <i class="fas fa-plus me-2"></i> Add Advice
            </a>
        </div>
    </div>

    <div class="admin-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Source</th>
                            <th>Read</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($advices as $advice)
                        <tr>
                            <td>{{ $advice->title }}</td>
                            <td>{{ ucfirst($advice->source) }}</td>
                            <td>
                                @if($advice->is_read)
                                    <span class="status-badge status-active">Read</span>
                                @else
                                    <span class="status-badge status-pending">Unread</span>
                                @endif
                            </td>
                            <td>{{ $advice->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.advices.show', $advice) }}" class="btn btn-outline-primary" title="View"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.advices.edit', $advice) }}" class="btn btn-outline-secondary" title="Edit"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.advices.destroy', $advice) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger" onclick="return confirm('Delete this advice?')" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <i class="fas fa-lightbulb fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No advices found</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $advices->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
