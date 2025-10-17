<?php

namespace App\Services;

use App\Models\Repas;
use App\Models\Ingredient;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIRepasService
{
    protected $pythonApiUrl;

    public function __construct()
    {
        // Utiliser le serveur Python local au lieu d'OpenAI
        $this->pythonApiUrl = env('PYTHON_AI_URL', 'http://localhost:5000');
    }

    /**
     * Générer des suggestions de repas basées sur le profil utilisateur
     */
    public function getSuggestions(User $user, array $preferences = [])
    {
        $objetifCalories = $preferences['objectif_calories'] ?? 2000;
        $objetifProteines = $preferences['objectif_proteines'] ?? 100;
        $restrictions = $preferences['restrictions'] ?? [];
        
        // Récupérer l'historique des repas de l'utilisateur
        $repasPrecedents = Repas::where('user_id', $user->id)
            ->with('repasIngredients.ingredient')
            ->latest()
            ->take(5)
            ->get();

        // Préparer les données pour le serveur Python
        $data = [
            'objectif_calories' => $objetifCalories,
            'objectif_proteines' => $objetifProteines,
            'nombre_repas' => 3, // Par défaut 3 repas par jour
            'restrictions' => $restrictions
        ];

        // Appeler le serveur Python AI pour générer un plan
        $response = $this->callPythonAI('/generate/meal-plan', $data);

        return $response;
    }

    /**
     * Suggérer des ingrédients alternatifs
     */
    public function suggestAlternativeIngredients(Ingredient $ingredient, array $criteria = [])
    {
        // Préparer les données pour le serveur Python
        $data = [
            'nom' => $ingredient->nom,
            'categorie' => $ingredient->categorie,
            'calories_pour_100g' => $ingredient->calories_pour_100g,
            'proteines_pour_100g' => $ingredient->proteines_pour_100g,
            'glucides_pour_100g' => $ingredient->glucides_pour_100g,
            'lipides_pour_100g' => $ingredient->lipides_pour_100g
        ];

        // Appeler le serveur Python AI
        $aiResponse = $this->callPythonAI('/suggest/alternatives', $data);

        // Récupérer aussi les alternatives de la base de données
        $categorie = $ingredient->categorie;
        $caloriesSimilaires = $criteria['calories_similar'] ?? true;
        $proteinesSimilaires = $criteria['proteines_similar'] ?? false;

        $query = Ingredient::where('categorie', $categorie)
            ->where('id', '!=', $ingredient->id);

        if ($caloriesSimilaires) {
            $tolerance = 50; // ±50 calories
            $query->whereBetween('calories_pour_100g', [
                $ingredient->calories_pour_100g - $tolerance,
                $ingredient->calories_pour_100g + $tolerance
            ]);
        }

        if ($proteinesSimilaires) {
            $tolerance = 5; // ±5g de protéines
            $query->whereBetween('proteines_pour_100g', [
                $ingredient->proteines_pour_100g - $tolerance,
                $ingredient->proteines_pour_100g + $tolerance
            ]);
        }

        $alternatives = $query->take(5)->get();

        return [
            'alternatives' => $alternatives,
            'ai_analysis' => [
                'message' => $aiResponse['data']['message'] ?? 'Alternatives basées sur la catégorie et les valeurs nutritionnelles similaires',
                'recommendations' => $aiResponse['data']['recommendations'] ?? [],
                'similarity_score' => $aiResponse['data']['similarity_score'] ?? 0
            ],
            'success' => $aiResponse['success'] ?? true
        ];
    }

    /**
     * Générer un plan de repas pour une semaine
     */
    public function generateWeeklyMealPlan(User $user, array $preferences = [])
    {
        $objetifCaloriesJour = $preferences['objectif_calories'] ?? 2000;
        $nombreRepas = $preferences['nombre_repas'] ?? 7;
        
        // Préparer les données pour le serveur Python
        $data = [
            'objectif_calories' => $objetifCaloriesJour,
            'nombre_repas' => $nombreRepas
        ];
        
        // Appeler le serveur Python AI
        $weeklyPlan = $this->callPythonAI('/generate/meal-plan', $data);

        return $weeklyPlan;
    }

    /**
     * Optimiser un repas pour atteindre des objectifs nutritionnels
     */
    public function optimizeRepas(Repas $repas, array $targets = [])
    {
        $currentNutrition = [
            'calories' => $repas->calories_total,
            'proteines' => $repas->proteines_total,
            'glucides' => $repas->glucides_total,
            'lipides' => $repas->lipides_total
        ];

        $ingredients = $repas->repasIngredients->map(function($ri) {
            return [
                'nom' => $ri->ingredient->nom,
                'quantite' => $ri->quantite,
                'calories' => $ri->calories_calculees,
                'proteines' => $ri->proteines_calculees
            ];
        })->toArray();

        // Préparer les données pour le serveur Python
        $data = [
            'meal' => $currentNutrition,
            'criteria' => $targets
        ];
        
        // Appeler le serveur Python AI
        $optimizations = $this->callPythonAI('/optimize/meal', $data);

        return $optimizations;
    }

    /**
     * Construire le prompt pour les suggestions
     */
    protected function buildPromptForSuggestions($user, $calories, $proteines, $restrictions, $historique)
    {
        $historyText = $historique->map(fn($r) => "- {$r->nom} ({$r->calories_total} kcal)")->join("\n");
        $restrictionsText = empty($restrictions) ? "Aucune" : implode(', ', $restrictions);

        return "En tant que nutritionniste expert, suggère 3 idées de repas équilibrés pour un utilisateur avec les critères suivants:
        
Objectif calorique: {$calories} kcal/jour
Objectif protéines: {$proteines}g/jour
Restrictions alimentaires: {$restrictionsText}

Historique récent:
{$historyText}

Pour chaque suggestion, fournis:
1. Le nom du repas
2. Les ingrédients avec quantités
3. Les valeurs nutritionnelles totales
4. Une brève explication des bénéfices

Format de réponse: JSON avec structure {\"suggestions\": [{\"nom\": \"\", \"ingredients\": [], \"nutrition\": {}, \"benefices\": \"\"}]}";
    }

    /**
     * Construire le prompt pour les alternatives
     */
    protected function buildPromptForAlternatives($ingredient, $alternatives)
    {
        $ingredientInfo = "{$ingredient->nom} ({$ingredient->calories_pour_100g} kcal, {$ingredient->proteines_pour_100g}g protéines)";
        $alternativesText = $alternatives->map(fn($alt) => "- {$alt->nom} ({$alt->calories_pour_100g} kcal, {$alt->proteines_pour_100g}g protéines)")->join("\n");

        return "Compare l'ingrédient original avec les alternatives et recommande la meilleure option:

Ingrédient original: {$ingredientInfo}

Alternatives disponibles:
{$alternativesText}

Fournis une analyse comparative et recommande la meilleure alternative selon le contexte (santé, calories, protéines).
Format JSON: {\"recommendation\": \"\", \"raison\": \"\", \"comparaison\": []}";
    }

    /**
     * Construire le prompt pour le plan hebdomadaire
     */
    protected function buildPromptForWeeklyPlan($user, $calories, $nombreRepas, $restrictions)
    {
        $restrictionsText = empty($restrictions) ? "Aucune" : implode(', ', $restrictions);

        return "Crée un plan de repas pour 7 jours avec {$nombreRepas} repas par jour.

Critères:
- Objectif: {$calories} kcal/jour
- Restrictions: {$restrictionsText}
- Variété et équilibre nutritionnel

Pour chaque jour, fournis le petit-déjeuner, déjeuner, dîner avec ingrédients et valeurs nutritionnelles.
Format JSON: {\"semaine\": [{\"jour\": 1, \"repas\": []}]}";
    }

    /**
     * Construire le prompt pour l'optimisation
     */
    protected function buildPromptForOptimization($current, $targets, $ingredients)
    {
        $currentText = json_encode($current, JSON_PRETTY_PRINT);
        $targetsText = json_encode($targets, JSON_PRETTY_PRINT);
        $ingredientsText = json_encode($ingredients, JSON_PRETTY_PRINT);

        return "Optimise ce repas pour atteindre les objectifs nutritionnels:

Nutrition actuelle:
{$currentText}

Objectifs:
{$targetsText}

Ingrédients actuels:
{$ingredientsText}

Suggère des ajustements (quantités ou substitutions) pour atteindre les objectifs.
Format JSON: {\"ajustements\": [], \"nouvelles_valeurs\": {}}";
    }

    /**
     * Appeler le serveur Python AI local
     */
    protected function callPythonAI($endpoint, $data)
    {
        try {
            $response = Http::timeout(30)->post("{$this->pythonApiUrl}{$endpoint}", $data);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('Python AI Error', ['response' => $response->body()]);
            return $this->getFallbackResponse($endpoint);

        } catch (\Exception $e) {
            Log::error('Python AI Exception', ['error' => $e->getMessage()]);
            return $this->getFallbackResponse($endpoint);
        }
    }

    /**
     * Réponse de secours si le serveur Python est inaccessible
     */
    protected function getFallbackResponse($endpoint)
    {
        return [
            'success' => false,
            'message' => 'Le serveur AI Python est temporairement indisponible. Assurez-vous qu\'il est démarré.',
            'fallback' => true
        ];
    }
}
