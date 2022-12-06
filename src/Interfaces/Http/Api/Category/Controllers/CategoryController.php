<?php

namespace Interfaces\Http\Api\Category\Controllers;

use Domains\Categories\Actions\FindCategoryBySlugAndTenantUuidAction;
use Domains\Categories\Actions\QueryCategoryByTenantUuidAction;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Api\Category\Resources\CategoryResource;
use Interfaces\Http\Categories\DataTransferObjects\IndexCategoryRequestData;
use Interfaces\Http\Categories\Requests\IndexCategoryRequest;

class CategoryController extends Controller
{
    public function index(
        string $companyToken,
        IndexCategoryRequest $request,
        QueryCategoryByTenantUuidAction $queryCategoryByTenantUuidAction
    ) {
        $validatedRequest = IndexCategoryRequestData::fromRequest($request->validated());

        $categories = $queryCategoryByTenantUuidAction($companyToken, $validatedRequest);

        return CategoryResource::collection($categories->paginated);
    }

    public function show(
        string $companyToken,
        $categorySlug,
        FindCategoryBySlugAndTenantUuidAction $findCategoryBySlugAndTenantUuidAction
    )
    {
        $category = $findCategoryBySlugAndTenantUuidAction($categorySlug, $companyToken);

        return new CategoryResource($category);
    }
}
