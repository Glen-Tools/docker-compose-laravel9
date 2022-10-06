<?php

namespace App\Observers;

use App\Services\JwtService;
use App\Services\LogService;
use Illuminate\Http\Request;

class MenuObserver extends BaseObserver
{
    public function __construct(
        Request $request,
        LogService $logService,
        JwtService $jwtService
    ) {
        parent::__construct($request, $logService, $jwtService);
        $this->tableName = "menus";
    }
}
