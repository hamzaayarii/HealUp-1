<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@healup.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create Professor Users
        $professors = [
            [
                'name' => 'Dr. Sarah Wilson',
                'email' => 'sarah.wilson@healup.com',
                'password' => Hash::make('password'),
                'role' => 'professor',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Prof. Michael Chen',
                'email' => 'michael.chen@healup.com',
                'password' => Hash::make('password'),
                'role' => 'professor',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Dr. Emily Rodriguez',
                'email' => 'emily.rodriguez@healup.com',
                'password' => Hash::make('password'),
                'role' => 'professor',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($professors as $professor) {
            User::create($professor);
        }

        // Create Student Users
        $students = [
            [
                'name' => 'Alice Johnson',
                'email' => 'alice@student.healup.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Bob Smith',
                'email' => 'bob@student.healup.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Carol Davis',
                'email' => 'carol@student.healup.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'David Wilson',
                'email' => 'david@student.healup.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Emma Thompson',
                'email' => 'emma@student.healup.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Frank Garcia',
                'email' => 'frank@student.healup.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Grace Liu',
                'email' => 'grace@student.healup.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Henry Brown',
                'email' => 'henry@student.healup.com',
                'password' => Hash::make('password'),
                'role' => 'student',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($students as $student) {
            User::create($student);
        }
    }
}
