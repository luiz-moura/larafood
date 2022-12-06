<?php

namespace Domains\Products\Actions;

use Domains\Products\DataTransferObjects\ProductData;
use Domains\Products\Repositories\ProductRepository;

class FindProductBySlugAndTenantUuidAction
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function __invoke(string $slug, string $companyToken): ProductData
    {
        return $this->productRepository->findBySlugAndTenantUuid($slug, $companyToken);
    }
}
