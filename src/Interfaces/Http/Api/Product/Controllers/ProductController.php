<?php

namespace Interfaces\Http\Api\Product\Controllers;

use Domains\Products\Actions\FindProductByUuidAndTenantUuidAction;
use Domains\Products\Actions\QueryProductsByTenantUuidAction;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Api\Product\Resources\ProductResource;
use Interfaces\Http\Products\DataTransferObjects\IndexProductRequestData;
use Interfaces\Http\Products\Requests\IndexProductRequest;

class ProductController extends Controller
{
    public function index(
        string $companyToken,
        IndexProductRequest $request,
        QueryProductsByTenantUuidAction $queryProductsByTenantUuidAction
    ) {
        $validatedRequest = IndexProductRequestData::fromRequest($request->validated());

        $products = $queryProductsByTenantUuidAction($companyToken, $validatedRequest);

        return ProductResource::collection($products->paginated);
    }

    public function show(
        string $companyToken,
        string $identify,
        FindProductByUuidAndTenantUuidAction $findProductByUuidAndTenantUuidAction
    ) {
        $product = $findProductByUuidAndTenantUuidAction($identify, $companyToken);

        return new ProductResource($product);
    }
}
