<?php

namespace Interfaces\Http\Tenant\Controllers;

use Domains\Tenants\Actions\DeleteTenantAction;
use Domains\Tenants\Actions\FindTenantAction;
use Domains\Tenants\Actions\GetAllTenantsAction;
use Domains\Tenants\Actions\SearchTenantsAction;
use Domains\Tenants\Actions\StorageTenantImageAction;
use Domains\Tenants\Actions\UpdateTenantAction;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Tenant\DataTransferObjects\IndexTenantRequestData;
use Interfaces\Http\Tenant\DataTransferObjects\SearchTenantRequestData;
use Interfaces\Http\Tenant\DataTransferObjects\TenantFormData;
use Interfaces\Http\Tenant\DataTransferObjects\UpdateTenantRequest;
use Interfaces\Http\Tenant\Requests\IndexTenantRequest;
use Interfaces\Http\Tenant\Requests\SearchTenantRequest;

class TenantController extends Controller
{
    public function index(
        IndexTenantRequest $request,
        GetAllTenantsAction $getAllTenantsAction
    ) {
        $validatedRequest = IndexTenantRequestData::fromRequest($request->validated());
        $tenantsPaginated = $getAllTenantsAction($validatedRequest);

        return view('admin.pages.tenants.index', [
            'tenants' => $tenantsPaginated->items,
            'pagination' => $tenantsPaginated->links,
        ]);
    }

    public function edit(int $id, FindTenantAction $findTenantAction)
    {
        $tenant = $findTenantAction($id);

        return view('admin.pages.tenants.edit', compact('tenant'));
    }

    public function update(
        int $id,
        UpdateTenantRequest $request,
        UpdateTenantAction $updateTenantAction,
        StorageTenantImageAction $storageTenantImageAction,
    ) {
        $formData = TenantFormData::fromRequest($request->validated());

        if ($request->hasFile('file')) {
            $path = $storageTenantImageAction($request->file('file'), $id);
            $formData->image = $path;
        }

        $updateTenantAction($id, $formData);

        return to_route('tenants.index');
    }

    public function show(int $id, FindTenantAction $findTenantAction)
    {
        $tenant = $findTenantAction($id, with: ['plan']);

        return view('admin.pages.tenants.show', compact('tenant'));
    }

    public function destroy(int $id, DeleteTenantAction $deleteTenantAction)
    {
        $deleteTenantAction($id);

        return to_route('tenants.index');
    }

    public function search(
        SearchTenantRequest $request,
        SearchTenantsAction $searchTenantsAction
    ) {
        $validatedRequest = SearchTenantRequestData::fromRequest($request->validated());
        $tenantsPaginated = $searchTenantsAction($validatedRequest);

        return view('admin.pages.tenants.index', [
            'tenants' => $tenantsPaginated->items,
            'pagination' => $tenantsPaginated->links,
        ]);
    }
}
