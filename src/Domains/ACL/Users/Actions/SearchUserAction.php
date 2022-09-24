<?php

namespace Domains\ACL\Users\Actions;

use Domains\ACL\Users\DataTransferObjects\UserPaginatedData;
use Domains\ACL\Users\Repositories\UserRepository;
use Interfaces\Http\Users\DataTransferObjects\SearchUserRequestData;

class SearchUserAction
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(SearchUserRequestData $paginationData, array $with = []): UserPaginatedData
    {
        return $this->userRepository->queryByName($paginationData, $with);
    }
}
