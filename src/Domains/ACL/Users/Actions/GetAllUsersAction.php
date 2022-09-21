<?php

namespace Domains\ACL\Users\Actions;

use Domains\ACL\Users\DataTransferObjects\IndexUsersPaginationData;
use Domains\ACL\Users\DataTransferObjects\UsersPaginatedData;
use Domains\ACL\Users\Repositories\UserRepository;

class GetAllUsersAction
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(IndexUsersPaginationData $paginationData, array $with = []): UsersPaginatedData
    {
        return $this->userRepository->getAll($paginationData, $with);
    }
}
