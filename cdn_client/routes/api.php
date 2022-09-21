<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

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


Route::get('/test/{id}', function (Request $request,$id) {
    return phpinfo();
});

Route::post('/test/{id}', function (Request $request,$id) {
    $data = $request->getContent();
    $data = json_decode($data);
    $data->id=$id;
    // dd($data);

    Log::debug(print_r($data, true));
    return response()->json($data);
});

Route::post('/testjson', function (Request $request) {
    $data= $request->all();
    // dd($data);
    Cache::put("json","123456",600);
    $value = Cache::get('json');
    return response()->json($value);
});
