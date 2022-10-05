<?php

namespace App\Http\Controllers;

use App\Dto\InputLoginDto;
use App\Services\LoginService;
use App\Services\ResponseService;
use App\Services\UtilService;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    private $utilService;
    private $loginService;
    private $responseService;

    public function __construct(
        UtilService $utilService,
        LoginService $loginService,
        ResponseService $responseService
    ) {
        $this->utilService = $utilService;
        $this->loginService = $loginService;
        $this->responseService = $responseService;
    }

    /**
     * @OA\Post(
     *  tags={"User"},
     *  path="/api/v1/user",
     *  summary="新增使用者(User Create)",
     *  security={{"Authorization":{}}},
     *  @OA\Response(response=200,description="OK",@OA\JsonContent(ref="#/components/schemas/ResponseSuccess")),
     *  @OA\RequestBody(@OA\JsonContent(ref="#/components/schemas/CreateUser")),
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
            'password' => 'required|max:50',
            'captcha' => 'max:50'
            // 'captcha' => 'required|max:50'
        ]);

        $inputLoginDto = new InputLoginDto(
            $data["account"],
            $data["password"],
            $data["captcha"] ?? "",
        );

        $outputLoginDto = $this->loginService->login($inputLoginDto);

        // //jwk token
        // $User

        return $this->responseService->responseJson($outputLoginDto);
    }
}
