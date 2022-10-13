<?php

namespace Domains\Tables\Actions;

use Domains\Tables\Contracts\TableRepository;
use Domains\Tables\DataTransferObjects\TableData;
use Interfaces\Http\Tables\DataTransferObjects\TableFormData;

class CreateTableAction
{
    public function __construct(private TableRepository $tableRepository)
    {
    }

    public function __invoke(int $tenantId, TableFormData $formData): TableData
    {
        return $this->tableRepository->create($tenantId, $formData);
    }
}
