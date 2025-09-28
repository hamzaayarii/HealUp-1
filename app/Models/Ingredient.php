<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     */
    protected $fillable = [
        'nom',
        'categorie',
        'calories_pour_100g',
        'proteines_pour_100g',
        'glucides_pour_100g',
        'lipides_pour_100g',
        'fibres_pour_100g',
        'allergenes',
        'image'
    ];

    /**
     * Les casts des attributs.
     */
    protected $casts = [
        'allergenes' => 'array',
        'calories_pour_100g' => 'float',
        'proteines_pour_100g' => 'float',
        'glucides_pour_100g' => 'float',
        'lipides_pour_100g' => 'float',
        'fibres_pour_100g' => 'float'
    ];

    /**
     * Relation avec les repas via table pivot
     */
    public function repas()
    {
        return $this->belongsToMany(Repas::class, 'repas_ingredients')
                    ->withPivot('quantite', 'calories_calculees')
                    ->withTimestamps();
    }

    /**
     * Relation directe avec la table pivot
     */
    public function repasIngredients()
    {
        return $this->hasMany(RepasIngredient::class);
    }

    /**
     * Obtenir les allergènes formatés sous forme de chaîne
     */
    public function getFormattedAllergenes()
    {
        return $this->allergenes ? implode(', ', $this->allergenes) : 'Aucun';
    }

    /**
     * Obtenir l'emoji correspondant à la catégorie
     */
    public function getCategorieEmoji()
    {
        return match($this->categorie) {
            'fruits' => '🍎',
            'legumes' => '🥕',
            'cereales' => '🌾',
            'legumineuses' => '🫘',
            'viandes' => '🥩',
            'poissons' => '🐟',
            'produits-laitiers' => '🥛',
            'oeufs' => '🥚',
            'noix-graines' => '🌰',
            'huiles-graisses' => '🫒',
            'boissons' => '🥤',
            default => '📦'
        };
    }

    /**
     * Obtenir la couleur CSS correspondant à la catégorie
     */
    public function getCategorieColor()
    {
        return match($this->categorie) {
            'fruits' => 'green',
            'legumes' => 'blue',
            'cereales' => 'yellow',
            'legumineuses' => 'purple',
            'viandes' => 'red',
            'poissons' => 'cyan',
            'produits-laitiers' => 'indigo',
            'oeufs' => 'orange',
            'noix-graines' => 'amber',
            'huiles-graisses' => 'lime',
            'boissons' => 'teal',
            default => 'gray'
        };
    }

    /**
     * Scope pour filtrer par catégorie
     */
    public function scopeByCategorie($query, $categorie)
    {
        return $query->where('categorie', $categorie);
    }

    /**
     * Scope pour rechercher par nom
     */
    public function scopeSearch($query, $term)
    {
        return $query->where('nom', 'LIKE', "%{$term}%")
                    ->orWhere('categorie', 'LIKE', "%{$term}%");
    }

    /**
     * Calculer les calories pour une quantité donnée
     */
    public function calculateCaloriesForQuantity($quantityInGrams)
    {
        return ($this->calories_pour_100g * $quantityInGrams) / 100;
    }

    /**
     * Calculer tous les macros pour une quantité donnée
     */
    public function calculateMacrosForQuantity($quantityInGrams)
    {
        $factor = $quantityInGrams / 100;
        
        return [
            'calories' => $this->calories_pour_100g * $factor,
            'proteines' => $this->proteines_pour_100g * $factor,
            'glucides' => $this->glucides_pour_100g * $factor,
            'lipides' => $this->lipides_pour_100g * $factor,
            'fibres' => ($this->fibres_pour_100g ?? 0) * $factor,
        ];
    }

    /**
     * Vérifier si l'ingrédient contient un allergène spécifique
     */
    public function hasAllergene($allergene)
    {
        return in_array($allergene, $this->allergenes ?? []);
    }

    /**
     * Obtenir tous les allergènes disponibles (static method)
     */
    public static function getAllergenesList()
    {
        return [
            'gluten' => 'Gluten',
            'lait' => 'Lait',
            'oeufs' => 'Œufs',
            'poissons' => 'Poissons',
            'crustaces' => 'Crustacés',
            'mollusques' => 'Mollusques',
            'fruits-a-coque' => 'Fruits à coque',
            'arachides' => 'Arachides',
            'soja' => 'Soja',
            'sesame' => 'Sésame',
            'sulfites' => 'Sulfites',
            'celeri' => 'Céleri'
        ];
    }

    /**
     * Obtenir toutes les catégories disponibles (static method)
     */
    public static function getCategoriesList()
    {
        return [
            'fruits' => 'Fruits',
            'legumes' => 'Légumes',
            'cereales' => 'Céréales',
            'legumineuses' => 'Légumineuses',
            'viandes' => 'Viandes',
            'poissons' => 'Poissons',
            'produits-laitiers' => 'Produits laitiers',
            'oeufs' => 'Œufs',
            'noix-graines' => 'Noix et graines',
            'huiles-graisses' => 'Huiles et graisses',
            'boissons' => 'Boissons',
            'autres' => 'Autres'
        ];
    }
}
