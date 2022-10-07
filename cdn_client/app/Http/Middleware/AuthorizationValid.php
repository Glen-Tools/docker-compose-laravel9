<?php

namespace App\Http\Middleware;

use App\Exceptions\ParameterException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;

class AuthorizationValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // todo write service

        //todo get auth page collection in cache
        $route = $request->route();
        // var_dump("getControllerClass()", $route->getControllerClass());
        // var_dump("methods()", $route->methods());
        // var_dump("getActionName()", $route->getActionName());
        // var_dump("getActionMethod()", $route->getActionMethod());

        // $validMenuAuth = true;

        // if (!$validMenuAuth) {
        //     throw new ParameterException(trans('error.user_authority_insufficinet'), Response::HTTP_UNAUTHORIZED);
        // }
        return $next($request);
    }
}
