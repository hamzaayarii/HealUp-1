<div class="p-6 space-y-4">

    <form action="{{ route('admin.advices.update', $advice) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium mb-1">Title</label>
            <input type="text" name="title" value="{{ $advice->title }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Content</label>
            <textarea name="content" rows="5" class="w-full border rounded px-3 py-2" required>{{ $advice->content }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">For User</label>
            <select name="user_id" class="w-full border rounded px-3 py-2" required>
                @foreach(\App\Models\User::all() as $user)
                    <option value="{{ $user->id }}" {{ $advice->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Source</label>
            <select name="source" class="w-full border rounded px-3 py-2" required>
                <option value="AI" {{ $advice->source=='AI'?'selected':'' }}>AI</option>
                <option value="professor" {{ $advice->source=='professor'?'selected':'' }}>Professor</option>
                <option value="system" {{ $advice->source=='system'?'selected':'' }}>System</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Is Read</label>
            <select name="is_read" class="w-full border rounded px-3 py-2">
                <option value="0" {{ !$advice->is_read ? 'selected' : '' }}>Unread</option>
                <option value="1" {{ $advice->is_read ? 'selected' : '' }}>Read</option>
            </select>
        </div>

        <div class="flex justify-end gap-3 mt-4">
            <button type="submit" class="btn-healup text-white px-4 py-2 rounded">Update</button>
            <button type="button" onclick="closeEditModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
        </div>
    </form>
</div>
