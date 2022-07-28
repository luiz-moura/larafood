<?php

namespace Domains\Plans\Contracts;

use Domains\Plans\DataTransferObjects\{IndexPlansPaginationData, PlanData, PlansPaginatedData, SearchPlansPaginationData};

interface PlanRepository
{
    public function getAll(): ?array;
    public function findByUrl(string $url): ?PlanData;
    public function create(PlanData $plan): bool;
    public function updateByUrl(string $url, PlanData $plan): bool;
    public function deleteByUrl(string $url): bool;
    public function queryAllWithFilterPaginated(IndexPlansPaginationData $plansPaginationData): PlansPaginatedData;
    public function searchByNameAndDescription(SearchPlansPaginationData $plansPaginationData): PlansPaginatedData;
}
