<?php

namespace Domains\ACL\Clients\Contracts;

use Domains\ACL\Clients\DataTransferObjects\ClientData;
use Interfaces\Http\Api\Authentication\DataTransferObjects\ClientRequestData;

interface ClientRepository
{
    public function create(ClientRequestData $requestData): ClientData;
    public function findByEmail(string $email): ClientData;
    public function generateToken(int $id, string $deviceName): string;
}
