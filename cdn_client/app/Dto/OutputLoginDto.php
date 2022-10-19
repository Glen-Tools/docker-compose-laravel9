<?php

namespace App\Dto;

class OutputLoginDto
{
    public mixed $userInfo;
    public mixed $authorisation;

    public function __construct(OutputUserInfoDto $userInfo, OutputJwtDto $authorisation)
    {
        $this->userInfo = $userInfo;
        $this->authorisation = $authorisation;
    }
}
