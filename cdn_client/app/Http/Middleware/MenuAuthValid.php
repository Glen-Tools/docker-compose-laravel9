<?php

namespace App\Http\Middleware;

use App\Exceptions\ParameterException;
use App\Services\AuthorizationService;
use App\Services\JwtService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class MenuAuthValid
{

    private $jwtService;
    private $authorizationService;

    public function __construct(
        JwtService $jwtService,
        AuthorizationService $authorizationService
    ) {
        $this->jwtService = $jwtService;
        $this->authorizationService = $authorizationService;
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
        $controllerMethod = $this->authorizationService->getControllerFunc($request);
        $authRouteMenuComparison = $this->authorizationService->getAuthRouteMenuComparison();

        $userInfo = $this->jwtService->getUserInfoByRequest($request);
        $userMenu = collect($this->authorizationService->getUserMenu($userInfo->getId()));
        $validMenuAuth = false;

        $userMenu->each(function ($item) use (&$validMenuAuth, $authRouteMenuComparison, $controllerMethod) {
            if (isset($authRouteMenuComparison[$controllerMethod]) && $item->key == $authRouteMenuComparison[$controllerMethod]) {
                $validMenuAuth = true;
                return false;
            }
        });

        if (!$validMenuAuth) {
            throw new ParameterException(trans('error.user_authority_insufficinet'), Response::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
