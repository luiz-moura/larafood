<?php

namespace Domains\ACL\Roles\DataTransferObjects;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Infrastructure\Shared\DataTransferObject;

class RolePaginatedData extends DataTransferObject
{
    public int $total;
    public RoleDataCollection $data;
    public ?View $pagination;

    public static function fromPaginator(LengthAwarePaginator $paginated): self
    {
        return new self(
            data: RoleDataCollection::fromArray($paginated->toArray()['data']),
            total: $paginated->total(),
            pagination: $paginated->withQueryString()->links(),
        );
    }
}
