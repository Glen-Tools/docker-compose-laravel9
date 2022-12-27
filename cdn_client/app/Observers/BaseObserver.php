<?php

namespace App\Observers;

use App\Dto\InputLogDto;
use App\Dto\InputUserInfoDto;
use App\Services\JwtService;
use App\Services\LogService;
use App\Services\AuthorizationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BaseObserver
{
    protected $request;
    protected $logService;
    protected $tableName;
    protected $jwtService;
    protected $authorizationService;

    public function __construct(
        Request $request,
        LogService $logService,
        JwtService $jwtService,
        AuthorizationService $authorizationService
    ) {
        $this->request = $request;
        $this->logService = $logService;
        $this->jwtService = $jwtService;
        $this->authorizationService = $authorizationService;
    }

    /**
     * Handle the table "created" event.
     *
     * @return void
     */
    public function created($table)
    {
        $this->setLogInfo("created");
    }

    /**
     * Handle the table "updated" event.
     *
     * @return void
     */
    public function updated($table)
    {
        $this->setLogInfo("updated");
    }

    /**
     * Handle the table "deleted" event.
     *
     * @return void
     */
    public function deleted($table)
    {
        $this->setLogInfo("deleted");
    }

    /**
     * Handle the table "restored" event.
     *
     * @return void
     */
    public function restored($table)
    {
        //
    }

    /**
     * Handle the table "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted($table)
    {
        $this->setLogInfo("deleted");
    }

    protected function setLogInfo(string $operate)
    {
        $uri = $this->request->path();
        $queryString = $this->request->getQueryString();
        if ($queryString) $uri = "$uri?$queryString";

        $feature = $this->authorizationService->getControllerFunc($this->request);
        $method = $this->request->method();

        $content = json_encode($this->request->all());

        $userInfo = $this->getUserInfo();

        $inputLogDto = new InputLogDto(
            $uri,
            $method,
            $feature,
            $operate,
            $this->tableName,
            $content,
            $userInfo->getId()
        );

        $this->logService->create($inputLogDto);
    }

    protected function getUserInfo(): InputUserInfoDto
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
