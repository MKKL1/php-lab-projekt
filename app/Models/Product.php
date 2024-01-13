<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function carts(): BelongsToMany
    {
        return $this
            ->belongsToMany(Cart::class, 'cart_products', 'product_id', 'cart_id')
            ->withPivot('quantity');
    }
}
