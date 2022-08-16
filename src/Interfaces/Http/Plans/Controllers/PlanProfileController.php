<?php

namespace Interfaces\Http\Plans\Controllers;

use Domains\ACL\Profiles\Actions\GetAllProfilesAvaliableForPlanAction;
use Domains\ACL\Profiles\Actions\GetAllProfilesByPlanIdPaginatedAction;
use Domains\ACL\Profiles\Actions\SearchProfileForPlanAction;
use Domains\ACL\Profiles\Actions\SearchProfilesAvaliableForPlanAction;
use Domains\ACL\Profiles\DataTransferObjects\IndexProfilesPaginationData;
use Domains\ACL\Profiles\DataTransferObjects\SearchProfilesPaginationData;
use Domains\Plans\Actions\AttachProfilesInPlanAction;
use Domains\Plans\Actions\DetachPlanProfileAction;
use Domains\Plans\Actions\FindPlanByUrlAction;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Plans\Requests\AttachProfilesRequest;
use Interfaces\Http\Profiles\Requests\IndexProfileRequest;
use Interfaces\Http\Profiles\Requests\SearchProfileRequest;

class PlanProfileController extends Controller
{
    public function index(
        string $planUrl,
        IndexProfileRequest $request,
        FindPlanByUrlAction $findPlanByUrlAction,
        GetAllProfilesByPlanIdPaginatedAction $getAllProfilesByPlanIdPaginatedAction
    ) {
        $plan = ($findPlanByUrlAction)($planUrl);

        $indexProfilePaginationData = new IndexProfilesPaginationData($request->validated());
        $profiles = ($getAllProfilesByPlanIdPaginatedAction)($plan->id, $indexProfilePaginationData);

        return View::make('admin.pages.plans.profiles.index', [
            'plan' => $plan,
            'profiles' => $profiles->data,
            'pagination' => $profiles->pagination,
        ]);
    }

    public function available(
        string $planUrl,
        IndexProfileRequest $request,
        FindPlanByUrlAction $findPlanByUrlAction,
        GetAllProfilesAvaliableForPlanAction $getAllProfilesAvaliableForPlanAction,
    ) {
        $plan = ($findPlanByUrlAction)($planUrl);

        $indexProfilePaginationData = new IndexProfilesPaginationData($request->validated());
        $profiles = ($getAllProfilesAvaliableForPlanAction)($plan->id, $indexProfilePaginationData);

        return View::make('admin.pages.plans.profiles.available', [
            'plan' => $plan,
            'profiles' => $profiles->data,
            'pagination' => $profiles->pagination,
        ]);
    }

    public function search(
        string $planUrl,
        SearchProfileRequest $request,
        FindPlanByUrlAction $findPlanByUrlAction,
        SearchProfileForPlanAction $searchProfileForPlanAction
    ) {
        $plan = ($findPlanByUrlAction)($planUrl);

        $searchProfilePaginationData = new SearchProfilesPaginationData($request->validated());
        $profiles = ($searchProfileForPlanAction)($plan->id, $searchProfilePaginationData);

        return View::make('admin.pages.plans.profiles.index', [
            'plan' => $plan,
            'profiles' => $profiles->data,
            'pagination' => $profiles->pagination,
        ]);
    }

    public function searchAvailable(
        string $planUrl,
        SearchProfileRequest $request,
        FindPlanByUrlAction $findPlanByUrlAction,
        SearchProfilesAvaliableForPlanAction $searchProfilesAvaliableForPlanAction
    ) {
        $plan = ($findPlanByUrlAction)($planUrl);

        $searchProfilePaginationData = new SearchProfilesPaginationData($request->validated());
        $profiles = ($searchProfilesAvaliableForPlanAction)($plan->id, $searchProfilePaginationData);

        return View::make('admin.pages.plans.profiles.available', [
            'plan' => $plan,
            'profiles' => $profiles->data,
            'pagination' => $profiles->pagination,
        ]);
    }

    public function attachProfiles(
        string $planUrl,
        AttachProfilesRequest $request,
        AttachProfilesInPlanAction $attachProfilesInPlanAction
    ) {
        ($attachProfilesInPlanAction)($planUrl, $request->validated()['profiles']);

        return Redirect::route('plans.profiles', $planUrl);
    }

    public function detachProfile(
        string $planUrl,
        int $profileId,
        DetachPlanProfileAction $detachPlanProfileAction
    ) {
        ($detachPlanProfileAction)($planUrl, $profileId);

        return Redirect::route('plans.profiles', $planUrl);
    }
}
