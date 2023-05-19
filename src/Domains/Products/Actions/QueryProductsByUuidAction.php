<?php

namespace Domains\Products\Actions;

use Domains\Products\DataTransferObjects\ProductCollection;
use Domains\Products\Repositories\ProductRepository;

class QueryProductsByUuidAction
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function __invoke(array $ids): ProductCollection
    {
        return $this->productRepository->queryThoseInTheUuid($ids);
    }
}
