<?php

namespace Interfaces\Http\Api\Tenant\Controllers;

use Domains\Tenants\Actions\FindTenantByUuidAction;
use Domains\Tenants\Actions\GetAllTenantsAction;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Api\Tenant\Resources\TenantResource;
use Interfaces\Http\Tenant\DataTransferObjects\IndexTenantRequestData;
use Interfaces\Http\Tenant\Requests\IndexTenantRequest;

class TenantController extends Controller
{
    public function index(IndexTenantRequest $request, GetAllTenantsAction $getAllTenantsAction)
    {
        $validatedRequest = IndexTenantRequestData::fromRequest($request->validated());

        $tenants = $getAllTenantsAction($validatedRequest);

        return TenantResource::collection($tenants->paginated);
    }

    public function show(string $companyToken, FindTenantByUuidAction $findTenantByUuidAction)
    {
        $tenant = $findTenantByUuidAction($companyToken);

        return new TenantResource($tenant);
    }
}
