<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\ACL\Users\DataTransferObjects\UserData;
use Domains\ACL\Users\DataTransferObjects\UserPaginatedData;
use Domains\ACL\Users\Repositories\UserRepository as UserRepositoryContract;
use Infrastructure\Persistence\Eloquent\Models\User;
use Infrastructure\Shared\AbstractRepository;
use Interfaces\Http\Users\DataTransferObjects\IndexUserRequestData;
use Interfaces\Http\Users\DataTransferObjects\SearchUserRequestData;
use Interfaces\Http\Users\DataTransferObjects\UserFormData;

class UserRepository extends AbstractRepository implements UserRepositoryContract
{
    protected $modelClass = User::class;

    public function create(int $tenantId, UserFormData $userFormData): UserData
    {
        return UserData::fromModel(
            $this->model->create(
                $userFormData->toArray() + ['tenant_id' => $tenantId]
            )
        );
    }

    public function find(int $id, array $with = []): UserData
    {
        return UserData::fromModel(
            $this->model->with($with)->tenantUser()->findOrFail($id)
        );
    }

    public function update(int $id, UserFormData $userFormData): bool
    {
        return (bool) $this->model->tenantUser()
            ->findOrFail($id)
            ->update($userFormData->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->model->tenantUser()->findOrFail($id)->delete();
    }

    public function getAll(IndexUserRequestData $paginationData, array $with = []): UserPaginatedData
    {
        $users = $this->model
            ->tenantUser()
            ->select()
            ->with($with)
            ->orderBy($paginationData->order, $paginationData->sort)
            ->paginate($paginationData->per_page, $paginationData->page);

        return UserPaginatedData::fromPaginator($users);
    }

    public function queryByName(SearchUserRequestData $paginationData, array $with = []): UserPaginatedData
    {
        $users = $this->model
            ->tenantUser()
            ->select()
            ->with($with)
            ->where('name', 'ilike', "%{$paginationData->filter}%")
            ->orWhere('description', 'ilike', "%{$paginationData->filter}%")
            ->orderBy($paginationData->order, $paginationData->sort)
            ->paginate($paginationData->per_page, $paginationData->page);

        return UserPaginatedData::fromPaginator($users);
    }

    public function attachRoles(int $id, array $roles): void
    {
        $this->model->findOrFail($id)->roles()->syncWithoutDetaching($roles);
    }

    public function detachRole(int $userId, int $roleId): void
    {
        $this->model->findOrFail($userId)->roles()->detach($roleId);
    }
}
