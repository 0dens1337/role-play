<?php

namespace Database\Factories;

use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;

class LevelFactory extends Factory
{
    protected $model = Level::class;

    public function definition(): array
    {
        return [
            'required_exp' => $this->faker->numberBetween(1, 100),
            'title' => $this->faker->word(),
        ];
    }
}
