<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Physical Activity',
                'description' => 'Exercise, sports, and physical movement habits',
                'icon' => 'dumbbell',
                'color' => '#10b981'
            ],
            [
                'name' => 'Nutrition',
                'description' => 'Healthy eating and dietary habits',
                'icon' => 'apple',
                'color' => '#f59e0b'
            ],
            [
                'name' => 'Mental Health',
                'description' => 'Meditation, mindfulness, and mental wellness',
                'icon' => 'brain',
                'color' => '#8b5cf6'
            ],
            [
                'name' => 'Sleep & Rest',
                'description' => 'Sleep quality and rest habits',
                'icon' => 'moon',
                'color' => '#3b82f6'
            ],
            [
                'name' => 'Hydration',
                'description' => 'Water intake and hydration habits',
                'icon' => 'droplet',
                'color' => '#06b6d4'
            ],
            [
                'name' => 'Social Wellness',
                'description' => 'Social connections and community activities',
                'icon' => 'users',
                'color' => '#ef4444'
            ],
            [
                'name' => 'Study Habits',
                'description' => 'Learning and academic wellness practices',
                'icon' => 'book',
                'color' => '#84cc16'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
