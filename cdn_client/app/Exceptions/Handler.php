<?php

namespace App\Exceptions;

use App\Dto\OutputResponseDto;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Exception;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
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
        //     //
        // });

        $this->renderable(function (Exception $e, $request) {
            return $this->handleException($request, $e);
        });
    }

    /**
     * Handle response from exception.
     *
     * @param Request $request
     * @param \Exception $exception
     * @return JsonResponse|null
     */
    private function handleException($request, Exception $exception)
    {
        //回傳 Response dto
        $outputResponseDto = new OutputResponseDto();
        $outputResponseDto->data = null;
        $outputResponseDto->success = false;

        if ($exception instanceof ValidationException || $exception instanceof ParameterException) { //驗證錯誤 回參數錯誤
            if (env("APP_DEBUG") == true) {
                $msg = $exception->errors();
                if (gettype($msg) != "string") {
                    $msg = json_encode($msg);
                }
            }
            $outputResponseDto->message = __('error.parameter', ["msg" => $msg]);
            return response()->json($outputResponseDto,  Response::HTTP_BAD_REQUEST);
        }

        if ($exception instanceof NotFoundHttpException) { //404
            $outputResponseDto->message = __('error.not_found');
            return response()->json($outputResponseDto,  Response::HTTP_NOT_FOUND);
        }

        $outputResponseDto->message = __('error.server');
        return response()->json($outputResponseDto, Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
