<?php

namespace Interfaces\Http\Api\Table\Controllers;

use Domains\Tables\Actions\FindTableByUuidAndTenantUuidAction;
use Domains\Tables\Actions\QueryTableByTenantUuidAction;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Api\Table\Resources\TableResource;
use Interfaces\Http\Tables\DataTransferObjects\IndexTableRequestData;
use Interfaces\Http\Tables\Requests\IndexTableRequest;

class TableController extends Controller
{
    public function index(
        string $companyToken,
        IndexTableRequest $request,
        QueryTableByTenantUuidAction $queryTableByTenantUuidAction
    ) {
        $validatedRequest = IndexTableRequestData::fromRequest($request->validated());

        $tables = $queryTableByTenantUuidAction($companyToken, $validatedRequest);

        return TableResource::collection($tables->paginated);
    }

    public function show(
        string $companyToken,
        string $identify,
        FindTableByUuidAndTenantUuidAction $findTableByUuidAndTenantUuidAction
    ) {
        $table = $findTableByUuidAndTenantUuidAction($identify, $companyToken);

        return new TableResource($table);
    }
}
