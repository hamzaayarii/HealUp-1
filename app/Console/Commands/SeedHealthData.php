<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Habit;
use App\Models\UserHabit;
use App\Models\DailyProgress;
use Carbon\Carbon;

class SeedHealthData extends Command
{
    protected $signature = 'health:seed';
    protected $description = 'Seed health tracking data for testing';

    public function handle()
    {
        $this->info('🌱 Seeding health tracking data...');

        // Get a test user (or create one)
        $user = User::where('email', 'alex.student@example.com')->first();
        if (!$user) {
            $user = User::where('role', 'student')->first();
        }

        if (!$user) {
            $this->error('No student user found. Please run: php artisan db:seed first');
            return;
        }

        $this->info("👤 Using user: {$user->name} ({$user->email})");

        // Get some habits
        $waterHabit = Habit::where('name', 'like', '%water%')->first();
        $sleepHabit = Habit::where('name', 'like', '%sleep%')->first();
        $exerciseHabit = Habit::where('name', 'like', '%exercise%')->first();

        if (!$waterHabit || !$sleepHabit || !$exerciseHabit) {
            $this->error('Required habits not found. Please ensure habits are seeded.');
            return;
        }

        // Create user habits
        $userHabits = [
            [
                'habit' => $waterHabit,
                'target_value' => 8,
                'unit' => 'glasses'
            ],
            [
                'habit' => $sleepHabit,
                'target_value' => 8,
                'unit' => 'hours'
            ],
            [
                'habit' => $exerciseHabit,
                'target_value' => 30,
                'unit' => 'minutes'
            ]
        ];

        foreach ($userHabits as $habitData) {
            $userHabit = UserHabit::firstOrCreate([
                'user_id' => $user->id,
                'habit_id' => $habitData['habit']->id,
            ], [
                'target_value' => $habitData['target_value'],
                'unit' => $habitData['unit'],
                'is_active' => true,
                'started_at' => Carbon::now()->subDays(7),
            ]);

            $this->info("✅ Created habit: {$habitData['habit']->name}");

            // Add progress for the last 7 days
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);

                // Skip if progress already exists
                if (
                    DailyProgress::where('user_habit_id', $userHabit->id)
                        ->where('date', $date->toDateString())
                        ->exists()
                ) {
                    continue;
                }

                // Generate realistic progress values
                $value = $this->generateRealisticValue($habitData['habit']->name, $habitData['target_value']);

                DailyProgress::create([
                    'user_habit_id' => $userHabit->id,
                    'value' => $value,
                    'completed' => $value >= $habitData['target_value'],
                    'notes' => $this->generateNote($habitData['habit']->name, $value, $habitData['target_value']),
                    'date' => $date->toDateString(),
                ]);

                $this->info("  📊 Added progress for {$date->format('M j')}: {$value} {$habitData['unit']}");
            }

            // Update streak
            $userHabit->updateStreak();
        }

        $this->info('');
        $this->info('🎉 Health tracking data seeded successfully!');
        $this->info('');
        $this->info('You can now:');
        $this->info('1. Login as: ' . $user->email . ' (password: password)');
        $this->info('2. Visit: http://127.0.0.1:8000/health');
        $this->info('3. Explore the health tracking features!');
    }

    private function generateRealisticValue($habitName, $target)
    {
        $habitName = strtolower($habitName);

        if (str_contains($habitName, 'water')) {
            // Water: 6-10 glasses
            return rand(6, 10);
        } elseif (str_contains($habitName, 'sleep')) {
            // Sleep: 6.5-9 hours
            return rand(65, 90) / 10;
        } elseif (str_contains($habitName, 'exercise')) {
            // Exercise: 20-60 minutes
            return rand(20, 60);
        }

        // Default: 80-120% of target
        return rand(intval($target * 0.8), intval($target * 1.2));
    }

    private function generateNote($habitName, $value, $target)
    {
        $habitName = strtolower($habitName);

        if ($value >= $target) {
            $positiveNotes = [
                "Feeling great!",
                "Right on track 💪",
                "Exceeded my goal today!",
                "This is becoming a habit 😊",
                "Proud of myself!"
            ];
            return $positiveNotes[array_rand($positiveNotes)];
        } else {
            $encouragingNotes = [
                "Tomorrow will be better",
                "Making progress step by step",
                "Every bit counts",
                "Still working on it",
                "Keeping consistent"
            ];
            return $encouragingNotes[array_rand($encouragingNotes)];
        }
    }
}
