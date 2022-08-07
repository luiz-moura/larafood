<?php

namespace Interfaces\Http\Plans\Controllers;

use Domains\Plans\Actions\CreatePlanAction;
use Domains\Plans\Actions\DeletePlanByUrlAction;
use Domains\Plans\Actions\FindPlanByUrlAction;
use Domains\Plans\Actions\GetAllPlansPaginatedAction;
use Domains\Plans\Actions\SearchPlanAction;
use Domains\Plans\Actions\UpdatePlanAction;
use Domains\Plans\DataTransferObjects\IndexPlansPaginationData;
use Domains\Plans\DataTransferObjects\PlansData;
use Domains\Plans\DataTransferObjects\SearchPlansPaginationData;
use Domains\Plans\Exceptions\CannotDeletePlanWithDetailsException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Infrastructure\Shared\Controller;
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
        $plansPaginationData = new IndexPlansPaginationData($request->validated());
        $plansPaginatedData = ($getAllPlansPaginatedAction)($plansPaginationData);

        return View::make('admin.pages.plans.index', [
            'plans' => $plansPaginatedData->plans,
            'pagination' => $plansPaginatedData->pagination,
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
        $planData = PlansData::createFromArray($planRequest->validated());
        $success = ($createPlanAction)($planData);

        return Redirect::route('plans.index')->with('stored', $success);
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
        try {
            $success = ($deletePlanByUrlAction)($url);
        } catch (CannotDeletePlanWithDetailsException) {
            Session::flash('alert', [
                'type' => 'danger',
                'message' => 'Não é possível excluir um plano que possua detalhes',
            ]);

            return Redirect::route('plans.show', $url);
        }

        return Redirect::route('plans.index')->with('destroyed', $success);
    }

    public function edit(
        string $url,
        FindPlanByUrlAction $findPlanByUrlAction,
    ) {
        $plan = ($findPlanByUrlAction)($url);

        return View::make('admin.pages.plans.edit', compact('plan'));
    }

    public function update(
        string $url,
        UpdatePlanRequest $request,
        UpdatePlanAction $updatePlanAction
    ) {
        $planData = PlansData::createFromArray($request->validated());
        $success = ($updatePlanAction)($url, $planData);

        return Redirect::route('plans.index')->with('updated', $success);
    }

    public function search(
        SearchPlanRequest $request,
        SearchPlanAction $searchPlanAction
    ) {
        $plansPaginationData = new SearchPlansPaginationData($request->validated());
        $plansPaginatedData = ($searchPlanAction)($plansPaginationData);

        return View::make('admin.pages.plans.index', [
            'plans' => $plansPaginatedData->plans,
            'pagination' => $plansPaginatedData->pagination,
        ]);
    }
}
