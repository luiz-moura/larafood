<?php

namespace Domains\ACL\Users\Actions;

use Domains\ACL\Users\DataTransferObjects\SearchUsersPaginationData;
use Domains\ACL\Users\DataTransferObjects\UsersPaginatedData;
use Domains\ACL\Users\Repositories\UserRepository;

class SearchUserByNameAction
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(SearchUsersPaginationData $paginationData, array $with = []): UsersPaginatedData
    {
        return $this->userRepository->searchByName($paginationData, $with);
    }
}
