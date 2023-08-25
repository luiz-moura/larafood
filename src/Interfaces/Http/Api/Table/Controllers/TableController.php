<?php

namespace Interfaces\Http\Api\Table\Controllers;

use Domains\Tables\Actions\FindTableByUuidAndTenantUuidAction;
use Domains\Tables\Actions\QueryTableByTenantUuidAction;
use Illuminate\Http\Request;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Api\Table\Resources\TableResource;
use Interfaces\Http\Tables\DataTransferObjects\IndexTableRequestData;
use Interfaces\Http\Tables\Requests\IndexTableRequest;

class TableController extends Controller
{
    public function index(
        IndexTableRequest $request,
        QueryTableByTenantUuidAction $queryTableByTenantUuidAction
    ) {
        $validatedRequest = IndexTableRequestData::fromRequest($request->validated());

        $tables = $queryTableByTenantUuidAction($request->companyToken, $validatedRequest);

        return TableResource::collection($tables->paginated);
    }

    public function show(
        string $identify,
        Request $request,
        FindTableByUuidAndTenantUuidAction $findTableByUuidAndTenantUuidAction
    ) {
        $table = $findTableByUuidAndTenantUuidAction($identify, $request->companyToken);

        return TableResource::make($table);
    }
}
