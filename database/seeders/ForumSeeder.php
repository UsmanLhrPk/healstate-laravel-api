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
                    // Add 3-8 top-level comments to each forum
                    $commentCount = rand(3, 8);
                    
                    for ($i = 0; $i < $commentCount; $i++) {
                        $topLevelComment = Comment::factory()->create([
                            'commentable_type' => Forum::class, // This will be stored as App\Models\Forum
                            'commentable_id' => $forum->id,
                            'parent_id' => null,
                            'author_id' => $users->random()->id,
                        ]);

                        // Add 1-3 replies to some comments (33% chance)
                        if (rand(1, 3) === 1) {
                            $replyCount = rand(1, 3);
                            for ($j = 0; $j < $replyCount; $j++) {
                                Comment::factory()->create([
                                    'commentable_type' => Comment::class, // This will be stored as App\Models\Comment
                                    'commentable_id' => $topLevelComment->id,
                                    'parent_id' => $topLevelComment->id,
                                    'author_id' => $users->random()->id,
                                ]);
                            }
                        }
                    }

                    // Refresh forum to load the new comments
                    $forum->refresh();

                    // Add likes from random users
                    $likeCount = rand(5, min(20, $users->count()));
                    $users->random($likeCount)->each(function ($user) use ($forum) {
                        Like::factory()->create([
                            'likeable_type' => Forum::class,
                            'likeable_id' => $forum->id,
                            'user_id' => $user->id,
                        ]);
                    });

                    // Add some likes to comments
                    if ($forum->comments->count() > 0) {
                        $commentsToLike = $forum->comments->random(min(5, $forum->comments->count()));
                        
                        foreach ($commentsToLike as $comment) {
                            $commentLikeCount = rand(1, min(5, $users->count()));
                            $users->random($commentLikeCount)->each(function ($user) use ($comment) {
                                Like::factory()->create([
                                    'likeable_type' => Comment::class,
                                    'likeable_id' => $comment->id,
                                    'user_id' => $user->id,
                                ]);
                            });
                        }
                    }

                    // Randomly flag some forums (10% chance)
                    if (rand(1, 10) === 1) {
                        Flag::factory()->create([
                            'flaggable_type' => Forum::class,
                            'flaggable_id' => $forum->id,
                            'user_id' => $users->random()->id,
                        ]);
                    }
                });
        }

        // Create some popular forums
        Forum::factory(5)
            ->popular()
            ->create()
            ->each(function ($forum) use ($users) {
                // More comments for popular forums (15-30)
                $popularCommentCount = rand(15, 30);
                
                for ($i = 0; $i < $popularCommentCount; $i++) {
                    Comment::factory()->create([
                        'commentable_type' => Forum::class,
                        'commentable_id' => $forum->id,
                        'parent_id' => null,
                        'author_id' => $users->random()->id,
                    ]);
                }

                // More likes for popular forums
                $popularLikeCount = rand(15, min(50, $users->count()));
                $users->random($popularLikeCount)->each(function ($user) use ($forum) {
                    Like::factory()->create([
                        'likeable_type' => Forum::class,
                        'likeable_id' => $forum->id,
                        'user_id' => $user->id,
                    ]);
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
        
        // Show sample data for verification
        $this->command->info('
📊 Sample data verification:');
        $sampleForum = Forum::first();
        if ($sampleForum) {
            $this->command->info("Forum ID {$sampleForum->id}: {$sampleForum->comments()->count()} comments");
            $sampleComment = $sampleForum->comments()->first();
            if ($sampleComment) {
                $this->command->info("  - Comment commentable_type: {$sampleComment->commentable_type}");
            }
        }
    }
}