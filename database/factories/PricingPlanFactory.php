<?php

namespace Database\Factories;

use App\Models\Tool;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PricingPlan>
 */
class PricingPlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tool_id' => Tool::factory(),
            'name' => fake()->randomElement(['Free', 'Pro', 'Business', 'Enterprise']),
            'billing_period' => fake()->randomElement(['monthly', 'yearly', 'one_time']),
            'price' => fake()->randomFloat(2, 0, 100),
            'currency' => 'USD',
            'features' => fake()->sentence(),
            'is_deprecated' => false,
            'last_updated_date' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
