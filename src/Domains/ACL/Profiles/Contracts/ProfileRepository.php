<?php

namespace Domains\ACL\Profiles\Contracts;

use Domains\ACL\Profiles\DataTransferObjects\ProfileData;
use Domains\ACL\Profiles\DataTransferObjects\ProfilePaginatedData;
use Interfaces\Http\Profiles\DataTransferObjects\IndexProfileRequestData;
use Interfaces\Http\Profiles\DataTransferObjects\ProfileFormData;
use Interfaces\Http\Profiles\DataTransferObjects\SearchProfileRequestData;

interface ProfileRepository
{
    public function create(ProfileFormData $formData): bool;
    public function update(int $id, ProfileFormData $formData): bool;
    public function delete(int $id): bool;
    public function findById(int $id, array $with = []): ProfileData;
    public function attachPermissionsInProfile(int $profileId, array $permissions): bool;
    public function detachProfilePermission(int $profileId, int $permissionId): bool;
    public function getAll(IndexProfileRequestData $paginationData, array $with = []): ProfilePaginatedData;
    public function getAllByPermission(int $permissionId, IndexProfileRequestData $paginationData, array $with = []): ProfilePaginatedData;
    public function getAllByPlan(int $planId, IndexProfileRequestData $paginationData, array $with = []): ProfilePaginatedData;
    public function getAllAvailableByPlan(int $planId, IndexProfileRequestData $paginationData, array $with = []): ProfilePaginatedData;
    public function queryByPlan(int $planId, SearchProfileRequestData $paginationData, array $with = []): ProfilePaginatedData;
    public function queryAvailableByPlan(int $planId, SearchProfileRequestData $paginationData, array $with = []): ProfilePaginatedData;
    public function queryByNameAndDescription(SearchProfileRequestData $paginationData, array $with = []): ProfilePaginatedData;
}
