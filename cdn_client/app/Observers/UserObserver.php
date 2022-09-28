<?php

namespace App\Observers;

use App\Models\User;
use App\Services\LogService;
use Illuminate\Http\Request;

class UserObserver extends BaseObserver
{
    public function __construct(Request $request, LogService $logService)
    {
        parent::__construct($request, $logService);
        $this->tableName = "users";
    }
}
