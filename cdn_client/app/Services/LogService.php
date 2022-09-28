<?php

namespace App\Services;

use App\Dto\InputLogDto;
use App\Repositories\LogRepository;

class LogService
{
    protected $logRepository;

    public function __construct(LogRepository $logRepository)
    {
        $this->logRepository = $logRepository;
    }

    public function create(InputLogDto $inputLogDto)
    {
        $this->logRepository->create($inputLogDto);
    }
}
