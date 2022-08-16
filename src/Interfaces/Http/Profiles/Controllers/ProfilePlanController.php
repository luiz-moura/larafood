<?php

namespace Interfaces\Http\Profiles\Controllers;

use Domains\ACL\Profiles\Actions\FindProfileByIdAction;
use Domains\Plans\Actions\GetAllPlansByProfileIdPaginatedAction;
use Domains\Plans\DataTransferObjects\IndexPlansPaginationData;
use Illuminate\Support\Facades\View;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Plans\Requests\IndexPlanRequest;

class ProfilePlanController extends Controller
{
    public function index(
        int $profileId,
        IndexPlanRequest $request,
        FindProfileByIdAction $findProfileByIdAction,
        GetAllPlansByProfileIdPaginatedAction $getAllPlansByProfileIdPaginatedAction,
    ) {
        $profile = ($findProfileByIdAction)($profileId);

        $indexProfilePaginationData = new IndexPlansPaginationData($request->validated());
        $plans = ($getAllPlansByProfileIdPaginatedAction)($profileId, $indexProfilePaginationData);

        return View::make('admin.pages.profiles.plans.index', [
            'profile' => $profile,
            'plans' => $plans->plans,
            'pagination' => $plans->pagination,
        ]);
    }
}
