<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description', 
        'icon',
        'required_points',
        'type',
        'criteria',
        'is_active'
    ];

    protected $casts = [
        'criteria' => 'array',
        'is_active' => 'boolean',
        'required_points' => 'integer'
    ];

    // Relation avec les utilisateurs qui ont ce badge
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_badges')
                    ->withPivot('earned_at', 'progress_data')
                    ->withTimestamps();
    }

    // Scope pour les badges actifs
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Vérifier si un utilisateur a ce badge
    public function isEarnedByUser($userId)
    {
        return $this->users()->where('user_id', $userId)->exists();
    }

    // Méthode pour attribuer le badge à un utilisateur
    public function awardToUser($user, $progressData = null)
    {
        if (!$this->isEarnedByUser($user->id)) {
            $this->users()->attach($user->id, [
                'earned_at' => now(),
                'progress_data' => $progressData ? json_encode($progressData) : null
            ]);
            return true;
        }
        return false;
    }
}