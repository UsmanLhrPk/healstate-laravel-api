<?php

namespace App\Providers;

use App\Models\Address;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Forum;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ServiceBooking;
use App\Models\ServiceSlot;
use App\Models\Vendor;
use App\Policies\AddressPolicy;
use App\Policies\CoursePolicy;
use App\Policies\OrderPolicy;
use App\Policies\ProductPolicy;
use App\Policies\ProductVariantPolicy;
use App\Policies\ServiceBookingPolicy;
use App\Policies\ServiceSlotPolicy;
use App\Policies\VendorPolicy;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Vendor::class => VendorPolicy::class,
        Product::class => ProductPolicy::class,
        ProductVariant::class => ProductVariantPolicy::class,
        ServiceSlot::class => ServiceSlotPolicy::class,
        ServiceBooking::class => ServiceBookingPolicy::class,
        Address::class => AddressPolicy::class,
        Order::class => OrderPolicy::class,
        Course::class => CoursePolicy::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(\App\Services\HtmlSanitizerService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register policies
        foreach ($this->policies as $model => $policy) {
            Gate::policy($model, $policy);
        }

        // Register event listeners

        // Enforce morph map for polymorphic relationships
        // Relation::enforceMorphMap([
        //     'forum' => Forum::class,
        //     'comment' => Comment::class,
        // ]);

        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        VerifyEmail::createUrlUsing(function (object $notifiable) {
            $url = URL::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                [
                    'id' => $notifiable->getKey(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                ]
            );
            $verifyEmailUrl = urlencode($url);

            return config('app.frontend_url')."/verify?url=$verifyEmailUrl";
        });
    }
}
