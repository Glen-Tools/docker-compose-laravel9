<?php

namespace App\Http\Middleware;

use App\Exceptions\ParameterException;
use App\Services\JwtService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JwtValid
{
    private $jwtService;

    public function __construct(JwtService $jwtService)
    {
        $this->jwtService = $jwtService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $jwt = $request->header('Authorization');

        if (str_contains($jwt, "bearer") || str_contains($jwt, "Bearer")) {
            $jwtToken = str_replace(["Bearer", "bearer", " "], "", $jwt);
        } else {
            throw new ParameterException(trans('error.unauthorized'), Response::HTTP_UNAUTHORIZED);
        }

        $this->jwtService->setUserInfoToRequest($jwtToken, $request);

        return $next($request);
    }
}
