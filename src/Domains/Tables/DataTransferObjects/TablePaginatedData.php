<?php

namespace Domains\Tables\DataTransferObjects;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Infrastructure\Shared\DataTransferObject;

class TablePaginatedData extends DataTransferObject
{
    public TableDataCollection $items;
    public LengthAwarePaginator $paginated;
    public View $links;

    public static function fromArray(array $paginated): self
    {
        return new self(
            data: TableDataCollection::fromArray($paginated['data']),
            total: $paginated['total'],
        );
    }

    public static function fromPaginator(LengthAwarePaginator $paginated): self
    {
        return new self(
            items: TableDataCollection::fromModelCollection($paginated->getCollection()),
            links: $paginated->withQueryString()->links(),
            paginated: $paginated
        );
    }
}
