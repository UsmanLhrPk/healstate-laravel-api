<?php

namespace Database\Factories;

use App\Models\Flag;
use App\Models\User;
use App\Models\Forum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flag>
 */
class FlagFactory extends Factory
{
    protected $model = Flag::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'flaggable_type' => 'App\\Models\\Forum',
            'flaggable_id' => Forum::factory(),
        ];
    }

    /**
     * Set the flaggable (polymorphic).
     * Renamed from 'for' to 'forModel' to avoid conflict with parent Factory::for()
     */
    public function forModel($flaggable): static
    {
        return $this->state(fn (array $attributes) => [
            'flaggable_type' => get_class($flaggable),
            'flaggable_id' => $flaggable->id,
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