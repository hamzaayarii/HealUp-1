@extends('layouts.back')

@section('title', 'Edit Habit - ' . $habit->name)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h4 mb-0">Edit Habit</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.habits.index') }}">Habits</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.habits.show', $habit) }}">{{ Str::limit($habit->name, 30) }}</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
        <div class="btn-group">
            <a href="{{ route('admin.habits.show', $habit) }}" class="btn btn-outline-primary">
                <i class="fas fa-eye me-2"></i>View Habit
            </a>
            <a href="{{ route('admin.habits.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-list me-2"></i>All Habits
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Main Form -->
        <div class="col-md-8">
            <form action="{{ route('admin.habits.update', $habit) }}" method="POST" id="habitForm">
                @csrf
                @method('PUT')

                <div class="card shadow-sm">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-edit me-2"></i>Habit Information
                        </h6>
                    </div>
                    <div class="card-body">
                        <!-- Habit Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Habit Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name', $habit->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Habit Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="4" required>{{ old('description', $habit->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Category -->
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                                    <select class="form-select @error('category_id') is-invalid @enderror"
                                            id="category_id" name="category_id" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                    {{ old('category_id', $habit->category_id) == $category->id ? 'selected' : '' }}>
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
                                <!-- Frequency -->
                                <div class="mb-3">
                                    <label for="frequency" class="form-label">Frequency <span class="text-danger">*</span></label>
                                    <select class="form-select @error('frequency') is-invalid @enderror"
                                            id="frequency" name="frequency" required>
                                        <option value="">Select Frequency</option>
                                        <option value="daily" {{ old('frequency', $habit->frequency) == 'daily' ? 'selected' : '' }}>Daily</option>
                                        <option value="weekly" {{ old('frequency', $habit->frequency) == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                        <option value="monthly" {{ old('frequency', $habit->frequency) == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                    </select>
                                    @error('frequency')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Difficulty Level -->
                                <div class="mb-3">
                                    <label for="difficulty_level" class="form-label">Difficulty Level <span class="text-danger">*</span></label>
                                    <select class="form-select @error('difficulty_level') is-invalid @enderror"
                                            id="difficulty_level" name="difficulty_level" required>
                                        <option value="">Select Difficulty</option>
                                        <option value="easy" {{ old('difficulty_level', $habit->difficulty_level) == 'easy' ? 'selected' : '' }}>Easy</option>
                                        <option value="medium" {{ old('difficulty_level', $habit->difficulty_level) == 'medium' ? 'selected' : '' }}>Medium</option>
                                        <option value="hard" {{ old('difficulty_level', $habit->difficulty_level) == 'hard' ? 'selected' : '' }}>Hard</option>
                                    </select>
                                    @error('difficulty_level')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Points per Completion -->
                                <div class="mb-3">
                                    <label for="points_per_completion" class="form-label">Points per Completion <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('points_per_completion') is-invalid @enderror"
                                           id="points_per_completion" name="points_per_completion"
                                           value="{{ old('points_per_completion', $habit->points_per_completion) }}" min="0" required>
                                    @error('points_per_completion')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <!-- Icon -->
                                <div class="mb-3">
                                    <label for="icon" class="form-label">Icon (FontAwesome class)</label>
                                    <input type="text" class="form-control @error('icon') is-invalid @enderror"
                                           id="icon" name="icon" value="{{ old('icon', $habit->icon) }}"
                                           placeholder="e.g., fas fa-running">
                                    @error('icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Enter FontAwesome icon class (e.g., fas fa-running, fas fa-book)</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Color -->
                                <div class="mb-3">
                                    <label for="color" class="form-label">Color</label>
                                    <input type="color" class="form-control form-control-color @error('color') is-invalid @enderror"
                                           id="color" name="color" value="{{ old('color', $habit->color ?: '#6c757d') }}">
                                    @error('color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Icon Preview -->
                        <div class="mb-3" id="iconPreview" style="display: none;">
                            <label class="form-label">Icon Preview:</label>
                            <div class="p-3 border rounded bg-light text-center">
                                <i id="previewIcon" class="fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="card shadow-sm mt-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <button type="submit" class="btn btn-success me-2">
                                    <i class="fas fa-save me-2"></i>Update Habit
                                </button>
                                <a href="{{ route('admin.habits.show', $habit) }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </a>
                            </div>
                            <button type="button" class="btn btn-outline-danger" onclick="confirmDelete()">
                                <i class="fas fa-trash me-2"></i>Delete Habit
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Sidebar -->
        <div class="col-md-4">
            <!-- Usage Stats -->
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Usage Statistics
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <h5 class="text-primary mb-1">{{ $habit->userHabits->count() }}</h5>
                            <small class="text-muted">Total Users</small>
                        </div>
                        <div class="col-6">
                            <h5 class="text-success mb-1">{{ $habit->userHabits->where('is_active', true)->count() }}</h5>
                            <small class="text-muted">Active Users</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Help -->
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-question-circle me-2"></i>Help
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Frequency Guidelines:</strong>
                        <ul class="small mb-0">
                            <li><strong>Daily:</strong> For habits that should be done every day</li>
                            <li><strong>Weekly:</strong> For habits done once or few times per week</li>
                            <li><strong>Monthly:</strong> For monthly goals or reviews</li>
                        </ul>
                    </div>
                    <div class="mb-3">
                        <strong>Difficulty Guidelines:</strong>
                        <ul class="small mb-0">
                            <li><strong>Easy:</strong> Simple habits (5-10 minutes)</li>
                            <li><strong>Medium:</strong> Moderate effort (15-30 minutes)</li>
                            <li><strong>Hard:</strong> Challenging habits (30+ minutes)</li>
                        </ul>
                    </div>
                    <div>
                        <strong>Points Guidelines:</strong>
                        <ul class="small mb-0">
                            <li><strong>Easy:</strong> 5-10 points</li>
                            <li><strong>Medium:</strong> 10-25 points</li>
                            <li><strong>Hard:</strong> 25-50 points</li>
                        </ul>
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
                <h5 class="modal-title">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this habit template?</p>
                <p class="text-danger"><strong>This action cannot be undone.</strong></p>
                <p>This will affect {{ $habit->userHabits->count() }} users who have adopted this habit.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.habits.destroy', $habit) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Habit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const iconInput = document.getElementById('icon');
    const colorInput = document.getElementById('color');
    const iconPreview = document.getElementById('iconPreview');
    const previewIcon = document.getElementById('previewIcon');

    function updateIconPreview() {
        const iconClass = iconInput.value.trim();
        const color = colorInput.value;

        if (iconClass) {
            previewIcon.className = iconClass + ' fa-2x';
            previewIcon.style.color = color;
            iconPreview.style.display = 'block';
        } else {
            iconPreview.style.display = 'none';
        }
    }

    iconInput.addEventListener('input', updateIconPreview);
    colorInput.addEventListener('input', updateIconPreview);

    // Initial preview
    updateIconPreview();
});

function confirmDelete() {
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endpush
