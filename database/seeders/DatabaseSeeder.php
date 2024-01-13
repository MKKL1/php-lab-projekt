<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

         User::create([
             'name' => 'admin',
             'email' => 'admin@example.pl',
             'password' => Hash::make('12345678'),
             'status' => 'admin',
             'created_at' => Carbon::now(),
             'updated_at' => Carbon::now()
         ]);

        User::create([
            'name' => 'user',
            'email' => 'user@example.pl',
            'password' => Hash::make('12345678'),
            'status' => 'user',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

         Product::factory(100)->create();

         $products = Product::all();

         Cart::all()->each(function ($cart) use ($products) {
             $productIds = $products->random(rand(1,3))->pluck('id')->toArray();
             $toAttach = [];
             foreach ($productIds as $productId) {
                 $toAttach[$productId] = ['quantity' => rand(1, 5)];
             }
             $cart->products()->attach($toAttach);
         });
    }
}
