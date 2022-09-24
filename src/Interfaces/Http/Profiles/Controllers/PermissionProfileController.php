<?php

namespace Interfaces\Http\Profiles\Controllers;

use Domains\ACL\Permissions\Actions\GetAllPermissionsAvailableByProfileAction;
use Domains\ACL\Permissions\Actions\GetAllPermissionsByProfileAction;
use Domains\ACL\Permissions\Actions\SearchPermissionsAvailableByProfileAction;
use Domains\ACL\Permissions\Actions\SearchPermissionsByProfileAction;
use Domains\ACL\Profiles\Actions\AttachPermissionsInProfileAction;
use Domains\ACL\Profiles\Actions\DetachProfilePermissionAction;
use Domains\ACL\Profiles\Actions\FindProfileAction;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Permissions\DataTransferObjects\IndexPermissionRequestData;
use Interfaces\Http\Permissions\DataTransferObjects\SearchPermissionRequestData;
use Interfaces\Http\Permissions\Requests\IndexPermissionRequest;
use Interfaces\Http\Permissions\Requests\SearchPermissionRequest;
use Interfaces\Http\Profiles\Requests\AttachPermissionsRequest;

class PermissionProfileController extends Controller
{
    public function index(
        int $profileId,
        IndexPermissionRequest $request,
        FindProfileAction $findProfileAction,
        GetAllPermissionsByProfileAction $getAllPermissionsByProfileAction
    ) {
        $profileData = $findProfileAction($profileId);

        $paginationData = IndexPermissionRequestData::fromRequest($request->validated());
        $paginatedData = $getAllPermissionsByProfileAction($profileId, $paginationData);

        return view('admin.pages.profiles.permissions.index', [
            'profile' => $profileData,
            'permissions' => $paginatedData->data,
            'pagination' => $paginatedData->pagination,
        ]);
    }

    public function available(
        int $profileId,
        IndexPermissionRequest $request,
        FindProfileAction $findProfileAction,
        GetAllPermissionsAvailableByProfileAction $getAllPermissionsAvailableByProfileAction
    ) {
        $profileData = $findProfileAction($profileId);

        $paginationData = IndexPermissionRequestData::fromRequest($request->validated());
        $paginatedData = $getAllPermissionsAvailableByProfileAction($profileId, $paginationData);

        return view('admin.pages.profiles.permissions.available', [
            'profile' => $profileData,
            'permissions' => $paginatedData->data,
            'pagination' => $paginatedData->pagination,
        ]);
    }

    public function search(
        int $profileId,
        SearchPermissionRequest $request,
        FindProfileAction $findProfileAction,
        SearchPermissionsByProfileAction $searchPermissionsByProfileAction
    ) {
        $profileData = $findProfileAction($profileId);

        $paginationData = SearchPermissionRequestData::fromRequest($request->validated());
        $paginatedData = $searchPermissionsByProfileAction($profileId, $paginationData);

        return view('admin.pages.profiles.permissions.index', [
            'profile' => $profileData,
            'permissions' => $paginatedData->data,
            'pagination' => $paginatedData->pagination,
        ]);
    }

    public function searchAvailable(
        int $profileId,
        SearchPermissionRequest $request,
        FindProfileAction $findProfileAction,
        SearchPermissionsAvailableByProfileAction $searchPermissionsAvailableByProfileAction
    ) {
        $profileData = $findProfileAction($profileId);

        $paginationData = SearchPermissionRequestData::fromRequest($request->validated());
        $paginatedData = $searchPermissionsAvailableByProfileAction($profileId, $paginationData);

        return view('admin.pages.profiles.permissions.available', [
            'profile' => $profileData,
            'permissions' => $paginatedData->data,
            'pagination' => $paginatedData->pagination,
        ]);
    }

    public function attachPermissions(
        int $profileId,
        AttachPermissionsRequest $request,
        AttachPermissionsInProfileAction $attachPermissionsInProfileAction
    ) {
        $attachPermissionsInProfileAction($profileId, $request->validated()['permissions']);

        return to_route('profiles.permissions', $profileId);
    }

    public function detachPermission(
        int $profileId,
        int $permissionId,
        DetachProfilePermissionAction $detachProfilePermissionAction
    ) {
        $detachProfilePermissionAction($profileId, $permissionId);

        return to_route('profiles.permissions', $profileId);
    }
}
