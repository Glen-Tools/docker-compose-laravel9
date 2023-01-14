<?php

namespace App\Dto;

class OutputResponseDto
{
    public mixed $data;
    public string $message;
    public bool $success;

    public function __construct(mixed $data = null,string $message = "",bool $success = true)
    {
        $this->data = $data;
        $this->message = $message;
        $this->success = $success;
    }
}
