<?php

namespace Domains\Categories\Actions;

use Domains\Categories\Repositories\CategoryRepository;

class DeleteCategoryAction
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function __invoke(int $id): void
    {
        $this->categoryRepository->delete($id);
    }
}
