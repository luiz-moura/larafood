<?php

namespace Domains\ACL\Users\Repositories;

use Domains\ACL\Users\DataTransferObjects\UserData;
use Domains\ACL\Users\DataTransferObjects\UserPaginatedData;
use Interfaces\Http\Users\DataTransferObjects\IndexUserRequestData;
use Interfaces\Http\Users\DataTransferObjects\SearchUserRequestData;
use Interfaces\Http\Users\DataTransferObjects\UserFormData;

interface UserRepository
{
    public function create(int $tenantId, UserFormData $userFormData): UserData;
    public function find(int $id, array $with = []): UserData;
    public function update(int $id, UserFormData $userFormData): bool;
    public function delete(int $id): bool;
    public function getAll(IndexUserRequestData $paginationData, array $with = []): UserPaginatedData;
    public function queryByName(SearchUserRequestData $paginationData, array $with = []): UserPaginatedData;
}
