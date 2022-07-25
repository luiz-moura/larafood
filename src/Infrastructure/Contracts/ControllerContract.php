<?php

namespace Infrastructure\Contracts;

use Illuminate\Http\Request;

interface ControllerContract
{
    public function middleware($middleware, array $options);
    public function getMiddleware();
    public function callAction($method, $parameters);
    public function authorize($ability, $arguments);
    public function authorizeForUser($user, $ability, $arguments);
    public function authorizeResource($model, $parameter, array $options, $request);
    public function dispatchNow($job);
    public function dispatchSync($job);
    public function validateWith($validator, ?Request $request);
    public function validate(
        Request $request,
        array $rules,
        array $messages,
        array $customAttributes
    );
    public function validateWithBag(
        $errorBag,
        Request $request,
        array $rules,
        array $messages,
        array $customAttributes
    );
}
