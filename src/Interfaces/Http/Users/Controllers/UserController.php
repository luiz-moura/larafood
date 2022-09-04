<?php

namespace Interfaces\Http\Users\Controllers;

use Domains\ACL\Users\Actions\CreateUserAction;
use Domains\ACL\Users\Actions\DeleteUserByIdAction;
use Domains\ACL\Users\Actions\FindUserByIdAction;
use Domains\ACL\Users\Actions\GetAllUsersAction;
use Domains\ACL\Users\Actions\SearchUserByNameAction;
use Domains\ACL\Users\Actions\UpdateUserAction;
use Domains\ACL\Users\DataTransferObjects\IndexUsersPaginationData;
use Domains\ACL\Users\DataTransferObjects\SearchUsersPaginationData;
use Domains\ACL\Users\DataTransferObjects\UsersFormData;
use Infrastructure\Shared\Controller;
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
        $indexUsersPaginationData = new IndexUsersPaginationData($request->validated());
        $users = ($getAllUsersAction)($indexUsersPaginationData);

        return view('admin.pages.users.index', [
            'users' => $users->data,
            'pagination' => $users->pagination,
        ]);
    }

    public function create()
    {
        return view('admin.pages.users.create');
    }

    public function store(StoreUserRequest $request, CreateUserAction $createUserAction)
    {
        $userFormData = new UsersFormData($request->validated());
        ($createUserAction)(auth()->user()->tenant_id, $userFormData);

        return to_route('users.index');
    }

    public function edit(int $id, FindUserByIdAction $findUserByIdAction)
    {
        $user = ($findUserByIdAction)($id);

        return view('admin.pages.users.edit', compact('user'));
    }

    public function update(
        int $id,
        UpdateUserRequest $request,
        UpdateUserAction $updateUserAction
    ) {
        $userFormData = new UsersFormData($request->validated());
        ($updateUserAction)($id, $userFormData);

        return to_route('users.index');
    }

    public function show(int $id, FindUserByIdAction $findUserByIdAction)
    {
        $user = ($findUserByIdAction)($id, ['tenant']);

        return view('admin.pages.users.show', compact('user'));
    }

    public function destroy(int $id, DeleteUserByIdAction $deleteUserByIdAction)
    {
        ($deleteUserByIdAction)($id);

        return to_route('users.index');
    }

    public function search(SearchUserRequest $request, SearchUserByNameAction $searchUserByName)
    {
        $searchUsersPaginationData = new SearchUsersPaginationData($request->all());

        $users = ($searchUserByName)($searchUsersPaginationData);

        return view('admin.pages.users.index', [
            'users' => $users->data,
            'pagination' => $users->pagination,
        ]);
    }
}
