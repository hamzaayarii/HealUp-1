<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRecommendation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'challenge_id',
        'score',
        'source',
    ];
}
