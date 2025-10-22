@extends('layouts.back')

@section('title', 'Challenge Management')

@section('content')
    <!-- Challenge Create Form -->
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 theme-transition">
        
        <!-- Main Content -->
        <div class="py-8">
            <div class="max-w-4xl mx-auto px-6 lg:px-8">
                
                <!-- Header Section -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                        Create a New Challenge
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400">
                        Inspire your community with a motivating challenge that will transform everyone's wellness habits.
                    </p>
                </div>

                <!-- Success Message -->
                @if(session('success'))
                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700 text-green-700 dark:text-green-300 px-4 py-3 rounded-lg mb-6 flex items-center shadow-sm theme-transition">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
                @endif

                <!-- Form Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 theme-transition">
                    <form action="{{ route('admin.challenges.store') }}" method="POST" id="challengeForm" class="p-6">
                        @csrf

                        <!-- General Information -->
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                General Information
                            </h2>
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Challenge Title <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        id="title"
                                        name="title" 
                                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2.5 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all theme-transition {{ $errors->has('title') ? 'border-red-500 dark:border-red-500' : '' }}"
                                        value="{{ old('title') }}" 
                                        placeholder="Ex: 7-Day Hydration Challenge"
                                    >
                                    @error('title') 
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Challenge Description <span class="text-red-500">*</span>
                                    </label>
                                    <textarea 
                                        id="description"
                                        name="description" 
                                        rows="4"
                                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2.5 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all theme-transition {{ $errors->has('description') ? 'border-red-500 dark:border-red-500' : '' }}"
                                        placeholder="Describe your challenge in an inspiring and clear way."
                                    >{{ old('description') }}</textarea>
                                    @error('description') 
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Challenge Parameters -->
                        <div class="mb-8 pt-8 border-t border-gray-200 dark:border-gray-700">
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                                Challenge Parameters
                            </h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="objectif" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Daily Goal
                                    </label>
                                    <input 
                                        type="number" 
                                        id="objectif"
                                        name="objectif" 
                                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2.5 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all theme-transition {{ $errors->has('objectif') ? 'border-red-500 dark:border-red-500' : '' }}"
                                        value="{{ old('objectif') }}"
                                        placeholder="Ex: 8 (glasses of water)"
                                        min="1"
                                    >
                                    @error('objectif') 
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="duration" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Duration (days) <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="number" 
                                        id="duration"
                                        name="duration" 
                                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2.5 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all theme-transition {{ $errors->has('duration') ? 'border-red-500 dark:border-red-500' : '' }}"
                                        value="{{ old('duration', 7) }}"
                                        min="1"
                                        max="365"
                                    >
                                    @error('duration') 
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label for="reward" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Reward
                                    </label>
                                    <input 
                                        type="text" 
                                        id="reward"
                                        name="reward" 
                                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2.5 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all theme-transition {{ $errors->has('reward') ? 'border-red-500 dark:border-red-500' : '' }}"
                                        value="{{ old('reward') }}"
                                        placeholder="Ex: Hydro-Master Badge + 100 points"
                                    >
                                    @error('reward') 
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Planning & Activation -->
                        <div class="mb-8 pt-8 border-t border-gray-200 dark:border-gray-700">
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                                Planning & Activation
                            </h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Start Date <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="date" 
                                        id="start_date"
                                        name="start_date" 
                                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2.5 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all theme-transition {{ $errors->has('start_date') ? 'border-red-500 dark:border-red-500' : '' }}"
                                        value="{{ old('start_date', date('Y-m-d', strtotime('+1 day'))) }}"
                                    >
                                    @error('start_date') 
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        End Date
                                    </label>
                                    <input 
                                        type="date" 
                                        id="end_date"
                                        name="end_date" 
                                        class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2.5 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all theme-transition {{ $errors->has('end_date') ? 'border-red-500 dark:border-red-500' : '' }}"
                                        value="{{ old('end_date') }}"
                                    >
                                    @error('end_date') 
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('admin.challenges.index') }}" class="flex-1 sm:flex-initial inline-flex items-center justify-center bg-gray-500 hover:bg-gray-600 text-white px-6 py-2.5 rounded-lg font-medium transition-colors shadow-sm">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Cancel
                            </a>
                            <button type="submit" class="flex-1 inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg font-medium transition-colors shadow-sm" id="submitBtn">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Create Challenge
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection