<?php

namespace Domains\ACL\Profiles\Contracts;

use Domains\ACL\Profiles\DataTransferObjects\IndexProfilesPaginationData;
use Domains\ACL\Profiles\DataTransferObjects\ProfilesData;
use Domains\ACL\Profiles\DataTransferObjects\ProfilesPaginatedData;
use Domains\ACL\Profiles\DataTransferObjects\SearchProfilesPaginationData;

interface ProfileRepository
{
    public function create(ProfilesData $profileData): bool;
    public function update(int $id, ProfilesData $profileData): bool;
    public function delete(int $id): bool;
    public function findById(int $id, array $with = []): ProfilesData;
    public function getAllProfilesPaginated(IndexProfilesPaginationData $indexProfilesPaginationData, array $with = []): ProfilesPaginatedData;
    public function getAllProfilesByPermissionIdPaginated(int $permissionId, IndexProfilesPaginationData $indexProfilesPaginationData, array $with = []): ProfilesPaginatedData;
    public function searchByNameAndDescription(SearchProfilesPaginationData $filter, array $with = []): ProfilesPaginatedData;
    public function attachPermissionsInProfile(int $profileId, array $permissions): bool;
    public function detachProfilePermission(int $profileId, int $permissionId): bool;
}
