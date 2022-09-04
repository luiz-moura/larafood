<?php

namespace Domains\ACL\Users\Repositories;

use Domains\ACL\Users\DataTransferObjects\IndexUsersPaginationData;
use Domains\ACL\Users\DataTransferObjects\SearchUsersPaginationData;
use Domains\ACL\Users\DataTransferObjects\UsersFormData;
use Domains\ACL\Users\DataTransferObjects\UsersModelData;
use Domains\ACL\Users\DataTransferObjects\UsersPaginatedData;

interface UserRepository
{
    public function create(int $tenantId, UsersFormData $userFormData): UsersModelData;
    public function find(int $id, array $with = []): UsersModelData;
    public function update(int $id, UsersFormData $userFormData): bool;
    public function delete(int $id): bool;
    public function searchByName(SearchUsersPaginationData $paginationData, array $with = []): UsersPaginatedData;
    public function getAll(IndexUsersPaginationData $paginationData, array $with = []): UsersPaginatedData;
}
