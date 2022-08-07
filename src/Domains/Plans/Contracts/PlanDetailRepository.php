<?php

namespace Domains\Plans\Contracts;

use Domains\Plans\DataTransferObjects\IndexPlanDetailsPaginationData;
use Domains\Plans\DataTransferObjects\PlanDetailsData;
use Domains\Plans\DataTransferObjects\PlanDetailsPaginatedData;

interface PlanDetailRepository
{
    public function create(PlanDetailsData $planDetailsData): bool;
    public function delete(int $planDetailId): bool;
    public function update(int $planDetailId, PlanDetailsData $planDetailsData): bool;
    public function findById(int $planDetailId): PlanDetailsData;
    public function getByPlanIdPaginated(int $planId, IndexPlanDetailsPaginationData $indexPlanDetailsPaginationData): PlanDetailsPaginatedData;
    public function checkIfDetailDoesNotBelongToPlan(string $planUrl, int $planDetailId): bool;
}
