<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\ACL\Permissions\Contracts\PermissionRepository as PermissionRepositoryContract;
use Domains\ACL\Permissions\DataTransferObjects\PermissionData;
use Domains\ACL\Permissions\DataTransferObjects\PermissionPaginatedData;
use Infrastructure\Persistence\Eloquent\Models\Permission;
use Infrastructure\Shared\AbstractRepository;
use Interfaces\Http\Permissions\DataTransferObjects\IndexPermissionRequestData;
use Interfaces\Http\Permissions\DataTransferObjects\PermissionFormData;
use Interfaces\Http\Permissions\DataTransferObjects\SearchPermissionRequestData;

class PermissionRepository extends AbstractRepository implements PermissionRepositoryContract
{
    protected $modelClass = Permission::class;

    public function create(PermissionFormData $permissionData): bool
    {
        return (bool) $this->model->create($permissionData->toArray());
    }

    public function update(int $id, PermissionFormData $permissionData): bool
    {
        return (bool) $this->model->findOrFail($id)->update($permissionData->toArray());
    }

    public function delete(int $id): bool
    {
        return (bool) $this->model->findOrFail($id)->delete();
    }

    public function findById(int $permissionId, array $with = []): PermissionData
    {
        return PermissionData::fromArray(
            $this->model->findOrFail($permissionId)->toArray()
        );
    }

    public function getAll(IndexPermissionRequestData $paginationData, array $with = []): PermissionPaginatedData
    {
        $permissions = $this->model
            ->select()
            ->with($with)
            ->when($paginationData->order, function ($query) use ($paginationData) {
                $query->orderBy($paginationData->order, $paginationData->sort);
            })
            ->latest()
            ->paginate($paginationData->per_page, $paginationData->page);

        return PermissionPaginatedData::fromPaginator($permissions);
    }

    public function getAllByProfile(
        int $profileId,
        IndexPermissionRequestData $paginationData,
        array $with = []
    ): PermissionPaginatedData {
        $permissions = $this->model
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

        return PermissionPaginatedData::fromPaginator($permissions);
    }

    public function getAllAvailableByProfile(int $profileId, IndexPermissionRequestData $paginationData, array $with = []): PermissionPaginatedData
    {
        $permissions = $this->model
            ->select()
            ->with($with)
            ->whereDoesntHave('profiles', function ($query) use ($profileId) {
                $query->where('profiles.id', $profileId);
            })
            ->when($paginationData->order, function ($query) use ($paginationData) {
                $query->orderBy($paginationData->order, $paginationData->sort);
            })
            ->latest()
            ->paginate($paginationData->per_page, $paginationData->page);

        return PermissionPaginatedData::fromPaginator($permissions);
    }

    public function queryByNameAndDescription(SearchPermissionRequestData $paginationData, array $with = []): PermissionPaginatedData
    {
        $permissions = $this->model
            ->select()
            ->with($with)
            ->where('name', 'ilike', "%{$paginationData->filter}%")
            ->orWhere('description', 'ilike', "%{$paginationData->filter}%")
            ->when($paginationData->order, function ($query) use ($paginationData) {
                $query->orderBy($paginationData->order, $paginationData->sort);
            })
            ->latest()
            ->paginate($paginationData->per_page, $paginationData->page);

        return PermissionPaginatedData::fromPaginator($permissions);
    }

    public function queryByProfile(
        int $profileId,
        SearchPermissionRequestData $paginationData,
        array $with = []
    ): PermissionPaginatedData {
        $permissions = $this->model
            ->select()
            ->with($with)
            ->whereHas('profiles', function ($query) use ($profileId) {
                $query->where('profiles.id', $profileId);
            })
            ->where(function ($query) use ($paginationData) {
                $query->where('name', 'ilike', "%{$paginationData->filter}%")
                    ->orWhere('description', 'ilike', "%{$paginationData->filter}%");
            })
            ->when($paginationData->order, function ($query) use ($paginationData) {
                $query->orderBy($paginationData->order, $paginationData->sort);
            })
            ->latest()
            ->paginate($paginationData->per_page, $paginationData->page);

        return PermissionPaginatedData::fromPaginator($permissions);
    }

    public function queryAvailableByProfile(
        int $profileId,
        SearchPermissionRequestData $paginationData,
        array $with = []
    ): PermissionPaginatedData {
        $permissions = $this->model
            ->select()
            ->with($with)
            ->whereDoesntHave('profiles', function ($query) use ($profileId) {
                $query->where('profiles.id', $profileId);
            })
            ->where(function ($query) use ($paginationData) {
                $query->where('name', 'ilike', "%{$paginationData->filter}%")
                    ->orWhere('description', 'ilike', "%{$paginationData->filter}%");
            })
            ->when($paginationData->order, function ($query) use ($paginationData) {
                $query->orderBy($paginationData->order, $paginationData->sort);
            })
            ->latest()
            ->paginate($paginationData->per_page, $paginationData->page);

        return PermissionPaginatedData::fromPaginator($permissions);
    }
}
