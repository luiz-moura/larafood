<?php

namespace Interfaces\Http\Plans\Controllers;

use Domains\Plans\Actions\{CreatePlanAction, DeletePlanByUrlAction, FindPlanByUrlAction, GetAllPlansPaginatedAction, SearchPlanAction, UpdatePlanAction};
use Domains\Plans\DataTransferObjects\{IndexPlansPaginationData, PlanData, SearchPlansPaginationData};
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\{Redirect};
use Infrastructure\Shared\Controller;
use Interfaces\Http\Plans\Requests\{IndexPlanRequest, SearchPlanRequest, StorePlanRequest, UpdatePlanRequest};

class PlanController extends Controller
{
    public function index(
        IndexPlanRequest $request,
        GetAllPlansPaginatedAction $getAllPlansPaginatedAction
    ) {
        $plansPaginationData = new IndexPlansPaginationData($request->validated());
        $plansPaginatedData = ($getAllPlansPaginatedAction)($plansPaginationData);

        return View::make('admin.pages.plans.index', [
            'plans' => $plansPaginatedData->plans,
            'pagination' => $plansPaginatedData->pagination
        ]);
    }

    public function create()
    {
        return View::make('admin.pages.plans.create');
    }

    public function store(
        StorePlanRequest $planRequest,
        CreatePlanAction $createPlanAction
    ) {
        $planData = PlanData::createFromArray($planRequest->validated());
        $success = ($createPlanAction)($planData);

        return Redirect::route('plans.index', status: Response::HTTP_CREATED)
            ->with('stored', $success);
    }

    public function show(
        string $url,
        FindPlanByUrlAction $findPlanByUrlAction
    ) {
        $plan = ($findPlanByUrlAction)($url);

        return View::make('admin.pages.plans.show', compact('plan'));
    }

    public function destroy(
        string $url,
        DeletePlanByUrlAction $deletePlanByUrlAction
    ) {
        $success = ($deletePlanByUrlAction)($url);

        return Redirect::route('plans.index', status: Response::HTTP_OK)
            ->with('destroyed', $success);
    }

    public function edit(
        string $url,
        FindPlanByUrlAction $findPlanByUrlAction,
    ) {
        $plan = ($findPlanByUrlAction)($url);

        return View::make('admin.pages.plans.edit', compact('plan'));
    }

    public function update(
        UpdatePlanRequest $request,
        string $url,
        UpdatePlanAction $updatePlanAction
    ) {
        $planData = PlanData::createFromArray($request->validated());
        $success = ($updatePlanAction)($url, $planData);

        return Redirect::route('plans.index', status: Response::HTTP_OK)
            ->with('updated', $success);
    }

    public function search(
        SearchPlanRequest $request,
        SearchPlanAction $searchPlanAction
    ) {
        $plansPaginationData = new SearchPlansPaginationData($request->validated());
        $plansPaginatedData = ($searchPlanAction)($plansPaginationData);

        return View::make('admin.pages.plans.index', [
            'plans' => $plansPaginatedData->plans,
            'pagination' => $plansPaginatedData->pagination
        ]);
    }
}
