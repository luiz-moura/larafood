<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\Plans\Contracts\PlanRepository as ContractsPlanRepository;
use Domains\Plans\DataTransferObjects\IndexPlansPaginationData;
use Domains\Plans\DataTransferObjects\PlansData;
use Domains\Plans\DataTransferObjects\PlansPaginatedData;
use Domains\Plans\DataTransferObjects\SearchPlansPaginationData;
use Domains\Plans\Exceptions\PlanNotFoundException;
use Infrastructure\Persistence\Eloquent\Models\Plans;
use Infrastructure\Shared\AbstractRepository;

class PlanRepository extends AbstractRepository implements ContractsPlanRepository
{
    protected $modelClass = Plans::class;

    public function create(PlansData $planData): bool
    {
        return $this->model->create($planData->except('id')->toArray());
    }

    public function findByUrl(string $url): PlansData
    {
        $plan = $this->model->firstWhere('url', $url)?->toArray();

        if (!$plan) {
            throw new PlanNotFoundException();
        }

        return new PlansData($plan);
    }

    public function deleteByUrl(string $url): bool
    {
        $plan = $this->model->firstWhere('url', $url);

        if (!$plan) {
            throw new PlanNotFoundException();
        }

        return $plan->delete();
    }

    public function updateByUrl(string $url, PlansData $planData): bool
    {
        $plan = $this->model->firstWhere('url', $url);

        if (!$plan) {
            throw new PlanNotFoundException();
        }

        return (bool) $plan->update($planData->toArray());
    }

    public function totalPlanDetailsByUrl(string $url): int
    {
        $plan = $this->model->firstWhere('url', $url);

        if (!$plan) {
            throw new PlanNotFoundException();
        }

        return $plan->details()->count();
    }

    public function queryAllWithFilterPaginated(IndexPlansPaginationData $plansPaginationData, array $with = []): PlansPaginatedData
    {
        $plans = $this->model
            ->select()
            ->with($with)
            ->when($plansPaginationData->order, function ($query) use ($plansPaginationData) {
                $query->orderBy($plansPaginationData->order, $plansPaginationData->sort);
            })
            ->latest()
            ->paginate($plansPaginationData->per_page, $plansPaginationData->page);

        return PlansPaginatedData::createFromPaginator($plans);
    }

    public function searchByNameAndDescription(SearchPlansPaginationData $plansPaginationData, array $with = []): PlansPaginatedData
    {
        $plans = $this->model
            ->select()
            ->where('name', 'ilike', "%{$plansPaginationData->filter}%")
            ->orWhere('description', 'ilike', "%{$plansPaginationData->filter}%")
            ->latest()
            ->paginate($plansPaginationData->per_page, $plansPaginationData->page);

        return PlansPaginatedData::createFromPaginator($plans);
    }
}
