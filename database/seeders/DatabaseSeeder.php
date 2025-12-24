<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call all your seeders here
        $this->call([
            ForumSeeder::class,
            CommentsSeeder::class,
            LikesSeeder::class,
            FlagSeeder::class,
            // Add any other seeders you have
        ]);
        
        // Or if you just want to create test data quickly:
        // User::factory(10)->create();
        
        // // Create a specific test user
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}