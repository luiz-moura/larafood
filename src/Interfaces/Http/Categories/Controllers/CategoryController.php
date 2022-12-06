<?php

namespace Interfaces\Http\Categories\Controllers;

use Domains\Categories\Actions\CreateCategoryAction;
use Domains\Categories\Actions\DeleteCategoryAction;
use Domains\Categories\Actions\FindCategoryAction;
use Domains\Categories\Actions\GetAllCategoriesAction;
use Domains\Categories\Actions\SearchCategoryAction;
use Domains\Categories\Actions\UpdateCategoryAction;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Categories\DataTransferObjects\CategoryFormData;
use Interfaces\Http\Categories\DataTransferObjects\IndexCategoryRequestData;
use Interfaces\Http\Categories\DataTransferObjects\SearchCategoryRequestData;
use Interfaces\Http\Categories\Requests\IndexCategoryRequest;
use Interfaces\Http\Categories\Requests\SearchCategoryRequest;
use Interfaces\Http\Categories\Requests\StoreCategoryRequest;
use Interfaces\Http\Categories\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index(
        IndexCategoryRequest $request,
        GetAllCategoriesAction $getAllCategoriesAction
    ) {
        $paginationData = IndexCategoryRequestData::fromRequest($request->validated());
        $paginatedData = $getAllCategoriesAction($paginationData);

        return view('admin.pages.categories.index', [
            'categories' => $paginatedData->items,
            'pagination' => $paginatedData->links,
        ]);
    }

    public function create()
    {
        return view('admin.pages.categories.create');
    }

    public function store(StoreCategoryRequest $request, CreateCategoryAction $createCategoryAction)
    {
        $formData = CategoryFormData::fromRequest($request->validated());
        $createCategoryAction($request->user()->tenant_id, $formData);

        return to_route('categories.index');
    }

    public function edit(int $id, FindCategoryAction $findCategoryAction)
    {
        $category = $findCategoryAction($id);

        return view('admin.pages.categories.edit', compact('category'));
    }

    public function update(
        int $id,
        UpdateCategoryRequest $request,
        UpdateCategoryAction $updateCategoryAction
    ) {
        $formData = CategoryFormData::fromRequest($request->validated());
        $updateCategoryAction($id, $formData);

        return to_route('categories.index');
    }

    public function show(int $id, FindCategoryAction $findCategoryAction)
    {
        $category = $findCategoryAction($id, with: ['tenant']);

        return view('admin.pages.categories.show', compact('category'));
    }

    public function destroy(int $id, DeleteCategoryAction $deleteCategoryAction)
    {
        $deleteCategoryAction($id);

        return to_route('categories.index');
    }

    public function search(SearchCategoryRequest $request, SearchCategoryAction $searchCategoryAction)
    {
        $paginationData = SearchCategoryRequestData::fromRequest($request->validated());
        $paginatedData = $searchCategoryAction($paginationData);

        return view('admin.pages.categories.index', [
            'categories' => $paginatedData->items,
            'pagination' => $paginatedData->links,
        ]);
    }
}
