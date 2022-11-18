<?php

namespace App\Dto;

class InputUserPasswordDto
{
    public readonly string $newPassword;
    public readonly string $checkPassword;

    public function __construct(string $newPassword, string $checkPassword)
    {
        $this->newPassword = $newPassword;
        $this->checkPassword = $checkPassword;
    }
}
