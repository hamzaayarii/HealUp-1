@extends('layouts.back')

@section('title', 'Manage Advices')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Advices</h2>
            <button type="button" class="btn btn-healup" onclick="openCreateAdviceModal()">
                <i class="fas fa-plus me-2"></i> Add Advice
            </button>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-lg shadow-sm border p-6 mb-6">
        <form method="GET" class="flex flex-col md:flex-row gap-4">
            <!-- Title -->
            <div class="flex-1">
                <label class="block text-sm font-medium mb-2">Title</label>
                <input type="text" 
                    name="title" 
                    value="{{ request('title') }}" 
                    placeholder="Search by title..."
                    class="w-full border rounded-lg px-4 py-2.5">
            </div>

            <!-- Source -->
            <div class="flex-1">
                <label class="block text-sm font-medium mb-2">Source</label>
                <input type="text" 
                    name="source" 
                    value="{{ request('source') }}" 
                    placeholder="Search by source..."
                    class="w-full border rounded-lg px-4 py-2.5">
            </div>

            <!-- User -->
            <div class="flex-1">
                <label class="block text-sm font-medium mb-2">User</label>
                <select name="user_id" class="w-full border rounded-lg px-4 py-2.5">
                    <option value="">All Users</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Status -->
            <div class="flex-1">
                <label class="block text-sm font-medium mb-2">Status</label>
                <select name="status" class="w-full border rounded-lg px-4 py-2.5">
                    <option value="">All</option>
                    <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read</option>
                    <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Unread</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="flex items-end gap-2">
                <button type="submit" class="btn btn-healup text-white px-5 py-2.5 rounded-lg">
                    Filter
                </button>
                @if(request()->anyFilled(['title', 'source', 'user_id', 'status']))
                <a href="{{ route('admin.advices.index') }}" class="bg-gray-500 text-white px-5 py-2.5 rounded-lg">
                    Clear
                </a>
                @endif
            </div>
        </form>
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
                                    <button type="button" class="btn btn-outline-primary" title="View" onclick="openAdviceDetails({{ $advice->id }})"><i class="fas fa-eye"></i></button>
                                    <button type="button" class="btn btn-outline-secondary" title="Edit" onclick="openEditModal({{ $advice->id }})"><i class="fas fa-edit"></i></button>
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

<!-- Advice Details Modal -->
<div id="adviceModal" class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm hidden z-[9999] overflow-hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 w-full max-w-2xl max-h-[85vh] overflow-hidden flex flex-col">
            <div class="flex justify-between items-center p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100" id="modalTitle">Advice Details</h3>
                <button type="button" onclick="closeAdviceModal()" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div id="adviceModalContent" class="flex-1 overflow-y-auto p-6">
                <!-- Advice content will be loaded here -->
            </div>
            <div class="p-6 border-t border-gray-200 dark:border-gray-700 flex justify-end">
                <button type="button" onclick="closeAdviceModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition-colors shadow-sm">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Create Advice Modal -->
<div id="createAdviceModal" class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm hidden z-[9999] overflow-hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 w-full max-w-2xl max-h-[85vh] overflow-y-auto flex flex-col">
            <div class="flex justify-between items-center p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">➕ Add New Advice</h3>
                <button type="button" onclick="closeCreateAdviceModal()" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div id="createAdviceModalContent" class="p-6">
                <!-- Form will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Edit Advice Modal -->
<div id="editAdviceModal" class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm hidden z-[9999] overflow-hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 w-full max-w-2xl max-h-[85vh] overflow-hidden flex flex-col">
            <div class="flex justify-between items-center p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">✏️ Edit Advice</h3>
                <button type="button" onclick="closeEditModal()" class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div id="editModalContent" class="flex-1 overflow-y-auto p-6">
                <!-- Edit form will be loaded here -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function openAdviceDetails(id) {
    const modal = document.getElementById('adviceModal');
    const body = document.body;

    // Show modal
    modal.classList.remove('hidden');
    body.style.overflow = 'hidden';

    // Loading spinner
    document.getElementById('adviceModalContent').innerHTML = `
        <div class="flex items-center justify-center py-10">
            <svg class="animate-spin h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" 
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 
                    5.291A7.962 7.962 0 014 12H0c0 
                    3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
        </div>`;

    // Fetch advice details
    fetch(`/admin/advices/${id}`)
        .then(response => {
            if (!response.ok) throw new Error('Error ' + response.status);
            return response.text();
        })
        .then(html => {
            document.getElementById('adviceModalContent').innerHTML = html;
        })
        .catch(error => {
            document.getElementById('adviceModalContent').innerHTML = `
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    Failed to load advice: ${error.message}
                </div>`;
        });
}

function closeAdviceModal() {
    const modal = document.getElementById('adviceModal');
    const body = document.body;
    modal.classList.add('hidden');
    body.style.overflow = '';
}

window.onclick = function(event) {
    const modal = document.getElementById('adviceModal');
    if (event.target === modal) closeAdviceModal();
}

function openCreateAdviceModal() {
    const modal = document.getElementById('createAdviceModal');
    const body = document.body;
    modal.classList.remove('hidden');
    body.style.overflow = 'hidden';

    // Load form via fetch (optional)
    fetch(`/admin/advices/create`)
        .then(res => res.text())
        .then(html => {
            document.getElementById('createAdviceModalContent').innerHTML = html;
        });
}

function closeCreateAdviceModal() {
    const modal = document.getElementById('createAdviceModal');
    const body = document.body;
    modal.classList.add('hidden');
    body.style.overflow = '';
}

function openEditModal(id) {
    const modal = document.getElementById('editAdviceModal');
    const body = document.body;

    // Show modal
    modal.classList.remove('hidden');
    body.style.overflow = 'hidden';

    // Loading spinner
    document.getElementById('editModalContent').innerHTML = `
        <div class="flex items-center justify-center py-10">
            <svg class="animate-spin h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" 
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 
                    5.291A7.962 7.962 0 014 12H0c0 
                    3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
        </div>`;

    // Fetch edit form via AJAX (expects JSON)
    fetch(`/admin/advices/${id}/edit`, {
    headers: { 'X-Requested-With': 'XMLHttpRequest' } // important
    })
    .then(res => res.json()) // expect JSON
    .then(data => {
        document.getElementById('editModalContent').innerHTML = data.html;
    })
    .catch(err => {
        document.getElementById('editModalContent').innerHTML = `<p>Error: ${err}</p>`;
    });
}

function closeEditModal() {
    const modal = document.getElementById('editAdviceModal');
    const body = document.body;
    modal.classList.add('hidden');
    body.style.overflow = '';
}

// Optional: close modal if click outside
window.addEventListener('click', function(event) {
    const modal = document.getElementById('editAdviceModal');
    if (event.target === modal) closeEditModal();
});
</script>
@endpush
