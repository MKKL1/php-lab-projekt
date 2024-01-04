<?php

namespace App\src\Cart;

use Ramsey\Collection\Collection;

class ItemCollection extends Collection
{
    public function __construct($items)
    {
        parent::__construct($items);
    }
}
