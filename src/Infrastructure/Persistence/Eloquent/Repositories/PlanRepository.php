<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\Plans\Contracts\PlanRepository as ContractsPlanRepository;
use Domains\Plans\DataTransferObjects\IndexPlansPaginationData;
use Domains\Plans\DataTransferObjects\PlansCollection;
use Domains\Plans\DataTransferObjects\PlansData;
use Domains\Plans\DataTransferObjects\PlansPaginatedData;
use Domains\Plans\DataTransferObjects\SearchPlansPaginationData;
use Domains\Plans\Exceptions\PlanNotFoundException;
use Infrastructure\Persistence\Eloquent\Models\Plan;
use Infrastructure\Shared\AbstractRepository;

class PlanRepository extends AbstractRepository implements ContractsPlanRepository
{
    protected $modelClass = Plan::class;

    public function findByUrl(string $url): PlansData
    {
        $plan = $this->model->firstWhere('url', $url)?->toArray();

        if (!$plan) {
            throw new PlanNotFoundException();
        }

        return new PlansData($plan);
    }

    public function create(PlansData $planData): bool
    {
        return (bool) $this->model->create($planData->except('id')->toArray());
    }

    public function deleteByUrl(string $url): bool
    {
        $plan = $this->model->firstWhere('url', $url);

        if (!$plan) {
            throw new PlanNotFoundException();
        }

        return (bool) $plan->delete();
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

    public function getAll(array $with = []): PlansCollection
    {
        $plans = $this->model
            ->select()
            ->with($with)
            ->orderBy('price', 'ASC')
            ->get()
            ->toArray();

        return PlansCollection::createFromArray($plans);
    }

    public function queryAllWithFilter(
        IndexPlansPaginationData $plansPaginationData,
        array $with = []
    ): PlansPaginatedData {
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

    public function searchByNameAndDescription(
        SearchPlansPaginationData $plansPaginationData,
        array $with = []
    ): PlansPaginatedData {
        $plans = $this->model
            ->select()
            ->where('name', 'ilike', "%{$plansPaginationData->filter}%")
            ->orWhere('description', 'ilike', "%{$plansPaginationData->filter}%")
            ->latest()
            ->paginate($plansPaginationData->per_page, $plansPaginationData->page);

        return PlansPaginatedData::createFromPaginator($plans);
    }

    public function getAllForProfile(
        int $profileId,
        IndexPlansPaginationData $plansPaginationData,
        array $with = []
    ): PlansPaginatedData {
        $plans = $this->model
            ->select()
            ->with($with)
            ->whereHas('profiles', function ($query) use ($profileId) {
                $query->where('profiles.id', $profileId);
            })
            ->when($plansPaginationData->order, function ($query) use ($plansPaginationData) {
                $query->orderBy($plansPaginationData->order, $plansPaginationData->sort);
            })
            ->latest()
            ->paginate($plansPaginationData->per_page, $plansPaginationData->page);

        return PlansPaginatedData::createFromPaginator($plans);
    }

    public function attachProfilesInPlan(string $planUrl, array $profiles): bool
    {
        $plan = $this->model->firstWhere('url', $planUrl);

        if (!$plan) {
            throw new PlanNotFoundException();
        }

        return (bool) $plan->profiles()->attach($profiles);
    }

    public function detachPlanProfile(string $planUrl, int $profileId): bool
    {
        $plan = $this->model->firstWhere('url', $planUrl);

        if (!$plan) {
            throw new PlanNotFoundException();
        }

        return (bool) $plan->profiles()->detach($profileId);
    }
}
