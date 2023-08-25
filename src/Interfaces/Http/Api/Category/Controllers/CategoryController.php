<?php

namespace Interfaces\Http\Api\Category\Controllers;

use Domains\Categories\Actions\FindCategoryByUuidAndTenantUuidAction;
use Domains\Categories\Actions\QueryCategoryByTenantUuidAction;
use Illuminate\Http\Request;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Api\Category\Resources\CategoryResource;
use Interfaces\Http\Categories\DataTransferObjects\IndexCategoryRequestData;
use Interfaces\Http\Categories\Requests\IndexCategoryRequest;

class CategoryController extends Controller
{
    public function index(
        IndexCategoryRequest $request,
        QueryCategoryByTenantUuidAction $queryCategoryByTenantUuidAction
    ) {
        $validatedRequest = IndexCategoryRequestData::fromRequest($request->validated());

        $categories = $queryCategoryByTenantUuidAction($request->companyToken, $validatedRequest);

        return CategoryResource::collection($categories->paginated);
    }

    public function show(
        string $identify,
        Request $request,
        FindCategoryByUuidAndTenantUuidAction $findCategoryByUuidAndTenantUuidAction
    ) {
        $category = $findCategoryByUuidAndTenantUuidAction($identify, $request->companyToken);

        return CategoryResource::make($category);
    }
}
