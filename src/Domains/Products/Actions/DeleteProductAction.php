<?php

namespace Domains\Products\Actions;

use Domains\Products\Repositories\ProductRepository;

class DeleteProductAction
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function __invoke(int $id): void
    {
        $this->productRepository->delete($id);
    }
}
