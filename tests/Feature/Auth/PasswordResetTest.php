<?php

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Notification;
use Infrastructure\Persistence\Eloquent\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->uri = '/forgot-password';
});

test('reset password link screen can be rendered', function () {
    $response = $this->get($this->uri);

    $response->assertStatus(Response::HTTP_OK);
});

test('reset password link can be requested', function () {
    Notification::fake();

    $this->post($this->uri, ['email' => $this->user->email]);

    Notification::assertSentTo($this->user, ResetPassword::class);
});

test('reset password screen can be rendered', function () {
    Notification::fake();

    $this->post($this->uri, ['email' => $this->user->email]);

    Notification::assertSentTo($this->user, ResetPassword::class, function ($notification) {
        $response = $this->get('/reset-password/'.$notification->token);

        $response->assertStatus(Response::HTTP_OK);

        return true;
    });
});

test('password can be reset with valid token', function () {
    Notification::fake();

    $this->post($this->uri, ['email' => $this->user->email]);

    Notification::assertSentTo($this->user, ResetPassword::class, function ($notification) {
        $response = $this->post('/reset-password', [
            'token' => $notification->token,
            'email' => $this->user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasNoErrors();

        return true;
    });
});
