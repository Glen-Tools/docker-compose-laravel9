<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthorizationController;
use App\Http\Middleware\AuthorizationValid;
use App\Http\Middleware\JwtValid;
use App\Http\Middleware\LanguageChange;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {

    Route::middleware(LanguageChange::class)->group(function () {

        //test language
        Route::get('/test', function () {
        });

        Route::post('/login', [LoginController::class, 'login']);
        Route::get('/jwt', [LoginController::class, 'refreshJwtToken']);

        //jwt 登入驗證
        Route::middleware(JwtValid::class)->group(function () {
            Route::get('/auth/menu', [AuthorizationController::class, 'getAuthMenuList']);
            Route::get('/logout', [LoginController::class, 'logout']);
            Route::get('/jwt/check', [LoginController::class, 'validToken']);

            //自己(self) 密碼修改
            Route::patch('/user/password/self', [UserController::class, 'updateSelfPassword']);
        });

        //jwt 登入與頁面權限驗證
        Route::middleware([JwtValid::class, AuthorizationValid::class])->group(function () {

            //密碼修改
            Route::patch('/user/password/{id}', [UserController::class, 'updatePassword']);
            Route::apiResource('user', UserController::class);
            Route::apiResource('role', RoleController::class);
            Route::apiResource('menu', MenuController::class);
        });
    });
});
