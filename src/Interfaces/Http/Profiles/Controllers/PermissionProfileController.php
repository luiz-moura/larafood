<?php

namespace Interfaces\Http\Profiles\Controllers;

use Domains\ACL\Permissions\Actions\GetAllPermissionsAvaliableForProfileAction;
use Domains\ACL\Permissions\Actions\GetAllPermissionsByProfileIdPaginatedAction;
use Domains\ACL\Permissions\DataTransferObjects\IndexPermissionsPaginationData;
use Domains\ACL\Permissions\DataTransferObjects\SearchPermissionsPaginationData;
use Domains\ACL\Profiles\Actions\AttachPermissionsInProfileAction;
use Domains\ACL\Profiles\Actions\DetachProfilePermissionAction;
use Domains\ACL\Profiles\Actions\FindProfileByIdAction;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Permissions\Requests\IndexPermissionRequest;
use Interfaces\Http\Permissions\Requests\SearchPermissionRequest;
use Interfaces\Http\Profiles\Requests\AttachPermissionsInProfileRequest;

class PermissionProfileController extends Controller
{
    public function index(
        int $profileId,
        IndexPermissionRequest $request,
        FindProfileByIdAction $findProfileByIdAction,
        GetAllPermissionsByProfileIdPaginatedAction $getAllPermissionsByProfileIdPaginatedAction
    ) {
        $profile = ($findProfileByIdAction)($profileId);

        $indexProfilePaginationData = new IndexPermissionsPaginationData($request->validated());
        $permissions = ($getAllPermissionsByProfileIdPaginatedAction)($profileId, $indexProfilePaginationData);

        return View::make('admin.pages.profiles.permissions.index', [
            'profile' => $profile,
            'permissions' => $permissions->data,
            'pagination' => $permissions->pagination,
        ]);
    }

    public function available(
        int $profileId,
        IndexPermissionRequest $request,
        FindProfileByIdAction $findProfileByIdAction,
        GetAllPermissionsAvaliableForProfileAction $getAllPermissionsAvaliableForProfileAction
    ) {
        $profile = ($findProfileByIdAction)($profileId);

        $indexProfilePaginationData = new IndexPermissionsPaginationData($request->validated());
        $permissions = ($getAllPermissionsAvaliableForProfileAction)($profileId, $indexProfilePaginationData);

        return View::make('admin.pages.profiles.permissions.available', [
            'profile' => $profile,
            'permissions' => $permissions->data,
            'pagination' => $permissions->pagination,
        ]);
    }

    public function searchAvaliable(
        int $profileId,
        SearchPermissionRequest $request,
        FindProfileByIdAction $findProfileByIdAction,
        GetAllPermissionsAvaliableForProfileAction $getAllPermissionsAvaliableForProfileAction
    ) {
        $profile = ($findProfileByIdAction)($profileId);

        $searchProfilePaginationData = new SearchPermissionsPaginationData($request->validated());
        $permissions = ($getAllPermissionsAvaliableForProfileAction)($profileId, $searchProfilePaginationData);

        return View::make('admin.pages.profiles.permissions.available', [
            'profile' => $profile,
            'permissions' => $permissions->data,
            'pagination' => $permissions->pagination,
        ]);
    }

    public function attachPermissions(
        int $profileId,
        AttachPermissionsInProfileRequest $request,
        AttachPermissionsInProfileAction $attachPermissionsInProfileAction
    ) {
        ($attachPermissionsInProfileAction)($profileId, $request->validated()['permissions']);

        return Redirect::route('profiles.permissions', $profileId);
    }

    public function detachPermission(
        int $profileId,
        int $permissionId,
        DetachProfilePermissionAction $detachProfilePermissionAction
    ) {
        ($detachProfilePermissionAction)($profileId, $permissionId);

        return Redirect::route('profiles.permissions', $profileId);
    }
}
