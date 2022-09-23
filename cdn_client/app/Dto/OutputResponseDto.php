<?php

namespace App\Dto;

class OutputResponseDto
{
    public $data;
    public $message;
    public $success;

    public function __construct($data = null, $message = "", $success = true)
    {
        $this->data = $data;
        $this->message = $message;
        $this->success = $success;
    }
}