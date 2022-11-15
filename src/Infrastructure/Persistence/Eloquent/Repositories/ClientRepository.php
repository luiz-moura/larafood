<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\ACL\Clients\Contracts\ClientRepository as ClientRepositoryContract;
use Domains\ACL\Clients\DataTransferObjects\ClientData;
use Infrastructure\Persistence\Eloquent\Models\Client;
use Infrastructure\Shared\AbstractRepository;
use Interfaces\Http\Api\Authentication\DataTransferObjects\ClientRequestData;

class ClientRepository extends AbstractRepository implements ClientRepositoryContract
{
    protected $modelClass = Client::class;

    public function create(ClientRequestData $requestData): ClientData
    {
        return ClientData::fromModel(
            $this->model->create($requestData->toArray())
        );
    }

    public function findByEmail(string $email): ClientData
    {
        return ClientData::fromModel(
            $this->model->where('email', $email)->firstOrFail()
        );
    }

    public function generateToken(int $id, string $deviceName): string
    {
        return $this->model->find($id)->createToken($deviceName, ['*'])->plainTextToken;
    }
}
