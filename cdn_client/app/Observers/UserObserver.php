<?php

namespace App\Observers;

use App\Models\User;
use App\Services\JwtService;
use App\Services\LogService;
use App\Services\AuthorizationService;
use Illuminate\Http\Request;

class UserObserver extends BaseObserver
{
    public function __construct(
        Request $request,
        LogService $logService,
        JwtService $jwtService,
        AuthorizationService $authorizationService
    ) {
        parent::__construct($request, $logService, $jwtService, $authorizationService);
        $this->tableName = "users";
    }
}
