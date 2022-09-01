<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\ACL\Users\DataTransferObjects\UsersFormData;
use Domains\ACL\Users\DataTransferObjects\UsersModelData;
use Domains\ACL\Users\Repositories\UserRepository as UserRepositoryContract;
use Infrastructure\Persistence\Eloquent\Models\User;
use Infrastructure\Shared\AbstractRepository;

class UserRepository extends AbstractRepository implements UserRepositoryContract
{
    protected $modelClass = User::class;

    public function create(UsersFormData $userFormData): UsersModelData
    {
        return UsersModelData::createFromModel(
            $this->model->create($userFormData->toArray())
        );
    }
}
