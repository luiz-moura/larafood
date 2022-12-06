<?php

namespace Interfaces\Http\Products\Controllers;

use Domains\Categories\Actions\GetCategoriesAvailableByProductAction;
use Domains\Categories\Actions\GetCategoriesByProductAction;
use Domains\Categories\Actions\SearchCategoriesByProductAction;
use Domains\Products\Actions\AttachCategoriesInProductAction;
use Domains\Products\Actions\DetachProductCategoryAction;
use Domains\Products\Actions\FindProductAction;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Categories\DataTransferObjects\IndexCategoryRequestData;
use Interfaces\Http\Categories\DataTransferObjects\SearchCategoryRequestData;
use Interfaces\Http\Categories\Requests\IndexCategoryRequest;
use Interfaces\Http\Categories\Requests\SearchCategoryRequest;
use Interfaces\Http\Products\Requests\AttachProductCategoriesRequest;

class ProductCategoryController extends Controller
{
    public function index(
        int $productId,
        IndexCategoryRequest $request,
        FindProductAction $findProductAction,
        GetCategoriesByProductAction $getCategoriesByProductAction,
    ) {
        $product = $findProductAction($productId);

        $request = IndexCategoryRequestData::fromRequest($request->validated());
        $categoriesPaginated = $getCategoriesByProductAction($productId, $request);

        return view('admin.pages.products.categories.index', [
            'product' => $product,
            'categories' => $categoriesPaginated->items,
            'pagination' => $categoriesPaginated->links,
        ]);
    }

    public function available(
        int $productId,
        IndexCategoryRequest $request,
        FindProductAction $findProductAction,
        GetCategoriesAvailableByProductAction $getCategoriesAvailableByProductAction,
    ) {
        $product = $findProductAction($productId);

        $request = IndexCategoryRequestData::fromRequest($request->validated());
        $categoriesPaginated = $getCategoriesAvailableByProductAction($productId, $request);

        return view('admin.pages.products.categories.available', [
            'product' => $product,
            'categories' => $categoriesPaginated->items,
            'pagination' => $categoriesPaginated->links,
        ]);
    }

    public function search(
        int $productId,
        SearchCategoryRequest $request,
        FindProductAction $findProductAction,
        SearchCategoriesByProductAction $searchCategoriesByProductAction,
    ) {
        $product = $findProductAction($productId);

        $request = SearchCategoryRequestData::fromRequest($request->validated());
        $categoriesPaginated = $searchCategoriesByProductAction($productId, $request);

        return view('admin.pages.products.categories.index', [
            'product' => $product,
            'categories' => $categoriesPaginated->items,
            'pagination' => $categoriesPaginated->links,
        ]);
    }

    public function attachCategories(
        int $productId,
        AttachProductCategoriesRequest $request,
        AttachCategoriesInProductAction $attachCategoriesInProductAction,
    ) {
        $validatedData = $request->validated();
        $attachCategoriesInProductAction($productId, $validatedData['categories']);

        return to_route('products.categories', $productId);
    }

    public function detachCategory(
        int $productId,
        int $categoryId,
        DetachProductCategoryAction $detachProductCategoryAction
    ) {
        $detachProductCategoryAction($productId, $categoryId);

        return to_route('products.categories', $productId);
    }
}
