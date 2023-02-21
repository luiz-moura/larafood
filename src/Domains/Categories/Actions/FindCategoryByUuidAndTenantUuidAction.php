<?php

namespace Domains\Categories\Actions;

use Domains\Categories\DataTransferObjects\CategoryData;
use Domains\Categories\Repositories\CategoryRepository;

class FindCategoryByUuidAndTenantUuidAction
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function __invoke(string $identify, string $companyToken): CategoryData
    {
        return $this->categoryRepository->findByUuidAndTenantUuid($identify, $companyToken);
    }
}
