<?php

namespace Domains\Tenants\DataTransferObjects;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Infrastructure\Shared\DataTransferObject;

class TenantPaginatedData extends DataTransferObject
{
    public ?TenantDataCollection $items;
    public LengthAwarePaginator $paginated;
    public View $links;

    public static function fromPaginator(LengthAwarePaginator $paginated): self
    {
        return new self(
            items: TenantDataCollection::fromArray($paginated->toArray()['data']),
            links: $paginated->withQueryString()->links(),
            paginated: $paginated
        );
    }
}
