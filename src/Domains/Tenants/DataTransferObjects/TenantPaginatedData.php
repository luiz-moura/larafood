<?php

namespace Domains\Tenants\DataTransferObjects;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Infrastructure\Shared\DataTransferObject;

class TenantPaginatedData extends DataTransferObject
{
    public int $total;
    public TenantDataCollection $data;
    public ?View $pagination;

    public static function fromArray(array $paginated): self
    {
        return new self(
            data: TenantDataCollection::fromArray($paginated['data']),
            total: $paginated['total'],
        );
    }

    public static function fromPaginator(LengthAwarePaginator $paginated): self
    {
        return new self(
            data: TenantDataCollection::fromModelCollection($paginated->getCollection()),
            total: $paginated->total(),
            pagination: $paginated->withQueryString()->links(),
        );
    }
}
