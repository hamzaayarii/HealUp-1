<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'objectif',
        'duration',
        'reward',
        'start_date',
        'end_date',
        'status',           
        'created_by',       
        'rejection_reason'  
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Relationships

    // Relation avec l'utilisateur qui a créé le défi
    public function creator(): BelongsTo
    {
    return $this->belongsTo(User::class, 'created_by')->withDefault([
        'name' => 'Utilisateur inconnu',
        'email' => 'n/a@example.com'
    ]); }

    public function users()
    {
        return $this->belongsToMany(User::class, 'participations')
            ->withPivot('joined_at', 'current_progress', 'completed', 'completed_at', 'points_earned')
            ->withTimestamps();
    }

    public function participations()
    {
        return $this->hasMany(Participation::class);
    }

    // AJOUTEZ CETTE MÉTHODE POUR COMPTER LES PARTICIPANTS
    public function getParticipantsCountAttribute()
    {
        return $this->participations()->count();
    }

    // AJOUTEZ CETTE MÉTHODE POUR COMPTER LES COMPLÉTIONS
    public function getCompletedCountAttribute()
    {
        return $this->participations()->where('completed', true)->count();
    }
}
