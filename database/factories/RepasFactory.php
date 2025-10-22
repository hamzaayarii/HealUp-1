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
            'type_repas' => $this->faker->randomElement(['breakfast', 'lunch', 'dinner']),
            'date_consommation' => $this->faker->dateTimeThisYear(),
            'user_id' => 1,
            'calories_total' => $this->faker->numberBetween(100, 1000),
            'proteines_total' => $this->faker->numberBetween(10, 100),
            'glucides_total' => $this->faker->numberBetween(10, 100),
            'lipides_total' => $this->faker->numberBetween(5, 50),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
