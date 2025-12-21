<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ForumService;
use App\Services\CommentService;
use App\Services\LikeService;
use App\Services\FlagService;

class ForumServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ForumService::class, function ($app) {
            return new ForumService();
        });

        $this->app->singleton(CommentService::class, function ($app) {
            return new CommentService();
        });

        $this->app->singleton(LikeService::class, function ($app) {
            return new LikeService();
        });

        $this->app->singleton(FlagService::class, function ($app) {
            return new FlagService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}