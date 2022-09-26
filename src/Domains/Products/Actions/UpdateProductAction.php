<?php

namespace Domains\Products\Actions;

use Domains\Products\Repositories\ProductRepository;
use Interfaces\Http\Products\DataTransferObjects\ProductFormData;

class UpdateProductAction
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function __invoke(int $id, ProductFormData $formData): void
    {
        $this->productRepository->update($id, $formData);
    }
}
