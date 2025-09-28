<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Category: ') . $category->name }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('categories.update', $category) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name</label>
                            <input type="text" name="name" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('name', $category->name) }}" required>
                            @error('name')<span class="text-red-600 text-sm mt-1">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                            <textarea name="description" rows="3" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $category->description) }}</textarea>
                            @error('description')<span class="text-red-600 text-sm mt-1">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-6">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="is_active" value="1" class="form-checkbox" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                                <span class="ml-2 text-gray-700 dark:text-gray-300">Active</span>
                            </label>
                        </div>
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('categories.index') }}" class="bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-700 dark:text-gray-200 font-semibold py-2 px-4 rounded-lg transition duration-200">Cancel</a>
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">Update Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
