<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\UserType;
use App\Services\JwtService;
use App\Exceptions\ParameterException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BackendValid
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
        $InputUserInfoDto = $this->jwtService->getUserInfoByRequest($request);
        // 確認身份
        if (($InputUserInfoDto->getUserType() != UserType::Admin->value)) {
            throw new ParameterException(trans('error.user_authority_insufficinet'), Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
