<?php

namespace App\Services;

use App\Dto\InputLogDto;
use App\Dto\InputUserInfoDto;
use App\Repositories\LogRepository;
use App\Services\JwtService;
use App\Services\AuthorizationService;
use Illuminate\Http\Request;

class LogService
{
    protected $logRepository;
    protected $request;
    protected $jwtService;
    protected $authorizationService;

    public function __construct(
        Request $request,
        JwtService $jwtService,
        AuthorizationService $authorizationService,
        LogRepository $logRepository
    ) {
        $this->request = $request;
        $this->jwtService = $jwtService;
        $this->authorizationService = $authorizationService;
        $this->logRepository = $logRepository;
    }

    public function create(InputLogDto $inputLogDto)
    {
        $this->logRepository->create($inputLogDto);
    }

    public function setLogInfo(string $opertateType, InputUserInfoDto $userInfo)
    {
        $uri = $this->request->path();
        $queryString = $this->request->getQueryString();
        if ($queryString) $uri = "$uri?$queryString";

        $feature = $this->authorizationService->getControllerFunc($this->request);
        $method = $this->request->method();
        $ip = $this->request->ip();

        $content = json_encode($this->request->all());

        $inputLogDto = new InputLogDto(
            $uri,
            $method,
            $feature,
            $ip,
            $opertateType,
            $userInfo->getId(),
            $content
        );

        $this->create($inputLogDto);
    }

    public function getUserInfo(): InputUserInfoDto
    {
        $controllerMethod = $this->authorizationService->getControllerFunc($this->request);

        $authOperate = $this->authorizationService->getAuthRouteMenuComparison();
        $userInfo = new InputUserInfoDto(0, "", "", 0);

        foreach (array_keys($authOperate) as  $value) {
            if ($value == $controllerMethod) {
                $userInfo = $this->jwtService->getUserInfoByRequest($this->request);
                break;
            }
        }

        return  $userInfo;
    }
}
