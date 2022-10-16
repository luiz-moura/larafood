<?php

namespace Interfaces\Http\Roles\Controllers;

use Domains\ACL\Roles\Actions\CreateRoleAction;
use Domains\ACL\Roles\Actions\DeleteRoleAction;
use Domains\ACL\Roles\Actions\FindRoleAction;
use Domains\ACL\Roles\Actions\GetAllRolesAction;
use Domains\ACL\Roles\Actions\SearchRoleAction;
use Domains\ACL\Roles\Actions\UpdateRoleAction;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Roles\DataTransferObjects\IndexRoleRequestData;
use Interfaces\Http\Roles\DataTransferObjects\RoleFormData;
use Interfaces\Http\Roles\DataTransferObjects\SearchRoleRequestData;
use Interfaces\Http\Roles\Requests\IndexRoleRequest;
use Interfaces\Http\Roles\Requests\SearchRoleRequest;
use Interfaces\Http\Roles\Requests\StoreRoleRequest;

class RoleController extends Controller
{
    public function index(
        IndexRoleRequest $request,
        GetAllRolesAction $getAllRolesAction
    ) {
        $validatedRequest = IndexRoleRequestData::fromRequest($request->validated());
        $rolesPaginated = $getAllRolesAction($validatedRequest);

        return view('admin.pages.roles.index', [
            'roles' => $rolesPaginated->data,
            'pagination' => $rolesPaginated->pagination,
        ]);
    }

    public function create()
    {
        return view('admin.pages.roles.create');
    }

    public function store(StoreRoleRequest $request, CreateRoleAction $createRoleAction)
    {
        $role = RoleFormData::fromRequest($request->validated());
        $createRoleAction($role);

        return to_route('roles.index');
    }

    public function edit(int $id, FindRoleAction $findRoleAction)
    {
        $role = $findRoleAction($id);

        return view('admin.pages.roles.edit', compact('role'));
    }

    public function update(
        int $id,
        StoreRoleRequest $request,
        UpdateRoleAction $updateRoleAction
    ) {
        $role = RoleFormData::fromRequest($request->validated());
        $updateRoleAction($id, $role);

        return to_route('roles.index');
    }

    public function show(int $id, FindRoleAction $findRoleAction)
    {
        $role = $findRoleAction($id);

        return view('admin.pages.roles.show', compact('role'));
    }

    public function destroy(int $id, DeleteRoleAction $deleteRoleAction)
    {
        $deleteRoleAction($id);

        return to_route('roles.index');
    }

    public function search(SearchRoleRequest $request, SearchRoleAction $searchRoleAction)
    {
        $validatedRequest = SearchRoleRequestData::fromRequest($request->validated());
        $rolesPaginated = $searchRoleAction($validatedRequest);

        return view('admin.pages.roles.index', [
            'roles' => $rolesPaginated->data,
            'pagination' => $rolesPaginated->pagination,
        ]);
    }
}
