<?php

namespace Database\Factories;

use App\Models\Tool;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Version>
 */
class VersionFactory extends Factory
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
            'version' => fake()->numerify('#.#.#'),
            'release_date' => fake()->dateTimeBetween('-2 years', 'now'),
            'description' => fake()->sentence(),
            'changelog_url' => fake()->url(),
            'download_url' => fake()->url(),
        ];
    }
}
