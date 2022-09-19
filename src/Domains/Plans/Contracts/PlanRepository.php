<?php

namespace Domains\Plans\Contracts;

use Domains\Plans\DataTransferObjects\PlanCollection;
use Domains\Plans\DataTransferObjects\PlanData;
use Domains\Plans\DataTransferObjects\PlanPaginatedData;
use Interfaces\Http\Plans\DataTransferObjects\IndexPlanRequestData;
use Interfaces\Http\Plans\DataTransferObjects\PlanFormData;
use Interfaces\Http\Plans\DataTransferObjects\SearchPlanRequestData;

interface PlanRepository
{
    public function create(PlanFormData $formData): bool;
    public function updateByUrl(string $url, PlanFormData $formData): bool;
    public function deleteByUrl(string $url): bool;
    public function findByUrl(string $url): PlanData;
    public function hasDetail(string $url): bool;
    public function attachProfilesInPlan(string $planUrl, array $profiles): bool;
    public function detachPlanProfile(string $planUrl, int $profileId): bool;
    public function getAll(array $with = []): PlanCollection;
    public function getAllPaginated(IndexPlanRequestData $paginationData, array $with = []): PlanPaginatedData;
    public function getAllByProfile(int $profileId, IndexPlanRequestData $paginationData, array $with = []): PlanPaginatedData;
    public function queryByNameAndDescription(SearchPlanRequestData $paginationData, array $with = []): PlanPaginatedData;
}
