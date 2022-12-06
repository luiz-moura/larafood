<?php

namespace Domains\Categories\Actions;

use Domains\Categories\DataTransferObjects\CategoryData;
use Domains\Categories\Repositories\CategoryRepository;

class FindCategoryBySlugAndTenantUuidAction
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function __invoke(string $slug, string $companyToken): CategoryData
    {
        return $this->categoryRepository->findBySlugAndTenantUuid($slug, $companyToken);
    }
}
