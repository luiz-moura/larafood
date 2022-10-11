<?php

namespace Domains\Products\Actions;

use Domains\Products\Repositories\ProductRepository;

class AttachCategoriesInProductAction
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function __invoke(string $productId, array $categories): void
    {
        $this->productRepository->attachCategories($productId, $categories);
    }
}
