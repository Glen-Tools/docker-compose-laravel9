<?php

namespace App\Http\Middleware;

use Closure;
use App\Dto\InputUserInfoDto;
use App\Services\LogService;
use Illuminate\Http\Request;

class LogRecord
{
    protected $logService;

    public function __construct(
        LogService $logService,
    ) {
        $this->logService = $logService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $this->logService->setLogInfo("MiddlewareLogRecord", new InputUserInfoDto(0, "", "", 0));
        return $next($request);
    }
}
