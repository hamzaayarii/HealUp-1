<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepasIngredient extends Model
{
    use HasFactory;

    protected $table = 'repas_ingredients';

    protected $fillable = [
        'repas_id',
        'ingredient_id',
        'quantite',
        'calories_calculees'
    ];

    protected $casts = [
        'quantite' => 'float',
        'calories_calculees' => 'float'
    ];

    // Relations
    public function repas()
    {
        return $this->belongsTo(Repas::class);
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
