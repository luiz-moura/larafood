<?php

namespace Interfaces\Http\Api\Authentication\Controllers;

use Illuminate\Http\Request;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Api\Authentication\DataTransferObjects\AuthenticatedTokenRequestData;
use Interfaces\Http\Api\Authentication\Requests\AuthenticatedTokenRequest;
use Interfaces\Http\Api\Authentication\Resources\AuthenticatedResource;
use stdClass;
use Support\Authentication\Actions\CheckClientCredentialsAction;
use Support\Authentication\Actions\GenerateClientTokenAction;

class AuthenticatedTokenController extends Controller
{
    public function store(
        AuthenticatedTokenRequest $request,
        CheckClientCredentialsAction $checkClientCredentialsAction,
        GenerateClientTokenAction $generateClientTokenAction
    ) {
        $validatedRequest = AuthenticatedTokenRequestData::fromRequest($request->validated());
        $client = $checkClientCredentialsAction($validatedRequest);

        $token = $generateClientTokenAction($client->id, $validatedRequest->deviceName);

        $dto = new stdClass();
        $dto->email = $client->email;
        $dto->token = $token;

        return AuthenticatedResource::make($dto);
    }

    public function destroy(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->noContent();
    }
}
