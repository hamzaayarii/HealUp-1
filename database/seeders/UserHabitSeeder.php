<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Habit;
use App\Models\UserHabit;
use App\Models\DailyProgress;
use App\Models\Challenge;
use App\Models\Participation;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserHabitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = User::where('role', 'student')->get();
        $habits = Habit::all();
        $challenges = Challenge::all();

        // Create user habits for each student
        foreach ($students as $student) {
            // Each student will have 3-5 random habits
            $selectedHabits = $habits->random(rand(3, 5));

            foreach ($selectedHabits as $habit) {
                $userHabit = UserHabit::create([
                    'user_id' => $student->id,
                    'habit_id' => $habit->id,
                    'current_streak' => rand(0, 15),
                    'longest_streak' => rand(5, 30),
                    'started_at' => Carbon::now()->subDays(rand(7, 30))->toDateString(),
                    'is_active' => true,
                ]);

                // Create some daily progress entries for the last 7 days
                for ($i = 6; $i >= 0; $i--) {
                    $date = Carbon::now()->subDays($i)->toDateString();
                    $completed = rand(0, 10) < 7; // 70% chance of completion

                    DailyProgress::create([
                        'user_habit_id' => $userHabit->id,
                        'date' => $date,
                        'value' => $completed ? $habit->target_value : rand(0, $habit->target_value),
                        'completed' => $completed,
                        'notes' => $completed ? null : 'Had some challenges today, but will try again tomorrow!',
                    ]);
                }
            }

            // Join some challenges
            $selectedChallenges = $challenges->random(rand(1, 3));
            foreach ($selectedChallenges as $challenge) {
                Participation::create([
                    'user_id' => $student->id,
                    'challenge_id' => $challenge->id,
                    'joined_at' => Carbon::now()->subDays(rand(1, 5))->toDateString(),
                    'current_progress' => rand(0, $challenge->objectif),
                    'completed' => rand(0, 4) === 0, // 25% completion rate
                    'completed_at' => rand(0, 4) === 0 ? Carbon::now()->subDays(rand(0, 3))->toDateString() : null,
                    'points_earned' => rand(10, 100),
                ]);
            }
        }
    }
}
