<?php

namespace Domains\Products\Actions;

use Domains\Products\DataTransferObjects\ProductPaginatedData;
use Domains\Products\Repositories\ProductRepository;
use Interfaces\Http\Products\DataTransferObjects\IndexProductRequestData;

class QueryProductsByTenantUuidAction
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function __invoke(string $companyToken, IndexProductRequestData $paginationData): ProductPaginatedData
    {
        return $this->productRepository->queryByTenantUuid($companyToken, $paginationData);
    }
}
