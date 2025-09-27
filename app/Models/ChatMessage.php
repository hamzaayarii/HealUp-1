<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_session_id',
        'sender',
        'content',
        'is_read',
        'sent_at'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'sent_at' => 'datetime',
    ];

    // Relationships
    public function chatSession()
    {
        return $this->belongsTo(ChatSession::class);
    }
}
