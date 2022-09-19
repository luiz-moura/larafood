<?php

namespace Interfaces\Http\Authentication\Controllers;

use Application\Providers\RouteServiceProvider;
use Domains\ACL\Users\Actions\CreateUserAction;
use Domains\Plans\Actions\FindPlanByUrlAction;
use Domains\Tenants\Actions\CreateTenantAction;
use Illuminate\Auth\Events\Registered;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Authentication\DataTransferObjects\TenantFormData;
use Interfaces\Http\Authentication\Requests\RegisteredUserRequest;
use Interfaces\Http\Users\DataTransferObjects\UserFormData;
use Support\Authentication\Actions\AuthenticateAction;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(
        string $planUrl,
        RegisteredUserRequest $request,
        FindPlanByUrlAction $findPlanByUrlAction,
        CreateTenantAction $createTenantAction,
        CreateUserAction $createUserAction,
        AuthenticateAction $authenticateAction
    ) {
        $validatedData = $request->validated();
        $planData = $findPlanByUrlAction($planUrl);

        $formData = TenantFormData::fromRequest(
            ['name' => $validatedData['company']] + $validatedData
        );
        $tenantData = $createTenantAction($planData->id, $formData, now()->addDays(7));

        $formData = UserFormData::fromRequest($validatedData);
        $createUserAction($tenantData->id, $formData);

        $authenticateAction($request);

        event(new Registered($request->user()));

        return redirect(RouteServiceProvider::HOME);
    }
}
