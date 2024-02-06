<?php

namespace Domains\Products\Actions;

use Domains\Products\DataTransferObjects\ProductData;
use Domains\Products\Repositories\ProductRepository;

class FindProductByUuidAndTenantUuidAction
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function __invoke(string $identify, string $companyToken): ProductData
    {
        return $this->productRepository->findByUuidAndTenantUuid($identify, $companyToken);
    }
}
