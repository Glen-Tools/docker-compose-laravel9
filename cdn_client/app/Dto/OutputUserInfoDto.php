<?php

namespace App\Dto;

class OutputUserInfoDto
{
    public $id;
    public $name;
    public $email;
    public $userType;

    public function __construct(int $id, string $name,  string $email, string $userType)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->userType = $userType;
    }
}
