<?php

namespace Interfaces\Http\Profiles\Controllers;

use Domains\ACL\Permissions\Actions\FindPermissionByIdAction;
use Domains\ACL\Profiles\Actions\GetAllProfilesByPermissionIdPaginatedAction;
use Domains\ACL\Profiles\DataTransferObjects\IndexProfilesPaginationData;
use Illuminate\Support\Facades\View;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Profiles\Requests\IndexProfileRequest;

class ProfilePermissionController extends Controller
{
    public function index(
        int $permissionId,
        IndexProfileRequest $request,
        FindPermissionByIdAction $findPermissionByIdAction,
        GetAllProfilesByPermissionIdPaginatedAction $getAllProfilesByPermissionIdPaginatedAction
    ) {
        $permission = ($findPermissionByIdAction)($permissionId);

        $indexPermissionsPaginationData = new IndexProfilesPaginationData($request->validated());
        $profiles = ($getAllProfilesByPermissionIdPaginatedAction)($permissionId, $indexPermissionsPaginationData);

        return View::make('admin.pages.permissions.profiles.index', [
            'permission' => $permission,
            'profiles' => $profiles->data,
            'pagination' => $profiles->pagination,
        ]);
    }
}
