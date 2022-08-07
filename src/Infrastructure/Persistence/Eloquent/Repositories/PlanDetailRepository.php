<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\Plans\Contracts\PlanDetailRepository as ContractsPlanDetailRepository;
use Domains\Plans\DataTransferObjects\IndexPlanDetailsPaginationData;
use Domains\Plans\DataTransferObjects\PlanDetailsData;
use Domains\Plans\DataTransferObjects\PlanDetailsPaginatedData;
use Domains\Plans\Exceptions\PlanDetailNotFoundException;
use Infrastructure\Persistence\Eloquent\Models\PlanDetails;
use Infrastructure\Shared\AbstractRepository;

class PlanDetailRepository extends AbstractRepository implements ContractsPlanDetailRepository
{
    protected $modelClass = PlanDetails::class;

    public function create(PlanDetailsData $planDetailsData): bool
    {
        return $this->model->create($planDetailsData->toArray());
    }

    public function update(int $planDetailId, PlanDetailsData $planDetailData): bool
    {
        $planDetail = $this->model->find($planDetailId);

        if (!$planDetail) {
            throw new PlanDetailNotFoundException();
        }

        return (bool) $planDetail->update($planDetailData->except('id')->toArray());
    }

    public function delete(int $planDetailId): bool
    {
        $planDetail = $this->model->find($planDetailId);

        if (!$planDetail) {
            throw new PlanDetailNotFoundException();
        }

        return $planDetail->delete();
    }

    public function findById(int $planDetailId): PlanDetailsData
    {
        $planDetail = $this->model->find($planDetailId);

        if (!$planDetail) {
            throw new PlanDetailNotFoundException();
        }

        return $planDetail;
    }

    public function getByPlanIdPaginated(
        int $planId,
        IndexPlanDetailsPaginationData $indexPlanDetailsPaginationData,
        array $with = []
    ): PlanDetailsPaginatedData {
        $plans = $this->model
            ->select()
            ->with($with)
            ->when($indexPlanDetailsPaginationData->order, function ($query) use ($indexPlanDetailsPaginationData) {
                $query->orderBy($indexPlanDetailsPaginationData->order, $indexPlanDetailsPaginationData->sort);
            })
            ->where('plan_id', $planId)
            ->latest()
            ->paginate($indexPlanDetailsPaginationData->per_page, $indexPlanDetailsPaginationData->page);

        return PlanDetailsPaginatedData::createFromPaginator($plans);
    }

    public function checkIfDetailDoesNotBelongToPlan(string $planUrl, int $planDetailId): bool
    {
        $planDetailModel = $this->model->find($planDetailId);

        return $planDetailModel->plan->url !== $planUrl;
    }
}
