<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\ChatSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ChatMessageController extends Controller
{
    // Store a new message
    public function store(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $session = ChatSession::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Save user message
        $userMessage = ChatMessage::create([
            'chat_session_id' => $session->id,
            'sender' => 'user',
            'content' => $request->content,
            'sent_at' => now(),
        ]);

        // Generate chatbot reply
        try {
            $response = Http::post('http://127.0.0.1:5000/predict_advice', [
                'message' => $request->content,
                'session_id' => $session->id,
            ]);

            $botContent = $response->json()['reply'] ?? "Sorry, I couldn't generate a reply.";

        } catch (\Exception $e) {
            // fallback if AI server is down
            $botContent = "🤖 Chatbot is temporarily unavailable.";
        }

        // Save bot message
        ChatMessage::create([
            'chat_session_id' => $session->id,
            'sender' => 'AI',
            'content' => $botContent,
            'sent_at' => now(),
        ]);


        return redirect()->route('chat.sessions.show', $session->id);
    }


    // Delete a message
    public function destroy($id)
    {
        // Join to chat_sessions to ensure correct ownership without using model relationship
        $message = ChatMessage::query()
            ->join('chat_sessions', 'chat_sessions.id', '=', 'chat_messages.chat_session_id')
            ->where('chat_messages.id', $id)
            ->where('chat_messages.sender', 'user')
            ->where('chat_sessions.user_id', Auth::id())
            ->select('chat_messages.*', 'chat_messages.chat_session_id')
            ->firstOrFail();

        $sessionId = $message->chat_session_id;
        ChatMessage::where('id', $message->id)->delete();

        return redirect()
            ->route('chat.sessions.show', $sessionId)
            ->with('success', 'Message deleted successfully!');
    }
}
