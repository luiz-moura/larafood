<?php

namespace Application\Observers;

use Illuminate\Support\Str;
use Infrastructure\Persistence\Eloquent\Models\Product;

class ProductObserver
{
    public function creating(Product $product)
    {
        $product->flag = Str::kebab($product->name);
    }

    public function updating(Product $product)
    {
        $product->flag = Str::kebab($product->name);
    }
}
