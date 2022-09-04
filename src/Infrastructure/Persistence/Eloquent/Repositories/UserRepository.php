<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\ACL\Users\DataTransferObjects\IndexUsersPaginationData;
use Domains\ACL\Users\DataTransferObjects\SearchUsersPaginationData;
use Domains\ACL\Users\DataTransferObjects\UsersFormData;
use Domains\ACL\Users\DataTransferObjects\UsersModelData;
use Domains\ACL\Users\DataTransferObjects\UsersPaginatedData;
use Domains\ACL\Users\Repositories\UserRepository as UserRepositoryContract;
use Illuminate\Database\Query\Builder;
use Infrastructure\Persistence\Eloquent\Models\User;
use Infrastructure\Shared\AbstractRepository;

class UserRepository extends AbstractRepository implements UserRepositoryContract
{
    protected $modelClass = User::class;

    public function create(int $tenantId, UsersFormData $userFormData): UsersModelData
    {
        return UsersModelData::createFromModel(
            $this->model->create(
                $userFormData->toArray() + ['tenant_id' => $tenantId]
            )
        );
    }

    public function find(int $id, array $with = []): UsersModelData
    {
        return UsersModelData::createFromModel(
            $this->model->with($with)->tenantUser()->findOrFail($id)
        );
    }

    public function getAll(IndexUsersPaginationData $paginationData, array $with = []): UsersPaginatedData
    {
        $users = $this->model
            ->select()
            ->with($with)
            ->tenantUser()
            ->when($paginationData->order, function (Builder $query) use ($paginationData) {
                $query->orderBy($paginationData->order, $paginationData->sort);
            })
            ->latest()
            ->paginate($paginationData->per_page, $paginationData->page);

        return UsersPaginatedData::createFromPaginator($users);
    }

    public function update(int $id, UsersFormData $userFormData): bool
    {
        return $this->model->tenantUser()->findOrFail($id)->update($userFormData->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->model->tenantUser()->findOrFail($id)->delete();
    }

    public function searchByName(SearchUsersPaginationData $paginationData, array $with = []): UsersPaginatedData
    {
        $users = $this->model
            ->select()
            ->with($with)
            ->tenantUser()
            ->where('name', 'ilike', "%{$paginationData->filter}%")
            ->orWhere('description', 'ilike', "%{$paginationData->filter}%")
            ->latest()
            ->paginate($paginationData->per_page, $paginationData->page);

        return UsersPaginatedData::createFromPaginator($users);
    }
}
