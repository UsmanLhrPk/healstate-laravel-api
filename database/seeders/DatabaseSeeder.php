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
        
      
    }
}