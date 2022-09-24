<?php

namespace Interfaces\Http\Users\Controllers;

use Domains\ACL\Users\Actions\CreateUserAction;
use Domains\ACL\Users\Actions\DeleteUserAction;
use Domains\ACL\Users\Actions\FindUserAction;
use Domains\ACL\Users\Actions\GetAllUsersAction;
use Domains\ACL\Users\Actions\SearchUserAction;
use Domains\ACL\Users\Actions\UpdateUserAction;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Users\DataTransferObjects\IndexUserRequestData;
use Interfaces\Http\Users\DataTransferObjects\SearchUserRequestData;
use Interfaces\Http\Users\DataTransferObjects\UserFormData;
use Interfaces\Http\Users\Requests\IndexUserRequest;
use Interfaces\Http\Users\Requests\SearchUserRequest;
use Interfaces\Http\Users\Requests\StoreUserRequest;
use Interfaces\Http\Users\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function index(
        IndexUserRequest $request,
        GetAllUsersAction $getAllUsersAction
    ) {
        $paginationData = IndexUserRequestData::fromRequest($request->validated());
        $paginatedData = $getAllUsersAction($paginationData);

        return view('admin.pages.users.index', [
            'users' => $paginatedData->data,
            'pagination' => $paginatedData->pagination,
        ]);
    }

    public function create()
    {
        return view('admin.pages.users.create');
    }

    public function store(StoreUserRequest $request, CreateUserAction $createUserAction)
    {
        $formData = UserFormData::fromRequest($request->validated());
        $createUserAction($request->user()->tenant_id, $formData);

        return to_route('users.index');
    }

    public function edit(int $id, FindUserAction $findUserAction)
    {
        $user = $findUserAction($id);

        return view('admin.pages.users.edit', compact('user'));
    }

    public function update(
        int $id,
        UpdateUserRequest $request,
        UpdateUserAction $updateUserAction
    ) {
        $formData = UserFormData::fromRequest($request->validated());
        $updateUserAction($id, $formData);

        return to_route('users.index');
    }

    public function show(int $id, FindUserAction $findUserAction)
    {
        $user = $findUserAction($id, with: ['tenant']);

        return view('admin.pages.users.show', compact('user'));
    }

    public function destroy(int $id, DeleteUserAction $deleteUserAction)
    {
        $deleteUserAction($id);

        return to_route('users.index');
    }

    public function search(SearchUserRequest $request, SearchUserAction $searchUserAction)
    {
        $paginationData = SearchUserRequestData::fromRequest($request->validated());
        $paginatedData = $searchUserAction($paginationData);

        return view('admin.pages.users.index', [
            'users' => $paginatedData->data,
            'pagination' => $paginatedData->pagination,
        ]);
    }
}
