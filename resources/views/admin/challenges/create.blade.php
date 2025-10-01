<<<<<<< HEAD
@vite('resources/css/challenges.css')


    <div class="bg-animated"></div>
    <div class="challenge-form-container">
        <div class="form-hero">
            <h1>🚀 Create a New Challenge</h1>
            <p class="form-hero-subtitle">
                Inspire your community with a motivating challenge that will transform everyone's wellness habits.
            </p>
        </div>

        @if(session('success'))
        <div class="form-success-message">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
        @endif

        <div class="challenge-form-card">
            <form action="{{ route('admin.challenges.store') }}" method="POST" id="challengeForm">
                @csrf

                <!-- General Information -->
                <div class="form-section">
                    <h2 class="form-section-title">
                        <i class="fas fa-info-circle form-helper-icon"></i>
                        General Information
                    </h2>
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <label for="title" class="form-label form-label-required">Challenge Title</label>
                        <input 
                            type="text" 
                            id="title"
                            name="title" 
                            class="form-input" 
                            value="{{ old('title') }}" 
                            placeholder="Ex: 7-Day Hydration Challenge"
                        >
                        @error('title') 
                            <span class="form-error">{{ $message }}</span> 
                        @enderror
                    </div>
                    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                        <label for="description" class="form-label form-label-required">Challenge Description</label>
                        <textarea 
                            id="description"
                            name="description" 
                            class="form-input form-textarea"
                            placeholder="Describe your challenge in an inspiring and clear way."
                        >{{ old('description') }}</textarea>
                        @error('description') 
                            <span class="form-error">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>

                <!-- Challenge Parameters -->
                <div class="form-section">
                    <h2 class="form-section-title">
                        <i class="fas fa-target form-helper-icon"></i>
                        Challenge Parameters
                    </h2>
                    <div class="form-group {{ $errors->has('objectif') ? 'has-error' : '' }}">
                        <label for="objectif" class="form-label">Daily Goal</label>
                        <input 
                            type="number" 
                            id="objectif"
                            name="objectif" 
                            class="form-input form-input-number"
                            value="{{ old('objectif') }}"
                            placeholder="Ex: 8 (glasses of water)"
                            min="1"
                        >
                        @error('objectif') 
                            <span class="form-error">{{ $message }}</span> 
                        @enderror
                    </div>
                    <div class="form-group {{ $errors->has('duration') ? 'has-error' : '' }}">
                        <label for="duration" class="form-label form-label-required">Duration (days)</label>
                        <input 
                            type="number" 
                            id="duration"
                            name="duration" 
                            class="form-input form-input-number"
                            value="{{ old('duration', 7) }}"
                            min="1"
                            max="365"
                        >
                        @error('duration') 
                            <span class="form-error">{{ $message }}</span> 
                        @enderror
                    </div>
                    <div class="form-group {{ $errors->has('reward') ? 'has-error' : '' }}">
                        <label for="reward" class="form-label">Reward</label>
                        <input 
                            type="text" 
                            id="reward"
                            name="reward" 
                            class="form-input"
                            value="{{ old('reward') }}"
                            placeholder="Ex: Hydro-Master Badge + 100 points"
                        >
                        @error('reward') 
                            <span class="form-error">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>

                <!-- Planning -->
                <div class="form-section">
                    <h2 class="form-section-title">
                        <i class="fas fa-calendar form-helper-icon"></i>
                        Planning & Activation
                    </h2>
                    <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                        <label for="start_date" class="form-label form-label-required">Start Date</label>
                        <input 
                            type="date" 
                            id="start_date"
                            name="start_date" 
                            class="form-input"
                            value="{{ old('start_date', date('Y-m-d', strtotime('+1 day'))) }}"
                        >
                        @error('start_date') 
                            <span class="form-error">{{ $message }}</span> 
                        @enderror
                    </div>
                    <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                        <label for="end_date" class="form-label">End Date</label>
                        <input 
                            type="date" 
                            id="end_date"
                            name="end_date" 
                            class="form-input"
                            value="{{ old('end_date') }}"
                        >
                        @error('end_date') 
                            <span class="form-error">{{ $message }}</span> 
                        @enderror
                    </div>
                    
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('admin.challenges.index') }}" class="btn-form-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Cancel
                    </a>
                    <button type="submit" class="btn-form-primary" id="submitBtn">
                        <i class="fas fa-rocket"></i>
                        Create Challenge
                    </button>
                </div>
            </form>
        </div>
    </div>
