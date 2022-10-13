<?php

namespace Domains\Tables\Actions;

use Domains\Tables\Contracts\TableRepository;
use Domains\Tables\DataTransferObjects\TablePaginatedData;
use Interfaces\Http\Tables\DataTransferObjects\IndexTableRequestData;

class GetAllTablesAction
{
    public function __construct(private TableRepository $tableRepository)
    {
    }

    public function __invoke(IndexTableRequestData $validatedRequest): TablePaginatedData
    {
        return $this->tableRepository->getAll($validatedRequest);
    }
}
