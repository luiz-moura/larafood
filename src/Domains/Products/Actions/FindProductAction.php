<?php

namespace Domains\Products\Actions;

use Domains\Products\DataTransferObjects\ProductData;
use Domains\Products\Repositories\ProductRepository;

class FindProductAction
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function __invoke(int $id, array $with = []): ProductData
    {
        return $this->productRepository->find($id, $with);
    }
}