=======
@extends('layouts.back')

@section('title', 'Create Challenge')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Create New Challenge</h1>
            <p class="text-muted">Design an engaging health challenge</p>
        </div>
        <a href="{{ route('admin.challenges.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Challenges
        </a>
    </div>

    <form action="{{ route('admin.challenges.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <!-- Challenge Details -->
                <div class="admin-card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-trophy me-2"></i>
                            Challenge Details
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Challenge Title *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
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
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="duration_days" class="form-label">Duration (Days) *</label>
                                <input type="number" class="form-control @error('duration_days') is-invalid @enderror"
                                       id="duration_days" name="duration_days" value="{{ old('duration_days', 30) }}"
                                       min="1" max="365" required>
                                @error('duration_days')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="points_reward" class="form-label">Points Reward *</label>
                                <input type="number" class="form-control @error('points_reward') is-invalid @enderror"
                                       id="points_reward" name="points_reward" value="{{ old('points_reward', 100) }}"
                                       min="0" required>
                                @error('points_reward')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                   {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Make this challenge active immediately
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Challenge Preview -->
                <div class="admin-card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-eye me-2"></i>
                            Preview
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="challenge-preview">
                            <h6 id="preview-title">Challenge Title</h6>
                            <p id="preview-description" class="text-muted small">Challenge description will appear here...</p>

                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <div class="text-center p-2 bg-light rounded">
                                        <div class="fw-bold text-primary" id="preview-duration">30</div>
                                        <small class="text-muted">Days</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-center p-2 bg-light rounded">
                                        <div class="fw-bold text-success" id="preview-points">100</div>
                                        <small class="text-muted">Points</small>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <span class="badge bg-success" id="preview-difficulty">Easy</span>
                                <span class="badge bg-primary" id="preview-status">Active</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tips -->
                <div class="admin-card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-lightbulb me-2"></i>
                            Tips for Great Challenges
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="small mb-0">
                            <li>Make titles clear and motivating</li>
                            <li>Provide detailed instructions</li>
                            <li>Set realistic timeframes</li>
                            <li>Balance difficulty and reward</li>
                            <li>Consider your target audience</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-end gap-2 mb-4">
            <a href="{{ route('admin.challenges.index') }}" class="btn btn-secondary">
                <i class="fas fa-times me-2"></i>Cancel
            </a>
            <button type="submit" class="btn btn-healup">
                <i class="fas fa-save me-2"></i>Create Challenge
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
// Live preview updates
document.getElementById('title').addEventListener('input', function() {
    document.getElementById('preview-title').textContent = this.value || 'Challenge Title';
});

document.getElementById('description').addEventListener('input', function() {
    document.getElementById('preview-description').textContent = this.value || 'Challenge description will appear here...';
});

document.getElementById('duration_days').addEventListener('input', function() {
    document.getElementById('preview-duration').textContent = this.value || '30';
});

document.getElementById('points_reward').addEventListener('input', function() {
    document.getElementById('preview-points').textContent = this.value || '100';
});

document.getElementById('difficulty_level').addEventListener('change', function() {
    const badge = document.getElementById('preview-difficulty');
    const value = this.value || 'easy';
    badge.textContent = value.charAt(0).toUpperCase() + value.slice(1);
    badge.className = `badge bg-${value === 'easy' ? 'success' : (value === 'medium' ? 'warning' : 'danger')}`;
});

document.getElementById('is_active').addEventListener('change', function() {
    const badge = document.getElementById('preview-status');
    badge.textContent = this.checked ? 'Active' : 'Inactive';
    badge.className = `badge bg-${this.checked ? 'primary' : 'secondary'}`;
});
</script>
@endpush
>>>>>>> 17c9ea13e911fb45dcd4cb3b2ac307ab18b58c4f
