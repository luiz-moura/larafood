<?php

namespace Domains\Categories\Actions;

use Domains\Categories\Contracts\CategoryRepository;
use Domains\Categories\DataTransferObjects\CategoryPaginatedData;
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
