<?php

namespace Domains\ACL\Permissions\DataTransferObjects;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Infrastructure\Shared\DataTransferObject;

class PermissionPaginatedData extends DataTransferObject
{
    public int $total;
    public PermissionCollection $data;
    public ?View $pagination;

    public static function fromPaginator(LengthAwarePaginator $paginated): self
    {
        return new self(
            data: PermissionCollection::fromArray($paginated->toArray()['data']),
            total: $paginated->total(),
            pagination: $paginated->withQueryString()->links(),
        );
    }
}
