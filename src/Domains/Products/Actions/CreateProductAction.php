<?php

namespace Domains\Products\Actions;

use Domains\Products\Repositories\ProductRepository;
use Interfaces\Http\Products\DataTransferObjects\ProductFormData;

class CreateProductAction
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function __invoke(int $tenantId, ProductFormData $formData): void
    {
        $this->productRepository->create($tenantId, $formData);
    }
}
