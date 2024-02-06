<?php

namespace Interfaces\Http\Api\Authentication\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

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

        if (!$companyToken || !Str::isUuid($companyToken)) {
            return response(
                ['message' => 'Company token not found in the header'],
                Response::HTTP_BAD_REQUEST
            );
        }

        $request->merge(['companyToken' => $companyToken]);

        return $next($request);
    }
}
