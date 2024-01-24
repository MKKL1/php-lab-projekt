<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Image extends Model
{
    protected $fillable = ['path'];

    public function url(): string
    {
        return 'storage/' . $this->path;
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
