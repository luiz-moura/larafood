<?php

namespace Interfaces\Http\Authentication\Controllers;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Authentication\Requests\NewPasswordRequest;

class NewPasswordController extends Controller
{
    public function create(Request $request)
    {
        return view('auth.passwords.reset', [
            'request' => $request,
            'token' => $request->token,
            'email' => $request->email,
        ]);
    }

    public function store(NewPasswordRequest $request)
    {
        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => bcrypt($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return Password::PASSWORD_RESET == $status
            ? redirect()->route('login')->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }
}
