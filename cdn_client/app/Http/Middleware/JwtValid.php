<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\JwtType;
use App\Services\JwtService;
use Illuminate\Http\Request;

class JwtValid
{
    private $jwtService;

    public function __construct(
        JwtService $jwtService,
    ) {
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
        $jwtToken = $this->jwtService->getJwtToken($request);

        $this->jwtService->validJwt($jwtToken, JwtType::JwtToken);

        //寫入 userId
        $this->jwtService->setUserIdToRequest($jwtToken, $request);

        return $next($request);
    }
}
