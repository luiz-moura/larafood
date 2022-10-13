<?php

namespace Domains\Tables\DataTransferObjects;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Infrastructure\Shared\DataTransferObject;

class TablePaginatedData extends DataTransferObject
{
    public int $total;
    public TableDataCollection $data;
    public ?View $pagination;

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
            data: TableDataCollection::fromModelCollection($paginated->getCollection()),
            total: $paginated->total(),
            pagination: $paginated->withQueryString()->links(),
        );
    }
}
