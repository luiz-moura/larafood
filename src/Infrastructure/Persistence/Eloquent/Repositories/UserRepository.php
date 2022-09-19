<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\ACL\Users\DataTransferObjects\UserData;
use Domains\ACL\Users\DataTransferObjects\UserPaginatedData;
use Domains\ACL\Users\Repositories\UserRepository as UserRepositoryContract;
use Illuminate\Database\Query\Builder;
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
        return $this->model->tenantUser()->findOrFail($id)->update($userFormData->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->model->tenantUser()->findOrFail($id)->delete();
    }

    public function getAll(IndexUserRequestData $paginationData, array $with = []): UserPaginatedData
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

        return UserPaginatedData::fromPaginator($users);
    }

    public function queryByName(SearchUserRequestData $paginationData, array $with = []): UserPaginatedData
    {
        $users = $this->model
            ->select()
            ->with($with)
            ->tenantUser()
            ->where('name', 'ilike', "%{$paginationData->filter}%")
            ->orWhere('description', 'ilike', "%{$paginationData->filter}%")
            ->when($paginationData->order, function (Builder $query) use ($paginationData) {
                $query->orderBy($paginationData->order, $paginationData->sort);
            })
            ->latest()
            ->paginate($paginationData->per_page, $paginationData->page);

        return UserPaginatedData::fromPaginator($users);
    }
}
