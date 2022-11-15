<?php

namespace Support\Authentication\Actions;

use Domains\ACL\Clients\Contracts\ClientRepository;
use Domains\ACL\Clients\DataTransferObjects\ClientData;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Interfaces\Http\Api\Authentication\DataTransferObjects\AuthenticatedTokenRequestData;

class CheckClientCredentialsAction
{
    public function __construct(private ClientRepository $clientRepository)
    {
    }

    public function __invoke(AuthenticatedTokenRequestData $validatedRequest): ClientData
    {
        try {
            $client = $this->clientRepository->findByEmail($validatedRequest->email);
        } catch (ModelNotFoundException) {
            throw ValidationException::withMessages(['email' => trans('auth.failed')]);
        }

        if (!Hash::check($validatedRequest->password, $client->password)) {
            throw ValidationException::withMessages(['email' => trans('auth.failed')]);
        }

        return $client;
    }
}
