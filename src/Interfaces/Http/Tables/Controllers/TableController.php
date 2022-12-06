<?php

namespace Interfaces\Http\Tables\Controllers;

use Domains\Tables\Actions\CreateTableAction;
use Domains\Tables\Actions\DeleteTableAction;
use Domains\Tables\Actions\FindTableAction;
use Domains\Tables\Actions\GetAllTablesAction;
use Domains\Tables\Actions\SearchTableAction;
use Domains\Tables\Actions\UpdateTableAction;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Tables\DataTransferObjects\IndexTableRequestData;
use Interfaces\Http\Tables\DataTransferObjects\SearchTableRequestData;
use Interfaces\Http\Tables\DataTransferObjects\TableFormData;
use Interfaces\Http\Tables\Requests\IndexTableRequest;
use Interfaces\Http\Tables\Requests\SearchTableRequest;
use Interfaces\Http\Tables\Requests\StoreTableRequest;

class TableController extends Controller
{
    public function index(
        IndexTableRequest $request,
        GetAllTablesAction $getAllTablesAction
    ) {
        $validatedRequest = IndexTableRequestData::fromRequest($request->validated());
        $tables = $getAllTablesAction($validatedRequest);

        return view('admin.pages.tables.index', [
            'tables' => $tables->items,
            'pagination' => $tables->links,
        ]);
    }

    public function create()
    {
        return view('admin.pages.tables.create');
    }

    public function store(
        StoreTableRequest $request,
        CreateTableAction $createTableAction
    ) {
        $tenantId = $request->user()->tenant_id;
        $formData = TableFormData::fromRequest($request->validated());
        $createTableAction($tenantId, $formData);

        return to_route('tables.index');
    }

    public function edit(int $id, FindTableAction $findTableAction)
    {
        $table = $findTableAction($id);

        return view('admin.pages.tables.edit', compact('table'));
    }

    public function update(
        int $id,
        StoreTableRequest $request,
        UpdateTableAction $updateTableAction
    ) {
        $formData = TableFormData::fromRequest($request->validated());
        $updateTableAction($id, $formData);

        return to_route('tables.index');
    }

    public function show(int $id, FindTableAction $findTableAction)
    {
        $table = $findTableAction($id);

        return view('admin.pages.tables.show', compact('table'));
    }

    public function destroy(int $id, DeleteTableAction $deleteTableAction)
    {
        $deleteTableAction($id);

        return to_route('tables.index');
    }

    public function search(SearchTableRequest $request, SearchTableAction $searchTableAction)
    {
        $validatedRequest = SearchTableRequestData::fromRequest($request->validated());
        $tables = $searchTableAction($validatedRequest);

        return view('admin.pages.tables.index', [
            'tables' => $tables->items,
            'pagination' => $tables->links,
        ]);
    }
}
