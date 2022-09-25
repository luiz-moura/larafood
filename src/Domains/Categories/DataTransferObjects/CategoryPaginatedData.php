<?php

namespace Domains\Categories\DataTransferObjects;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Infrastructure\Shared\DataTransferObject;

class CategoryPaginatedData extends DataTransferObject
{
    public int $total;
    public CategoryCollection $data;
    public ?View $pagination;

    public static function fromArray(array $paginated): self
    {
        return new self(
            data: CategoryCollection::fromArray($paginated['data']),
            total: $paginated['total'],
        );
    }

    public static function fromPaginator(LengthAwarePaginator $paginated): self
    {
        return new self(
            data: CategoryCollection::fromModelCollection($paginated->getCollection()),
            total: $paginated->total(),
            pagination: $paginated->withQueryString()->links(),
        );
    }
}
