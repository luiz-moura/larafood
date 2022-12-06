<?php

namespace Domains\Tables\Actions;

use Domains\Tables\Contracts\TableRepository;
use Domains\Tables\DataTransferObjects\TableData;

class FindTableByIdentifyActionAndTenantUuid
{
    public function __construct(private TableRepository $tableRepository)
    {
    }

    public function __invoke(string $identify, string $companyToken): TableData
    {
        return $this->tableRepository->findByIdentifyAndTenantUuid($identify, $companyToken);
    }
}
