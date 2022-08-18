<?php

namespace Interfaces\Http\Authentication\Controllers;

use Application\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Infrastructure\Shared\Controller;

class EmailVerificationPromptController extends Controller
{
    public function __invoke(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect()->intended(RouteServiceProvider::HOME)
            : view('auth.verify');
    }
}
