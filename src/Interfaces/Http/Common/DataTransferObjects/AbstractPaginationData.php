<?php

namespace Interfaces\Http\Common\DataTransferObjects;

use Infrastructure\Shared\DataTransferObject;

const FIRST_PAGE = 1;
const DEFAULT_FIELD_ORDER = 'id';

abstract class AbstractPaginationData extends DataTransferObject
{
    public int $page = FIRST_PAGE;
    public string $sort;
    public int $per_page;
    public ?string $order = DEFAULT_FIELD_ORDER;

    public function __construct(array $data)
    {
        $sort = env('PAGINATION_SORT_DEFAULT');
        $per_page = (int) env('PAGINATION_PER_PAGE_DEFAULT');

        parent::__construct(...$data + [
            'sort' => $sort,
            'per_page' => $per_page,
        ]);
    }
}
