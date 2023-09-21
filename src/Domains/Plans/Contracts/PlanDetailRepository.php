<?php

namespace Domains\Plans\Contracts;

use Domains\Plans\DataTransferObjects\PlanDetailData;
use Domains\Plans\DataTransferObjects\PlanDetailPaginatedData;
use Interfaces\Http\PlanDetails\DataTransferObjects\IndexPlanDetailRequestData;
use Interfaces\Http\PlanDetails\DataTransferObjects\PlanDetailFormData;

interface PlanDetailRepository
{
    public function create(int $planId, PlanDetailFormData $formData): bool;
    public function update(int $id, PlanDetailFormData $formData): bool;
    public function delete(int $id): bool;
    public function findById(int $id, array $withRelations = []): PlanDetailData;
    public function getAllByPlan(int $planId, IndexPlanDetailRequestData $paginationData): PlanDetailPaginatedData;
    public function checkIfDetailDoesNotBelongToPlan(string $planUrl, int $planDetailId): bool;
}
