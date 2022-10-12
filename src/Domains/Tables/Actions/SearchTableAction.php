<?php

namespace Domains\Tables\Actions;

use Domains\Tables\Contracts\TableRepository;
use Domains\Tables\DataTransferObjects\TablePaginatedData;
use Interfaces\Http\Tables\DataTransferObjects\SearchTableRequestData;

class SearchTableAction
{
    public function __construct(private TableRepository $tableRepository)
    {
    }

    public function __invoke(SearchTableRequestData $validatedRequest): TablePaginatedData
    {
        return $this->tableRepository->queryByDescription($validatedRequest);
    }
}
