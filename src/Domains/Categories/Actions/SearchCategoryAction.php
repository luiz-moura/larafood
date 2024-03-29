<?php

namespace Domains\Categories\Actions;

use Domains\Categories\Contracts\CategoryRepository;
use Domains\Categories\DataTransferObjects\CategoryPaginatedData;
use Interfaces\Http\Categories\DataTransferObjects\SearchCategoryRequestData;

class SearchCategoryAction
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function __invoke(SearchCategoryRequestData $paginationData, array $with = []): CategoryPaginatedData
    {
        return $this->categoryRepository->queryByName($paginationData, $with);
    }
}
