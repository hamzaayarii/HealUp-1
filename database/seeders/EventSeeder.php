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
            [
                'title' => 'Yoga for Beginners',
                'date' => Carbon::now()->addDays(25),
                'location' => 'Gym Studio',
                'description' => 'Introductory yoga session for flexibility and relaxation.',
                'max_participants' => 40,
                'category_id' => $categories['Physical Activity'] ?? null,
            ],
            [
                'title' => 'Healthy Cooking Class',
                'date' => Carbon::now()->addDays(30),
                'location' => 'Community Kitchen',
                'description' => 'Learn to cook nutritious meals with a professional chef.',
                'max_participants' => 25,
                'category_id' => $categories['Nutrition'] ?? null,
            ],
            [
                'title' => 'Stress Management Webinar',
                'date' => Carbon::now()->addDays(22),
                'location' => 'Online',
                'description' => 'Techniques and tips for managing stress in daily life.',
                'max_participants' => 150,
                'category_id' => $categories['Mental Health'] ?? null,
            ],
            [
                'title' => 'Art Therapy Session',
                'date' => Carbon::now()->addDays(28),
                'location' => 'Art Room',
                'description' => 'Express yourself and relieve stress through art.',
                'max_participants' => 30,
                'category_id' => $categories['Mental Health'] ?? null,
            ],
            [
                'title' => 'Eco-Friendly Living Workshop',
                'date' => Carbon::now()->addDays(35),
                'location' => 'Green Hall',
                'description' => 'Learn sustainable habits for a healthier planet.',
                'max_participants' => 60,
                'category_id' => $categories['Sustainability'] ?? null,
            ],
            [
                'title' => 'Digital Detox Challenge',
                'date' => Carbon::now()->addDays(40),
                'location' => 'Online',
                'description' => 'Take a break from screens and improve your well-being.',
                'max_participants' => 80,
                'category_id' => $categories['Lifestyle'] ?? null,
            ],
            [
                'title' => 'Volunteer Day',
                'date' => Carbon::now()->addDays(45),
                'location' => 'Local Park',
                'description' => 'Join us for a day of community service and giving back.',
                'max_participants' => 100,
                'category_id' => $categories['Social Wellness'] ?? null,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }

        // Export events to JSON file for Python AI after seeding
        $this->exportEventsToJson();
    }

    /**
     * Export all events to python_ai/events.json for AI module
     */
    private function exportEventsToJson(): void
    {
        $events = Event::all();
        $path = base_path('python_ai/events.json');
        
        // Ensure directory exists
        $directory = dirname($path);
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
        
        file_put_contents($path, $events->toJson(JSON_PRETTY_PRINT));
        
        $this->command->info('Events exported to python_ai/events.json for AI recommendations');
    }
}
