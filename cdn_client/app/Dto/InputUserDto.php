<?php

namespace App\Dto;

class InputUserDto
{
    public readonly string $name;
    public readonly string $email;
    public readonly string $password;
    public readonly bool $status;
    public readonly int $userType;
    public readonly ?string $remark;

    public function __construct(string $name, string $email, string $password, bool $status, int $userType, string $remark)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->status = $status;
        $this->userType = $userType;
        $this->remark = $remark;
    }
}
