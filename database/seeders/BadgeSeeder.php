<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $badges = [
            [
                'name' => 'Premier Pas',
                'description' => 'Compléter votre premier défi',
                'icon' => '🚶',
                'required_points' => 0,
                'type' => 'challenge',
                'criteria' => json_encode(['challenges_completed' => 1]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Débutant Motivé',
                'description' => 'Compléter 5 défis',
                'icon' => '🔥',
                'required_points' => 50,
                'type' => 'challenge',
                'criteria' => json_encode(['challenges_completed' => 5]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Expert en Défis',
                'description' => 'Compléter 20 défis',
                'icon' => '🏆',
                'required_points' => 200,
                'type' => 'challenge',
                'criteria' => json_encode(['challenges_completed' => 20]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Streak de 7 jours',
                'description' => 'Maintenir une série de 7 jours consécutifs',
                'icon' => '⚡',
                'required_points' => 0,
                'type' => 'streak',
                'criteria' => json_encode(['streak_days' => 7]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('badges')->insert($badges);
    
    }
}
