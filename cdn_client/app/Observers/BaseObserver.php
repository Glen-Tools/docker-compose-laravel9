<?php

namespace App\Observers;

use App\Services\LogService;

class BaseObserver
{
    protected $request;
    protected $logService;
    protected $tableName;
    protected $jwtService;
    protected $authorizationService;

    public function __construct(
        LogService $logService
    ) {
        $this->logService = $logService;
    }

    /**
     * Handle the table "created" event.
     *
     * @return void
     */
    public function created($table)
    {
        $this->logService->setLogInfo("created");
    }

    /**
     * Handle the table "updated" event.
     *
     * @return void
     */
    public function updated($table)
    {
        $this->logService->setLogInfo("updated");
    }

    /**
     * Handle the table "deleted" event.
     *
     * @return void
     */
    public function deleted($table)
    {
        $this->logService->setLogInfo("deleted");
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
        $this->logService->setLogInfo("deleted");
    }
}
