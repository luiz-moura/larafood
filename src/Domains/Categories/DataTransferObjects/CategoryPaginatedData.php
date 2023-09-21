<?php

namespace Domains\Categories\DataTransferObjects;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Infrastructure\Shared\DataTransferObject;

class CategoryPaginatedData extends DataTransferObject
{
    public ?CategoryCollection $items;
    public View $links;
    public LengthAwarePaginator $paginated;

    public static function fromPaginator(LengthAwarePaginator $paginated): self
    {
        return new self(
            items: CategoryCollection::fromArray($paginated->toArray()['data']),
            links: $paginated->withQueryString()->links(),
            paginated: $paginated,
        );
    }
}
