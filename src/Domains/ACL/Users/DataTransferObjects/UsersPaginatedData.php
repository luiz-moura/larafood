<?php

namespace Domains\ACL\Users\DataTransferObjects;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Infrastructure\Shared\DataTransferObject;

class UsersPaginatedData extends DataTransferObject
{
    public UsersModelCollection $data;
    public int $total;
    public ?View $pagination;

    public static function createFromArray(array $paginated): self
    {
        return new self([
            'data' => UsersModelCollection::createFromArray($paginated['data']),
            'total' => $paginated['total'],
        ]);
    }

    public static function createFromPaginator(LengthAwarePaginator $paginated): self
    {
        return new self([
            'data' => UsersModelCollection::createFromModel(collect($paginated->items())),
            'total' => $paginated->total(),
            'pagination' => $paginated->withQueryString()->links(),
        ]);
    }
}
