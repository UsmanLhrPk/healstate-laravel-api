<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\Forum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment' => $this->faker->paragraph(rand(1, 3)),
            'author_id' => User::factory(),
            'commentable_type' => 'App\\Models\\Forum',
            'commentable_id' => Forum::factory(),
            'parent_id' => null,
        ];
    }

    /**
     * Indicate that the comment is a reply.
     */
    public function reply(?int $parentId = null): static
    {
        return $this->state(fn (array $attributes) => [
            'parent_id' => $parentId ?? Comment::factory(),
        ]);
    }

    /**
     * Set the commentable (polymorphic).
     */
    public function forCommentable($commentable): static
    {
        return $this->state(fn (array $attributes) => [
            'commentable_type' => get_class($commentable),
            'commentable_id' => $commentable->id,
        ]);
    }

    /**
     * Set the author.
     */
    public function byUser(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'author_id' => $user->id,
        ]);
    }
}