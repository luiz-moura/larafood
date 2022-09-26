<?php

namespace Domains\Products\DataTransferObjects;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Infrastructure\Shared\DataTransferObject;

class ProductPaginatedData extends DataTransferObject
{
    public int $total;
    public ProductCollection $data;
    public ?View $pagination;

    public static function fromArray(array $paginated): self
    {
        return new self(
            data: ProductCollection::fromArray($paginated['data']),
            total: $paginated['total'],
        );
    }

    public static function fromPaginator(LengthAwarePaginator $paginated): self
    {
        return new self(
            data: ProductCollection::fromModelCollection($paginated->getCollection()),
            total: $paginated->total(),
            pagination: $paginated->withQueryString()->links(),
        );
    }
}
