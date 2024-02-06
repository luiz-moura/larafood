<?php

namespace Interfaces\Http\Authentication\Controllers;

use Application\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Authentication\Requests\LoginRequest;
use Domains\Authentication\Actions\AuthenticateAction;
use Domains\Authentication\Actions\DestroyAuthentication;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request, AuthenticateAction $authenticateAction)
    {
        $authenticateAction($request);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function destroy(Request $request, DestroyAuthentication $destroyAuthentication)
    {
        $destroyAuthentication($request);

        return redirect()->route('login');
    }
}
