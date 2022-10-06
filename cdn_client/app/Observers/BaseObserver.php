<?php

namespace App\Observers;

use App\Dto\InputLogDto;
use App\Services\JwtService;
use App\Services\LogService;
use Illuminate\Http\Request;

class BaseObserver
{

    protected $request;
    protected $logService;
    protected $tableName;
    protected $userInfo;

    public function __construct(
        Request $request,
        LogService $logService,
        JwtService $jwtService
    ) {
        $this->request = $request;
        $this->logService = $logService;
        $this->userInfo = $jwtService->getUserInfoByRequest($request);
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
        //
    }

    protected function setLogInfo(string $operate)
    {
        $uri = $this->request->path();
        $queryString = $this->request->getQueryString();
        $feature = "$uri?$queryString";
        $content = json_encode($this->request->all());

        $inputLogDto = new InputLogDto(
            $feature,
            $operate,
            $this->tableName,
            $content,
            $this->userInfo->getId()
        );

        $this->logService->create($inputLogDto);
    }
}
