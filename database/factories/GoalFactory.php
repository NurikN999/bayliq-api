<?php

namespace Database\Factories;

use App\Domain\Goals\Enums\GoalPriority;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Goal>
 */
class GoalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'target_amount' => $this->faker->numberBetween(1000, 10000),
            'saved_amount' => $this->faker->numberBetween(1000, 10000),
            'deadline' => $this->faker->date(),
            'priority' => GoalPriority::MEDIUM,
            'is_completed' => $this->faker->boolean(),
            'user_id' => User::factory(),
        ];
    }
}
