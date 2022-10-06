<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\JwtValid;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use PHPUnit\TextUI\XmlConfiguration\Groups;

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

Route::post('/testjson', function (Request $request) {
    $data = $request->all();
    dd($data);
    Log::debug(print_r($data, true));
    Cache::put("json", "123456", 600);
    $value = Cache::get('json');
    return response()->json($value);
});


Route::prefix('v1')->group(function () {

    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/jwt', [LoginController::class, 'refreshJwtToken']);


    //todo group jwt驗證

    Route::middleware(JwtValid::class)->group(function () {
        //移除 create:/photos/create 頁面
        //移除 edit:/photos/{photo}/edit 頁面
        Route::resource('user', UserController::class)->except(['create', 'edit']);
        Route::resource('role', RoleController::class)->except(['create', 'edit']);
        Route::resource('menu', MenuController::class)->except(['create', 'edit']);
    });
    // Route::get('/users', function () {
    //     // Matches The "/admin/users" URL
    // })->scopeBindings();


    // Route::middleware()->group(function () {
    // Route::get('/users', function () {
    //     // Matches The "/admin/users" URL
    // })->scopeBindings();;
    // });

});
