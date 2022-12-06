<?php

namespace Domains\Products\DataTransferObjects;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Infrastructure\Shared\DataTransferObject;

class ProductPaginatedData extends DataTransferObject
{
    public ?ProductCollection $items;
    public LengthAwarePaginator $paginated;
    public View $links;

    public static function fromPaginator(LengthAwarePaginator $paginated): self
    {
        return new self(
            items: ProductCollection::fromModelCollection($paginated->getCollection()),
            links: $paginated->withQueryString()->links(),
            paginated: $paginated,
        );
    }
}
