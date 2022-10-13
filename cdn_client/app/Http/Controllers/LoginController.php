<?php

namespace App\Http\Controllers;

use App\Dto\InputLoginDto;
use App\Dto\OutputJwtDto;
use App\Dto\OutputLoginDto;
use App\Enums\JwtType;
use App\Services\JwtService;
use App\Services\LoginService;
use App\Services\ResponseService;
use App\Services\UserService;
use App\Services\UtilService;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    private $utilService;
    private $loginService;
    private $responseService;
    protected $jwtService;
    protected $userService;

    public function __construct(
        UtilService $utilService,
        LoginService $loginService,
        ResponseService $responseService,
        JwtService $jwtService,
        UserService $userService,
    ) {
        $this->utilService = $utilService;
        $this->loginService = $loginService;
        $this->responseService = $responseService;
        $this->jwtService = $jwtService;
        $this->userService = $userService;
    }

    /**
     * @OA\Post(
     *  tags={"Login"},
     *  path="/api/v1/login",
     *  summary="使用者登入(User Login)",
     *  security={{"Authorization":{}}},
     *  @OA\RequestBody(@OA\JsonContent(ref="#/components/schemas/UserLogin")),
     *  @OA\Response(response=200,description="OK",@OA\JsonContent(examples={"myname":@OA\Schema(ref="#/components/examples/RefreshJwtToken", example="RefreshJwtToken")})),
     *  @OA\Response(response=401,description="Unauthorized",@OA\JsonContent(ref="#/components/schemas/ResponseUnauthorized")),
     *  @OA\Response(response=500,description="Server Error",@OA\JsonContent(ref="#/components/schemas/responseError")),
     * )
     */
    public function login(Request $request)
    {
        //取得api data
        $data = $request->all();

        //驗證
        $this->utilService->ColumnValidator($data, [
            'account' => 'required|max:100|email:rfc,dns',
            'password' => 'required|max:100',
            'captcha' => 'max:50',
            'captchaId' => 'max:50'
        ]);

        $inputLoginDto = new InputLoginDto(
            $data["account"],
            $data["password"],
            $data["captcha"] ?? "",
            $data["captchaId"] ?? "",
        );

        $outputUserInfoDto = $this->loginService->login($inputLoginDto);

        $jwtToken = $this->jwtService->genJwtToken($outputUserInfoDto, JwtType::jwtToken);
        $refreshToken = $this->jwtService->genJwtToken($outputUserInfoDto, JwtType::jwtRefreshToken);
        //todo 有時間在做 驗證 captcha

        $outputJwtDto = new OutputJwtDto($jwtToken, $refreshToken);
        $outputLoginDto = new OutputLoginDto($outputUserInfoDto, $outputJwtDto);

        return $this->responseService->responseJson($outputLoginDto);
    }

    /**
     * @OA\Get(
     *  tags={"Jwt"},
     *  path="/api/v1/jwt",
     *  summary="更新JwtToken (RefreshJwtToken)",
     *  security={{"Authorization":{}}},
     *  @OA\Parameter(parameter="page",in="query",name="refreshtoken",required=true,description="refreshtoken",@OA\Schema(type="string")),
     *  @OA\Response(response=200,description="OK",@OA\JsonContent(examples={"myname":@OA\Schema(ref="#/components/examples/RefreshJwtToken", example="RefreshJwtToken")})),
     *  @OA\Response(response=401,description="Unauthorized", @OA\JsonContent(ref="#/components/schemas/ResponseUnauthorized")),
     *  @OA\Response(response=500,description="Server Error",@OA\JsonContent(ref="#/components/schemas/responseError")),
     * )
     */
    public function refreshJwtToken(Request $request)
    {
        //取得api data
        $data = $request->all();

        //驗證
        $this->utilService->ColumnValidator($data, [
            'refreshtoken' => 'required|max:800'
        ]);

        $data = (is_array($data)) ? (object)$data : $data;

        // $jwtToken = $this->jwtService->getJwtToken($data->refreshtoken);
        $userInfoDto = $this->jwtService->getUserInfoByRefreshJwtToken($data->refreshtoken);

        //user可能更新資訊，所以重取user 資料
        $userInfo = $this->loginService->getUserInfoByLogin($userInfoDto->email);

        $jwtToken = $this->jwtService->genJwtToken($userInfo, JwtType::jwtToken);
        $refreshToken = $this->jwtService->genJwtToken($userInfo, JwtType::jwtRefreshToken);
        $outputJwtDto = new OutputJwtDto($jwtToken, $refreshToken);
        $outputLoginDto = new OutputLoginDto($userInfo, $outputJwtDto);
        return $this->responseService->responseJson($outputLoginDto);
    }

    /**
     * @OA\Get(
     *  tags={"Jwt"},
     *  path="/api/v1/jwt/check",
     *  summary="驗證JwtToken",
     *  security={{"Authorization":{}}},
     *  @OA\Response(response=200,description="OK",@OA\JsonContent(ref="#/components/schemas/ResponseSuccess")),
     *  @OA\Response(response=401,description="Unauthorized", @OA\JsonContent(ref="#/components/schemas/ResponseUnauthorized")),
     *  @OA\Response(response=500,description="Server Error",@OA\JsonContent(ref="#/components/schemas/responseError")),
     * )
     */
    public function validToken()
    {
        return $this->responseService->responseJson();
    }

    /**
     * @OA\Get(
     *  tags={"LoginOut"},
     *  path="/api/v1/logout",
     *  summary="使用者登出 (User Logout)",
     *  security={{"Authorization":{}}},
     *  @OA\Parameter(parameter="page",in="query",name="id",required=true,description="id",@OA\Schema(type="integer")),
     *  @OA\Response(response=200,description="OK",@OA\JsonContent(examples={"myname":@OA\Schema(ref="#/components/examples/LoginOut", example="LoginOut")})),
     *  @OA\Response(response=401,description="Unauthorized", @OA\JsonContent(ref="#/components/schemas/ResponseUnauthorized")),
     *  @OA\Response(response=500,description="Server Error",@OA\JsonContent(ref="#/components/schemas/responseError")),
     * )
     */
    public function logout(Request $request)
    {
    }
}
