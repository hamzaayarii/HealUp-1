<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Repas;
use App\Models\Ingredient;
use App\Services\AIRepasService;
use App\Services\AIAnalysisService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NutritionAITest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function it_can_search_repas_by_name()
    {
        $this->actingAs($this->user);

        Repas::factory()->create([
            'nom' => 'Salade de poulet',
            'user_id' => $this->user->id
        ]);

        Repas::factory()->create([
            'nom' => 'Steak frites',
            'user_id' => $this->user->id
        ]);

        $response = $this->get('/repas?search=poulet');

        $response->assertStatus(200);
        $response->assertSee('Salade de poulet');
        $response->assertDontSee('Steak frites');
    }

    /** @test */
    public function it_can_filter_repas_by_type()
    {
        $this->actingAs($this->user);

        Repas::factory()->create([
            'nom' => 'Petit déjeuner',
            'type_repas' => 'petit-dejeuner',
            'user_id' => $this->user->id
        ]);

        Repas::factory()->create([
            'nom' => 'Déjeuner',
            'type_repas' => 'dejeuner',
            'user_id' => $this->user->id
        ]);

        $response = $this->get('/repas?type_repas=petit-dejeuner');

        $response->assertStatus(200);
        $response->assertSee('Petit déjeuner');
        $response->assertDontSee('Déjeuner');
    }

    /** @test */
    public function it_can_filter_repas_by_calories()
    {
        $this->actingAs($this->user);

        Repas::factory()->create([
            'nom' => 'Repas léger',
            'calories_total' => 300,
            'user_id' => $this->user->id
        ]);

        Repas::factory()->create([
            'nom' => 'Repas copieux',
            'calories_total' => 800,
            'user_id' => $this->user->id
        ]);

        $response = $this->get('/repas?min_calories=500');

        $response->assertStatus(200);
        $response->assertSee('Repas copieux');
        $response->assertDontSee('Repas léger');
    }

    /** @test */
    public function it_can_search_ingredients_by_name()
    {
        $this->actingAs($this->user);

        Ingredient::factory()->create(['nom' => 'Poulet']);
        Ingredient::factory()->create(['nom' => 'Boeuf']);

        $response = $this->get('/ingredients?search=poulet');

        $response->assertStatus(200);
        $response->assertSee('Poulet');
        $response->assertDontSee('Boeuf');
    }

    /** @test */
    public function it_can_filter_ingredients_by_category()
    {
        $this->actingAs($this->user);

        Ingredient::factory()->create([
            'nom' => 'Pomme',
            'categorie' => 'fruits'
        ]);

        Ingredient::factory()->create([
            'nom' => 'Carotte',
            'categorie' => 'legumes'
        ]);

        $response = $this->get('/ingredients?categorie=fruits');

        $response->assertStatus(200);
        $response->assertSee('Pomme');
        $response->assertDontSee('Carotte');
    }

    /** @test */
    public function it_can_get_ai_suggestions()
    {
        $this->actingAs($this->user);

        $response = $this->postJson('/repas/ai/suggestions', [
            'objectif_calories' => 2000,
            'objectif_proteines' => 100,
            'restrictions' => []
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'suggestions'
        ]);
    }

    /** @test */
    public function it_can_analyze_nutritional_balance()
    {
        $this->actingAs($this->user);

        // Créer quelques repas pour l'analyse
        Repas::factory()->count(5)->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->postJson('/repas/ai/analyze-balance', [
            'periode' => 7
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'analysis'
        ]);
    }

    /** @test */
    public function it_can_detect_deficiencies()
    {
        $this->actingAs($this->user);

        Repas::factory()->count(3)->create([
            'user_id' => $this->user->id,
            'proteines_total' => 20 // Faible en protéines
        ]);

        $response = $this->postJson('/repas/ai/detect-deficiencies', [
            'periode' => 14
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data' => [
                'deficiencies',
                'recommendations'
            ]
        ]);
    }

    /** @test */
    public function it_can_generate_nutrition_report()
    {
        $this->actingAs($this->user);

        Repas::factory()->count(10)->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->postJson('/repas/ai/nutrition-report', [
            'periode' => 30
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'report' => [
                'stats',
                'trends',
                'top_ingredients',
                'meal_distribution'
            ]
        ]);
    }

    /** @test */
    public function it_can_analyze_meal_quality()
    {
        $this->actingAs($this->user);

        $repas = Repas::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->getJson("/repas/{$repas->id}/analyze-quality");

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'quality' => [
                'scores',
                'ai_evaluation'
            ]
        ]);
    }

    /** @test */
    public function it_can_get_ingredient_alternatives()
    {
        $this->actingAs($this->user);

        $ingredient = Ingredient::factory()->create([
            'nom' => 'Poulet',
            'categorie' => 'viandes',
            'calories_pour_100g' => 165
        ]);

        // Créer des alternatives similaires
        Ingredient::factory()->create([
            'nom' => 'Dinde',
            'categorie' => 'viandes',
            'calories_pour_100g' => 135
        ]);

        $response = $this->getJson("/ingredients/{$ingredient->id}/alternatives");

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'ingredient',
            'alternatives',
            'ai_analysis'
        ]);
    }

    /** @test */
    public function it_can_get_ingredient_stats()
    {
        $this->actingAs($this->user);

        $ingredient = Ingredient::factory()->create();

        $response = $this->getJson("/ingredients/{$ingredient->id}/stats");

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'stats' => [
                'total_utilisations',
                'quantite_moyenne',
                'calories_moyennes'
            ]
        ]);
    }

    /** @test */
    public function ai_service_works_without_api_key()
    {
        config(['services.openai.key' => '']); // Pas de clé API

        $service = new AIRepasService();
        $suggestions = $service->getSuggestions($this->user, [
            'objectif_calories' => 2000
        ]);

        $this->assertNotEmpty($suggestions);
        $this->assertIsArray($suggestions);
    }

    /** @test */
    public function analysis_service_calculates_scores_correctly()
    {
        $service = new AIAnalysisService();
        
        $repas = Repas::factory()->create([
            'user_id' => $this->user->id,
            'calories_total' => 500,
            'proteines_total' => 30,
            'glucides_total' => 50,
            'lipides_total' => 15
        ]);

        $quality = $service->analyzeMealQuality($repas);

        $this->assertArrayHasKey('scores', $quality);
        $this->assertArrayHasKey('global', $quality['scores']);
        $this->assertGreaterThanOrEqual(0, $quality['scores']['global']);
        $this->assertLessThanOrEqual(100, $quality['scores']['global']);
    }

    /** @test */
    public function it_validates_optimize_repas_input()
    {
        $this->actingAs($this->user);

        $repas = Repas::factory()->create([
            'user_id' => $this->user->id
        ]);

        $response = $this->postJson("/repas/{$repas->id}/optimize", [
            'calories' => 'invalid' // Should be numeric
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['calories']);
    }

    /** @test */
    public function it_validates_predict_goals_input()
    {
        $this->actingAs($this->user);

        $response = $this->postJson('/repas/ai/predict-goals', [
            'calories' => -100 // Should be positive
        ]);

        $response->assertStatus(422);
    }
}
