<?php

namespace Interfaces\Http\Api\Authentication\Controllers;

use Domains\ACL\Clients\Actions\CreateClientAction;
use Illuminate\Http\Request;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Api\Authentication\DataTransferObjects\ClientRequestData;
use Interfaces\Http\Api\Authentication\Requests\StoreClientRequest;
use Interfaces\Http\Api\Authentication\Resources\ClientResource;

class RegisteredClientController extends Controller
{
    public function store(
        StoreClientRequest $request,
        CreateClientAction $createClientAction
    ) {
        $clientRequest = ClientRequestData::fromRequest($request->validated());
        $client = $createClientAction($clientRequest);

        return new ClientResource($client);
    }

    public function me(Request $request)
    {
        return ClientResource::make($request->user());
    }
}
