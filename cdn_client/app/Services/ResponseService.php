<?php

namespace App\Services;

use App\Dto\InputPageDto;
use App\Dto\OutputResponseDto;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class ResponseService
{

    protected $logService;
    private $outputResponseDto;

    public function __construct(
        LogService $logService,
        OutputResponseDto $outputResponseDto
    ) {
        $this->logService = $logService;
        $this->outputResponseDto = $outputResponseDto;
    }

    public function responseJson($data = null, $message = "", $success = true, int $status = 200)
    {
        //log record
        $inputUserInfoDto = $this->logService->getUserInfo();
        $this->logService->setLogInfo("ResponseJson", $inputUserInfoDto);

        $this->outputResponseDto->data = $data;
        $this->outputResponseDto->message = $message;
        $this->outputResponseDto->success = $success;
        return response()->json($this->outputResponseDto, $status);
    }
}
