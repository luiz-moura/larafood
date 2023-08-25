<?php

namespace Interfaces\Http\Api\Authentication\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VerifyCompanyTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $companyToken = $request->header('company_token');

        if (!$companyToken) {
            return response()->status(Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $request->merge(['companyToken' => $companyToken]);

        return $next($request);
    }
}
