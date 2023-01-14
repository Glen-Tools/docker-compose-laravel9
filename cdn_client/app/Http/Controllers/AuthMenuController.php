<?php

namespace App\Http\Controllers;

use App\Services\JwtService;
use App\Services\ResponseService;
use App\Services\AuthorizationService;
use Illuminate\Http\Request;

class AuthMenuController extends Controller
{
    protected $jwtService;
    private $responseService;
    private $authorizationService;

    public function __construct(
        JwtService $jwtService,
        ResponseService $responseService,
        AuthorizationService $authorizationService
    ) {
        $this->jwtService = $jwtService;
        $this->responseService = $responseService;
        $this->authorizationService = $authorizationService;
    }

    /**
     * @OA\Get(
     *  tags={"Auth menu"},
     *  path="/api/v1/auth/menu",
     *  summary="取得菜單權限",
     *  security={{"Authorization":{}}},
     *  @OA\Response(response=200,description="OK",@OA\JsonContent(examples={"myname":@OA\Schema(ref="#/components/examples/AuthMenuList", example="AuthMenuList")})),
     *  @OA\Response(response=401,description="Unauthorized", @OA\JsonContent(ref="#/components/schemas/ResponseUnauthorized")),
     *  @OA\Response(response=500,description="Server Error",@OA\JsonContent(ref="#/components/schemas/responseError")),
     * )
     */
    public function getAuthMenuList(Request $request)
    {
        $userInfo = $this->jwtService->getUserInfoByRequest($request);
        $userMenu = collect($this->authorizationService->getUserMenu($userInfo->getId()));
        return $this->responseService->responseJson($userMenu);
    }
}
