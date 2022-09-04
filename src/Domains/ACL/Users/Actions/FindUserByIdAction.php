<?php

namespace Domains\ACL\Users\Actions;

use Domains\ACL\Users\DataTransferObjects\UsersModelData;
use Domains\ACL\Users\Repositories\UserRepository;

class FindUserByIdAction
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(int $id, array $with = []): UsersModelData
    {
        return $this->userRepository->find($id, $with);
    }
}
