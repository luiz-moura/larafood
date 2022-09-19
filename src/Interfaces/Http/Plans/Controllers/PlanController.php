<?php

namespace Interfaces\Http\Plans\Controllers;

use Domains\Plans\Actions\CreatePlanAction;
use Domains\Plans\Actions\DeletePlanByUrlAction;
use Domains\Plans\Actions\FindPlanByUrlAction;
use Domains\Plans\Actions\GetAllPlansPaginatedAction;
use Domains\Plans\Actions\SearchPlanAction;
use Domains\Plans\Actions\UpdatePlanAction;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Plans\DataTransferObjects\IndexPlanRequestData;
use Interfaces\Http\Plans\DataTransferObjects\PlanFormData;
use Interfaces\Http\Plans\DataTransferObjects\SearchPlanRequestData;
use Interfaces\Http\Plans\Requests\IndexPlanRequest;
use Interfaces\Http\Plans\Requests\SearchPlanRequest;
use Interfaces\Http\Plans\Requests\StorePlanRequest;
use Interfaces\Http\Plans\Requests\UpdatePlanRequest;

class PlanController extends Controller
{
    public function index(
        IndexPlanRequest $request,
        GetAllPlansPaginatedAction $getAllPlansPaginatedAction
    ) {
        $paginationData = IndexPlanRequestData::fromRequest($request->validated());
        $paginatedData = $getAllPlansPaginatedAction($paginationData);

        return view('admin.pages.plans.index', [
            'plans' => $paginatedData->data,
            'pagination' => $paginatedData->pagination,
        ]);
    }

    public function create()
    {
        return view('admin.pages.plans.create');
    }

    public function store(
        StorePlanRequest $planRequest,
        CreatePlanAction $createPlanAction
    ) {
        $formData = PlanFormData::fromRequest($planRequest->validated());
        $createPlanAction($formData);

        return to_route('plans.index');
    }

    public function show(
        string $url,
        FindPlanByUrlAction $findPlanByUrlAction
    ) {
        $plan = $findPlanByUrlAction($url);

        return view('admin.pages.plans.show', compact('plan'));
    }

    public function destroy(
        string $url,
        DeletePlanByUrlAction $deletePlanByUrlAction
    ) {
        $deletePlanByUrlAction($url);

        return to_route('plans.index');
    }

    public function edit(
        string $url,
        FindPlanByUrlAction $findPlanByUrlAction,
    ) {
        $plan = $findPlanByUrlAction($url);

        return view('admin.pages.plans.edit', compact('plan'));
    }

    public function update(
        string $url,
        UpdatePlanRequest $request,
        UpdatePlanAction $updatePlanAction
    ) {
        $formData = PlanFormData::fromRequest($request->validated());
        $updatePlanAction($url, $formData);

        return to_route('plans.index');
    }

    public function search(
        SearchPlanRequest $request,
        SearchPlanAction $searchPlanAction
    ) {
        $paginationData = SearchPlanRequestData::fromRequest($request->validated());
        $paginatedData = $searchPlanAction($paginationData);

        return view('admin.pages.plans.index', [
            'plans' => $paginatedData->data,
            'pagination' => $paginatedData->pagination,
        ]);
    }
}
