<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthMenuController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\JwtValid;
use App\Http\Middleware\BackendAuthValid;
use App\Http\Middleware\MenuAuthValid;
use App\Http\Middleware\LanguageChange;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

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
        Route::get('/test', [TestController::class, 'test']);

        Route::post('/register', [LoginController::class, 'register']);
        Route::post('/password/forgot', [LoginController::class, 'resetPassword']);
        Route::get('/register/validation/{account}', [LoginController::class, 'regValiCode']);
        Route::get('/password/validation/{account}', [LoginController::class, 'pwdValiCode']);

        Route::post('/login', [LoginController::class, 'login']);
        Route::get('/jwt', [LoginController::class, 'refreshJwtToken']);

        //jwt 權限
        Route::middleware(JwtValid::class)->group(function () {
            Route::get('/auth/menu', [AuthMenuController::class, 'getAuthMenuList']);
            Route::get('/logout', [LoginController::class, 'logout']);
            Route::get('/jwt/check', [LoginController::class, 'validToken']);

            //使用者資料(self)修改
            Route::get('/user/profile/self', [UserController::class, 'showSelfProfile']);
            Route::put('/user/profile/self', [UserController::class, 'updateSelfProfile']);
            Route::patch('/user/password/self', [UserController::class, 'updateSelfPassword']);
        });

        //jwt,後端權限(userType=1) （後端管理者使用)
        Route::middleware([JwtValid::class, BackendAuthValid::class])->group(function () {
            //取得所有 MenuList
            Route::get('/menu/all', [MenuController::class, 'getMenuAllList']);
            //取得所有 RoleList
            Route::get('/role/all', [RoleController::class, 'getRoleAllList']);
        });

        //jwt,頁面權限
        Route::middleware([JwtValid::class, MenuAuthValid::class])->group(function () {

            //後端權限(userType=1) （後端管理者使用)
            Route::middleware([BackendAuthValid::class])->group(function () {
                //CRUD user,role,menu
                Route::apiResource('user', UserController::class);
                Route::apiResource('role', RoleController::class);
                Route::apiResource('menu', MenuController::class);

                //密碼修改
                Route::patch('/user/password/{id}', [UserController::class, 'updatePassword']);

                //刪除多筆
                Route::delete('/user/multiple/ids', [UserController::class, 'destroyMultiple']);
                Route::delete('/role/multiple/ids', [RoleController::class, 'destroyMultiple']);
                Route::delete('/menu/multiple/ids', [MenuController::class, 'destroyMultiple']);
            });
        });
    });
});
