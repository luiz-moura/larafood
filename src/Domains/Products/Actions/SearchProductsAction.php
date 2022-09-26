<?php

namespace Domains\Products\Actions;

use Domains\Products\DataTransferObjects\ProductPaginatedData;
use Domains\Products\Repositories\ProductRepository;
use Interfaces\Http\Products\DataTransferObjects\SearchProductRequestData;

class SearchProductsAction
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function __invoke(SearchProductRequestData $paginationData, array $with = []): ProductPaginatedData
    {
        return $this->productRepository->queryByName($paginationData, $with);
    }
}
