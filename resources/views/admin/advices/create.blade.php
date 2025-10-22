<div class="p-6 space-y-4">

    <form action="{{ route('admin.advices.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Title</label>
            <input type="text" name="title" class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Content</label>
            <textarea name="content" rows="5" class="w-full border rounded px-3 py-2" required></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">For User</label>
            <select name="user_id" class="w-full border rounded px-3 py-2" required>
                @foreach(\App\Models\User::all() as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Source</label>
            <select name="source" class="w-full border rounded px-3 py-2" required>
                <option value="AI">AI</option>
                <option value="professor">Professor</option>
                <option value="system">System</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Is Read</label>
            <select name="is_read" class="w-full border rounded px-3 py-2">
                <option value="0">Unread</option>
                <option value="1">Read</option>
            </select>
        </div>

        <div class="flex justify-end gap-3 mt-4">
            <button type="submit" class="btn-healup text-white px-4 py-2 rounded">Save</button>
            <button type="button" onclick="closeCreateAdviceModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
        </div>
    </form>
</div>

