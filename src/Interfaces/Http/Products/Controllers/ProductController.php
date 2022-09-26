<?php

namespace Interfaces\Http\Products\Controllers;

use Domains\Products\Actions\CreateProductAction;
use Domains\Products\Actions\DeleteProductAction;
use Domains\Products\Actions\FindProductAction;
use Domains\Products\Actions\GetAllProductsAction;
use Domains\Products\Actions\SearchProductsAction;
use Domains\Products\Actions\StorageProductImageAction;
use Domains\Products\Actions\UpdateProductAction;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Products\DataTransferObjects\IndexProductRequestData;
use Interfaces\Http\Products\DataTransferObjects\ProductFormData;
use Interfaces\Http\Products\DataTransferObjects\SearchProductRequestData;
use Interfaces\Http\Products\Requests\IndexProductRequest;
use Interfaces\Http\Products\Requests\SearchProductRequest;
use Interfaces\Http\Products\Requests\StoreProductRequest;
use Interfaces\Http\Products\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index(
        IndexProductRequest $request,
        GetAllProductsAction $getAllProductsAction
    ) {
        $paginationData = IndexProductRequestData::fromRequest($request->validated());
        $paginatedData = $getAllProductsAction($paginationData);

        return view('admin.pages.products.index', [
            'products' => $paginatedData->data,
            'pagination' => $paginatedData->pagination,
        ]);
    }

    public function create()
    {
        return view('admin.pages.products.create');
    }

    public function store(
        StoreProductRequest $request,
        CreateProductAction $createProductAction,
        StorageProductImageAction $storageProductImageAction
    ) {
        $validatedData = $request->validated();

        $pathImage = $storageProductImageAction($validatedData['file']);
        $formData = ProductFormData::fromRequest(
            ['image' => $pathImage] + $validatedData
        );
        $createProductAction($request->user()->tenant_id, $formData);

        return to_route('products.index');
    }

    public function edit(int $id, FindProductAction $findProductAction)
    {
        $product = $findProductAction($id);

        return view('admin.pages.products.edit', compact('product'));
    }

    public function update(
        int $id,
        UpdateProductRequest $request,
        UpdateProductAction $updateProductAction,
        StorageProductImageAction $storageProductImageAction
    ) {
        $validatedData = $request->validated();

        if ($validatedData['file']) {
            $pathImage = $storageProductImageAction($validatedData['file'], $id);
            $validatedData['image'] = $pathImage;
        }

        $formData = ProductFormData::fromRequest($validatedData);
        $updateProductAction($id, $formData);

        return to_route('products.index');
    }

    public function show(int $id, FindProductAction $findProductAction)
    {
        $product = $findProductAction($id, with: ['tenant']);

        return view('admin.pages.products.show', compact('product'));
    }

    public function destroy(int $id, DeleteProductAction $deleteProductAction)
    {
        $deleteProductAction($id);

        return to_route('products.index');
    }

    public function search(SearchProductRequest $request, SearchProductsAction $searchProductsAction)
    {
        $paginationData = SearchProductRequestData::fromRequest($request->validated());
        $paginatedData = $searchProductsAction($paginationData);

        return view('admin.pages.products.index', [
            'products' => $paginatedData->data,
            'pagination' => $paginatedData->pagination,
        ]);
    }
}
