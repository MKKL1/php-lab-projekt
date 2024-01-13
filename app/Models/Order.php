<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['firstname', 'lastname', 'address', 'phone'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function products(): BelongsToMany
    {
        return $this
            ->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id')
            ->withPivot('quantity')
            ->withPivot('cost')
            ->withTimestamps();
    }

    public function productsMessage(): string
    {
        return $this->products()->first()->name . "...";
    }

    public function productCostSum()
    {
        $sum = 0;
        foreach ($this->products as $product) {
            $sum += $product->pivot->cost * $product->pivot->quantity;
        }
        return $sum;
    }
}
