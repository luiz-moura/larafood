<?php

namespace Domains\Categories\Actions;

use Domains\Categories\Repositories\CategoryRepository;
use Interfaces\Http\Categories\DataTransferObjects\CategoryFormData;

class UpdateCategoryAction
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function __invoke(int $id, CategoryFormData $formData): void
    {
        $this->categoryRepository->update($id, $formData);
    }
}
