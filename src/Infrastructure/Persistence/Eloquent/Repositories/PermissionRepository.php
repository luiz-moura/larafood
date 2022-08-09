<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\ACL\Permissions\Contracts\PermissionRepository as ContractsPermissionRepository;
use Domains\ACL\Permissions\DataTransferObjects\IndexPermissionsPaginationData;
use Domains\ACL\Permissions\DataTransferObjects\PermissionsData;
use Domains\ACL\Permissions\DataTransferObjects\PermissionsPaginatedData;
use Domains\ACL\Permissions\DataTransferObjects\SearchPermissionsPaginationData;
use Domains\ACL\Permissions\Exceptions\PermissionNotFoundException;
use Infrastructure\Persistence\Eloquent\Models\Permissions;
use Infrastructure\Shared\AbstractRepository;

class PermissionRepository extends AbstractRepository implements ContractsPermissionRepository
{
    protected $modelClass = Permissions::class;

    public function create(PermissionsData $permissionData): bool
    {
        return (bool) $this->model->create($permissionData->toArray());
    }

    public function update(int $permissionId, PermissionsData $permissionData): bool
    {
        $permission = $this->model->find($permissionId);

        if (!$permission) {
            throw new PermissionNotFoundException();
        }

        return (bool) $permission->update($permissionData->except('id')->toArray());
    }

    public function delete(int $permissionId): bool
    {
        $permission = $this->model->find($permissionId);

        if (!$permission) {
            throw new PermissionNotFoundException();
        }

        return $permission->delete();
    }

    public function findById(int $permissionId, array $with = []): PermissionsData
    {
        $permission = $this->model->find($permissionId)?->toArray();

        if (!$permission) {
            throw new PermissionNotFoundException();
        }

        return PermissionsData::createFromArray($permission);
    }

    public function queryAllWithFilterPaginated(IndexPermissionsPaginationData $permissionsPaginationData, array $with = []): PermissionsPaginatedData
    {
        $permissions = $this->model
            ->select()
            ->with($with)
            ->when($permissionsPaginationData->order, function ($query) use ($permissionsPaginationData) {
                $query->orderBy($permissionsPaginationData->order, $permissionsPaginationData->sort);
            })
            ->latest()
            ->paginate($permissionsPaginationData->per_page, $permissionsPaginationData->page);

        return PermissionsPaginatedData::createFromPaginator($permissions);
    }

    public function searchByNameAndDescription(SearchPermissionsPaginationData $permissionsPaginationData, array $with = []): PermissionsPaginatedData
    {
        $permissions = $this->model
            ->select()
            ->where('name', 'ilike', "%{$permissionsPaginationData->filter}%")
            ->orWhere('description', 'ilike', "%{$permissionsPaginationData->filter}%")
            ->latest()
            ->paginate($permissionsPaginationData->per_page, $permissionsPaginationData->page);

        return PermissionsPaginatedData::createFromPaginator($permissions);
    }
}
