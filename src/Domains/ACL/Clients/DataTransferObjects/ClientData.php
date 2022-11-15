<?php

namespace Domains\ACL\Clients\DataTransferObjects;

use DateTime;
use Infrastructure\Persistence\Eloquent\Models\Client;
use Infrastructure\Shared\DataTransferObject;

class ClientData extends DataTransferObject
{
    public int $id;
    public string $name;
    public string $email;
    public string $password;
    public ?DateTime $updated_at;
    public DateTime $created_at;

    public static function fromModel(Client $client): self
    {
        return new self([
            'created_at' => $client->created_at,
            'updated_at' => $client->updated_at,
        ] + $client->toArray());
    }
}
