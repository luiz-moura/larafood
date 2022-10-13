<?php

namespace Domains\Tables\Actions;

use Domains\Tables\Contracts\TableRepository;
use Interfaces\Http\Tables\DataTransferObjects\TableFormData;

class UpdateTableAction
{
    public function __construct(private TableRepository $tableRepository)
    {
    }

    public function __invoke(int $id, TableFormData $formData): void
    {
        $this->tableRepository->update($id, $formData);
    }
}
