<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loan>
 */
class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->title(),
            'total_amount' => $this->faker->numberBetween(1000, 10000),
            'monthly_payment' => $this->faker->numberBetween(1000, 10000),
            'paid_amount' => $this->faker->numberBetween(1000, 10000),
            'interest_rate' => $this->faker->numberBetween(1000, 10000),
            'due_date' => $this->faker->date(),
            'is_closed' => $this->faker->boolean(),
        ];
    }
}
