<?php

namespace Interfaces\Http\Authentication\Controllers;

use Application\Events\TenantCreated;
use Application\Providers\RouteServiceProvider;
use Domains\ACL\Users\Actions\CreateUserAction;
use Domains\Tenants\Actions\CreateTenantAction;
use Illuminate\Auth\Events\Registered;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Authentication\DataTransferObjects\UserTenantFormData;
use Interfaces\Http\Authentication\Requests\RegisteredUserRequest;
use Interfaces\Http\Users\DataTransferObjects\UserFormData;
use Domains\Authentication\Actions\AuthenticateAction;
use Symfony\Component\Routing\Exception\InvalidParameterException;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return session('plan')
            ? view('auth.register')
            : to_route('site.home');
    }

    public function store(
        RegisteredUserRequest $request,
        CreateTenantAction $createTenantAction,
        CreateUserAction $createUserAction,
        AuthenticateAction $authenticateAction
    ) {
        throw_if(!session('plan'), InvalidParameterException::class);

        $validatedData = $request->validated();

        $userTenantFormData = UserTenantFormData::fromRequest([
            ...$validatedData,
            'name' => $validatedData['company'],
            'expires' => now()->addDays(7),
        ]);
        $tenantData = $createTenantAction(session('plan')->id, $userTenantFormData);

        $userFormData = UserFormData::fromRequest($validatedData);
        $createUserAction($tenantData->id, $userFormData);

        $authenticateAction($request);

        session()->forget('planData');

        event(new Registered($request->user()));
        event(new TenantCreated($request->user()));

        return redirect(RouteServiceProvider::HOME);
    }
}
