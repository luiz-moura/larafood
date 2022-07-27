<?php

namespace Domains\Shared\Pagination;

use Infrastructure\Shared\DataTransferObject;

class PaginatedData extends DataTransferObject
{
    public int $current_page;
    public array $data;
    public string $first_page_url;
    public int $from;
    public int $last_page;
    public ?string $last_page_url;
    public array $links;
    public ?string $next_page_url;
    public string $path;
    public int $per_page;
    public ?string $prev_page_url;
    public int $to;
    public int $total;

    public static function createFromArray(array $paginatedData): self
    {
        return new self([
            'current_page' => $paginatedData['current_page'],
            'data' => $paginatedData['data'],
            'first_page_url' => $paginatedData['first_page_url'],
            'from' => $paginatedData['from'],
            'last_page' => $paginatedData['last_page'],
            'last_page_url' => $paginatedData['last_page_url'],
            'next_page_url' => $paginatedData['next_page_url'],
            'path' => $paginatedData['path'],
            'per_page' => $paginatedData['per_page'],
            'prev_page_url' => $paginatedData['prev_page_url'],
            'to' => $paginatedData['to'],
            'total' => $paginatedData['total'],
            'links' => array_map(
                fn ($linkData) => new PaginatedLinkData($linkData),
                $paginatedData['links']
            ),
        ]);
    }
}
