<?php

namespace Interfaces\Http\Authentication\Controllers;

use Illuminate\Support\Facades\Password;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Authentication\Requests\PasswordResetLinkRequest;

class PasswordResetLinkController extends Controller
{
    public function create()
    {
        return view('auth.passwords.email');
    }

    public function store(PasswordResetLinkRequest $request)
    {
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return Password::RESET_LINK_SENT == $status
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }
}
