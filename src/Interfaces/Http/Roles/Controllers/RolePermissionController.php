<?php

namespace Interfaces\Http\Roles\Controllers;

use Domains\ACL\Permissions\Actions\GetAllPermissionsAvailableByRoleAction;
use Domains\ACL\Permissions\Actions\GetAllPermissionsByRoleAction;
use Domains\ACL\Permissions\Actions\SearchPermissionsAvailableByRoleAction;
use Domains\ACL\Roles\Actions\AttachPermissionsInRoleAction;
use Domains\ACL\Roles\Actions\DetachRolePermissionAction;
use Domains\ACL\Roles\Actions\FindRoleAction;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Permissions\DataTransferObjects\IndexPermissionRequestData;
use Interfaces\Http\Permissions\DataTransferObjects\SearchPermissionRequestData;
use Interfaces\Http\Permissions\Requests\IndexPermissionRequest;
use Interfaces\Http\Permissions\Requests\SearchPermissionRequest;
use Interfaces\Http\Roles\Requests\AttachPermissionsRequest;

class RolePermissionController extends Controller
{
    public function index(
        int $roleId,
        IndexPermissionRequest $request,
        FindRoleAction $findRoleAction,
        GetAllPermissionsByRoleAction $getAllPermissionsByRoleAction
    ) {
        $role = $findRoleAction($roleId);

        $validatedRequest = IndexPermissionRequestData::fromRequest($request->validated());
        $rolesPaginated = $getAllPermissionsByRoleAction($roleId, $validatedRequest);

        return view('admin.pages.roles.permissions.index', [
            'role' => $role,
            'permissions' => $rolesPaginated->data,
            'pagination' => $rolesPaginated->pagination,
        ]);
    }

    public function available(
        int $roleId,
        IndexPermissionRequest $request,
        FindRoleAction $findRoleAction,
        GetAllPermissionsAvailableByRoleAction $getAllPermissionsAvailableByRoleAction
    ) {
        $role = $findRoleAction($roleId);

        $validatedRequest = IndexPermissionRequestData::fromRequest($request->validated());
        $rolesPaginated = $getAllPermissionsAvailableByRoleAction($roleId, $validatedRequest);

        return view('admin.pages.roles.permissions.available', [
            'role' => $role,
            'permissions' => $rolesPaginated->data,
            'pagination' => $rolesPaginated->pagination,
        ]);
    }

    public function searchAvailable(
        int $roleId,
        SearchPermissionRequest $request,
        FindRoleAction $findRoleAction,
        SearchPermissionsAvailableByRoleAction $searchPermissionsAvailableByRoleAction
    ) {
        $role = $findRoleAction($roleId);

        $validatedRequest = SearchPermissionRequestData::fromRequest($request->validated());
        $rolesPaginated = $searchPermissionsAvailableByRoleAction($roleId, $validatedRequest);

        return view('admin.pages.roles.permissions.available', [
            'role' => $role,
            'permissions' => $rolesPaginated->data,
            'pagination' => $rolesPaginated->pagination,
        ]);
    }

    public function attachPermissions(
        int $roleId,
        AttachPermissionsRequest $request,
        AttachPermissionsInRoleAction $attachPermissionsInRoleAction
    ) {
        $validatedRequest = $request->validated();
        $attachPermissionsInRoleAction($roleId, $validatedRequest['permissions']);

        return to_route('roles.permissions', $roleId);
    }

    public function detachPermission(
        int $roleId,
        int $permissionId,
        DetachRolePermissionAction $detachRolePermissionAction
    ) {
        $detachRolePermissionAction($roleId, $permissionId);

        return to_route('roles.permissions', $roleId);
    }
}
