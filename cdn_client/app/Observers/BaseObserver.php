<?php

namespace App\Observers;

use App\Dto\InputLogDto;
use App\Services\LogService;
use Illuminate\Http\Request;

class BaseObserver
{

    protected $request;
    protected $logService;
    protected $tableName;

    public function __construct(Request $request, LogService $logService)
    {
        $this->request = $request;
        $this->logService = $logService;
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
        //todo userId 先給1,等jwt 做完則修改
        $userId = 1;

        $inputLogDto = new InputLogDto(
            $feature,
            $operate,
            $this->tableName,
            $content,
            $userId
        );

        $this->logService->create($inputLogDto);
    }
}
