<?php

namespace Interfaces\Http\Plans\Controllers;

use Domains\Plans\Actions\CreatePlanDetailAction;
use Domains\Plans\Actions\DeletePlanDetailById;
use Domains\Plans\Actions\FindPlanByUrlAction;
use Domains\Plans\Actions\FindPlanDetailByIdAction;
use Domains\Plans\Actions\GetPlanDetailsByPlanPaginatedAction;
use Domains\Plans\Actions\UpdatePlanDetailAction;
use Domains\Plans\DataTransferObjects\IndexPlanDetailsPaginationData;
use Domains\Plans\DataTransferObjects\PlanDetailsData;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Plans\Requests\IndexPlanDetailRequest;
use Interfaces\Http\Plans\Requests\StorePlanDetailRequest;

class PlanDetailController extends Controller
{
    public function index(
        string $planUrl,
        IndexPlanDetailRequest $request,
        FindPlanByUrlAction $findPlanByUrlAction,
        GetPlanDetailsByPlanPaginatedAction $getPlanDetailsByPlanPaginatedAction,
    ) {
        $plan = ($findPlanByUrlAction)($planUrl);

        $indexPlanDetailsPaginationData = new IndexPlanDetailsPaginationData($request->validated());
        $planDetailsPaginatedData = ($getPlanDetailsByPlanPaginatedAction)($plan->id, $indexPlanDetailsPaginationData);

        return View::make('admin.pages.plan-details.index', [
            'plan' => $plan,
            'details' => $planDetailsPaginatedData->details,
            'pagination' => $planDetailsPaginatedData->pagination,
        ]);
    }

    public function create(string $planUrl, FindPlanByUrlAction $findPlanByUrlAction)
    {
        $plan = ($findPlanByUrlAction)($planUrl);

        return View::make('admin.pages.plan-details.create', compact('plan'));
    }

    public function store(
        string $planUrl,
        StorePlanDetailRequest $request,
        FindPlanByUrlAction $findPlanByUrlAction,
        CreatePlanDetailAction $createPlanDetailAction
    ) {
        $plan = ($findPlanByUrlAction)($planUrl);

        $planDetailData = new PlanDetailsData(
            $request->validated() + ['plan_id' => $plan->id]
        );

        $created = ($createPlanDetailAction)($planDetailData);

        return Redirect::route('plan_details.index', $plan->url)
            ->with('created', $created);
    }

    public function edit(
        string $planUrl,
        int $planDetailId,
        FindPlanByUrlAction $findPlanByUrlAction,
        FindPlanDetailByIdAction $findPlanDetailByIdAction
    ) {
        $plan = ($findPlanByUrlAction)($planUrl);
        $detail = ($findPlanDetailByIdAction)($planDetailId);

        return View::make('admin.pages.plan-details.edit', compact('plan', 'detail'));
    }

    public function update(
        string $planUrl,
        int $planDetailId,
        StorePlanDetailRequest $request,
        FindPlanByUrlAction $findPlanByUrlAction,
        UpdatePlanDetailAction $updatePlanDetailAction
    ) {
        $plan = ($findPlanByUrlAction)($planUrl);

        $planDetailData = new PlanDetailsData(
            $request->validated() + ['plan_id' => $plan->id]
        );

        $updated = ($updatePlanDetailAction)($planDetailId, $planDetailData);

        return Redirect::route('plan_details.index', $plan->url)
            ->with('updated', $updated);
    }

    public function destroy(
        string $planUrl,
        int $planDetailId,
        DeletePlanDetailById $deletePlanDetailById
    ) {
        $deleted = ($deletePlanDetailById)($planUrl, $planDetailId);

        return Redirect::route('plan_details.index', $planUrl)
            ->with('deleted', $deleted);
    }

    public function show(
        string $planUrl,
        int $planDetailId,
        FindPlanByUrlAction $findPlanByUrlAction,
        FindPlanDetailByIdAction $findPlanDetailByIdAction
    ) {
        $plan = ($findPlanByUrlAction)($planUrl);
        $detail = ($findPlanDetailByIdAction)($planDetailId);

        return View::make('admin.pages.plan-details.show', compact('plan', 'detail'));
    }
}
