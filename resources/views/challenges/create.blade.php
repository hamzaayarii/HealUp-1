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
            <form action="{{ route('challenges.store') }}" method="POST" id="challengeForm">
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
                            required
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
                            required
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
                            required
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
                            min="{{ date('Y-m-d') }}"
                            required
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
                            min="{{ date('Y-m-d') }}"
                        >
                        @error('end_date') 
                            <span class="form-error">{{ $message }}</span> 
                        @enderror
                        <div class="form-helper">Automatically calculated if empty (start + duration)</div>
                    </div>
                    <div class="form-group">
                        <div class="form-checkbox-group">
                            <label class="form-switch">
                                <input 
                                    type="checkbox" 
                                    name="is_active" 
                                    value="1" 
                                    {{ old('is_active', true) ? 'checked' : '' }}
                                >
                                <span class="form-switch-slider"></span>
                            </label>
                            <label for="is_active" class="form-switch-label">
                                <strong>Activate challenge immediately</strong>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('challenges.index') }}" class="btn-form-secondary">
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
