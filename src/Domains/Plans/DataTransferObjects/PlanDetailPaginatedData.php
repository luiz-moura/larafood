<?php

namespace Domains\Plans\DataTransferObjects;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Infrastructure\Shared\DataTransferObject;

class PlanDetailPaginatedData extends DataTransferObject
{
    public int $total;
    public PlanDetailCollection $details;
    public ?View $pagination;

    public static function fromArray(array $paginated): self
    {
        return new self(
            details: PlanDetailCollection::fromArray($paginated['data']),
            total: $paginated['total'],
        );
    }

    public static function fromPaginator(LengthAwarePaginator $paginated): self
    {
        return new self(
            total: $paginated->total(),
            details: PlanDetailCollection::fromArray($paginated->toArray()['data']),
            pagination: $paginated->withQueryString()->links(),
        );
    }
}
