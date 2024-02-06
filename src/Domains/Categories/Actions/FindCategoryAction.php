<?php

namespace Domains\Categories\Actions;

use Domains\Categories\Contracts\CategoryRepository;
use Domains\Categories\DataTransferObjects\CategoryData;

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
