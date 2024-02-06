<?php

namespace Domains\Categories\Actions;

use Domains\Categories\Contracts\CategoryRepository;
use Interfaces\Http\Categories\DataTransferObjects\CategoryFormData;

class CreateCategoryAction
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function __invoke(int $tenantId, CategoryFormData $formData): void
    {
        $this->categoryRepository->create($tenantId, $formData);
    }
}
