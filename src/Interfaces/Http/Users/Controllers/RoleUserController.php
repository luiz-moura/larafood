<?php

namespace Interfaces\Http\Users\Controllers;

use Domains\ACL\Roles\Actions\GetAvailableRolesFromUserAction;
use Domains\ACL\Roles\Actions\GetAvailableRolesFromUserByNameAction;
use Domains\ACL\Roles\Actions\GetUserRolesAction;
use Domains\ACL\Users\Actions\AttachRolesInUserAction;
use Domains\ACL\Users\Actions\DetachUserRoleAction;
use Domains\ACL\Users\Actions\FindUserAction;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Roles\DataTransferObjects\IndexRoleRequestData;
use Interfaces\Http\Roles\DataTransferObjects\SearchRoleRequestData;
use Interfaces\Http\Roles\Requests\IndexRoleRequest;
use Interfaces\Http\Roles\Requests\SearchRoleRequest;
use Interfaces\Http\Users\Requests\AttachRolesRequest;

class RoleUserController extends Controller
{
    public function index(
        int $id,
        IndexRoleRequest $request,
        FindUserAction $findUserAction,
        GetUserRolesAction $getUserRolesAction
    ) {
        $user = $findUserAction($id);

        $validatedRequest = IndexRoleRequestData::fromRequest($request->validated());
        $rolesPaginated = $getUserRolesAction($user->id, $validatedRequest);

        return view('admin.pages.users.roles.index', [
            'user' => $user,
            'roles' => $rolesPaginated->data,
            'pagination' => $rolesPaginated->pagination,
        ]);
    }

    public function available(
        int $id,
        IndexRoleRequest $request,
        FindUserAction $findUserAction,
        GetAvailableRolesFromUserAction $getAvailableRolesFromUserAction,
    ) {
        $user = $findUserAction($id);

        $validatedRequest = IndexRoleRequestData::fromRequest($request->validated());
        $rolesPaginated = $getAvailableRolesFromUserAction($user->id, $validatedRequest);

        return view('admin.pages.users.roles.available', [
            'user' => $user,
            'roles' => $rolesPaginated->data,
            'pagination' => $rolesPaginated->pagination,
        ]);
    }

    public function searchAvailable(
        int $id,
        SearchRoleRequest $request,
        FindUserAction $findUserAction,
        GetAvailableRolesFromUserByNameAction $getAvailableRolesFromUserByNameAction
    ) {
        $user = $findUserAction($id);

        $validatedRequest = SearchRoleRequestData::fromRequest($request->validated());
        $rolesPaginated = ($getAvailableRolesFromUserByNameAction)($user->id, $validatedRequest);

        return view('admin.pages.users.roles.available', [
            'user' => $user,
            'roles' => $rolesPaginated->data,
            'pagination' => $rolesPaginated->pagination,
        ]);
    }

    public function attachRoles(
        int $id,
        AttachRolesRequest $request,
        AttachRolesInUserAction $attachRolesInUserAction
    ) {
        $validatedRequest = $request->validated();
        $attachRolesInUserAction($id, $validatedRequest['roles']);

        return to_route('users.roles', $id);
    }

    public function detachRole(
        int $userId,
        int $roleId,
        DetachUserRoleAction $detachUserRoleAction
    ) {
        $detachUserRoleAction($userId, $roleId);

        return to_route('users.roles', $userId);
    }
}
