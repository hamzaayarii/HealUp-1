<?php

namespace Database\Seeders;

use App\Models\Advice;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = User::where('role', 'student')->get();
        $professors = User::where('role', 'professor')->get();

        $adviceData = [
            [
                'title' => 'Building Consistent Exercise Habits',
                'content' => 'Start small with just 15 minutes of activity daily. Consistency is more important than intensity when building new habits. Try activities you enjoy - dancing, walking, swimming - so exercise doesn\'t feel like a chore. Schedule your workouts like important appointments.',
                'source' => 'professor',
            ],
            [
                'title' => 'Improving Sleep Quality',
                'content' => 'Create a bedtime routine that signals your brain it\'s time to wind down. Avoid screens 1 hour before bed, keep your room cool and dark, and try to go to bed at the same time each night. Consider reading or gentle stretching before sleep.',
                'source' => 'professor',
            ],
            [
                'title' => 'Stress Management During Exams',
                'content' => 'Break study sessions into manageable chunks using the Pomodoro technique. Take regular breaks, practice deep breathing exercises, and don\'t forget to stay hydrated. Remember that some stress is normal - focus on what you can control.',
                'source' => 'professor',
            ],
            [
                'title' => 'Mindful Eating Practices',
                'content' => 'Pay attention to hunger cues and eat slowly. Try to include a variety of colors in your meals - this usually means more nutrients. Plan healthy snacks in advance to avoid impulsive food choices when studying.',
                'source' => 'professor',
            ],
            [
                'title' => 'Social Connection and Mental Health',
                'content' => 'Don\'t underestimate the power of social connections for your wellbeing. Schedule regular check-ins with friends, join study groups, or participate in campus activities. Quality relationships are a key component of mental health.',
                'source' => 'professor',
            ],
            [
                'title' => 'Hydration and Cognitive Performance',
                'content' => 'Even mild dehydration can affect concentration and mood. Keep a water bottle nearby while studying and aim for pale yellow urine as a hydration indicator. Add lemon or cucumber for variety if plain water feels boring.',
                'source' => 'AI',
            ],
            [
                'title' => 'Creating a Productive Study Environment',
                'content' => 'Your environment significantly impacts your focus. Keep your study space clean and organized, ensure good lighting, and minimize distractions. Consider using noise-canceling headphones or white noise if needed.',
                'source' => 'AI',
            ],
        ];

        foreach ($adviceData as $advice) {
            Advice::create([
                'user_id' => $students->random()->id,
                'advisor_id' => $advice['source'] === 'professor' ? $professors->random()->id : null,
                'title' => $advice['title'],
                'content' => $advice['content'],
                'source' => $advice['source'],
                'is_read' => rand(0, 1) === 1,
            ]);
        }
    }
}
