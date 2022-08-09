<?php

namespace Interfaces\Http\Permissions\Controllers;

use Domains\ACL\Permissions\Actions\CreatePermissionAction;
use Domains\ACL\Permissions\Actions\DeletePermissionAction;
use Domains\ACL\Permissions\Actions\FindPermissionByIdAction;
use Domains\ACL\Permissions\Actions\GetAllPermissionsPaginatedAction;
use Domains\ACL\Permissions\Actions\SearchPermissionAction;
use Domains\ACL\Permissions\Actions\UpdatePermissionAction;
use Domains\ACL\Permissions\DataTransferObjects\IndexPermissionsPaginationData;
use Domains\ACL\Permissions\DataTransferObjects\PermissionsData;
use Domains\ACL\Permissions\DataTransferObjects\SearchPermissionsPaginationData;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Permissions\Requests\IndexPermissionRequest;
use Interfaces\Http\Permissions\Requests\SearchPermissionRequest;
use Interfaces\Http\Permissions\Requests\StorePermissionRequest;

class PermissionController extends Controller
{
    public function index(
        IndexPermissionRequest $request,
        GetAllPermissionsPaginatedAction $getAllPermissionsPaginatedAction
    ) {
        $indexPermissionPaginationData = new IndexPermissionsPaginationData($request->validated());
        $permissions = ($getAllPermissionsPaginatedAction)($indexPermissionPaginationData);

        return View::make('admin.pages.permissions.index', [
            'permissions' => $permissions->data,
            'pagination' => $permissions->pagination,
        ]);
    }

    public function create()
    {
        return View::make('admin.pages.permissions.create');
    }

    public function store(StorePermissionRequest $request, CreatePermissionAction $createPermissionAction)
    {
        $permissionData = PermissionsData::createFromArray($request->validated());

        $success = ($createPermissionAction)($permissionData);

        return Redirect::route('permissions.index');
    }

    public function edit(int $id, FindPermissionByIdAction $findPermissionById)
    {
        $permission = ($findPermissionById)($id);

        return View::make('admin.pages.permissions.edit', compact('permission'));
    }

    public function update(
        int $id,
        StorePermissionRequest $request,
        UpdatePermissionAction $updatePermissionAction
    ) {
        $permissionData = PermissionsData::createFromArray($request->validated());
        $success = ($updatePermissionAction)($id, $permissionData);

        return Redirect::route('permissions.index');
    }

    public function show(int $id, FindPermissionByIdAction $findPermissionById)
    {
        $permission = ($findPermissionById)($id);

        return View::make('admin.pages.permissions.show', compact('permission'));
    }

    public function destroy(int $id, DeletePermissionAction $deletePermissionAction)
    {
        $success = ($deletePermissionAction)($id);

        return Redirect::route('permissions.index');
    }

    public function search(SearchPermissionRequest $request, SearchPermissionAction $searchPermissionAction)
    {
        $searchPermissionsPaginationData = new SearchPermissionsPaginationData($request->all());

        $permissions = ($searchPermissionAction)($searchPermissionsPaginationData);

        return View::make('admin.pages.permissions.index', [
            'permissions' => $permissions->data,
            'pagination' => $permissions->pagination,
        ]);
    }
}
