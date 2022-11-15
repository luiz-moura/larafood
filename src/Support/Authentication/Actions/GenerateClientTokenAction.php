<?php

namespace Support\Authentication\Actions;

use Domains\ACL\Clients\Contracts\ClientRepository;

class GenerateClientTokenAction
{
    public function __construct(private ClientRepository $clientRepository)
    {
    }

    public function __invoke(int $id, string $deviceName): string
    {
        return $this->clientRepository->generateToken($id, $deviceName);
    }
}
