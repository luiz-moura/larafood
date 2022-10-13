<?php

namespace Domains\Tables\Actions;

use Domains\Tables\Contracts\TableRepository;

class DeleteTableAction
{
    public function __construct(private TableRepository $tableRepository)
    {
    }

    public function __invoke(int $id): void
    {
        $this->tableRepository->delete($id);
    }
}
