<?php

namespace Interfaces\Http\Api\Product\Controllers;

use Domains\Products\Actions\FindProductByUuidAndTenantUuidAction;
use Domains\Products\Actions\QueryProductsByTenantUuidAction;
use Illuminate\Http\Request;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Api\Product\Resources\ProductResource;
use Interfaces\Http\Products\DataTransferObjects\IndexProductRequestData;
use Interfaces\Http\Products\Requests\IndexProductRequest;

class ProductController extends Controller
{
    public function index(
        IndexProductRequest $request,
        QueryProductsByTenantUuidAction $queryProductsByTenantUuidAction
    ) {
        $validatedRequest = IndexProductRequestData::fromRequest($request->validated());

        $products = $queryProductsByTenantUuidAction($request->companyToken, $validatedRequest);

        return ProductResource::collection($products->paginated);
    }

    public function show(
        string $identify,
        Request $request,
        FindProductByUuidAndTenantUuidAction $findProductByUuidAndTenantUuidAction
    ) {
        $product = $findProductByUuidAndTenantUuidAction($identify, $request->companyToken);

        return ProductResource::make($product);
    }
}
