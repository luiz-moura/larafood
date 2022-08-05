<?php

namespace Domains\Plans\DataTransferObjects;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Infrastructure\Shared\DataTransferObject;

class PlansPaginatedData extends DataTransferObject
{
    public PlansCollection $plans;
    public int $total;
    public ?View $pagination;

    public static function createFromArray(array $paginated): self
    {
        return new self([
            'plans' => PlansCollection::createFromArray($paginated['data']),
            'total' => $paginated['total']
        ]);
    }

    public static function createFromPaginator(LengthAwarePaginator $paginated): self
    {
        return new self([
            'plans' => PlansCollection::createFromArray($paginated->toArray()['data']),
            'total' => $paginated->total(),
            'pagination' => $paginated->withQueryString()->links()
        ]);
    }
}
