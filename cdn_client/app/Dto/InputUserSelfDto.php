<?php

namespace App\Dto;

class InputUserSelfDto
{
    public readonly string $name;
    public readonly string $email;

    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }
}
