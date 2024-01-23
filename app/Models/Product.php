<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'cost', 'saleCost', 'quantity', 'description', 'image'];
    function isOnSale(): bool
    {
        return $this->saleCost != null;
    }

    function calculatedPrice() {
        return $this->isOnSale() ? $this->saleCost : $this->cost;
    }

    public function orders(): BelongsToMany
    {
        return $this
            ->belongsToMany(Order::class, 'order_items', 'product_id', 'order_id')
            ->withPivot('quantity');
    }

    public function carts(): BelongsToMany
    {
        return $this
            ->belongsToMany(Cart::class, 'cart_products', 'product_id', 'cart_id')
            ->withPivot('quantity');
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }
}
