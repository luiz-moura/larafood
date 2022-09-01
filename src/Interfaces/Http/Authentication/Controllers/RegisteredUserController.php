<?php

namespace Interfaces\Http\Authentication\Controllers;

use Application\Providers\RouteServiceProvider;
use DateTime;
use Domains\Tenants\Actions\CreateTenantAction;
use Domains\Tenants\DataTransferObjects\TenantsFormData;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Infrastructure\Persistence\Eloquent\Models\User;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Authentication\Requests\RegisteredUserRequest;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(
        RegisteredUserRequest $request,
        CreateTenantAction $createTenantAction
    ) {
        if (!$plan = session('plan')) {
            return redirect()->route('site.home');
        }

        $validated = $request->validated();

        $tenantFormData = new TenantsFormData([
            'plan_id' => $plan->id,
            'name' => $validated['company'],
            'expires_at' => new DateTime('now + 7 days'),
        ] + $validated);

        ($createTenantAction)($tenantFormData);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
