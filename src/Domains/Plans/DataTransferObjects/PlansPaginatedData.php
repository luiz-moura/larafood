<?php

namespace Domains\Plans\DataTransferObjects;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Infrastructure\Persistence\Eloquent\Models\Plans;
use Infrastructure\Shared\DataTransferObject;

class PlansPaginatedData extends DataTransferObject
{
    public array $plans;
    public int $total;
    public ?View $pagination;

    public static function createFromArray(array $paginated): self
    {
        return new self([
            'plans' => PlansCollectionData::createFromArray($paginated['data']),
            'total' => $paginated['total']
        ]);
    }

    public static function createFromPaginator(LengthAwarePaginator $paginated): self
    {
        return new self([
            'total' => $paginated->total(),
            'pagination' => $paginated->withQueryString()->links(),
            'plans' => array_map(
                fn (Plans $plan) => new PlanData($plan->toArray()),
                $paginated->items()
            )
        ]);
    }
}
