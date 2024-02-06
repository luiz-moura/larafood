<?php

namespace Domains\ACL\Users\Actions;

use Domains\ACL\Users\Contracts\UserRepository;
use Domains\ACL\Users\DataTransferObjects\UserData;

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
