<?php

namespace Domains\ACL\Users\DataTransferObjects;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Infrastructure\Shared\DataTransferObject;

class UserPaginatedData extends DataTransferObject
{
    public int $total;
    public UserCollection $data;
    public ?View $pagination;

    public static function fromArray(array $paginated): self
    {
        return new self(
            data: UserCollection::fromArray($paginated['data']),
            total: $paginated['total'],
        );
    }

    public static function fromPaginator(LengthAwarePaginator $paginated): self
    {
        return new self(
            data: UserCollection::fromArray($paginated->toArray()['data']),
            total: $paginated->total(),
            pagination: $paginated->withQueryString()->links(),
        );
    }
}
