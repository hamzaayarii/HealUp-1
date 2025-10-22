@extends('layouts.back')

@section('title', 'Create Habit Template')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Create Habit Template</h1>
            <p class="text-muted">Design a new habit for users to track</p>
        </div>
        <a href="{{ route('admin.habits.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Habits
        </a>
    </div>

    <form action="{{ route('admin.habits.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <!-- Habit Details -->
                <div class="admin-card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-calendar-check me-2"></i>
                            Habit Details
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Habit Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description *</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label">Category *</label>
                                <select class="form-select @error('category_id') is-invalid @enderror"
                                        id="category_id" name="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="frequency" class="form-label">Frequency *</label>
                                <select class="form-select @error('frequency') is-invalid @enderror"
                                        id="frequency" name="frequency" required>
                                    <option value="">Select Frequency</option>
                                    <option value="daily" {{ old('frequency') === 'daily' ? 'selected' : '' }}>Daily</option>
                                    <option value="weekly" {{ old('frequency') === 'weekly' ? 'selected' : '' }}>Weekly</option>
                                    <option value="monthly" {{ old('frequency') === 'monthly' ? 'selected' : '' }}>Monthly</option>
                                </select>
                                @error('frequency')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="difficulty_level" class="form-label">Difficulty Level *</label>
                                <select class="form-select @error('difficulty_level') is-invalid @enderror"
                                        id="difficulty_level" name="difficulty_level" required>
                                    <option value="">Select Difficulty</option>
                                    <option value="easy" {{ old('difficulty_level') === 'easy' ? 'selected' : '' }}>Easy</option>
                                    <option value="medium" {{ old('difficulty_level') === 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="hard" {{ old('difficulty_level') === 'hard' ? 'selected' : '' }}>Hard</option>
                                </select>
                                @error('difficulty_level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="points_per_completion" class="form-label">Points per Completion *</label>
                                <input type="number" class="form-control @error('points_per_completion') is-invalid @enderror"
                                       id="points_per_completion" name="points_per_completion" value="{{ old('points_per_completion', 10) }}"
                                       min="0" required>
                                @error('points_per_completion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="icon" class="form-label">Icon (FontAwesome class)</label>
                                <input type="text" class="form-control @error('icon') is-invalid @enderror"
                                       id="icon" name="icon" value="{{ old('icon', 'fas fa-star') }}"
                                       placeholder="fas fa-star">
                                @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Use FontAwesome classes like "fas fa-star"</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="color" class="form-label">Color</label>
                                <input type="color" class="form-control form-control-color @error('color') is-invalid @enderror"
                                       id="color" name="color" value="{{ old('color', '#10B981') }}">
                                @error('color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Habit Preview -->
                <div class="admin-card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-eye me-2"></i>
                            Preview
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="habit-preview">
                            <div class="d-flex align-items-center mb-3">
                                <i id="preview-icon" class="fas fa-star me-2" style="color: #10B981;"></i>
                                <div>
                                    <h6 id="preview-name" class="mb-0">Habit Name</h6>
                                    <small class="text-muted" id="preview-category">Category</small>
                                </div>
                            </div>

                            <p id="preview-description" class="text-muted small">Habit description will appear here...</p>

                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <div class="text-center p-2 bg-light rounded">
                                        <div class="fw-bold text-primary" id="preview-frequency">Daily</div>
                                        <small class="text-muted">Frequency</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center p-2 bg-light rounded">
                                        <div class="fw-bold text-success" id="preview-points">10</div>
                                        <small class="text-muted">Points</small>
                                    </div>
                                </div>
                            </div>

                            <span class="badge bg-success" id="preview-difficulty">Easy</span>
                        </div>
                    </div>
                </div>

                <!-- Common Icons -->
                <div class="admin-card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-icons me-2"></i>
                            Common Icons
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-4 text-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary w-100" onclick="setIcon('fas fa-running')">
                                    <i class="fas fa-running"></i>
                                </button>
                                <small class="d-block text-muted">Running</small>
                            </div>
                            <div class="col-4 text-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary w-100" onclick="setIcon('fas fa-dumbbell')">
                                    <i class="fas fa-dumbbell"></i>
                                </button>
                                <small class="d-block text-muted">Exercise</small>
                            </div>
                            <div class="col-4 text-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary w-100" onclick="setIcon('fas fa-apple-alt')">
                                    <i class="fas fa-apple-alt"></i>
                                </button>
                                <small class="d-block text-muted">Nutrition</small>
                            </div>
                            <div class="col-4 text-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary w-100" onclick="setIcon('fas fa-bed')">
                                    <i class="fas fa-bed"></i>
                                </button>
                                <small class="d-block text-muted">Sleep</small>
                            </div>
                            <div class="col-4 text-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary w-100" onclick="setIcon('fas fa-book')">
                                    <i class="fas fa-book"></i>
                                </button>
                                <small class="d-block text-muted">Reading</small>
                            </div>
                            <div class="col-4 text-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary w-100" onclick="setIcon('fas fa-medkit')">
                                    <i class="fas fa-medkit"></i>
                                </button>
                                <small class="d-block text-muted">Health</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-end gap-2 mb-4">
            <a href="{{ route('admin.habits.index') }}" class="btn btn-secondary">
                <i class="fas fa-times me-2"></i>Cancel
            </a>
            <button type="submit" class="btn btn-healup">
                <i class="fas fa-save me-2"></i>Create Habit
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function setIcon(iconClass) {
    document.getElementById('icon').value = iconClass;
    updatePreviewIcon();
}

function updatePreviewIcon() {
    const icon = document.getElementById('icon').value || 'fas fa-star';
    const previewIcon = document.getElementById('preview-icon');
    previewIcon.className = icon + ' me-2';
}

// Live preview updates
document.getElementById('name').addEventListener('input', function() {
    document.getElementById('preview-name').textContent = this.value || 'Habit Name';
});

document.getElementById('description').addEventListener('input', function() {
    document.getElementById('preview-description').textContent = this.value || 'Habit description will appear here...';
});

document.getElementById('frequency').addEventListener('change', function() {
    document.getElementById('preview-frequency').textContent = this.value ? this.value.charAt(0).toUpperCase() + this.value.slice(1) : 'Daily';
});

document.getElementById('points_per_completion').addEventListener('input', function() {
    document.getElementById('preview-points').textContent = this.value || '10';
});

document.getElementById('difficulty_level').addEventListener('change', function() {
    const badge = document.getElementById('preview-difficulty');
    const value = this.value || 'easy';
    badge.textContent = value.charAt(0).toUpperCase() + value.slice(1);
    badge.className = `badge bg-${value === 'easy' ? 'success' : (value === 'medium' ? 'warning' : 'danger')}`;
});

document.getElementById('icon').addEventListener('input', updatePreviewIcon);

document.getElementById('color').addEventListener('input', function() {
    document.getElementById('preview-icon').style.color = this.value;
});

document.getElementById('category_id').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    document.getElementById('preview-category').textContent = selectedOption.text !== 'Select Category' ? selectedOption.text : 'Category';
});
</script>
@endpush
