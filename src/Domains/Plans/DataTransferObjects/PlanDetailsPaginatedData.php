<?php

namespace Domains\Plans\DataTransferObjects;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Infrastructure\Shared\DataTransferObject;

class PlanDetailsPaginatedData extends DataTransferObject
{
    public int $total;
    public PlanDetailsCollection $details;
    public ?View $pagination;

    public static function createFromArray(array $paginated): self
    {
        return new self([
            'details' => PlanDetailsCollection::createFromArray($paginated['data']),
            'total' => $paginated['total'],
        ]);
    }

    public static function createFromPaginator(LengthAwarePaginator $paginated): self
    {
        return new self([
            'total' => $paginated->total(),
            'details' => PlanDetailsCollection::createFromArray($paginated->toArray()['data']),
            'pagination' => $paginated->withQueryString()->links(),
        ]);
    }
}
