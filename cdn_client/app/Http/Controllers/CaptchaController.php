<?php

namespace App\Http\Controllers;

use App\Services\ResponseService;
use App\Services\UtilService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;
use App\Facades\Captcha;
use App\Enums\CaptchaType;

class CaptchaController extends Controller
{
    private $utilService;
    private $responseService;

    public function __construct(
        UtilService $utilService,
        ResponseService $responseService
    ) {
        $this->utilService = $utilService;
        $this->responseService = $responseService;
    }

    /**
     * @OA\Get(
     *  tags={"Captcha"},
     *  path="/api/v1/captcha/create/{config}",
     *  summary="驗證碼 (Validation Code Create)",
     *  @OA\Parameter(parameter="config",in="path",name="config",description="config", explode=true,
     *      @OA\Schema(type="string",enum = \App\Enums\CaptchaType::class)),
     *  @OA\Response(response=200,description="OK",@OA\JsonContent(examples={"myname":@OA\Schema(ref="#/components/examples/CreateCaptcha", example="CreateCaptcha")})),
     *  @OA\Response(response=500,description="Server Error",@OA\JsonContent(ref="#/components/schemas/responseError")),
     * )
     */
    public function getCaptcha($config)
    {
        $this->utilService->ColumnValidator(['config' => $config], [
            'config' => [new Enum(CaptchaType::class)],
        ]);

        // return $this->responseService->responseJson(CaptchaType::);
        // $config = $config ?? 'default';
        $data['captcha'] = Captcha::create($config, true);

        return $this->responseService->responseJson($data);
    }

    /**
     * @OA\Post(
     *  tags={"Captcha"},
     *  path="/api/v1/captcha",
     *  summary="檢查驗證碼 (Validation Code Checked)",
     *  @OA\RequestBody(@OA\JsonContent(ref="#/components/schemas/CheckCaptcha")),
     *  @OA\Response(response=200,description="OK",@OA\JsonContent(ref="#/components/schemas/ResponseSuccess")),
     *  @OA\Response(response=500,description="Server Error",@OA\JsonContent(ref="#/components/schemas/responseError")),
     * )
     */
    public function checkCaptcha(Request $request)
    {
        //取得api data
        $data = $request->all();

        //驗證
        $this->utilService->ColumnValidator($data, [
            'config' => [new Enum(CaptchaType::class)],
            'key' => 'required|max:150',
            'captcha' => 'required|max:50'
        ]);

        $config = $data["config"] ?? 'default';
        $data = Captcha::check_api($data["captcha"], $data["key"], $config);

        return $this->responseService->responseJson($data);
    }
}
