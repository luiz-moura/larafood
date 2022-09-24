<?php

namespace Domains\Plans\DataTransferObjects;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Infrastructure\Shared\DataTransferObject;

class PlanPaginatedData extends DataTransferObject
{
    public int $total;
    public PlanCollection $data;
    public ?View $pagination;

    public static function fromArray(array $paginated): self
    {
        return new self(
            data: PlanCollection::fromArray($paginated['data']),
            total: $paginated['total'],
        );
    }

    public static function fromPaginator(LengthAwarePaginator $paginated): self
    {
        return new self(
            data: PlanCollection::fromArray($paginated->toArray()['data']),
            total: $paginated->total(),
            pagination: $paginated->withQueryString()->links(),
        );
    }
}
