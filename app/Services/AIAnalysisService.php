<?php

namespace App\Services;

use App\Models\User;
use App\Models\Repas;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AIAnalysisService
{
    protected $pythonApiUrl;

    public function __construct()
    {
        // Utiliser le serveur Python local au lieu d'OpenAI
        $this->pythonApiUrl = env('PYTHON_AI_URL', 'http://localhost:5000');
    }

    /**
     * Analyser l'équilibre nutritionnel d'un utilisateur sur une période
     */
    public function analyzeNutritionalBalance(User $user, $periode = 7)
    {
        $dateDebut = Carbon::now()->subDays($periode);
        
        $repas = Repas::where('user_id', $user->id)
            ->where('date_consommation', '>=', $dateDebut)
            ->with('repasIngredients.ingredient')
            ->get();

        if ($repas->isEmpty()) {
            return [
                'status' => 'insufficient_data',
                'message' => 'Pas assez de données pour analyse',
                'recommendations' => []
            ];
        }

        // Calculer les statistiques
        $stats = $this->calculateNutritionStats($repas);
        
        // Préparer les données pour le serveur Python
        $mealsData = $repas->map(function($repas) {
            return [
                'calories' => $repas->calories_total,
                'proteines' => $repas->proteines_total,
                'glucides' => $repas->glucides_total,
                'lipides' => $repas->lipides_total,
                'date' => $repas->date_consommation
            ];
        })->toArray();

        $data = [
            'meals' => $mealsData
        ];
        
        // Analyser avec le serveur Python AI
        $analysis = $this->callPythonAI('/analyze/weekly', $data);

        return array_merge($stats, [
            'ai_analysis' => $analysis['data'] ?? [],
            'periode' => $periode
        ]);
    }

    /**
     * Détecter les carences nutritionnelles potentielles
     */
    public function detectDeficiencies(User $user, $periode = 14)
    {
        $dateDebut = Carbon::now()->subDays($periode);
        
        $repas = Repas::where('user_id', $user->id)
            ->where('date_consommation', '>=', $dateDebut)
            ->with('repasIngredients.ingredient')
            ->get();

        $stats = $this->calculateNutritionStats($repas);
        
        // Préparer les données pour le serveur Python
        $data = [
            'nutrition_stats' => $stats['moyennes'] ?? [],
            'period_days' => $periode
        ];

        // Appeler le serveur Python AI
        $deficienciesResult = $this->callPythonAI('/detect/deficiencies', $data);

        return [
            'deficiencies' => $deficienciesResult['data']['carences_detectees'] ?? [],
            'recommendations' => $deficienciesResult['data']['recommendations'] ?? [],
            'stats' => $stats,
            'periode' => $periode
        ];
    }

    /**
     * Générer un rapport nutritionnel personnalisé
     */
    public function generateNutritionReport(User $user, $periode = 30)
    {
        $dateDebut = Carbon::now()->subDays($periode);
        
        $repas = Repas::where('user_id', $user->id)
            ->where('date_consommation', '>=', $dateDebut)
            ->with('repasIngredients.ingredient')
            ->orderBy('date_consommation', 'desc')
            ->get();

        $stats = $this->calculateNutritionStats($repas);
        $trends = $this->calculateTrends($repas);
        $topIngredients = $this->getTopIngredients($repas);
        $mealDistribution = $this->getMealTypeDistribution($repas);

        $prompt = $this->buildPromptForNutritionReport($stats, $trends, $topIngredients, $mealDistribution);
        $aiInsights = $this->callAI($prompt);

        return [
            'periode' => $periode,
            'stats' => $stats,
            'trends' => $trends,
            'top_ingredients' => $topIngredients,
            'meal_distribution' => $mealDistribution,
            'ai_insights' => $aiInsights,
            'generated_at' => Carbon::now()
        ];
    }

    /**
     * Prédire l'atteinte des objectifs nutritionnels
     */
    public function predictGoalAchievement(User $user, array $goals)
    {
        $repas = Repas::where('user_id', $user->id)
            ->where('date_consommation', '>=', Carbon::now()->subDays(30))
            ->get();

        $stats = $this->calculateNutritionStats($repas);
        
        $predictions = [];
        foreach ($goals as $nutrient => $targetValue) {
            $currentAvg = $stats['moyennes'][$nutrient] ?? 0;
            $progress = ($currentAvg / $targetValue) * 100;
            
            $predictions[$nutrient] = [
                'current_average' => round($currentAvg, 1),
                'target' => $targetValue,
                'progress_percentage' => round($progress, 1),
                'status' => $this->getGoalStatus($progress),
                'days_to_goal' => $this->estimateDaysToGoal($currentAvg, $targetValue)
            ];
        }

        $prompt = $this->buildPromptForGoalPrediction($predictions, $stats);
        $aiGuidance = $this->callAI($prompt);

        return [
            'predictions' => $predictions,
            'ai_guidance' => $aiGuidance
        ];
    }

    /**
     * Analyser la qualité des repas
     */
    public function analyzeMealQuality(Repas $repas)
    {
        $ingredients = $repas->repasIngredients->map(function($ri) {
            return [
                'nom' => $ri->ingredient->nom,
                'categorie' => $ri->ingredient->categorie,
                'quantite' => $ri->quantite
            ];
        })->toArray();

        $nutrition = [
            'calories' => $repas->calories_total,
            'proteines' => $repas->proteines_total,
            'glucides' => $repas->glucides_total,
            'lipides' => $repas->lipides_total
        ];

        // Calcul de scores locaux
        $scores = [
            'variete' => $this->calculateVarietyScore(collect($ingredients)),
            'equilibre' => $this->calculateBalanceScore($nutrition),
            'qualite_ingredients' => $this->calculateIngredientQualityScore(collect($ingredients))
        ];

        $scores['global'] = round(array_sum($scores) / count($scores), 1);

        // Préparer les données pour le serveur Python
        $data = [
            'calories' => $repas->calories_total,
            'proteines' => $repas->proteines_total,
            'glucides' => $repas->glucides_total,
            'lipides' => $repas->lipides_total
        ];

        // Analyser avec le serveur Python AI
        $aiEvaluation = $this->callPythonAI('/analyze/meal', $data);

        return [
            'scores' => $scores,
            'ingredients_count' => count($ingredients),
            'nutrition' => $nutrition,
            'ai_evaluation' => $aiEvaluation['data'] ?? []
        ];
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
            'message' => 'Le serveur AI Python est temporairement indisponible. Assurez-vous qu\'il est démarré sur le port 5000.',
            'fallback' => true
        ];
    }

    /**
     * Calculer les statistiques nutritionnelles
     */
    protected function calculateNutritionStats($repas)
    {
        if ($repas->isEmpty()) {
            return [
                'total_repas' => 0,
                'moyennes' => [],
                'totaux' => []
            ];
        }

        $totaux = [
            'calories' => $repas->sum('calories_total'),
            'proteines' => $repas->sum('proteines_total'),
            'glucides' => $repas->sum('glucides_total'),
            'lipides' => $repas->sum('lipides_total')
        ];

        $count = $repas->count();
        $moyennes = array_map(fn($val) => round($val / $count, 1), $totaux);

        return [
            'total_repas' => $count,
            'moyennes' => $moyennes,
            'totaux' => $totaux,
            'moyenne_par_jour' => round($count / max(1, $repas->unique('date_consommation')->count()), 1)
        ];
    }

    /**
     * Calculer les tendances
     */
    protected function calculateTrends($repas)
    {
        $grouped = $repas->groupBy(function($r) {
            return Carbon::parse($r->date_consommation)->format('Y-m-d');
        });

        $daily = $grouped->map(function($dayRepas) {
            return [
                'calories' => $dayRepas->sum('calories_total'),
                'proteines' => $dayRepas->sum('proteines_total')
            ];
        })->values();

        if ($daily->count() < 2) {
            return ['trend' => 'stable'];
        }

        $recent = $daily->slice(-7)->avg(fn($d) => $d['calories']);
        $previous = $daily->slice(-14, 7)->avg(fn($d) => $d['calories']);

        $change = $recent - $previous;
        $changePercent = $previous > 0 ? ($change / $previous) * 100 : 0;

        return [
            'calories_trend' => $change > 0 ? 'increasing' : ($change < 0 ? 'decreasing' : 'stable'),
            'change_percentage' => round($changePercent, 1),
            'recent_average' => round($recent, 1),
            'previous_average' => round($previous, 1)
        ];
    }

    /**
     * Obtenir les ingrédients les plus utilisés
     */
    protected function getTopIngredients($repas, $limit = 10)
    {
        $ingredientCounts = [];
        
        foreach ($repas as $r) {
            foreach ($r->repasIngredients as $ri) {
                $nom = $ri->ingredient->nom;
                if (!isset($ingredientCounts[$nom])) {
                    $ingredientCounts[$nom] = 0;
                }
                $ingredientCounts[$nom]++;
            }
        }

        arsort($ingredientCounts);
        return array_slice($ingredientCounts, 0, $limit, true);
    }

    /**
     * Obtenir la distribution des types de repas
     */
    protected function getMealTypeDistribution($repas)
    {
        return $repas->groupBy('type_repas')->map->count()->toArray();
    }

    /**
     * Calculer le score de variété
     */
    protected function calculateVarietyScore($ingredients)
    {
        $categories = $ingredients->pluck('categorie')->unique()->count();
        return min(100, $categories * 12); // Max 100 pour 8+ catégories
    }

    /**
     * Calculer le score d'équilibre
     */
    protected function calculateBalanceScore($nutrition)
    {
        $total = $nutrition['proteines'] * 4 + $nutrition['glucides'] * 4 + $nutrition['lipides'] * 9;
        if ($total == 0) return 0;

        $protPercent = ($nutrition['proteines'] * 4 / $total) * 100;
        $carbPercent = ($nutrition['glucides'] * 4 / $total) * 100;
        $fatPercent = ($nutrition['lipides'] * 9 / $total) * 100;

        // Idéal: 15-25% protéines, 45-65% glucides, 20-35% lipides
        $protScore = 100 - abs($protPercent - 20) * 3;
        $carbScore = 100 - abs($carbPercent - 55) * 2;
        $fatScore = 100 - abs($fatPercent - 25) * 3;

        return round(max(0, ($protScore + $carbScore + $fatScore) / 3), 1);
    }

    /**
     * Calculer le score de qualité des ingrédients
     */
    protected function calculateIngredientQualityScore($ingredients)
    {
        $healthyCategories = ['fruits', 'legumes', 'cereales', 'poissons', 'noix-graines', 'legumineuses'];
        $healthyCount = $ingredients->filter(fn($i) => in_array($i['categorie'], $healthyCategories))->count();
        
        $total = $ingredients->count();
        return $total > 0 ? round(($healthyCount / $total) * 100, 1) : 0;
    }

    /**
     * Obtenir la sévérité d'une carence
     */
    protected function getDeficiencySeverity($percentage)
    {
        if ($percentage < 30) return 'severe';
        if ($percentage < 50) return 'moderate';
        if ($percentage < 70) return 'mild';
        return 'normal';
    }

    /**
     * Obtenir le statut d'un objectif
     */
    protected function getGoalStatus($progress)
    {
        if ($progress >= 95) return 'achieved';
        if ($progress >= 75) return 'on_track';
        if ($progress >= 50) return 'needs_improvement';
        return 'off_track';
    }

    /**
     * Estimer les jours pour atteindre l'objectif
     */
    protected function estimateDaysToGoal($current, $target)
    {
        if ($current >= $target) return 0;
        if ($current == 0) return null;
        
        $gap = $target - $current;
        $improvementRate = 0.02; // 2% d'amélioration par jour
        
        return round($gap / ($current * $improvementRate));
    }

    /**
     * Construire les prompts pour l'IA
     */
    protected function buildPromptForNutritionalAnalysis($stats, $periode)
    {
        $statsJson = json_encode($stats, JSON_PRETTY_PRINT);
        return "Analyse ces statistiques nutritionnelles sur {$periode} jours et fournis des insights:\n\n{$statsJson}\n\nFormat JSON: {\"analyse\": \"\", \"points_forts\": [], \"points_amelioration\": [], \"conseils\": []}";
    }

    protected function buildPromptForDeficiencies($deficiencies, $stats)
    {
        $defJson = json_encode($deficiencies, JSON_PRETTY_PRINT);
        return "Carences détectées:\n{$defJson}\n\nSuggère des aliments spécifiques pour combler ces carences. Format JSON: {\"aliments_recommandes\": [], \"plan_action\": \"\"}";
    }

    protected function buildPromptForNutritionReport($stats, $trends, $topIngredients, $mealDist)
    {
        $data = json_encode(compact('stats', 'trends', 'topIngredients', 'mealDist'), JSON_PRETTY_PRINT);
        return "Génère un rapport nutritionnel complet basé sur ces données:\n{$data}\n\nFormat JSON: {\"resume\": \"\", \"tendances\": \"\", \"recommandations\": []}";
    }

    protected function buildPromptForGoalPrediction($predictions, $stats)
    {
        $predJson = json_encode($predictions, JSON_PRETTY_PRINT);
        return "Prédictions d'objectifs:\n{$predJson}\n\nFournis des conseils pour atteindre ces objectifs. Format JSON: {\"strategie\": \"\", \"actions_prioritaires\": []}";
    }

    protected function buildPromptForMealQuality($nom, $ingredients, $nutrition, $scores)
    {
        $data = json_encode(compact('nom', 'ingredients', 'nutrition', 'scores'), JSON_PRETTY_PRINT);
        return "Évalue la qualité de ce repas:\n{$data}\n\nFormat JSON: {\"evaluation\": \"\", \"ameliorations\": [], \"note_globale\": \"\"}";
    }

    /**
     * Appeler l'API IA
     */
    protected function callAI($prompt)
    {
        try {
            if (empty($this->apiKey)) {
                return $this->getMockAnalysis($prompt);
            }

            $response = Http::withHeaders([
                'Authorization' => "Bearer {$this->apiKey}",
                'Content-Type' => 'application/json',
            ])->timeout(30)->post($this->apiUrl, [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'Tu es un nutritionniste expert en analyse de données alimentaires.'],
                    ['role' => 'user', 'content' => $prompt]
                ],
                'temperature' => 0.7,
                'max_tokens' => 1000
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $content = $data['choices'][0]['message']['content'] ?? '';
                $decoded = json_decode($content, true);
                return $decoded ?? ['response' => $content];
            }

            return $this->getMockAnalysis($prompt);

        } catch (\Exception $e) {
            Log::error('AI Analysis Exception', ['error' => $e->getMessage()]);
            return $this->getMockAnalysis($prompt);
        }
    }

    /**
     * Analyse mock pour démo
     */
    protected function getMockAnalysis($prompt)
    {
        if (str_contains($prompt, 'Carences')) {
            return [
                'aliments_recommandes' => ['Épinards', 'Lentilles', 'Saumon', 'Amandes'],
                'plan_action' => 'Augmentez progressivement votre consommation de protéines et fibres'
            ];
        }

        return [
            'analyse' => 'Analyse en mode démo. Configurez OPENAI_API_KEY pour analyses IA complètes.',
            'conseils' => ['Variez vos sources de protéines', 'Augmentez la consommation de légumes']
        ];
    }
}
