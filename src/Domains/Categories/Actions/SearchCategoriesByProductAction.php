<?php

namespace Domains\Categories\Actions;

use Domains\Categories\Contracts\CategoryRepository;
use Domains\Categories\DataTransferObjects\CategoryPaginatedData;
use Interfaces\Http\Categories\DataTransferObjects\SearchCategoryRequestData;

class SearchCategoriesByProductAction
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function __invoke(
        int $productId,
        SearchCategoryRequestData $request,
        array $with = []
    ): CategoryPaginatedData {
        return $this->categoryRepository->queryByNameAndByProductId($productId, $request, $with);
    }
}
