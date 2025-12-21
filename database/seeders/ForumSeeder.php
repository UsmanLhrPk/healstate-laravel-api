<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Forum;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Flag;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test users (more users to support the likes/flags)
        $users = User::factory(50)->create();
        
        // Create a specific test user for easy login
        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
        
        // Add test user to the collection
        $users->push($testUser);

        // Create forums with different categories
        $categories = ['Mind', 'Body', 'Spirit', 'Biohacking', 'Frequency Healing', 'Holistic Health'];
        
        foreach ($categories as $category) {
            // Create 5 forums per category
            Forum::factory(5)
                ->category($category)
                ->create()
                ->each(function ($forum) use ($users) {
                    // Add 3-8 comments to each forum
                    $commentCount = rand(3, 8);
                    $topLevelComments = Comment::factory($commentCount)
                        ->forCommentable($forum)
                        ->create();

                    // Add replies to some comments
                    $topLevelComments->random(min(3, $commentCount))->each(function ($comment) use ($users) {
                        Comment::factory(rand(1, 3))
                            ->forCommentable($comment)
                            ->reply($comment->id)
                            ->create();
                    });

                    // Add likes from random users (ensure we don't request more than available)
                    $likeCount = rand(5, min(20, $users->count()));
                    $users->random($likeCount)->each(function ($user) use ($forum) {
                        Like::factory()
                            ->forModel($forum)
                            ->byUser($user)
                            ->create();
                    });

                    // Add some likes to comments
                    if ($forum->comments->count() > 0) {
                        $forum->comments->random(min(5, $forum->comments->count()))->each(function ($comment) use ($users) {
                            $users->random(rand(1, min(5, $users->count())))->each(function ($user) use ($comment) {
                                Like::factory()
                                    ->forModel($comment)
                                    ->byUser($user)
                                    ->create();
                            });
                        });
                    }

                    // Randomly flag some forums (10% chance)
                    if (rand(1, 10) === 1) {
                        Flag::factory()
                            ->forModel($forum)
                            ->byUser($users->random())
                            ->create();
                    }
                });
        }

        // Create some popular forums
        Forum::factory(5)
            ->popular()
            ->create()
            ->each(function ($forum) use ($users) {
                // More comments for popular forums
                Comment::factory(rand(15, 30))
                    ->forCommentable($forum)
                    ->create();

                // More likes for popular forums (ensure we don't request more than available)
                $popularLikeCount = rand(15, min(50, $users->count()));
                $users->random($popularLikeCount)->each(function ($user) use ($forum) {
                    Like::factory()
                        ->forModel($forum)
                        ->byUser($user)
                        ->create();
                });
            });

        $this->command->info('✅ Forum seeding completed!');
        $this->command->info('📧 Test User: test@example.com');
        $this->command->info('🔑 Password: password');
        $this->command->info('👥 Total Users: ' . User::count());
        $this->command->info('📝 Total Forums: ' . Forum::count());
        $this->command->info('💬 Total Comments: ' . Comment::count());
        $this->command->info('❤️ Total Likes: ' . Like::count());
        $this->command->info('🚩 Total Flags: ' . Flag::count());
    }
}