<?php

namespace Support\Authentication\Actions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DestroyAuthentication
{
    public function __invoke(Request $request): void
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }
}
