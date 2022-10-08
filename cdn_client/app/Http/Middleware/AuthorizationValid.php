<?php

namespace App\Http\Middleware;

use App\Exceptions\ParameterException;
use App\Services\AuthorizationService;
use App\Services\JwtService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthorizationValid
{

    private $jwtService;
    private $authorizationService;
    private $validMenuAuth;

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
        $userInfo = $this->jwtService->getUserInfoByRequest($request);
        $userMenu = $this->authorizationService->getUserMenu($userInfo->getId());

        $route = $request->route();
        $actionName = explode('\\', $route->getActionName());

        if (empty($actionName)) {
            throw new NotFoundHttpException(trans('error.not_found'), null, Response::HTTP_NOT_FOUND);
        }

        $controllerMethod = $actionName[count($actionName)];

        $validMenuAuth = false;

        $userMenu->each(function ($item) {
            if ($item->key == [$controllerMethod]) {
                $this->validMenuAuth = true;
                return false;
            }
        });

        if (!$validMenuAuth) {
            throw new ParameterException(trans('error.user_authority_insufficinet'), Response::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
