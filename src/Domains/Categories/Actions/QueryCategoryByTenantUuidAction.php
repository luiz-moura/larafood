<?php

namespace Domains\Categories\Actions;

use Domains\Categories\DataTransferObjects\CategoryPaginatedData;
use Domains\Categories\Repositories\CategoryRepository;
use Interfaces\Http\Categories\DataTransferObjects\IndexCategoryRequestData;

class QueryCategoryByTenantUuidAction
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function __invoke(string $companyToken, IndexCategoryRequestData $validatedRequest): CategoryPaginatedData
    {
        return $this->categoryRepository->queryByTenantUuid($companyToken, $validatedRequest);
    }
}
