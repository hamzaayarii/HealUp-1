<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            HabitSeeder::class,
            ChallengeSeeder::class,
            PostSeeder::class,
            AdviceSeeder::class,
            BadgeSeeder::class,
        ]);
    }
}
