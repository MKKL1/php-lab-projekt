<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Image;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
         ->has(Order::factory()->count(3))
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

        foreach(Storage::disk('images')->allFiles() as $image) {

            Storage::disk('public')
                ->put('images/' . $image, Storage::disk('images')->get($image));
            Image::create([
                'path' => 'images/' . $image,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
        Product::factory(100)
            ->create();
        $products = Product::all();


        Cart::all()->each(function ($cart) use ($products) {
         $productIds = $products->random(rand(1,3))->pluck('id')->toArray();
         $toAttach = [];
         foreach ($productIds as $productId) {
             $toAttach[$productId] = ['quantity' => rand(1, 5)];
         }
         $cart->products()->attach($toAttach);
        });

        Order::all()->each(function ($order) use ($products) {
         $productIds = $products->random(rand(1,3))->pluck('id')->toArray();
         $toAttach = [];
         foreach ($productIds as $productId) {
             $toAttach[$productId] = ['quantity' => rand(1, 5), 'cost' => rand(10, 50)];
         }
         $order->products()->attach($toAttach);
        });
    }
}
