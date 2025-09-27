<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = User::where('role', 'student')->get();

        $posts = [
            [
                'content' => 'Just completed my 30-minute morning walk! Feeling energized and ready for the day. 🚶‍♀️✨',
                'sentiment' => 'positive',
            ],
            [
                'content' => 'Struggled with meditation today - my mind kept wandering. Any tips for beginners?',
                'sentiment' => 'neutral',
            ],
            [
                'content' => 'Hit my water intake goal for the 5th day in a row! The water reminder app is really helping 💧',
                'sentiment' => 'positive',
            ],
            [
                'content' => 'Having trouble sleeping lately. The stress from exams is affecting my sleep schedule 😴',
                'sentiment' => 'negative',
            ],
            [
                'content' => 'Tried a new healthy recipe today - quinoa bowl with vegetables. Surprisingly delicious! 🥗',
                'sentiment' => 'positive',
            ],
            [
                'content' => 'Completed the 7-day step challenge! Walking with friends made it so much more enjoyable 👥',
                'sentiment' => 'positive',
            ],
            [
                'content' => 'Missed my workout today due to heavy rain. Need to find indoor alternatives 🌧️',
                'sentiment' => 'neutral',
            ],
            [
                'content' => 'Started keeping a gratitude journal. Day 3 and already noticing positive changes in my mindset ✨',
                'sentiment' => 'positive',
            ],
        ];

        foreach ($posts as $index => $postData) {
            $post = Post::create([
                'user_id' => $students->random()->id,
                'content' => $postData['content'],
                'sentiment' => $postData['sentiment'],
                'likes_count' => rand(0, 25),
            ]);

            // Add some random comments
            if (rand(1, 3) === 1) { // 33% chance of having comments
                $numComments = rand(1, 3);
                for ($i = 0; $i < $numComments; $i++) {
                    $comments = [
                        'Great job! Keep it up! 👏',
                        'Thanks for sharing, this is inspiring!',
                        'I can relate to this. We\'re in this together!',
                        'Have you tried meditation apps? They really help!',
                        'Love seeing everyone\'s progress! 💪',
                        'This motivated me to start my own journey!',
                        'Keep pushing forward, you\'ve got this!',
                    ];

                    Comment::create([
                        'user_id' => $students->random()->id,
                        'post_id' => $post->id,
                        'content' => $comments[array_rand($comments)],
                        'likes_count' => rand(0, 10),
                    ]);
                }
            }
        }
    }
}
