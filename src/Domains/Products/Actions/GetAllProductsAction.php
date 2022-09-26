<?php

namespace Domains\Products\Actions;

use Domains\Products\DataTransferObjects\ProductPaginatedData;
use Domains\Products\Repositories\ProductRepository;
use Interfaces\Http\Products\DataTransferObjects\IndexProductRequestData;

class GetAllProductsAction
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function __invoke(IndexProductRequestData $paginationData, array $with = []): ProductPaginatedData
    {
        return $this->productRepository->getAll($paginationData, $with);
    }
}
