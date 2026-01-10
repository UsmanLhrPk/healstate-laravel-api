<?php

namespace Database\Factories;

use App\Models\Like;
use App\Models\User;
use App\Models\Forum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
{
    protected $model = Like::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'likeable_type' => 'App\\Models\\Forum',
            'likeable_id' => Forum::factory(),
        ];
    }

    /**
     * Set the likeable (polymorphic).
     * Renamed from 'for' to 'forModel' to avoid conflict with parent Factory::for()
     */
    public function forModel($likeable): static
    {
        return $this->state(fn (array $attributes) => [
            'likeable_type' => get_class($likeable),
            'likeable_id' => $likeable->id,
        ]);
    }

    /**
     * Set the user.
     */
    public function byUser(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $user->id,
        ]);
    }
}