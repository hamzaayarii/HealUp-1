<?php

namespace Database\Seeders;

use App\Models\Challenge;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChallengeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first admin or professor user to assign as creator
        $creator = User::whereIn('role', ['admin', 'professor'])->first();
        
        // If no admin or professor exists, get any user or create a default one
        if (!$creator) {
            $creator = User::first() ?? User::create([
                'name' => 'System Admin',
                'email' => 'admin@healup.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]);
        }

        // Get categories
        $physicalActivity = Category::where('name', 'Physical Activity')->first();
        $nutrition = Category::where('name', 'Nutrition')->first();
        $mentalHealth = Category::where('name', 'Mental Health')->first();
        $hydration = Category::where('name', 'Hydration')->first();
        $sleep = Category::where('name', 'Sleep & Rest')->first();

        $challenges = [
            [
                'title' => '30-Day Fitness Challenge',
                'description' => 'Complete 30 minutes of exercise every day for 30 days',
                'objectif' => 30, // 30 days target
                'duration' => 30,
                'reward' => 'Fitness Champion Badge + 500 Points',
                'start_date' => now(),
                'end_date' => now()->addDays(30),
                'status' => 'approved',
                'category_id' => $physicalActivity?->id,
                'created_by' => $creator->id,
            ],
            [
                'title' => 'Healthy Eating Week',
                'description' => 'Eat 5 servings of fruits and vegetables daily for 7 days',
                'objectif' => 5, // 5 servings per day
                'duration' => 7,
                'reward' => 'Nutrition Pro Badge + 200 Points',
                'start_date' => now(),
                'end_date' => now()->addDays(7),
                'status' => 'approved',
                'category_id' => $nutrition?->id,
                'created_by' => $creator->id,
            ],
            [
                'title' => 'Meditation Master',
                'description' => 'Practice meditation for 10 minutes daily for 21 days',
                'objectif' => 10, // 10 minutes per day
                'duration' => 21,
                'reward' => 'Zen Master Badge + 350 Points',
                'start_date' => now(),
                'end_date' => now()->addDays(21),
                'status' => 'approved',
                'category_id' => $mentalHealth?->id,
                'created_by' => $creator->id,
            ],
            [
                'title' => 'Hydration Hero',
                'description' => 'Drink 8 glasses of water every day for 14 days',
                'objectif' => 8, // 8 glasses per day
                'duration' => 14,
                'reward' => 'Hydration Hero Badge + 250 Points',
                'start_date' => now(),
                'end_date' => now()->addDays(14),
                'status' => 'approved',
                'category_id' => $hydration?->id,
                'created_by' => $creator->id,
            ],
            [
                'title' => 'Sleep Schedule Reset',
                'description' => 'Go to bed before 11 PM and sleep 7-8 hours for 10 days',
                'objectif' => 7, // 7 hours minimum sleep
                'duration' => 10,
                'reward' => 'Sleep Champion Badge + 200 Points',
                'start_date' => now(),
                'end_date' => now()->addDays(10),
                'status' => 'approved',
                'category_id' => $sleep?->id,
                'created_by' => $creator->id,
            ],
            [
                'title' => '10K Steps Daily',
                'description' => 'Walk at least 10,000 steps every day for 30 days',
                'objectif' => 10000, // 10,000 steps per day
                'duration' => 30,
                'reward' => 'Step Master Badge + 500 Points',
                'start_date' => now()->addDays(5),
                'end_date' => now()->addDays(35),
                'status' => 'pending',
                'category_id' => $physicalActivity?->id,
                'created_by' => $creator->id,
            ],
            [
                'title' => 'Sugar-Free Sprint',
                'description' => 'Avoid added sugars and sugary drinks for 14 days',
                'objectif' => 0, // 0 grams of added sugar
                'duration' => 14,
                'reward' => 'Sugar Warrior Badge + 300 Points',
                'start_date' => now()->subDays(20),
                'end_date' => now()->subDays(6),
                'status' => 'approved',
                'category_id' => $nutrition?->id,
                'created_by' => $creator->id,
            ],
            [
                'title' => 'Rejected Challenge Example',
                'description' => 'This challenge was not approved by admin',
                'objectif' => 100,
                'duration' => 7,
                'reward' => 'None',
                'start_date' => now(),
                'end_date' => now()->addDays(7),
                'status' => 'rejected',
                'rejection_reason' => 'Challenge requirements are too vague and unrealistic',
                'category_id' => $physicalActivity?->id,
                'created_by' => $creator->id,
            ],
        ];

        foreach ($challenges as $challengeData) {
            Challenge::create($challengeData);
        }
    }
}
