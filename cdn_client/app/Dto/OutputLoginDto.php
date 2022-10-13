<?php

namespace App\Dto;

class OutputLoginDto
{
    public $userInfo;
    public $authorisation;

    public function __construct(OutputUserInfoDto $userInfo, OutputJwtDto $authorisation)
    {
        $this->userInfo = $userInfo;
        $this->authorisation = $authorisation;
    }
}
