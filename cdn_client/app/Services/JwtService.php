<?php

namespace App\Services;

use App\Dto\InputPayloadDto;
use App\Dto\InputUserInfoDto;
use App\Dto\OutputUserInfoDto;
use App\Enums\JwtType;
use App\Exceptions\ParameterException;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JwtService
{

    private $utilService;
    private $userRepository;
    private $cacheService;

    protected const JWT_ISS = "CDN";
    protected const JWT_EXP_ADD_TIME = 7200;
    protected const JWT_REF_EXP_ADD_TIME = 14400;
    protected const DEFAULT_HEADER = '{"typ":"JWT","alg":"HS256"}';

    protected const REQUEST_USER_ID = "userId";
    protected const CACHE_TIME = 7200;
    protected const CACHE_USER_INFO = "CACHE_USER_INFO";

    protected const PREFIX_JWT_AUTH = "bearer";

    protected $header = null;

    public function __construct(
        UtilService $utilService,
        UserRepository $userRepository,
        CacheService $cacheService
    ) {
        $this->utilService = $utilService;
        $this->userRepository = $userRepository;
        $this->cacheService = $cacheService;
    }

    public function getJwtToken(Request $request): string
    {
        $jwt = $request->header('Authorization');

        //驗證 bearer
        $lenCompare = strlen($this::PREFIX_JWT_AUTH);
        $prefixJwt = substr($jwt, 0, $lenCompare);

        if (strncasecmp($prefixJwt, $this::PREFIX_JWT_AUTH, $lenCompare) !== 0) {
            throw new ParameterException(trans('error.unauthorized'), Response::HTTP_UNAUTHORIZED);
        }

        //驗證 token
        $jwtToken = substr($jwt, $lenCompare);
        $jwtToken = str_replace(" ", "", $jwtToken);

        return $jwtToken;
    }

    public function genJwtToken(int $userId, JwtType $type): string
    {
        $header = $this::DEFAULT_HEADER;

        $timeNow = Carbon::now()->timestamp;
        $exp = $timeNow;
        if ($type == JwtType::JwtRefreshToken) {
            $exp += env('JWT_REF_EXP_ADD_TIME', $this::JWT_REF_EXP_ADD_TIME);
        } else {
            $exp += env('JWT_EXP_ADD_TIME', $this::JWT_EXP_ADD_TIME);
        }

        $payload = array();
        $payload["iss"] = env("JWT_ISS", $this::JWT_ISS);
        $payload["exp"] = $exp;
        $payload["nbf"] = $timeNow;
        $payload["iat"] = $timeNow;
        $payload["tokenType"] = $type;
        $payload["userId"] = $userId;
        // $arrUserInfo = (array)$userInfoDto;
        // $payload = json_encode($this->utilService->arrayAppendToKeyValueArray($publicPayload, $arrUserInfo));

        $jwtHeader = $this->utilService->base64url_encode($header);
        $jwtPayload = $this->utilService->base64url_encode(json_encode($payload));
        $jwtHeaderPayload = "$jwtHeader.$jwtPayload";
        $jwtSecret = $this->utilService->base64url_encode(hash_hmac('sha256', $jwtHeaderPayload, env("JWT_SECRET"), true));

        return "$jwtHeaderPayload.$jwtSecret";
    }

    public function validJwt(string $jwt, JwtType $jwtType)
    {
        //驗證 sign
        $arrJwt = explode(".", $jwt);
        $jwtHeaderPayload = "{$arrJwt[0]}.{$arrJwt[1]}";
        $jwtSecret = $this->utilService->base64url_encode(hash_hmac('sha256', $jwtHeaderPayload, env("JWT_SECRET"), true));

        if (count($arrJwt) != 3 || $arrJwt[2] != $jwtSecret) {
            throw new ParameterException(trans('error.unauthorized'), Response::HTTP_UNAUTHORIZED);
        }

        //驗證 payload
        $payload = $this->parseJwtPayload($jwt);

        $validPayload = $this->validJwtPayload($payload, $jwtType);
        if (!$validPayload) {
            throw new ParameterException(trans('error.unauthorized'), Response::HTTP_UNAUTHORIZED);
        }
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

    public function setUserIdToRequest(string $jwt, Request $request)
    {
        $userId = $this->parseJwtPayload($jwt)->getUserId();
        $request->merge([$this::REQUEST_USER_ID => (int)$userId]);
    }

    public function getUserInfoByRequest(Request $request): InputUserInfoDto
    {
        $userId = (int)$request->get($this::REQUEST_USER_ID);
        return   $this->getUserInfoById($userId);
    }

    public function getUserInfoById(int $userId): InputUserInfoDto
    {
        $cacheNameUserInfo = $this->getUserInfoCacheById($userId);
        $userInfo =  $this->cacheService->getByJson($cacheNameUserInfo);

        if (isset($userInfo)) {
            return  new InputUserInfoDto(
                $userInfo->id,
                $userInfo->name,
                $userInfo->email,
                $userInfo->userType,
            );
        }

        $data =  $this->userRepository->getUserById($userId);
        $userInfo = (object)($data[0]);
        $inputUserInfoDto = new InputUserInfoDto(
            $userInfo->id,
            $userInfo->name,
            $userInfo->email,
            $userInfo->user_type,
        );

        $this->cacheService->putByJson($cacheNameUserInfo, $inputUserInfoDto, env("CACHE_TIME", $this::CACHE_TIME));
        return $inputUserInfoDto;
    }

    public function getUserInfoCacheById(int $id)
    {
        return $this::CACHE_USER_INFO . "_$id";
    }

    public function removeCacheUserInfo(int $id)
    {
        $cacheName = $this->getUserInfoCacheById($id);
        $this->cacheService->removeCache($cacheName);
    }

    public function getUserIdByJwtPayload(string $jwt): int
    {
        $inputPayloadDto = $this->parseJwtPayload($jwt);
        return $inputPayloadDto->getUserId();
    }

    private function parseJwtPayload(string $jwt): InputPayloadDto
    {
        $arrJwt = explode(".", $jwt);
        $jwtData = json_decode($this->utilService->base64url_decode($arrJwt[1]));

        try {
            //Payload data
            $inputPayloadDto = new InputPayloadDto(
                $jwtData->iss,
                $jwtData->exp,
                $jwtData->nbf,
                $jwtData->iat,
                $jwtData->tokenType,
                $jwtData->userId,
            );
        } catch (\Throwable $th) {
            throw new ParameterException(trans('error.unauthorized'), Response::HTTP_UNAUTHORIZED);
        }

        return $inputPayloadDto;
    }
}
