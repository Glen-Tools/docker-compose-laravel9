<?php

namespace App\Dto;

class InputUserPasswordDto
{
    public readonly ?string $password;
    public readonly string $newPassword;
    public readonly string $checkPassword;

    public function __construct(string $password, string $newPassword, string $checkPassword)
    {
        $this->password = $password;
        $this->newPassword = $newPassword;
        $this->checkPassword = $checkPassword;
    }
}
