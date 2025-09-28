<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user if doesn't exist
        $adminUser = User::where('email', 'admin@healup.com')->first();

        if (!$adminUser) {
            User::create([
                'name' => 'HealUp Admin',
                'email' => 'admin@healup.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'age' => 30,
                'poids' => 70.0,
                'taille' => 175.0,
                'sexe' => 'male',
            ]);

            $this->command->info('Admin user created successfully!');
            $this->command->info('Email: admin@healup.com');
            $this->command->info('Password: admin123');
        } else {
            $this->command->info('Admin user already exists!');
        }

        // Update existing user to admin if needed (for testing)
        $existingUser = User::where('email', '!=', 'admin@healup.com')->first();
        if ($existingUser && $existingUser->role !== 'admin') {
            $existingUser->update(['role' => 'admin']);
            $this->command->info("Updated user {$existingUser->email} to admin role for testing");
        }
    }
}
