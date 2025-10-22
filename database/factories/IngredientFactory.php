<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->word(),
            'categorie' => $this->faker->word(),
            'calories_pour_100g' => $this->faker->numberBetween(10, 500),
            'proteines_pour_100g' => $this->faker->numberBetween(1, 50),
        ];
    }
}
