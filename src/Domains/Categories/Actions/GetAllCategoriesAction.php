<?php

namespace Domains\Categories\Actions;

use Domains\Categories\DataTransferObjects\CategoryPaginatedData;
use Domains\Categories\Repositories\CategoryRepository;
use Interfaces\Http\Categories\DataTransferObjects\IndexCategoryRequestData;

class GetAllCategoriesAction
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function __invoke(IndexCategoryRequestData $paginationData, array $with = []): CategoryPaginatedData
    {
        return $this->categoryRepository->getAll($paginationData, $with);
    }
}
