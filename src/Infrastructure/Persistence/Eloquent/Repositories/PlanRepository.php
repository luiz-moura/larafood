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

    public function deleteByUrl(string $url): bool
    {
        return (bool) $this->model->where('url', $url)->firstOrFail()->delete();
    }

    public function updateByUrl(string $url, PlanFormData $formData): bool
    {
        return (bool) $this->model->where('url', $url)->firstOrFail()->update(
            $formData->toArray()
        );
    }

    public function findByUrl(string $url): PlanData
    {
        return PlanData::fromArray(
            $this->model->where('url', $url)->firstOrFail()->toArray()
        );
    }

    public function hasDetail(string $url): bool
    {
        return $this->model->firstOrFail('url', $url)->details()->exists();
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
            ->when($paginationData->order, function ($query) use ($paginationData) {
                $query->orderBy($paginationData->order, $paginationData->sort);
            })
            ->latest()
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
            ->where('name', 'ilike', "%{$paginationData->filter}%")
            ->orWhere('description', 'ilike', "%{$paginationData->filter}%")
            ->when($paginationData->order, function ($query) use ($paginationData) {
                $query->orderBy($paginationData->order, $paginationData->sort);
            })
            ->latest()
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
            ->whereHas('profiles', function ($query) use ($profileId) {
                $query->where('profiles.id', $profileId);
            })
            ->when($paginationData->order, function ($query) use ($paginationData) {
                $query->orderBy($paginationData->order, $paginationData->sort);
            })
            ->latest()
            ->paginate($paginationData->per_page, $paginationData->page);

        return PlanPaginatedData::fromPaginator($plans);
    }
}
