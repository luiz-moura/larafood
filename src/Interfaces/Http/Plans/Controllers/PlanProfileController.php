<?php

namespace Interfaces\Http\Plans\Controllers;

use Domains\ACL\Profiles\Actions\GetAllProfilesAvailableByPlanAction;
use Domains\ACL\Profiles\Actions\GetAllProfilesByPlanAction;
use Domains\ACL\Profiles\Actions\SearchProfilesAvailableByPlanAction;
use Domains\Plans\Actions\AttachProfilesInPlanAction;
use Domains\Plans\Actions\DetachPlanProfileAction;
use Domains\Plans\Actions\FindPlanByUrlAction;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Plans\Requests\AttachProfilesRequest;
use Interfaces\Http\Profiles\DataTransferObjects\IndexProfileRequestData;
use Interfaces\Http\Profiles\DataTransferObjects\SearchProfileRequestData;
use Interfaces\Http\Profiles\Requests\IndexProfileRequest;
use Interfaces\Http\Profiles\Requests\SearchProfileRequest;

class PlanProfileController extends Controller
{
    public function index(
        string $planUrl,
        IndexProfileRequest $request,
        FindPlanByUrlAction $findPlanByUrlAction,
        GetAllProfilesByPlanAction $getAllProfilesByPlanAction
    ) {
        $planData = $findPlanByUrlAction($planUrl);

        $paginationData = IndexProfileRequestData::fromRequest($request->validated());
        $paginatedData = ($getAllProfilesByPlanAction)($planData->id, $paginationData);

        return view('admin.pages.plans.profiles.index', [
            'plan' => $planData,
            'profiles' => $paginatedData->data,
            'pagination' => $paginatedData->pagination,
        ]);
    }

    public function available(
        string $planUrl,
        IndexProfileRequest $request,
        FindPlanByUrlAction $findPlanByUrlAction,
        GetAllProfilesAvailableByPlanAction $getAllProfilesAvailableByPlanAction,
    ) {
        $planData = $findPlanByUrlAction($planUrl);

        $paginationData = IndexProfileRequestData::fromRequest($request->validated());
        $paginatedData = $getAllProfilesAvailableByPlanAction($planData->id, $paginationData);

        return view('admin.pages.plans.profiles.available', [
            'plan' => $planData,
            'profiles' => $paginatedData->data,
            'pagination' => $paginatedData->pagination,
        ]);
    }

    public function searchAvailable(
        string $planUrl,
        SearchProfileRequest $request,
        FindPlanByUrlAction $findPlanByUrlAction,
        SearchProfilesAvailableByPlanAction $searchProfilesAvailableByPlanAction
    ) {
        $planData = $findPlanByUrlAction($planUrl);

        $paginationData = SearchProfileRequestData::fromRequest($request->validated());
        $paginatedData = ($searchProfilesAvailableByPlanAction)($planData->id, $paginationData);

        return view('admin.pages.plans.profiles.available', [
            'plan' => $planData,
            'profiles' => $paginatedData->data,
            'pagination' => $paginatedData->pagination,
        ]);
    }

    public function attachProfiles(
        string $planUrl,
        AttachProfilesRequest $request,
        AttachProfilesInPlanAction $attachProfilesInPlanAction
    ) {
        $attachProfilesInPlanAction($planUrl, $request->validated()['profiles']);

        return to_route('plans.profiles', $planUrl);
    }

    public function detachProfile(
        string $planUrl,
        int $profileId,
        DetachPlanProfileAction $detachPlanProfileAction
    ) {
        $detachPlanProfileAction($planUrl, $profileId);

        return to_route('plans.profiles', $planUrl);
    }
}
