<?php

namespace Domains\Tables\Actions;

use Domains\Tables\Contracts\TableRepository;
use Domains\Tables\DataTransferObjects\TableData;

class FindTableByUuidAndTenantUuidAction
{
    public function __construct(private TableRepository $tableRepository)
    {
    }

    public function __invoke(string $identify, string $companyToken): TableData
    {
        return $this->tableRepository->findByUuidAndTenantUuid($identify, $companyToken);
    }
}
