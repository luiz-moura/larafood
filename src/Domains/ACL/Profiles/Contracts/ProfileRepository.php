<?php

namespace Domains\ACL\Profiles\Contracts;

use Domains\ACL\Profiles\DataTransferObjects\IndexProfilesPaginationData;
use Domains\ACL\Profiles\DataTransferObjects\ProfilesData;
use Domains\ACL\Profiles\DataTransferObjects\ProfilesPaginatedData;
use Domains\ACL\Profiles\DataTransferObjects\SearchProfilesPaginationData;

interface ProfileRepository
{
    public function getAllProfilesPaginated(IndexProfilesPaginationData $indexProfilesPaginationData): ProfilesPaginatedData;
    public function create(ProfilesData $profileData): bool;
    public function update(int $id, ProfilesData $profileData): bool;
    public function findById(int $id): ProfilesData;
    public function delete(int $id): bool;
    public function searchByNameAndDescription(SearchProfilesPaginationData $filter): ProfilesPaginatedData;
}
