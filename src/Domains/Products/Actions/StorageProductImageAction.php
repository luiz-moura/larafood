<?php

namespace Domains\Products\Actions;

use Domains\Products\Repositories\ProductRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StorageProductImageAction
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function __invoke(UploadedFile $image, ?int $productId = null): string
    {
        if ($productId) {
            $productData = $this->productRepository->find($productId);

            if (Storage::exists($productData->image)) {
                Storage::delete($productData->image);
            }
        }

        $uuid = auth()->user()->tenant->uuid;

        return Storage::putFile("tenants/{$uuid}", $image);
    }
}
