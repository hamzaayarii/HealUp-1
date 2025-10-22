<div class="p-6 space-y-4">
    <h2 class="text-xl font-bold text-gray-800">🧠 {{ $advice->title }}</h2>

    <ul class="space-y-1 text-sm text-gray-700">
        <li><strong>Source:</strong> {{ ucfirst($advice->source) }}</li>
        <li><strong>Status:</strong>
            @if($advice->is_read)
                <span class="text-green-600 font-semibold">✅ Read</span>
            @else
                <span class="text-yellow-600 font-semibold">⏳ Unread</span>
            @endif
        </li>
        <li><strong>Created At:</strong> {{ $advice->created_at->format('d/m/Y H:i') }}</li>
        <li><strong>Advisor:</strong> {{ $advice->advisor->name ?? '—' }}</li>
        <li><strong>User:</strong> {{ $advice->user->name ?? '—' }}</li>
    </ul>

    <div class="mt-4">
        <h3 class="text-lg font-semibold text-gray-800 mb-2">📝 Content</h3>
        <div class="p-4 bg-gray-50 border rounded text-gray-700 whitespace-pre-line">
            {!! nl2br(e($advice->content)) !!}
        </div>
    </div>
</div>
