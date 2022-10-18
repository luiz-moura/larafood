<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\ACL\Roles\Contracts\RoleRepository as RoleRepositoryContract;
use Domains\ACL\Roles\DataTransferObjects\RoleData;
use Domains\ACL\Roles\DataTransferObjects\RolePaginatedData;
use Infrastructure\Persistence\Eloquent\Models\Role;
use Infrastructure\Shared\AbstractRepository;
use Interfaces\Http\Roles\DataTransferObjects\IndexRoleRequestData;
use Interfaces\Http\Roles\DataTransferObjects\RoleFormData;
use Interfaces\Http\Roles\DataTransferObjects\SearchRoleRequestData;

class RoleRepository extends AbstractRepository implements RoleRepositoryContract
{
    protected $modelClass = Role::class;

    public function findById(int $id): RoleData
    {
        return RoleData::fromArray(
            $this->model->findOrFail($id)->toArray()
        );
    }

    public function create(RoleFormData $formData): bool
    {
        return (bool) $this->model->create($formData->toArray());
    }

    public function update(int $id, RoleFormData $formData): bool
    {
        return (bool) $this->model->findOrFail($id)->update($formData->toArray());
    }

    public function delete(int $id): bool
    {
        return (bool) $this->model->findOrFail($id)->delete();
    }

    public function getAll(IndexRoleRequestData $validatedRequest): RolePaginatedData
    {
        $roles = $this->model
            ->select()
            ->when($validatedRequest->order, function ($query) use ($validatedRequest) {
                $query->orderBy($validatedRequest->order, $validatedRequest->sort);
            })
            ->latest()
            ->paginate($validatedRequest->per_page, $validatedRequest->page);

        return RolePaginatedData::fromPaginator($roles);
    }

    public function queryByNameAndDescription(SearchRoleRequestData $validatedRequest): RolePaginatedData
    {
        $roles = $this->model
            ->select()
            ->where('name', 'ilike', "%{$validatedRequest->filter}%")
            ->orWhere('description', 'ilike', "%{$validatedRequest->filter}%")
            ->latest()
            ->paginate($validatedRequest->per_page, $validatedRequest->page);

        return RolePaginatedData::fromPaginator($roles);
    }

    public function attachPermissions(int $roleId, array $permissions): bool
    {
        return (bool) $this->model->findOrFail($roleId)->permissions()->sync($permissions, false);
    }

    public function detachPermission(int $roleId, int $permissionId): bool
    {
        return (bool) $this->model->findOrFail($roleId)->permissions()->detach($permissionId);
    }
}
