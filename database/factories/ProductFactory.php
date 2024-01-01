<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'cost' => fake()->randomFloat(2, 1, 100),
            'saleCost' => fake()->randomFloat(2, 1, 100),
            'quantity' => fake()->numberBetween(1, 100),
            'description' => fake()->text(),
            'image' => fake()->imageUrl(640, 480, 'cats')
        ];
    }
}
