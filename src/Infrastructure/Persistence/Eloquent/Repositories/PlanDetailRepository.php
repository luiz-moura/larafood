<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\Plans\Contracts\PlanDetailRepository as PlanDetailRepositoryContract;
use Domains\Plans\DataTransferObjects\PlanDetailData;
use Domains\Plans\DataTransferObjects\PlanDetailPaginatedData;
use Infrastructure\Persistence\Eloquent\Models\PlanDetail;
use Infrastructure\Shared\AbstractRepository;
use Interfaces\Http\PlanDetails\DataTransferObjects\IndexPlanDetailRequestData;
use Interfaces\Http\PlanDetails\DataTransferObjects\PlanDetailFormData;

class PlanDetailRepository extends AbstractRepository implements PlanDetailRepositoryContract
{
    protected $modelClass = PlanDetail::class;

    public function create(int $planId, PlanDetailFormData $formData): bool
    {
        return (bool) $this->model->create(
            $formData->toArray() + ['plan_id' => $planId]
        );
    }

    public function update(int $id, PlanDetailFormData $formData): bool
    {
        return (bool) $this->model->findOrFail($id)->update(
            $formData->toArray()
        );
    }

    public function delete(int $id): bool
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function findById(int $id, array $withRelations = []): PlanDetailData
    {
        return PlanDetailData::fromArray(
            $this->model->with($withRelations)->findOrFail($id)->toArray()
        );
    }

    public function getAllByPlan(
        int $planId,
        IndexPlanDetailRequestData $paginationData,
        array $with = []
    ): PlanDetailPaginatedData {
        $plans = $this->model
            ->select()
            ->with($with)
            ->where('plan_id', $planId)
            ->orderBy($paginationData->order, $paginationData->sort)
            ->paginate($paginationData->per_page, $paginationData->page);

        return PlanDetailPaginatedData::fromPaginator($plans);
    }

    public function checkIfDetailDoesNotBelongToPlan(string $planUrl, int $planDetailId): bool
    {
        return $this->model->find($planDetailId)->plan->url !== $planUrl;
    }
}
