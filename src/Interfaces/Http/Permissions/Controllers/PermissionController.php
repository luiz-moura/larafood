<?php

namespace Interfaces\Http\Permissions\Controllers;

use Domains\ACL\Permissions\Actions\CreatePermissionAction;
use Domains\ACL\Permissions\Actions\DeletePermissionAction;
use Domains\ACL\Permissions\Actions\FindPermissionAction;
use Domains\ACL\Permissions\Actions\GetAllPermissionsAction;
use Domains\ACL\Permissions\Actions\SearchPermissionAction;
use Domains\ACL\Permissions\Actions\UpdatePermissionAction;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Permissions\DataTransferObjects\IndexPermissionRequestData;
use Interfaces\Http\Permissions\DataTransferObjects\PermissionFormData;
use Interfaces\Http\Permissions\DataTransferObjects\SearchPermissionRequestData;
use Interfaces\Http\Permissions\Requests\IndexPermissionRequest;
use Interfaces\Http\Permissions\Requests\SearchPermissionRequest;
use Interfaces\Http\Permissions\Requests\StorePermissionRequest;

class PermissionController extends Controller
{
    public function index(
        IndexPermissionRequest $request,
        GetAllPermissionsAction $getAllPermissionsAction
    ) {
        $paginationData = IndexPermissionRequestData::fromRequest($request->validated());
        $paginatedData = $getAllPermissionsAction($paginationData);

        return view('admin.pages.permissions.index', [
            'permissions' => $paginatedData->data,
            'pagination' => $paginatedData->pagination,
        ]);
    }

    public function create()
    {
        return view('admin.pages.permissions.create');
    }

    public function store(StorePermissionRequest $request, CreatePermissionAction $createPermissionAction)
    {
        $formData = PermissionFormData::fromRequest($request->validated());
        $createPermissionAction($formData);

        return to_route('permissions.index');
    }

    public function edit(int $id, FindPermissionAction $findPermissionAction)
    {
        $permission = $findPermissionAction($id);

        return view('admin.pages.permissions.edit', compact('permission'));
    }

    public function update(
        int $id,
        StorePermissionRequest $request,
        UpdatePermissionAction $updatePermissionAction
    ) {
        $permissionData = PermissionFormData::fromRequest($request->validated());
        $updatePermissionAction($id, $permissionData);

        return to_route('permissions.index');
    }

    public function show(int $id, FindPermissionAction $findPermissionAction)
    {
        $permission = $findPermissionAction($id);

        return view('admin.pages.permissions.show', compact('permission'));
    }

    public function destroy(int $id, DeletePermissionAction $deletePermissionAction)
    {
        $deletePermissionAction($id);

        return to_route('permissions.index');
    }

    public function search(SearchPermissionRequest $request, SearchPermissionAction $searchPermissionAction)
    {
        $paginationData = SearchPermissionRequestData::fromRequest($request->validated());
        $paginatedData = $searchPermissionAction($paginationData);

        return view('admin.pages.permissions.index', [
            'permissions' => $paginatedData->data,
            'pagination' => $paginatedData->pagination,
        ]);
    }
}
