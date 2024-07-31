<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AdvertFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->text(50),
            'description' => $this->faker->text(1000),
            'images' => [
                $this->faker->imageUrl(),
                $this->faker->imageUrl(),
            ],
            'price' => $this->faker->randomNumber(),
        ];
    }
}
