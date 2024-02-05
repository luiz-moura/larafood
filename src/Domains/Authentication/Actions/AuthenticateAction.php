<?php

namespace Domains\Authentication\Actions;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthenticateAction
{
    private $request;

    public function __invoke(Request $request): void
    {
        $this->request = $request;

        self::authenticate();

        $request->session()->regenerate();
    }

    public function authenticate(): void
    {
        self::ensureIsNotRateLimited();

        if (!Auth::attempt($this->request->only('email', 'password'), $this->request->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages(['email' => trans('auth.failed')]);
        }

        RateLimiter::clear(self::throttleKey());
    }

    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts(self::throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this->request));

        $seconds = RateLimiter::availableIn(self::throttleKey());

        throw ValidationException::withMessages(['email' => trans('auth.throttle', ['seconds' => $seconds, 'minutes' => ceil($seconds / 60)])]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->request->input('email')).'|'.$this->request->ip());
    }
}
