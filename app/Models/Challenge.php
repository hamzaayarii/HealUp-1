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

    // Compter les participants
    public function getParticipantsCountAttribute()
    {
        return $this->participations()->count();
    }

    // Compter les complétions
    public function getCompletedCountAttribute()
    {
        return $this->participations()->where('completed', true)->count();
    }

    // Relation avec la catégorie
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

// Ajoutez un accessor pour garantir que reward est toujours un integer
public function getRewardAttribute($value)
{
    // Convertir en integer peu importe le type d'origine
    return (int)$value;
}

// Et pour la durée aussi, au cas où
public function getDurationAttribute($value)
{
    return (int)$value;
}


}