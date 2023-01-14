<?php

namespace App\Http\Controllers;

use App\Dto\InputUserRoleDto;
use App\Dto\InputUserSelfDto;
use App\Dto\InputUserPasswordDto;
use App\Dto\OutputUserListDto;
use App\Dto\OutputUserInfoRoleDto;
use App\Services\ResponseService;
use App\Services\UserService;
use App\Services\UtilService;
use App\Services\JwtService;
use App\Services\CacheMamageService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TestController extends BaseController
{

    private $userService;
    private $utilService;
    private $responseService;
    private $jwtService;
    protected $cacheMamageService;

    public function __construct(
        UserService $userService,
        UtilService $utilService,
        ResponseService $responseService,
        JwtService $jwtService,
        CacheMamageService $cacheMamageService
    ) {
        $this->userService = $userService;
        $this->utilService = $utilService;
        $this->responseService = $responseService;
        $this->jwtService = $jwtService;
        $this->cacheMamageService = $cacheMamageService;
    }

    public function test(Request $request)
    {

        var_dump((!empty($_SERVER["proxy_add_x_forwarded_for"])) ? "proxy_add_x_forwarded_for:" . $_SERVER["proxy_add_x_forwarded_for"] : "proxy_add_x_forwarded_for:empty");
        var_dump((!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) ? "HTTP_X_FORWARDED_FOR:" . $_SERVER["HTTP_X_FORWARDED_FOR"] : "HTTP_X_FORWARDED_FOR:empty");
        var_dump((!empty($_SERVER["HTTP_CLIENT_IP"])) ? "HTTP_CLIENT_IP:" . $_SERVER["HTTP_CLIENT_IP"] : "HTTP_CLIENT_IP:empty");
        var_dump((!empty($_SERVER["REMOTE_ADDR"])) ? "REMOTE_ADDR:" . $_SERVER["REMOTE_ADDR"] : "REMOTE_ADDR:empty");
        var_dump((!empty(getenv('HTTP_X_FORWARDED_FOR'))) ? "HTTP_X_FORWARDED_FOR:" . (getenv('HTTP_X_FORWARDED_FOR')) : "HTTP_X_FORWARDED_FOR:empty");
        var_dump((!empty(getenv('HTTP_CLIENT_IP'))) ? "HTTP_CLIENT_IP:" . (getenv('HTTP_CLIENT_IP')) : "HTTP_CLIENT_IP:empty");
        var_dump((!empty(getenv('REMOTE_ADDR'))) ? "REMOTE_ADDR:" . (getenv('REMOTE_ADDR')) : "REMOTE_ADDR:empty");
        var_dump($request->getClientIp());
        var_dump($request->ip());
    }
}
