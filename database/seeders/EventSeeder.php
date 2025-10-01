<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::pluck('id', 'name');

        $events = [
            [
                'title' => 'Hydration Challenge',
                'date' => Carbon::now()->addDays(10),
                'location' => 'Online',
                'description' => 'Join us for a week-long hydration challenge to improve your water intake habits.',
                'max_participants' => 100,
                'category_id' => $categories['Hydration'] ?? null,
            ],
            [
                'title' => 'Mindfulness Workshop',
                'date' => Carbon::now()->addDays(20),
                'location' => 'Campus Room 101',
                'description' => 'A workshop on meditation and mindfulness for better mental health.',
                'max_participants' => 50,
                'category_id' => $categories['Mental Health'] ?? null,
            ],
            [
                'title' => 'Healthy Eating Seminar',
                'date' => Carbon::now()->addDays(15),
                'location' => 'Cafeteria',
                'description' => 'Learn about nutrition and healthy eating habits from experts.',
                'max_participants' => 80,
                'category_id' => $categories['Nutrition'] ?? null,
            ],
            [
                'title' => 'Campus Run',
                'date' => Carbon::now()->addDays(5),
                'location' => 'Main Quad',
                'description' => 'A fun run event to promote physical activity and wellness.',
                'max_participants' => 200,
                'category_id' => $categories['Physical Activity'] ?? null,
            ],
            [
                'title' => 'Sleep Hygiene Talk',
                'date' => Carbon::now()->addDays(12),
                'location' => 'Library Conference Room',
                'description' => 'Tips and science behind good sleep and rest habits.',
                'max_participants' => 60,
                'category_id' => $categories['Sleep & Rest'] ?? null,
            ],
            [
                'title' => 'Social Wellness Mixer',
                'date' => Carbon::now()->addDays(18),
                'location' => 'Student Lounge',
                'description' => 'Meet new people and build social connections in a relaxed setting.',
                'max_participants' => 120,
                'category_id' => $categories['Social Wellness'] ?? null,
            ],
            [
                'title' => 'Study Skills Bootcamp',
                'date' => Carbon::now()->addDays(8),
                'location' => 'Room 202',
                'description' => 'Improve your learning and academic wellness with proven study techniques.',
                'max_participants' => 70,
                'category_id' => $categories['Study Habits'] ?? null,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
