<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\ACL\Profiles\Contracts\ProfileRepository as ProfileRepositoryContract;
use Domains\ACL\Profiles\DataTransferObjects\ProfileData;
use Domains\ACL\Profiles\DataTransferObjects\ProfilePaginatedData;
use Infrastructure\Persistence\Eloquent\Models\Profile;
use Infrastructure\Shared\AbstractRepository;
use Interfaces\Http\Profiles\DataTransferObjects\IndexProfileRequestData;
use Interfaces\Http\Profiles\DataTransferObjects\ProfileFormData;
use Interfaces\Http\Profiles\DataTransferObjects\SearchProfileRequestData;

class ProfileRepository extends AbstractRepository implements ProfileRepositoryContract
{
    protected $modelClass = Profile::class;

    public function findById(int $id, array $with = []): ProfileData
    {
        return ProfileData::fromArray(
            $this->model->with($with)->findOrFail($id)->toArray()
        );
    }

    public function create(ProfileFormData $formData): bool
    {
        return (bool) $this->model->create($formData->toArray());
    }

    public function update(int $id, ProfileFormData $formData): bool
    {
        return (bool) $this->model->findOrFail($id)->update($formData->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function attachPermissionsInProfile(int $profileId, array $permissions): bool
    {
        return (bool) $this->model->findOrFail($profileId)->permissions()->attach($permissions);
    }

    public function detachProfilePermission(int $profileId, int $permissionId): bool
    {
        return (bool) $this->model->findOrFail($profileId)->permissions()->detach($permissionId);
    }

    public function getAll(IndexProfileRequestData $paginationData, array $with = []): ProfilePaginatedData
    {
        $profiles = $this->model
            ->select()
            ->with($with)
            ->orderBy($paginationData->order, $paginationData->sort)
            ->paginate($paginationData->per_page, $paginationData->page);

        return ProfilePaginatedData::fromPaginator($profiles);
    }

    public function getAllByPermission(
        int $permissionId,
        IndexProfileRequestData $paginationData,
        array $with = []
    ): ProfilePaginatedData {
        $profiles = $this->model
            ->select()
            ->with($with)
            ->whereHas('permissions', fn ($query) => $query->where('permissions.id', $permissionId))
            ->orderBy($paginationData->order, $paginationData->sort)
            ->paginate($paginationData->per_page, $paginationData->page);

        return ProfilePaginatedData::fromPaginator($profiles);
    }

    public function queryByNameAndDescription(SearchProfileRequestData $paginationData, array $with = []): ProfilePaginatedData
    {
        $profiles = $this->model
            ->select()
            ->with($with)
            ->where(function ($query) use ($paginationData) {
                $query->where('name', 'ilike', "%{$paginationData->filter}%")
                    ->orWhere('description', 'ilike', "%{$paginationData->filter}%");
            })
            ->orderBy($paginationData->order, $paginationData->sort)
            ->paginate($paginationData->per_page, $paginationData->page);

        return ProfilePaginatedData::fromPaginator($profiles);
    }

    public function getAllByPlan(
        int $planId,
        IndexProfileRequestData $paginationData,
        array $with = []
    ): ProfilePaginatedData {
        $profiles = $this->model
            ->select()
            ->with($with)
            ->whereHas('plans', fn ($query) => $query->where('plans.id', $planId))
            ->orderBy($paginationData->order, $paginationData->sort)
            ->paginate($paginationData->per_page, $paginationData->page);

        return ProfilePaginatedData::fromPaginator($profiles);
    }

    public function queryByPlan(
        int $planId,
        SearchProfileRequestData $paginationData,
        array $with = []
    ): ProfilePaginatedData {
        $profiles = $this->model
            ->select()
            ->with($with)
            ->whereHas('plans', fn ($query) => $query->where('plans.id', $planId))
            ->where(function ($query) use ($paginationData) {
                $query->where('name', 'ilike', "%{$paginationData->filter}%")
                    ->orWhere('description', 'ilike', "%{$paginationData->filter}%");
            })
            ->orderBy($paginationData->order, $paginationData->sort)
            ->paginate($paginationData->per_page, $paginationData->page);

        return ProfilePaginatedData::fromPaginator($profiles);
    }

    public function queryAvailableByPlan(
        int $planId,
        SearchProfileRequestData $paginationData,
        array $with = []
    ): ProfilePaginatedData {
        $profiles = $this->model
            ->select()
            ->with($with)
            ->whereDoesntHave('plans', fn ($query) => $query->where('plans.id', $planId))
            ->where(function ($query) use ($paginationData) {
                $query->where('name', 'ilike', "%{$paginationData->filter}%")
                    ->orWhere('description', 'ilike', "%{$paginationData->filter}%");
            })
            ->orderBy($paginationData->order, $paginationData->sort)
            ->paginate($paginationData->per_page, $paginationData->page);

        return ProfilePaginatedData::fromPaginator($profiles);
    }

    public function getAllAvailableByPlan(
        int $planId,
        IndexProfileRequestData $paginationData,
        array $with = []
    ): ProfilePaginatedData {
        $profiles = $this->model
            ->select()
            ->with($with)
            ->whereDoesntHave('plans', fn ($query) => $query->where('plans.id', $planId))
            ->orderBy($paginationData->order, $paginationData->sort)
            ->paginate($paginationData->per_page, $paginationData->page);

        return ProfilePaginatedData::fromPaginator($profiles);
    }
}
