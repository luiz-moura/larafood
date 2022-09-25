<?php

namespace Domains\Categories\Actions;

use Domains\Categories\DataTransferObjects\CategoryData;
use Domains\Categories\Repositories\CategoryRepository;

class FindCategoryAction
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function __invoke(int $id, array $with = []): CategoryData
    {
        return $this->categoryRepository->find($id, $with);
    }
}
