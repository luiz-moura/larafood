<?php

namespace Domains\Products\Actions;

use Domains\Products\Repositories\ProductRepository;

class DetachProductCategoryAction
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function __invoke(int $productId, int $categoryId): void
    {
        $this->productRepository->detachCategory($productId, $categoryId);
    }
}
