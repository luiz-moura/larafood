<?php

namespace Docs\Common\Params;

use OpenApi\Attributes as OA;

class PaginationParams
{
    #[OA\Parameter(
        name: "page",
        description: "Current page",
        required: false,
        in: "query",
        schema: new OA\Schema(type: 'integer')
    )]
    public int $page = 1;

    #[OA\Parameter(
        name: "per_page",
        description: "Quantity of records per page",
        required: false,
        in: "query",
        schema: new OA\Schema(type: 'integer')
    )]
    public int $per_page = 10;

    #[OA\Parameter(
        name: "sort",
        description: "Sort records",
        required: false,
        in: "query",
        schema: new OA\Schema(type: 'string')
    )]
    public string $sort = 'asc';
}
