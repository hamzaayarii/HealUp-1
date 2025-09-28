@extends('layouts.back')

@section('title', 'Edit Challenge - ' . $challenge->title)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h4 mb-0">Edit Challenge</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.challenges.index') }}">Challenges</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.challenges.show', $challenge) }}">{{ Str::limit($challenge->title, 30) }}</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
        <div class="btn-group">
            <a href="{{ route('admin.challenges.show', $challenge) }}" class="btn btn-outline-primary">
                <i class="fas fa-eye me-2"></i>View Challenge
            </a>
            <a href="{{ route('admin.challenges.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-list me-2"></i>All Challenges
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Main Form -->
        <div class="col-md-8">
            <form action="{{ route('admin.challenges.update', $challenge) }}" method="POST" id="challengeForm">
                @csrf
                @method('PUT')

                <div class="card shadow-sm">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-edit me-2"></i>Challenge Information
                        </h6>
                    </div>
                    <div class="card-body">
                        <!-- Challenge Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Challenge Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   id="title" name="title" value="{{ old('title', $challenge->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Challenge Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="4" required>{{ old('description', $challenge->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Category and Duration -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select class="form-select @error('category_id') is-invalid @enderror"
                                            id="category_id" name="category_id">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                    {{ old('category_id', $challenge->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="duration_days" class="form-label">Duration (Days) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('duration_days') is-invalid @enderror"
                                           id="duration_days" name="duration_days" min="1" max="365"
                                           value="{{ old('duration_days', $challenge->duration_days) }}" required>
                                    @error('duration_days')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Difficulty and Points -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="difficulty_level" class="form-label">Difficulty Level <span class="text-danger">*</span></label>
                                    <select class="form-select @error('difficulty_level') is-invalid @enderror"
                                            id="difficulty_level" name="difficulty_level" required>
                                        <option value="">Select Difficulty</option>
                                        <option value="easy" {{ old('difficulty_level', $challenge->difficulty_level) == 'easy' ? 'selected' : '' }}>
                                            🟢 Easy
                                        </option>
                                        <option value="medium" {{ old('difficulty_level', $challenge->difficulty_level) == 'medium' ? 'selected' : '' }}>
                                            🟡 Medium
                                        </option>
                                        <option value="hard" {{ old('difficulty_level', $challenge->difficulty_level) == 'hard' ? 'selected' : '' }}>
                                            🔴 Hard
                                        </option>
                                    </select>
                                    @error('difficulty_level')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="points_reward" class="form-label">Points Reward <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('points_reward') is-invalid @enderror"
                                           id="points_reward" name="points_reward" min="0" max="1000"
                                           value="{{ old('points_reward', $challenge->points_reward) }}" required>
                                    @error('points_reward')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                       {{ old('is_active', $challenge->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active Challenge
                                </label>
                            </div>
                            <small class="text-muted">Only active challenges can be joined by users</small>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between">
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Update Challenge
                                </button>
                                <a href="{{ route('admin.challenges.show', $challenge) }}" class="btn btn-outline-secondary ms-2">
                                    Cancel
                                </a>
                            </div>
                            <button type="button" class="btn btn-outline-danger" onclick="confirmDelete()">
                                <i class="fas fa-trash me-2"></i>Delete Challenge
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Live Preview -->
        <div class="col-md-4">
            <div class="sticky-top" style="top: 20px;">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-eye me-2"></i>Live Preview
                        </h6>
                    </div>
                    <div class="card-body">
                        <div id="preview-card" class="border rounded p-3">
                            <div class="challenge-preview">
                                <h6 id="preview-title" class="card-title">{{ $challenge->title }}</h6>
                                <p id="preview-description" class="card-text text-muted small">{{ Str::limit($challenge->description, 100) }}</p>

                                <div class="challenge-meta mt-3">
                                    <div class="row text-center">
                                        <div class="col-4">
                                            <div class="meta-item">
                                                <i class="fas fa-calendar-alt text-primary"></i>
                                                <div id="preview-duration" class="small fw-bold">{{ $challenge->duration_days }}d</div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="meta-item">
                                                <div id="preview-difficulty" class="small fw-bold">
                                                    @switch($challenge->difficulty_level)
                                                        @case('easy') 🟢 @break
                                                        @case('medium') 🟡 @break
                                                        @case('hard') 🔴 @break
                                                    @endswitch
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="meta-item">
                                                <i class="fas fa-star text-warning"></i>
                                                <div id="preview-points" class="small fw-bold">{{ $challenge->points_reward }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <span id="preview-status" class="badge {{ $challenge->is_active ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $challenge->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                    <span id="preview-category" class="badge bg-primary ms-2">
                                        {{ $challenge->category ? $challenge->category->name : 'No Category' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Current Stats -->
                <div class="card shadow-sm mt-3">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-chart-line me-2"></i>Current Stats
                        </h6>
                    </div>
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-6">
                                <div class="stats-item">
                                    <div class="stats-number text-primary">{{ $challenge->participations->count() }}</div>
                                    <div class="stats-label text-muted">Participants</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stats-item">
                                    <div class="stats-number text-success">{{ $challenge->participations->where('completed', true)->count() }}</div>
                                    <div class="stats-label text-muted">Completed</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Challenge</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this challenge? This action cannot be undone.</p>
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    This will also remove all {{ $challenge->participations->count() }} associated participations.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.challenges.destroy', $challenge) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Challenge</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Live preview updates
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('title');
    const descriptionInput = document.getElementById('description');
    const durationInput = document.getElementById('duration_days');
    const difficultySelect = document.getElementById('difficulty_level');
    const pointsInput = document.getElementById('points_reward');
    const statusCheckbox = document.getElementById('is_active');
    const categorySelect = document.getElementById('category_id');

    function updatePreview() {
        // Update title
        document.getElementById('preview-title').textContent = titleInput.value || 'Challenge Title';

        // Update description
        const description = descriptionInput.value || 'Challenge description...';
        document.getElementById('preview-description').textContent = description.length > 100 ? description.substring(0, 100) + '...' : description;

        // Update duration
        document.getElementById('preview-duration').textContent = (durationInput.value || '0') + 'd';

        // Update difficulty
        const difficulty = difficultySelect.value;
        let difficultyIcon = '⚪';
        switch(difficulty) {
            case 'easy': difficultyIcon = '🟢'; break;
            case 'medium': difficultyIcon = '🟡'; break;
            case 'hard': difficultyIcon = '🔴'; break;
        }
        document.getElementById('preview-difficulty').textContent = difficultyIcon;

        // Update points
        document.getElementById('preview-points').textContent = pointsInput.value || '0';

        // Update status
        const statusBadge = document.getElementById('preview-status');
        if (statusCheckbox.checked) {
            statusBadge.textContent = 'Active';
            statusBadge.className = 'badge bg-success';
        } else {
            statusBadge.textContent = 'Inactive';
            statusBadge.className = 'badge bg-secondary';
        }

        // Update category
        const categoryText = categorySelect.options[categorySelect.selectedIndex].text;
        document.getElementById('preview-category').textContent = categoryText === 'Select Category' ? 'No Category' : categoryText;
    }

    // Add event listeners
    titleInput.addEventListener('input', updatePreview);
    descriptionInput.addEventListener('input', updatePreview);
    durationInput.addEventListener('input', updatePreview);
    difficultySelect.addEventListener('change', updatePreview);
    pointsInput.addEventListener('input', updatePreview);
    statusCheckbox.addEventListener('change', updatePreview);
    categorySelect.addEventListener('change', updatePreview);
});

function confirmDelete() {
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>

<style>
.stats-item {
    padding: 10px 0;
}

.stats-number {
    font-size: 1.2rem;
    font-weight: bold;
    line-height: 1;
}

.stats-label {
    font-size: 0.75rem;
    margin-top: 5px;
}

.meta-item {
    padding: 5px 0;
}

.challenge-preview {
    min-height: 200px;
}

.sticky-top {
    z-index: 1020;
}
</style>
@endsection
