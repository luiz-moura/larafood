<?php

namespace Domains\ACL\Users\Actions;

use Domains\ACL\Users\DataTransferObjects\UserData;
use Domains\ACL\Users\Repositories\UserRepository;

class FindUserAction
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(int $id, array $with = []): UserData
    {
        return $this->userRepository->find($id, $with);
    }
}
