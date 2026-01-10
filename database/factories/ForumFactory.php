<?php

namespace Database\Factories;

use App\Models\Forum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Forum>
 */
class ForumFactory extends Factory
{
    protected $model = Forum::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Mind' => ['Mental Health', 'Meditation', 'Mindfulness', 'Cognitive Enhancement', 'Consciousness Exploration'],
            'Body' => ['Physical Wellness', 'Fitness', 'Nutrition', 'Detox', 'Bodywork Therapies'],
            'Spirit' => ['Spiritual Practices', 'Energy Work', 'Metaphysics', 'Esoteric Studies'],
            'Biohacking' => ['Optimization Techniques', 'Supplements', 'Wearables', 'Performance Enhancement'],
            'Frequency Healing' => ['Sound Therapy', 'Resonance', 'Vibrational Medicine'],
            'Holistic Health' => ['Integrative Approaches', 'Natural Remedies', 'Alternative Therapies'],
        ];

        $category = $this->faker->randomElement(array_keys($categories));
        $subCategory = $this->faker->randomElement($categories[$category]);

        return [
            'title' => $this->faker->sentence(rand(4, 10)),
            'content' => $this->faker->paragraphs(rand(3, 6), true),
            'category' => $category,
            'sub_category' => $subCategory,
            'author_id' => User::factory(),
            'status' => $this->faker->randomElement(['approved', 'approved', 'approved', 'flagged']), // 75% approved
            'views' => $this->faker->numberBetween(0, 1000),
        ];
    }

    /**
     * Indicate that the forum is approved.
     */
    public function approved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'approved',
        ]);
    }

    /**
     * Indicate that the forum is flagged.
     */
    public function flagged(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'flagged',
        ]);
    }

    /**
     * Indicate that the forum is disapproved.
     */
    public function disapproved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'disapproved',
        ]);
    }

    /**
     * Indicate that the forum is popular.
     */
    public function popular(): static
    {
        return $this->state(fn (array $attributes) => [
            'views' => $this->faker->numberBetween(500, 5000),
        ]);
    }

    /**
     * Set a specific category.
     */
    public function category(string $category): static
    {
        $categories = [
            'Mind' => ['Mental Health', 'Meditation', 'Mindfulness', 'Cognitive Enhancement', 'Consciousness Exploration'],
            'Body' => ['Physical Wellness', 'Fitness', 'Nutrition', 'Detox', 'Bodywork Therapies'],
            'Spirit' => ['Spiritual Practices', 'Energy Work', 'Metaphysics', 'Esoteric Studies'],
            'Biohacking' => ['Optimization Techniques', 'Supplements', 'Wearables', 'Performance Enhancement'],
            'Frequency Healing' => ['Sound Therapy', 'Resonance', 'Vibrational Medicine'],
            'Holistic Health' => ['Integrative Approaches', 'Natural Remedies', 'Alternative Therapies'],
        ];

        return $this->state(fn (array $attributes) => [
            'category' => $category,
            'sub_category' => $this->faker->randomElement($categories[$category]),
        ]);
    }
}