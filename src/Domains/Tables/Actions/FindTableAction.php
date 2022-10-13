<?php

namespace Domains\Tables\Actions;

use Domains\Tables\Contracts\TableRepository;
use Domains\Tables\DataTransferObjects\TableData;

class FindTableAction
{
    public function __construct(private TableRepository $tableRepository)
    {
    }

    public function __invoke(int $id): TableData
    {
        return $this->tableRepository->find($id);
    }
}
