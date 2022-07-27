<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\Plans\Contracts\PlanRepository as ContractsPlanRepository;
use Domains\Plans\DataTransferObjects\PlansPaginatedData;
use Domains\Plans\DataTransferObjects\{PlanData, PlansCollectionData, PlansPaginationData};
use Infrastructure\Persistence\Eloquent\Models\Plans;
use Infrastructure\Shared\AbstractRepository;

class PlanRepository extends AbstractRepository implements ContractsPlanRepository
{
    protected $modelClass = Plans::class;

    public function getAll(): ?array
    {
        return PlansCollectionData::createFromArray(parent::getAll());
    }

    public function create(object $plan): bool
    {
        return parent::create($plan);
    }

    public function update(int $id, object $plan): bool
    {
        return parent::update($id, $plan);
    }

    public function findByUrl(string $url): ?PlanData
    {
        $plan = $this->model->firstWhere('url', $url)?->toArray();

        if (!$plan) {
            return null;
        }

        return new PlanData($plan);
    }

    public function deleteByUrl(string $url): bool
    {
        return $this->model->where('url', $url)->delete();
    }

    public function queryAllWithFilterPaginated(PlansPaginationData $plansPaginationData, array $with = []): ?PlansPaginatedData
    {
        $plans = $this->model
            ->select()
            ->with($with)
            ->when($plansPaginationData->order, function ($query) use ($plansPaginationData) {
                $query->orderBy($plansPaginationData->order, $plansPaginationData->sort);
            })
            ->latest()
            ->paginate(1, $plansPaginationData->page);

        if (!$plans) {
            return null;
        }

        return PlansPaginatedData::createFromPaginator($plans);
    }
}
