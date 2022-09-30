<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\OpenApi(
 *  @OA\Info(
 *      title="CDN API",
 *      version="1.0.0",
 *      description="CDN Swagger Api Document",
 *      @OA\Contact(
 *          email="gary.shih@wvt.com.tw, linda.lin@wvt.com.tw"
 *      )
 *  ),
 *  @OA\Server(
 *      description="local",
 *      url="http://localhost:8023"
 *  ),
 *  @OA\Server(
 *      description="Swagger-doc App API",
 *      url="http://localhost:8023"
 *  ),
 *  @OA\PathItem(
 *      path="/"
 *  ),
 *   @OA\Components(
 *     @OA\SecurityScheme(
 *        securityScheme="Authorization",
 *        in="header",
 *        type="http",
 *        scheme="bearer",
 *        name="Authorization"
 *      )
 *   )
 * )
 */

//swagger 網址
//http://localhost:8023/api/documentation

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
