<?php

namespace Domains\ACL\Permissions\DataTransferObjects;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Infrastructure\Shared\DataTransferObject;

class PermissionsPaginatedData extends DataTransferObject
{
    public PermissionsCollection $data;
    public int $total;
    public ?View $pagination;

    public static function createFromArray(array $paginated): self
    {
        return new self([
            'data' => PermissionsCollection::createFromArray($paginated['data']),
            'total' => $paginated['total'],
        ]);
    }

    public static function createFromPaginator(LengthAwarePaginator $paginated): self
    {
        return new self([
            'data' => PermissionsCollection::createFromArray($paginated->toArray()['data']),
            'total' => $paginated->total(),
            'pagination' => $paginated->withQueryString()->links(),
        ]);
    }
}
