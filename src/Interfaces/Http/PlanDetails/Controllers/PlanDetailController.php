<?php

namespace Interfaces\Http\PlanDetails\Controllers;

use Domains\Plans\Actions\CreatePlanDetailAction;
use Domains\Plans\Actions\DeletePlanDetailAction;
use Domains\Plans\Actions\FindPlanByUrlAction;
use Domains\Plans\Actions\FindPlanDetailAction;
use Domains\Plans\Actions\GetAllPlanDetailsByPlanAction;
use Domains\Plans\Actions\UpdatePlanDetailAction;
use Infrastructure\Shared\Controller;
use Interfaces\Http\PlanDetails\DataTransferObjects\IndexPlanDetailRequestData;
use Interfaces\Http\PlanDetails\DataTransferObjects\PlanDetailFormData;
use Interfaces\Http\PlanDetails\Requests\IndexPlanDetailRequest;
use Interfaces\Http\PlanDetails\Requests\StorePlanDetailRequest;

class PlanDetailController extends Controller
{
    public function index(
        string $planUrl,
        IndexPlanDetailRequest $request,
        FindPlanByUrlAction $findPlanByUrlAction,
        GetAllPlanDetailsByPlanAction $getAllPlanDetailsByPlanAction,
    ) {
        $planData = $findPlanByUrlAction($planUrl);

        $paginationData = IndexPlanDetailRequestData::fromRequest($request->validated());
        $paginatedData = $getAllPlanDetailsByPlanAction($planData->id, $paginationData);

        return view('admin.pages.plans.plan-details.index', [
            'plan' => $planData,
            'details' => $paginatedData->details,
            'pagination' => $paginatedData->pagination,
        ]);
    }

    public function create(string $planUrl, FindPlanByUrlAction $findPlanByUrlAction)
    {
        $plan = $findPlanByUrlAction($planUrl);

        return view('admin.pages.plans.plan-details.create', compact('plan'));
    }

    public function store(
        string $planUrl,
        StorePlanDetailRequest $request,
        FindPlanByUrlAction $findPlanByUrlAction,
        CreatePlanDetailAction $createPlanDetailAction
    ) {
        $planData = $findPlanByUrlAction($planUrl);

        $formData = PlanDetailFormData::fromRequest($request->validated());
        $createPlanDetailAction($planData->id, $formData);

        return to_route('plan_details.index', $planData->url);
    }

    public function edit(
        string $planUrl,
        int $planDetailId,
        FindPlanDetailAction $findPlanDetailAction
    ) {
        $planDetail = $findPlanDetailAction($planDetailId, withRelations: ['plan']);

        return view('admin.pages.plans.plan-details.edit', compact('planDetail'));
    }

    public function update(
        string $planUrl,
        int $planDetailId,
        StorePlanDetailRequest $request,
        UpdatePlanDetailAction $updatePlanDetailAction
    ) {
        $planDetailData = PlanDetailFormData::fromRequest($request->validated());
        $updatePlanDetailAction($planDetailId, $planDetailData);

        return to_route('plan_details.index', $planUrl);
    }

    public function destroy(
        string $planUrl,
        int $planDetailId,
        DeletePlanDetailAction $deletePlanDetailAction
    ) {
        $deletePlanDetailAction($planUrl, $planDetailId);

        return to_route('plan_details.index', $planUrl);
    }

    public function show(
        string $planUrl,
        int $planDetailId,
        FindPlanDetailAction $findPlanDetailAction
    ) {
        $planDetail = $findPlanDetailAction($planDetailId, withRelations: ['plan']);

        return view('admin.pages.plans.plan-details.show', compact('planDetail'));
    }
}
