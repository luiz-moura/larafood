<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\Plans\Contracts\PlanRepository as PlanRepositoryContract;
use Domains\Plans\DataTransferObjects\PlanCollection;
use Domains\Plans\DataTransferObjects\PlanData;
use Domains\Plans\DataTransferObjects\PlanPaginatedData;
use Infrastructure\Persistence\Eloquent\Models\Plan;
use Infrastructure\Shared\AbstractRepository;
use Interfaces\Http\Plans\DataTransferObjects\IndexPlanRequestData;
use Interfaces\Http\Plans\DataTransferObjects\PlanFormData;
use Interfaces\Http\Plans\DataTransferObjects\SearchPlanRequestData;

class PlanRepository extends AbstractRepository implements PlanRepositoryContract
{
    protected $modelClass = Plan::class;

    public function create(PlanFormData $formData): bool
    {
        return (bool) $this->model->create($formData->toArray());
    }

    public function updateByUrl(string $url, PlanFormData $formData): bool
    {
        return (bool) $this->model->where('url', $url)->firstOrFail()->update(
            $formData->toArray()
        );
    }

    public function deleteByUrl(string $url): bool
    {
        return $this->model->where('url', $url)->firstOrFail()->delete();
    }

    public function findByUrl(string $url): PlanData
    {
        return PlanData::fromArray(
            $this->model->where('url', $url)->firstOrFail()->toArray()
        );
    }

    public function hasTenants(string $url): bool
    {
        return $this->model->where('url', $url)->firstOrFail()->tenants()->exists();
    }

    public function attachProfilesInPlan(string $planUrl, array $profiles): bool
    {
        return (bool) $this->model->where('url', $planUrl)->firstOrFail()->profiles()->attach($profiles);
    }

    public function detachPlanProfile(string $planUrl, int $profileId): bool
    {
        return (bool) $this->model->where('url', $planUrl)->firstOrFail()->profiles()->detach($profileId);
    }

    public function getAll(array $with = []): PlanCollection
    {
        $plans = $this->model
            ->select()
            ->with($with)
            ->orderBy('price', 'ASC')
            ->get()
            ->toArray();

        return PlanCollection::fromArray($plans);
    }

    public function getAllPaginated(
        IndexPlanRequestData $paginationData,
        array $with = []
    ): PlanPaginatedData {
        $plans = $this->model
            ->select()
            ->with($with)
            ->orderBy($paginationData->order, $paginationData->sort)
            ->paginate($paginationData->per_page, $paginationData->page);

        return PlanPaginatedData::fromPaginator($plans);
    }

    public function queryByNameAndDescription(
        SearchPlanRequestData $paginationData,
        array $with = []
    ): PlanPaginatedData {
        $plans = $this->model
            ->select()
            ->with($with)
            ->where(function ($query) use ($paginationData) {
                $query->where('name', 'ilike', "%{$paginationData->filter}%")
                    ->orWhere('description', 'ilike', "%{$paginationData->filter}%");
            })
            ->orderBy($paginationData->order, $paginationData->sort)
            ->paginate($paginationData->per_page, $paginationData->page);

        return PlanPaginatedData::fromPaginator($plans);
    }

    public function getAllByProfile(
        int $profileId,
        IndexPlanRequestData $paginationData,
        array $with = []
    ): PlanPaginatedData {
        $plans = $this->model
            ->select()
            ->with($with)
            ->whereHas('profiles', fn ($query) => $query->where('profiles.id', $profileId))
            ->orderBy($paginationData->order, $paginationData->sort)
            ->paginate($paginationData->per_page, $paginationData->page);

        return PlanPaginatedData::fromPaginator($plans);
    }
}
