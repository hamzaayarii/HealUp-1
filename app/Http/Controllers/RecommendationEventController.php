<?php

namespace App\Http\Controllers;

use App\Models\RecommendationEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecommendationEventController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'challenge_id' => 'nullable|integer|exists:challenges,id',
            'type' => 'required|string|in:impression,click,join',
            'context' => 'nullable|array',
        ]);

        $event = RecommendationEvent::create([
            'user_id' => Auth::id(),
            'challenge_id' => $data['challenge_id'] ?? null,
            'type' => $data['type'],
            'context_json' => $data['context'] ?? null,
        ]);

        return response()->json(['success' => true, 'id' => $event->id]);
    }
}
