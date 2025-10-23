<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\ChatSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ChatMessageController extends Controller
{
    // Store user message + AI reply
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

        // Call Cohere API to generate AI reply
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer GFkaep14YavatdnDnFVj9gXdTli8OZPztjLKa8Mm',
                'Content-Type' => 'application/json',
            ])->post('https://api.cohere.ai/v2/chat', [
                'model' => 'command-xlarge-nightly',
                'messages' => [
                    ['role' => 'user', 'content' => $request->content]
                ],
                'max_tokens' => 150,
                'temperature' => 0.7,
            ]);

            $responseJson = $response->json();
            $botContent = "🤖 Sorry, no reply.";

            if (isset($responseJson['message']['content']) && is_array($responseJson['message']['content'])) {
                $botContent = collect($responseJson['message']['content'])
                    ->pluck('text')
                    ->implode("\n");
            }
        } catch (\Exception $e) {
            $botContent = "🤖 Chatbot temporarily unavailable.";
        }

        // Save AI reply
        ChatMessage::create([
            'chat_session_id' => $session->id,
            'sender' => 'AI',
            'content' => $botContent,
            'sent_at' => now(),
        ]);

        return redirect()->route('chat.sessions.show', $session->id);
    }

    // Update user message + regenerate AI reply
    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $message = ChatMessage::query()
            ->join('chat_sessions', 'chat_sessions.id', '=', 'chat_messages.chat_session_id')
            ->where('chat_messages.id', $id)
            ->where('chat_messages.sender', 'user')
            ->where('chat_sessions.user_id', Auth::id())
            ->select('chat_messages.*', 'chat_messages.chat_session_id')
            ->firstOrFail();

        $message->update(['content' => $request->content]);

        // Delete all AI messages that come after this user message
        ChatMessage::where('chat_session_id', $message->chat_session_id)
            ->where('sent_at', '>', $message->sent_at)
            ->delete();

        // Regenerate AI reply
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer GFkaep14YavatdnDnFVj9gXdTli8OZPztjLKa8Mm',
                'Content-Type' => 'application/json',
            ])->post('https://api.cohere.ai/v2/chat', [
                'model' => 'command-xlarge-nightly',
                'messages' => [
                    ['role' => 'user', 'content' => $request->content]
                ],
                'max_tokens' => 150,
                'temperature' => 0.7,
            ]);

            $responseJson = $response->json();
            $aiContent = "🤖 Sorry, no reply.";

            if (isset($responseJson['message']['content']) && is_array($responseJson['message']['content'])) {
                $aiContent = collect($responseJson['message']['content'])
                    ->pluck('text')
                    ->implode("\n");
            }
        } catch (\Exception $e) {
            $aiContent = "🤖 Chatbot temporarily unavailable.";
        }

        // Save new AI reply
        ChatMessage::create([
            'chat_session_id' => $message->chat_session_id,
            'content' => $aiContent,
            'sent_at' => now(),
        ]);

        return redirect()
            ->route('chat.sessions.show', $message->chat_session_id)
            ->with('success', 'Message updated successfully!');
    }

    // Delete user message + all AI messages after it
    public function destroy($id)
    {
        $message = ChatMessage::query()
            ->join('chat_sessions', 'chat_sessions.id', '=', 'chat_messages.chat_session_id')
            ->where('chat_messages.id', $id)
            ->where('chat_messages.sender', 'user')
            ->where('chat_sessions.user_id', Auth::id())
            ->select('chat_messages.*', 'chat_messages.chat_session_id')
            ->firstOrFail();

        $sessionId = $message->chat_session_id;

        // Delete user message
        $message->delete();

        // Delete all AI messages after this user message
        ChatMessage::where('chat_session_id', $sessionId)
            ->where('sender', 'AI')
            ->where('sent_at', '>', $message->sent_at)
            ->delete();

        return redirect()
            ->route('chat.sessions.show', $sessionId)
            ->with('success', 'Message deleted successfully!');
    }
}
