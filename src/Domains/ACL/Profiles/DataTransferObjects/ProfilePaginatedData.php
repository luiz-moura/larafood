<?php

namespace Domains\ACL\Profiles\DataTransferObjects;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Infrastructure\Shared\DataTransferObject;

class ProfilePaginatedData extends DataTransferObject
{
    public int $total;
    public ProfileCollection $data;
    public ?View $pagination;

    public static function fromPaginator(LengthAwarePaginator $paginated): self
    {
        return new self(
            data: ProfileCollection::fromArray($paginated->toArray()['data']),
            total: $paginated->total(),
            pagination: $paginated->withQueryString()->links(),
        );
    }
}
