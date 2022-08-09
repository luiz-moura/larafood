<?php

namespace Domains\ACL\Profiles\DataTransferObjects;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Infrastructure\Shared\DataTransferObject;

class ProfilesPaginatedData extends DataTransferObject
{
    public ProfilesCollection $data;
    public int $total;
    public ?View $pagination;

    public static function createFromArray(array $paginated): self
    {
        return new self([
            'data' => ProfilesCollection::createFromArray($paginated['data']),
            'total' => $paginated['total'],
        ]);
    }

    public static function createFromPaginator(LengthAwarePaginator $paginated): self
    {
        return new self([
            'data' => ProfilesCollection::createFromArray($paginated->toArray()['data']),
            'total' => $paginated->total(),
            'pagination' => $paginated->withQueryString()->links(),
        ]);
    }
}
