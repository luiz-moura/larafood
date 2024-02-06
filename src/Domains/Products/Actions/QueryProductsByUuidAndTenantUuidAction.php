<?php

namespace Domains\Products\Actions;

use Domains\Products\DataTransferObjects\ProductCollection;
use Domains\Products\Repositories\ProductRepository;

class QueryProductsByUuidAndTenantUuidAction
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function __invoke(array $ids, string $companyToken): ProductCollection
    {
        return $this->productRepository->queryThoseInTheUuidAndTenantUuid($ids, $companyToken);
    }
}
