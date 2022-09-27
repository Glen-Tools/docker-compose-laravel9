<?php

namespace App\Services;

use App\Dto\InputPageDto;
use App\Dto\OutputResponseDto;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class ResponseService
{

    private $outputResponseDto;

    public function __construct(OutputResponseDto $outputResponseDto)
    {
        $this->outputResponseDto = $outputResponseDto;
    }

    public function responseJson($data = null, $message = "", $success = true, int $status = 200)
    {
        $this->outputResponseDto->data = $data;
        $this->outputResponseDto->message = $message;
        $this->outputResponseDto->success = $success;
        return response()->json($this->outputResponseDto, $status);
    }
}
