<?php

namespace Database\Seeders;

use App\Models\Habit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HabitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $habits = [
            // Physical Activity
            [
                'category_id' => 1,
                'name' => 'Daily Walk',
                'description' => 'Take a 30-minute walk every day',
                'frequency' => 'daily',
                'target_value' => 30,
                'unit' => 'minutes',
                'difficulty_level' => 'easy',
                'points_per_completion' => 10,
                'icon' => 'fas fa-walking',
                'color' => '#28a745',
            ],
            [
                'category_id' => 1,
                'name' => 'Exercise Workout',
                'description' => 'Complete a structured workout session',
                'frequency' => 'daily',
                'target_value' => 45,
                'unit' => 'minutes',
                'difficulty_level' => 'medium',
                'points_per_completion' => 20,
                'icon' => 'fas fa-dumbbell',
                'color' => '#ffc107',
            ],
            [
                'category_id' => 1,
                'name' => 'Steps Goal',
                'description' => 'Reach daily step count goal',
                'frequency' => 'daily',
                'target_value' => 10000,
                'unit' => 'steps',
                'difficulty_level' => 'medium',
                'points_per_completion' => 15,
                'icon' => 'fas fa-shoe-prints',
                'color' => '#17a2b8',
            ],

            // Nutrition
            [
                'category_id' => 2,
                'name' => 'Fruits & Vegetables',
                'description' => 'Eat 5 servings of fruits and vegetables',
                'frequency' => 'daily',
                'target_value' => 5,
                'unit' => 'servings',
                'difficulty_level' => 'easy',
                'points_per_completion' => 12,
                'icon' => 'fas fa-apple-alt',
                'color' => '#28a745',
            ],
            [
                'category_id' => 2,
                'name' => 'Healthy Breakfast',
                'description' => 'Start the day with a nutritious breakfast',
                'frequency' => 'daily',
                'target_value' => 1,
                'unit' => 'meal',
                'difficulty_level' => 'easy',
                'points_per_completion' => 8,
                'icon' => 'fas fa-coffee',
                'color' => '#fd7e14',
            ],

            // Mental Health
            [
                'category_id' => 3,
                'name' => 'Meditation',
                'description' => 'Practice mindfulness meditation',
                'frequency' => 'daily',
                'target_value' => 15,
                'unit' => 'minutes',
                'difficulty_level' => 'medium',
                'points_per_completion' => 15,
                'icon' => 'fas fa-spa',
                'color' => '#6f42c1',
            ],
            [
                'category_id' => 3,
                'name' => 'Gratitude Journal',
                'description' => 'Write down things you are grateful for',
                'frequency' => 'daily',
                'target_value' => 3,
                'unit' => 'items',
                'difficulty_level' => 'easy',
                'points_per_completion' => 10,
                'icon' => 'fas fa-book',
                'color' => '#e83e8c',
            ],

            // Sleep & Rest
            [
                'category_id' => 4,
                'name' => 'Sleep Schedule',
                'description' => 'Get 7-8 hours of quality sleep',
                'frequency' => 'daily',
                'target_value' => 8,
                'unit' => 'hours',
                'difficulty_level' => 'medium',
                'points_per_completion' => 12,
                'icon' => 'fas fa-bed',
                'color' => '#6610f2',
            ],
            [
                'category_id' => 4,
                'name' => 'No Screen Before Bed',
                'description' => 'Avoid screens 1 hour before bedtime',
                'frequency' => 'daily',
                'target_value' => 1,
                'unit' => 'hour',
                'difficulty_level' => 'hard',
                'points_per_completion' => 18,
                'icon' => 'fas fa-moon',
                'color' => '#20c997',
            ],

            // Hydration
            [
                'category_id' => 5,
                'name' => 'Water Intake',
                'description' => 'Drink adequate water throughout the day',
                'frequency' => 'daily',
                'target_value' => 8,
                'unit' => 'glasses',
                'difficulty_level' => 'easy',
                'points_per_completion' => 10,
                'icon' => 'fas fa-tint',
                'color' => '#17a2b8',
            ],

            // Social Wellness
            [
                'category_id' => 6,
                'name' => 'Connect with Friends',
                'description' => 'Spend quality time with friends or family',
                'frequency' => 'weekly',
                'target_value' => 3,
                'unit' => 'times',
                'difficulty_level' => 'medium',
                'points_per_completion' => 20,
                'icon' => 'fas fa-users',
                'color' => '#fd7e14',
            ],

            // Study Habits
            [
                'category_id' => 7,
                'name' => 'Focused Study',
                'description' => 'Dedicated study time without distractions',
                'frequency' => 'daily',
                'target_value' => 2,
                'unit' => 'hours',
                'difficulty_level' => 'hard',
                'points_per_completion' => 25,
                'icon' => 'fas fa-graduation-cap',
                'color' => '#007bff',
            ],
            [
                'category_id' => 7,
                'name' => 'Reading',
                'description' => 'Read for personal development or pleasure',
                'frequency' => 'daily',
                'target_value' => 30,
                'unit' => 'minutes',
                'difficulty_level' => 'easy',
                'points_per_completion' => 12,
                'icon' => 'fas fa-book-open',
                'color' => '#6c757d',
            ],
        ];

        foreach ($habits as $habit) {
            Habit::create($habit);
        }
    }
}
