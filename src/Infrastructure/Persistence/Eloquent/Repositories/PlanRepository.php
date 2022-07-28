<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\Plans\Contracts\PlanRepository as ContractsPlanRepository;
use Domains\Plans\DataTransferObjects\PlansPaginatedData;
use Domains\Plans\DataTransferObjects\{IndexPlansPaginationData, PlanData, SearchPlansPaginationData};
use Domains\Plans\Exceptions\PlanNotFoundException;
use Infrastructure\Persistence\Eloquent\Models\Plans;
use Infrastructure\Shared\AbstractRepository;

class PlanRepository extends AbstractRepository implements ContractsPlanRepository
{
    protected $modelClass = Plans::class;

    public function create(object $plan): bool
    {
        return parent::create($plan);
    }

    public function findByUrl(string $url): ?PlanData
    {
        $plan = $this->model->firstWhere('url', $url)?->toArray();

        return $plan
            ? new PlanData($plan)
            : null;
    }

    public function deleteByUrl(string $url): bool
    {
        return $this->model->where('url', $url)->delete();
    }

    public function updateByUrl(string $url, PlanData $planData): bool
    {
        $plan = $this->model->firstWhere('url', $url);

        if (!$plan) {
            throw new PlanNotFoundException();
        }

        return (bool) $plan->update($planData->toArray());
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
