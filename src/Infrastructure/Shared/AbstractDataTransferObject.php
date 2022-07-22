<?php

namespace Infrastructure\Shared;

use Infrastructure\Contracts\DataTransferObjectContract;
use Spatie\DataTransferObject\DataTransferObject;

abstract class AbstractDataTransferObject implements DataTransferObjectContract
{
    protected $dto;

    public function __construct()
    {
        $this->dto = $this->resolveDTO();
    }

    public static function arrayOf(array $arrayOfParameters): array
    {
        return DataTransferObject::arrayOf($arrayOfParameters);
    }

    public function all(): array
    {
        return $this->dto->all();
    }

    public function toArray(): array
    {
        return $this->dto->toArray();
    }

    private function resolveDTO()
    {
        return app(DataTransferObject::class);
    }
}
