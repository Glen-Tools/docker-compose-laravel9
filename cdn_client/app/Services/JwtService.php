<?php

namespace App\Services;

use App\Dto\InputPayloadDto;
use App\Dto\InputUserInfoDto;
use App\Dto\OutputUserInfoDto;
use App\Enums\JwtType;
use App\Exceptions\ParameterException;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JwtService
{

    protected $utilService;
    protected const REQUEST_USER_INFO = "userInfo";
    protected const JWT_ISS = "CDN";
    protected const JWT_EXP_ADD_TIME = 7200;
    protected const JWT_REF_EXP_ADD_TIME = 14400;
    protected const DEFAULT_HEADER = '{"typ":"JWT","alg":"HS256"}';

    protected $header = null;

    public function __construct(UtilService $utilService)
    {
        $this->utilService = $utilService;
    }

    // public function setHeader(string $header)
    // {
    //     if ($this->utilService->isJson($header)) {
    //         $this->header = $header;
    //     }
    // }
    public function getJwtToken(string $jwt): string
    {
        if (str_contains($jwt, "bearer") || str_contains($jwt, "Bearer")) {
            $jwtToken = str_replace(["Bearer", "bearer", " "], "", $jwt);
        } else {
            throw new ParameterException(trans('error.unauthorized'), Response::HTTP_BAD_REQUEST);
        }
        return $jwtToken;
    }

    public function genJwtToken(OutputUserInfoDto $userInfoDto, JwtType $type): string
    {
        // $header = $this->header ?? $this::DEFAULT_HEADER;
        $header = $this::DEFAULT_HEADER;

        $arrUserInfo = (array)$userInfoDto;
        $timeNow = Carbon::now()->timestamp;
        $exp = $timeNow;
        if ($type == JwtType::jwtRefreshToken) {
            $exp += env('JWT_REF_EXP_ADD_TIME', $this::JWT_REF_EXP_ADD_TIME);
        } else {
            $exp += env('JWT_EXP_ADD_TIME', $this::JWT_EXP_ADD_TIME);
        }

        $publicPayload = array();
        $publicPayload["iss"] = env("JWT_ISS", $this::JWT_ISS);
        $publicPayload["exp"] = $exp;
        $publicPayload["nbf"] = $timeNow;
        $publicPayload["iat"] = $timeNow;
        $publicPayload["tokenType"] = $type;

        $payload = json_encode($this->utilService->arrayAppendToKeyValueArray($publicPayload, $arrUserInfo));

        $jwtHeader = $this->utilService->base64url_encode($header);
        $jwtPayload = $this->utilService->base64url_encode($payload);
        $jwtHeaderPayload = "$jwtHeader.$jwtPayload";
        $jwtSecret = $this->utilService->base64url_encode(hash_hmac('sha256', $jwtHeaderPayload, env("JWT_SECRET"), true));

        return "$jwtHeaderPayload.$jwtSecret";
    }

    public function validJwtSign(string $jwt): bool
    {
        $arrJwt = explode(".", $jwt);
        if (count($arrJwt) != 3) {
            return false;
        }

        $jwtHeaderPayload = "{$arrJwt[0]}.{$arrJwt[1]}";

        $jwtSecret = $this->utilService->base64url_encode(hash_hmac('sha256', $jwtHeaderPayload, env("JWT_SECRET"), true));
        if ($arrJwt[2] != $jwtSecret) {
            return false;
        }

        return true;
    }

    private function parseJwtPayload(string $jwt): InputPayloadDto
    {

        $arrJwt = explode(".", $jwt);
        $jwtData = json_decode($this->utilService->base64url_decode($arrJwt[1]));

        $outputUserInfoDto = new OutputUserInfoDto(
            $jwtData->id,
            $jwtData->name,
            $jwtData->email,
            $jwtData->userType
        );

        $inputPayloadDto = new InputPayloadDto(
            $jwtData->iss,
            $jwtData->exp,
            $jwtData->nbf,
            $jwtData->iat,
            $jwtData->tokenType,
            $outputUserInfoDto
        );
        return $inputPayloadDto;
    }

    private function validJwtPayload(InputPayloadDto $payload, JwtType $type): bool
    {

        $now = Carbon::now()->timestamp;
        $exp = $payload->getExp();
        $nbf = $payload->getNbf();
        $iat = $payload->getIat();
        $tokenType = $payload->getTokenType();
        if (
            $exp >= $now &&
            $nbf <= $now &&
            $iat <= $now &&
            $tokenType == $type->value
        ) {
            return true;
        }

        return false;
    }

    public function getUserInfoByRefreshJwtToken(string $jwt): OutputUserInfoDto
    {
        $validSign = $this->validJwtSign($jwt);
        if (!$validSign) {
            throw new ParameterException(trans('error.unauthorized'), Response::HTTP_BAD_REQUEST);
        }

        $payload = $this->parseJwtPayload($jwt);

        $validPayload = $this->validJwtPayload($payload, JwtType::jwtRefreshToken);
        if (!$validPayload) {
            throw new ParameterException(trans('error.unauthorized'), Response::HTTP_BAD_REQUEST);
        }

        $userInfoDto = $payload->getUserInfo();
        return  $userInfoDto;
    }

    public function setUserInfoToRequest(string $jwt, Request $request)
    {
        $validSign = $this->validJwtSign($jwt);
        if (!$validSign) {
            throw new ParameterException(trans('error.unauthorized'), Response::HTTP_BAD_REQUEST);
        }

        $payload = $this->parseJwtPayload($jwt);
        $userInfoDto = $payload->getUserInfo();

        $validPayload = $this->validJwtPayload($payload, JwtType::jwtToken);
        if (!$validPayload) {
            throw new ParameterException(trans('error.unauthorized'), Response::HTTP_BAD_REQUEST);
        }

        $request->merge([$this::REQUEST_USER_INFO => (array)$userInfoDto]);
    }

    public function getUserInfoByRequest(Request $request): InputUserInfoDto
    {
        $data = (object)$request->get($this::REQUEST_USER_INFO);
        $userInfo = new InputUserInfoDto(
            $data->id,
            $data->name,
            $data->email,
            $data->userType,
        );
        return  $userInfo;
    }
}
