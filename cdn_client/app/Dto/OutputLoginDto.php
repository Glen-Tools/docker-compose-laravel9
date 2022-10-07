<?php

namespace App\Dto;

class OutputLoginDto
{
    public $user;
    public $authorisation;

    public function __construct(OutputUserInfoDto $user, OutputJwtDto $authorisation)
    {
        $this->user = $user;
        $this->authorisation = $authorisation;
    }
}
