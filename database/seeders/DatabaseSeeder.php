<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory()
             ->count(50)
             ->has(Cart::factory()->count(1))
             ->create();

         Product::factory(100)->create();

         $products = Product::all();

         Cart::all()->each(function ($cart) use ($products) {
             $cart->products()->attach(
                 $products->random(rand(1,3))->pluck('id')->toArray()
             );
         });
    }
}
