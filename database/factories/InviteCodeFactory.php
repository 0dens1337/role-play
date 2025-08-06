<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InviteCode>
 */
class InviteCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->word,
            'max_uses' => $this->faker->randomNumber(),
            'uses' => 0,
            'expires_at' => $this->faker->dateTimeBetween('now', '2 weeks'),
            'num_of_symbols' => 9,
        ];
    }
}
