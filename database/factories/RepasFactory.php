<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Repas>
 */
class RepasFactory extends Factory
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
            'type' => $this->faker->randomElement(['breakfast', 'lunch', 'dinner']),
            'calories' => $this->faker->numberBetween(100, 1000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
