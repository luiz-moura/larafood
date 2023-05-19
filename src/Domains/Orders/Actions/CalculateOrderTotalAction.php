<?php

namespace Domains\Orders\Actions;

use Domains\Orders\DataTransferObjects\ProductWithQuantityCollection;
use Domains\Products\Repositories\ProductRepository;

class CalculateOrderTotalAction
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function __invoke(ProductWithQuantityCollection $productsWithQuantity): float
    {
        return $productsWithQuantity->sum(
            fn ($productWithQuantity) => $productWithQuantity->product->price * $productWithQuantity->quantity
        );
    }
}
