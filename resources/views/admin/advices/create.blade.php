<div class="p-6 space-y-4">
    <form action="{{ route('admin.advices.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Title -->
        <div>
            <label class="block text-sm font-medium mb-1">Title</label>
            <input 
                type="text" 
                name="title" 
                value="{{ old('title') }}" 
                class="w-full border rounded px-3 py-2 {{ $errors->has('title') ? 'border-red-500' : '' }}" 
            >
            @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Content -->
        <div>
            <label class="block text-sm font-medium mb-1">Content</label>
            <textarea 
                name="content" 
                rows="5" 
                class="w-full border rounded px-3 py-2 {{ $errors->has('content') ? 'border-red-500' : '' }}" 
            >{{ old('content') }}</textarea>
            @error('content')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- For User -->
        <div>
            <label class="block text-sm font-medium mb-1">For User</label>
            <select 
                name="user_id" 
                class="w-full border rounded px-3 py-2 {{ $errors->has('user_id') ? 'border-red-500' : '' }}" 
            >
                @foreach(\App\Models\User::all() as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Source -->
        <div>
            <label class="block text-sm font-medium mb-1">Source</label>
            <select 
                name="source" 
                class="w-full border rounded px-3 py-2 {{ $errors->has('source') ? 'border-red-500' : '' }}" 
            >
                <option value="AI" {{ old('source') == 'AI' ? 'selected' : '' }}>AI</option>
                <option value="professor" {{ old('source') == 'professor' ? 'selected' : '' }}>Professor</option>
                <option value="system" {{ old('source') == 'system' ? 'selected' : '' }}>System</option>
            </select>
            @error('source')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Is Read -->
        <div>
            <label class="block text-sm font-medium mb-1">Is Read</label>
            <select name="is_read" class="w-full border rounded px-3 py-2">
                <option value="0" {{ old('is_read') == 0 ? 'selected' : '' }}>Unread</option>
                <option value="1" {{ old('is_read') == 1 ? 'selected' : '' }}>Read</option>
            </select>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-3 mt-4">
            <button type="submit" class="btn-healup text-white px-4 py-2 rounded">Save</button>
            <button type="button" onclick="closeCreateAdviceModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
        </div>
    </form>
</div>
