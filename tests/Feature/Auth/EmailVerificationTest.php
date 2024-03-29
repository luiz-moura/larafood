<?php

use Application\Providers\RouteServiceProvider;
use Database\Factories\UserFactory;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;

beforeEach(function () {
    $this->user = UserFactory::new()->create([
        'email_verified_at' => null,
    ]);
});

test('email verification screen can be rendered', function () {
    $response = $this->actingAs($this->user)->get('/verify-email');

    $response->assertStatus(Response::HTTP_OK);
});

test('email can be verified', function () {
    Event::fake();

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $this->user->id, 'hash' => sha1($this->user->email)]
    );

    $response = $this->actingAs($this->user)->get($verificationUrl);

    Event::assertDispatched(Verified::class);
    expect($this->user->fresh()->hasVerifiedEmail())->toBeTrue();
    $response->assertRedirect(RouteServiceProvider::HOME.'?verified=1');
});

test('email is not verified with invalid hash', function () {
    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $this->user->id, 'hash' => sha1('wrong-email')]
    );

    $this->actingAs($this->user)->get($verificationUrl);

    expect($this->user->fresh()->hasVerifiedEmail())->toBeFalse();
});
