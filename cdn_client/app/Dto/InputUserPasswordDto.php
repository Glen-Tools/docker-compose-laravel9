<?php

namespace App\Dto;

class InputUserPasswordDto
{
    public readonly ?string $password;
    public readonly string $newPassord;
    public readonly string $checkPassord;

    public function __construct(string $password, string $newPassord, string $checkPassord)
    {
        $this->password = $password;
        $this->newPassord = $newPassord;
        $this->checkPassord = $checkPassord;
    }
}
