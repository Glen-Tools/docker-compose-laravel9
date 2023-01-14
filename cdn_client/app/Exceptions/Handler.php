<?php

namespace App\Exceptions;

use App\Dto\OutputResponseDto;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Database\MultipleRecordsFoundException;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Routing\Exceptions\BackedEnumCaseNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Exception\SuspiciousOperationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Log;
use Exception;
use Psr\Log\LogLevel;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        ValidationException::class => LogLevel::INFO,
        ParameterException::class => LogLevel::INFO,
        NotFoundHttpException::class => LogLevel::INFO,
        MethodNotAllowedHttpException::class => LogLevel::INFO,
    ];


    /**
     * A list of the internal exception types that should not be reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $internalDontReport = [
        AuthenticationException::class,
        AuthorizationException::class,
        BackedEnumCaseNotFoundException::class,
        MultipleRecordsFoundException::class,
        RecordsNotFoundException::class,
        SuspiciousOperationException::class,
        TokenMismatchException::class,
        ModelNotFoundException::class,

        // HttpException::class,
        // HttpResponseException::class,
        // ValidationException::class,
    ];


    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        // $this->reportable(function (Throwable $e) {
        // });

        $this->renderable(function (Throwable $e, $request) {
            return $this->handleException($request, $e);
        });
    }

    // private function handleLog($request, Throwable $exception)
    // {
    // }

    /**
     * Handle response from exception.
     *
     * @param Request $request
     * @param \Exception $exception
     * @return JsonResponse|null
     */
    private function handleException($request, Throwable $exception)
    {
        //回傳 Response dto
        $outputResponseDto = new OutputResponseDto();
        $outputResponseDto->data = null;
        $outputResponseDto->success = false;

        if ($exception instanceof ValidationException) { //驗證錯誤 回參數錯誤
            $msg = $this->getValidExceptionError($exception);
            $outputResponseDto->message = trans('error.parameter', ["msg" => $msg]);
            return response()->json($outputResponseDto,  Response::HTTP_BAD_REQUEST);
        }

        if ($exception instanceof ParameterException) { //自訂錯誤
            $outputResponseDto->message = $exception->errors();
            return response()->json($outputResponseDto,  $exception->getCode());
        }

        if ($exception instanceof NotFoundHttpException) { //404 or method is not supported for this route
            $outputResponseDto->message = trans('error.not_found');
            return response()->json($outputResponseDto,  Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof MethodNotAllowedHttpException) { //405 method is not supported for this route
            $outputResponseDto->message = trans('error.not_found_http_method');
            return response()->json($outputResponseDto,  Response::HTTP_METHOD_NOT_ALLOWED);
        }

        // Log::error($exception);
        $outputResponseDto->message = trans('error.server');
        return response()->json($outputResponseDto, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    private function getValidExceptionError($exception): string
    {
        $msg = "";
        if (env("APP_DEBUG") == true) {
            $msg = $exception->errors();
            if (is_array($msg)) {
                $msg =  rtrim($this->getKeyAndValueToString($msg), ",");
            }
            $msg = "," . $msg;
        }
        return $msg;
    }

    private function getKeyAndValueToString(array $data): string
    {
        $keyValue = "";

        foreach ($data as $key => $value) {
            if (gettype($value) == "string" && !empty($value) && !empty($key)) {
                $keyValue .= "$key:$value,";
            } else if (gettype($key) == "string" && !empty($key)) {
                $keyValue .= "$key:";
            } else if (gettype($value) == "string" && !empty($value)) {
                $keyValue .= "$value,";
            }
            if (is_array($value)) {
                $keyValue .= $this->getKeyAndValueToString($value);
            }
        }
        return $keyValue;
    }
}
