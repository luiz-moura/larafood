<?php

namespace Interfaces\Http\Profiles\Controllers;

use Domains\ACL\Profiles\Actions\FindProfileAction;
use Domains\Plans\Actions\GetAllPlansByProfileAction;
use Illuminate\Support\Facades\View;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Plans\DataTransferObjects\IndexPlanRequestData;
use Interfaces\Http\Plans\Requests\IndexPlanRequest;

class ProfilePlanController extends Controller
{
    public function index(
        int $profileId,
        IndexPlanRequest $request,
        FindProfileAction $findProfileAction,
        GetAllPlansByProfileAction $getAllPlansByProfileAction,
    ) {
        $profileData = $findProfileAction($profileId);

        $paginationData = IndexPlanRequestData::fromRequest($request->validated());
        $paginatedData = ($getAllPlansByProfileAction)($profileId, $paginationData);

        return View::make('admin.pages.profiles.plans.index', [
            'profile' => $profileData,
            'plans' => $paginatedData->data,
            'pagination' => $paginatedData->pagination,
        ]);
    }
}
