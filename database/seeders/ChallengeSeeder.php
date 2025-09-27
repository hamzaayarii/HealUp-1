<?php

namespace Database\Seeders;

use App\Models\Challenge;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChallengeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $challenges = [
            [
                'title' => '30-Day Water Challenge',
                'description' => 'Drink 8 glasses of water every day for 30 days',
                'objectif' => 8,
                'duration' => 30,
                'reward' => 'Hydration Master Badge',
                'start_date' => Carbon::now()->toDateString(),
                'end_date' => Carbon::now()->addDays(30)->toDateString(),
                'is_active' => true,
            ],
            [
                'title' => '7-Day Step Challenge',
                'description' => 'Walk 10,000 steps every day for a week',
                'objectif' => 10000,
                'duration' => 7,
                'reward' => 'Walking Champion Badge',
                'start_date' => Carbon::now()->toDateString(),
                'end_date' => Carbon::now()->addDays(7)->toDateString(),
                'is_active' => true,
            ],
            [
                'title' => '14-Day Meditation Journey',
                'description' => 'Practice meditation for 15 minutes daily for 2 weeks',
                'objectif' => 15,
                'duration' => 14,
                'reward' => 'Mindfulness Expert Badge',
                'start_date' => Carbon::now()->toDateString(),
                'end_date' => Carbon::now()->addDays(14)->toDateString(),
                'is_active' => true,
            ],
            [
                'title' => 'Healthy Sleep Week',
                'description' => 'Sleep 8 hours every night for 7 days',
                'objectif' => 8,
                'duration' => 7,
                'reward' => 'Sleep Champion Badge',
                'start_date' => Carbon::now()->toDateString(),
                'end_date' => Carbon::now()->addDays(7)->toDateString(),
                'is_active' => true,
            ],
            [
                'title' => '21-Day Gratitude Challenge',
                'description' => 'Write down 3 things you\'re grateful for each day',
                'objectif' => 3,
                'duration' => 21,
                'reward' => 'Gratitude Guru Badge',
                'start_date' => Carbon::now()->toDateString(),
                'end_date' => Carbon::now()->addDays(21)->toDateString(),
                'is_active' => true,
            ],
            [
                'title' => 'Study Focus Sprint',
                'description' => 'Complete 2 hours of focused study daily for 10 days',
                'objectif' => 2,
                'duration' => 10,
                'reward' => 'Focus Master Badge',
                'start_date' => Carbon::now()->toDateString(),
                'end_date' => Carbon::now()->addDays(10)->toDateString(),
                'is_active' => true,
            ],
        ];

        foreach ($challenges as $challenge) {
            Challenge::create($challenge);
        }
    }
}
