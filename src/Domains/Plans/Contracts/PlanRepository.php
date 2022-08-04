<?php

namespace Domains\Plans\Contracts;

use Domains\Plans\DataTransferObjects\IndexPlansPaginationData;
use Domains\Plans\DataTransferObjects\PlansData;
use Domains\Plans\DataTransferObjects\PlansPaginatedData;
use Domains\Plans\DataTransferObjects\SearchPlansPaginationData;

interface PlanRepository
{
    public function findByUrl(string $url): PlansData;
    public function create(PlansData $planData): bool;
    public function updateByUrl(string $url, PlansData $planData): bool;
    public function deleteByUrl(string $url): bool;
    public function queryAllWithFilterPaginated(IndexPlansPaginationData $plansPaginationData): PlansPaginatedData;
    public function searchByNameAndDescription(SearchPlansPaginationData $plansPaginationData): PlansPaginatedData;
}
