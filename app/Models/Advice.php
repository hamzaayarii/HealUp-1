<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advice extends Model
{
    use HasFactory;

    protected $table = 'advices';

    protected $fillable = [
        'user_id',
        'advisor_id',
        'title',
        'content',
        'source',
        'is_read'
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function advisor()
    {
        return $this->belongsTo(User::class, 'advisor_id');
    }

    public function chatSessions()
    {
        return $this->hasMany(ChatSession::class);
    }
}
