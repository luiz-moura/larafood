<?php

namespace Domains\ACL\Users\Actions;

use Domains\ACL\Users\DataTransferObjects\UserPaginatedData;
use Domains\ACL\Users\Repositories\UserRepository;
use Interfaces\Http\Users\DataTransferObjects\IndexUserRequestData;

class GetAllUsersAction
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(IndexUserRequestData $paginationData, array $with = []): UserPaginatedData
    {
        return $this->userRepository->getAll($paginationData, $with);
    }
}
