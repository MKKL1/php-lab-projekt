<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'cost' => fake()->randomFloat(2, 50, 100),
            'saleCost' => rand(0,99) < 20 ? fake()->randomFloat(2, 0, 50) : null,
            'quantity' => fake()->randomNumber(2),
            'description' => fake()->text(),
            'image' => fake()->imageUrl(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
