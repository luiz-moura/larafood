<?php

namespace Domains\Categories\Actions;

use Domains\Categories\Contracts\CategoryRepository;
use Domains\Categories\DataTransferObjects\CategoryPaginatedData;
use Interfaces\Http\Categories\DataTransferObjects\IndexCategoryRequestData;

class GetCategoriesAvailableByProductAction
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function __invoke(
        int $productId,
        IndexCategoryRequestData $request,
        array $with = []
    ): CategoryPaginatedData {
        return $this->categoryRepository->queryAvailableByProductId($productId, $request, $with);
    }
}
