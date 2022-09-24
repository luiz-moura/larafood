<?php

namespace Interfaces\Http\Profiles\Controllers;

use Domains\ACL\Permissions\Actions\FindPermissionAction;
use Domains\ACL\Profiles\Actions\GetAllProfilesByPermissionAction;
use Illuminate\Support\Facades\View;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Profiles\DataTransferObjects\IndexProfileRequestData;
use Interfaces\Http\Profiles\Requests\IndexProfileRequest;

class ProfilePermissionController extends Controller
{
    public function index(
        int $permissionId,
        IndexProfileRequest $request,
        FindPermissionAction $findPermissionAction,
        GetAllProfilesByPermissionAction $getAllProfilesByPermissionAction
    ) {
        $permissionData = $findPermissionAction($permissionId);

        $paginationData = IndexProfileRequestData::fromRequest($request->validated());
        $paginatedData = $getAllProfilesByPermissionAction($permissionId, $paginationData);

        return View::make('admin.pages.permissions.profiles.index', [
            'permission' => $permissionData,
            'profiles' => $paginatedData->data,
            'pagination' => $paginatedData->pagination,
        ]);
    }
}
