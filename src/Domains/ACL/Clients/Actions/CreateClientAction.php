<?php

namespace Domains\ACL\Clients\Actions;

use Domains\ACL\Clients\Contracts\ClientRepository;
use Domains\ACL\Clients\DataTransferObjects\ClientData;
use Interfaces\Http\Api\Authentication\DataTransferObjects\ClientRequestData;

class CreateClientAction
{
    public function __construct(private ClientRepository $clientRepository)
    {
    }

    public function __invoke(ClientRequestData $client): ClientData
    {
        return $this->clientRepository->create($client);
    }
}
