<?php

namespace App\Http\Controllers;

use App\Dto\InputUserRoleDto;
use App\Dto\InputLoginDto;
use App\Dto\OutputJwtDto;
use App\Dto\OutputLoginDto;
use App\Dto\OutputAuthUserInfoDto;
use App\Dto\InputUserPasswordDto;
use App\Enums\JwtType;
use App\Enums\UserType;
use App\Services\JwtService;
use App\Services\LoginService;
use App\Services\ResponseService;
use App\Services\UserService;
use App\Services\UtilService;
use App\Services\CacheMamageService;
use App\Services\CacheService;
use Illuminate\Http\Request;
use App\Exceptions\ParameterException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{

    private $utilService;
    private $loginService;
    private $responseService;
    protected $jwtService;
    protected $userService;
    protected $cacheMamageService;
    private $cacheService;

    public function __construct(
        UtilService $utilService,
        LoginService $loginService,
        ResponseService $responseService,
        JwtService $jwtService,
        UserService $userService,
        CacheMamageService $cacheMamageService,
        CacheService $cacheService
    ) {
        $this->utilService = $utilService;
        $this->loginService = $loginService;
        $this->responseService = $responseService;
        $this->jwtService = $jwtService;
        $this->userService = $userService;
        $this->cacheMamageService = $cacheMamageService;
        $this->cacheService = $cacheService;
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
            'captcha' => 'max:50|nullable',
            'captchaId' => 'max:50|nullable'
        ]);

        $inputLoginDto = new InputLoginDto(
            $data["account"],
            $data["password"],
            $data["captcha"] ?? "",
            $data["captchaId"] ?? "",
        );

        $outputAuthUserInfoDto = $this->loginService->login($inputLoginDto);
        $userId = $outputAuthUserInfoDto->id;
        $jwtToken = $this->jwtService->genJwtToken($userId, JwtType::JwtToken);
        $refreshToken = $this->jwtService->genJwtToken($userId, JwtType::JwtRefreshToken);

        //存入 login ip and time
        //todo REMOTE_ADDR 拿到的是docker default gateway ip
        // $request->getClientIp();
        // $request->ip();
        $ip = $request->ip();
        $this->jwtService->setUserIdToRequest($jwtToken, $request);
        $this->loginService->setLoginInfo($userId, $ip);

        //todo 有時間在做 驗證 captcha
        $outputJwtDto = new OutputJwtDto($jwtToken, $refreshToken);
        $outputLoginDto = new OutputLoginDto($outputAuthUserInfoDto, $outputJwtDto);

        return $this->responseService->responseJson($outputLoginDto);
    }

    /**
     * @OA\Get(
     *  tags={"Jwt"},
     *  path="/api/v1/jwt",
     *  summary="更新JwtToken (RefreshJwtToken)",
     *  security={{"Authorization":{}}},
     *  @OA\Parameter(parameter="refreshtoken",in="query",name="refreshtoken",required=true,description="refreshtoken",@OA\Schema(type="string")),
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

        $token = $data->refreshtoken;
        $this->jwtService->validJwt($token, JwtType::JwtRefreshToken);

        $userId = $this->jwtService->getUserIdByJwtPayload($token);
        $userInfo = $this->jwtService->getUserInfoById($userId);
        $jwtToken = $this->jwtService->genJwtToken($userId, JwtType::JwtToken);
        $refreshToken = $this->jwtService->genJwtToken($userId, JwtType::JwtRefreshToken);
        $outputJwtDto = new OutputJwtDto($jwtToken, $refreshToken);
        $outputLoginDto = new OutputLoginDto(
            new OutputAuthUserInfoDto(
                $userInfo->getId(),
                $userInfo->getName(),
                $userInfo->getEmail(),
                $userInfo->getUserType(),
            ),
            $outputJwtDto
        );

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
     *  tags={"Login"},
     *  path="/api/v1/logout",
     *  summary="使用者登出 (User Logout)",
     *  security={{"Authorization":{}}},
     *  @OA\Response(response=200,description="OK",@OA\JsonContent(examples={"myname":@OA\Schema(ref="#/components/examples/LoginOut", example="LoginOut")})),
     *  @OA\Response(response=401,description="Unauthorized", @OA\JsonContent(ref="#/components/schemas/ResponseUnauthorized")),
     *  @OA\Response(response=500,description="Server Error",@OA\JsonContent(ref="#/components/schemas/responseError")),
     * )
     */
    public function logout(Request $request)
    {
        // userInfo
        $inputUserInfoDto = $this->jwtService->getUserInfoByRequest($request);
        $userId = $inputUserInfoDto->getId();

        //移除cache
        $this->cacheMamageService->removeCacheAuth($userId);

        return $this->responseService->responseJson();
    }

    /**
     * @OA\Get(
     *  tags={"Login"},
     *  path="/api/v1/password/forgot/check/{valicode}",
     *  summary="忘記密碼cachekey 確認(Forget password validation code)",
     *  @OA\Parameter(parameter="valicode",in="path",name="valicode",required=true,description="valicode",@OA\Schema(type="string")),
     *  @OA\Response(response=200,description="OK",@OA\JsonContent(ref="#/components/schemas/ResponseSuccess")),
     *  @OA\Response(response=500,description="Server Error",@OA\JsonContent(ref="#/components/schemas/responseError")),
     * )
     */
    public function pwdCheckValiCode(Request $request, $valicode)
    {

        $cacheName = $this->loginService->getPwdForgotCodeCacheNameByAccount($valicode);
        $account = $this->cacheService->getByJson($cacheName);

        if (empty($account)) {
            throw new ParameterException(trans('error.validation_code', ['type' => trans('error.user_authority_insufficinet')]), Response::HTTP_BAD_REQUEST);
        }

        return $this->responseService->responseJson();
    }

    /**
     * @OA\Get(
     *  tags={"Login"},
     *  path="/api/v1/password/validation/{account}",
     *  summary="忘記密碼驗證碼(Forget password validation code)",
     *  @OA\Parameter(parameter="account",in="path",name="account",required=true,description="account",@OA\Schema(type="string")),
     *  @OA\Response(response=200,description="OK",@OA\JsonContent(ref="#/components/schemas/ResponseSuccess")),
     *  @OA\Response(response=500,description="Server Error",@OA\JsonContent(ref="#/components/schemas/responseError")),
     * )
     */
    public function pwdValiCode(Request $request, $account)
    {
        //取得url
        $data = $request->query();

        $data["account"] = $account;
        $this->utilService->ColumnValidator($data, [
            'account' => 'required|max:100|email:rfc,dns',
            'url' => 'required',
        ]);

        $this->loginService->pwdForgotValidCodeAndEmail($account, $data["url"]);

        return $this->responseService->responseJson();
    }

    /**
     * @OA\Get(
     *  tags={"Login"},
     *  path="/api/v1/register/validation/{account}",
     *  summary="註冊帳號驗證碼(register account validation code)",
     *  @OA\Parameter(parameter="account",in="path",name="account",required=true,description="account",@OA\Schema(type="string")),
     *  @OA\Response(response=200,description="OK",@OA\JsonContent(ref="#/components/schemas/ResponseSuccess")),
     *  @OA\Response(response=500,description="Server Error",@OA\JsonContent(ref="#/components/schemas/responseError")),
     * )
     */
    public function regValiCode($account)
    {
        $data["account"] = $account;
        $this->utilService->ColumnValidator($data, [
            'account' => 'required|max:100|email:rfc,dns',
        ]);

        $this->loginService->regInValidCode($account);

        return $this->responseService->responseJson();
    }


    /**
     * @OA\Post(
     *  tags={"Login"},
     *  path="/api/v1/register",
     *  summary="一般使用者註冊(Customer Register)",
     *  @OA\RequestBody(@OA\JsonContent(ref="#/components/schemas/RegisterUser")),
     *  @OA\Response(response=200,description="OK",@OA\JsonContent(ref="#/components/schemas/ResponseSuccess")),
     *  @OA\Response(response=500,description="Server Error",@OA\JsonContent(ref="#/components/schemas/responseError")),
     * )
     */
    public function register(Request $request)
    {
        //取得api data
        $data = $request->all();

        //驗證
        $this->utilService->ColumnValidator($data, [
            'name' => 'required|max:50',
            'account' => 'required|max:100|email:rfc,dns',
            'password' => 'required|max:50|min:5',
            'validation' => 'required',
        ]);

        $userDto = new InputUserRoleDto(
            $data["name"],
            $data["account"],
            $data["password"],
            true,
            UserType::User->value,
            "",
            []
        );

        $cacheName = $this->loginService->getRegInCodeCacheNameByAccount($userDto->email);

        $this->loginService->validCacheValueByCacheName($cacheName, $data['validation'], trans('error.validation_code', ['type' => trans('error.register_in')]));
        $this->userService->createUser($userDto);
        $this->cacheService->removeCache($cacheName);

        return $this->responseService->responseJson();
    }

    /**
     * @OA\Post(
     *  tags={"Login"},
     *  path="/api/v1/password/forgot",
     *  summary="忘記(重置)密碼(User Register)",
     *  @OA\RequestBody(@OA\JsonContent(ref="#/components/schemas/ResetPassword")),
     *  @OA\Response(response=200,description="OK",@OA\JsonContent(ref="#/components/schemas/ResponseSuccess")),
     *  @OA\Response(response=500,description="Server Error",@OA\JsonContent(ref="#/components/schemas/responseError")),
     * )
     */
    public function resetPassword(Request $request)
    {
        //取得api data
        $data = $request->all();

        //驗證
        $this->utilService->ColumnValidator($data, [
            'newPassword' => 'required|max:50|min:5',
            'checkPassword' => 'required|max:50|min:5',
            'validation' => 'required|min:8',
        ]);

        $userPasswordDto = new InputUserPasswordDto(
            $data["newPassword"],
            $data["checkPassword"],
        );

        $validation = $data["validation"];
        $cacheName = $this->loginService->getPwdForgotCodeCacheNameByAccount($validation);
        $account = $this->cacheService->getByJson($cacheName);

        if (empty($account)) {
            throw new ParameterException(trans('error.validation_code', ['type' => trans('error.forgot_password')]), Response::HTTP_BAD_REQUEST);
        }

        $outputAuthUserInfoDto = $this->loginService->getUserInfoByLogin($account);
        $this->userService->updateUserPassword($userPasswordDto, $outputAuthUserInfoDto->id);
        $this->cacheService->removeCache($cacheName);

        return $this->responseService->responseJson();
    }
}
