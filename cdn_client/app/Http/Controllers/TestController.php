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
        $route = $request->route();
        $actionName = explode('\\', $route->getActionName());
        $controllerMethod = $actionName[count($actionName) - 1];
        var_dump($controllerMethod);
    }
}
